<?php

namespace controllers;
use PDO;
class SubjectController 
{
    public $con;
    public $course_ids;
    public function __construct($con) {
        $this->con=$con;
    }
    public function subjectList($id,$pagecuurent,$collegeId)
    {  // echo  $collegeId;
        //$ids=array();
        $query1=
                $this->con->
                    prepare("select 
                                 college_name.id as cid,
                                 college_name.name as cname,
                                
                                 (select 
                                        count(subject.id)
                                    from 
                                        subject
                                    INNER JOIN
                                        course
                                    On  
                                        course.id=subject.course_id
                                    INNER JOIN
                                        college_name
                                    on
                                        college_name.id=course.college_id
                                     ) as subCountId
                                 
                            from
                                college_name 
                           
                                    ");
        $query1->execute();
        $countId=array(
                'all_details'=>array(),
                 );
        while($row=$query1->FETCH(PDO::FETCH_ASSOC)){
           // echo $row['subCountId'];
            array_push($countId['all_details'],array
                    (
                      'cname'=>$row['cname'],
                      'collegeid'=>$row['cid'],
                      'subCountId'=>$row['subCountId']
                     
                      
                    ));
            $totalRecord = $row['subCountId'];

            $totalPage = ceil($totalRecord/10);
        }
        $query2=
                $this->con->
                    prepare("select 
                                *
                            from
                               course
                            where
                              college_id=$collegeId");
        $query2->execute();
        $course=array(
                'course_details'=>array()
                 );
        while($row=$query2->FETCH(PDO::FETCH_ASSOC)){
            array_push($course['course_details'],array
                    (
                      'name'=>$row['name'],
                      'id'=>$row['id'],
                      'collegeId'=>$collegeId
                    ));
        }
        //print_r($course);        echo 'bfgh';
        if($totalPage < $pagecuurent){
            $pagecuurent--; 
        }
        $page1=$pagecuurent*10-10;
        $page2=$pagecuurent*10;
       $querySubject=
               $this->con->
               prepare("
                        select 
                             subject.name as subname,
                             subject.id as subid
                                
			from 
                             subject
			INNER JOIN
                            course
                        on
                            course.id=subject.course_id
                        INNER JOIN
                            college_name
                        on
                            college_name.id=course.college_id
                        LIMIT
                            $page1,$page2
                        
                        ");
        $querySubject->execute();
        $subjectArray=
                     array(      
                        'college_details' =>array(),
                        'subject_details'=>array(),
                        'ids'=>array()
                        );
       
        
        $perPage=10;
        $subjectArray['college_details']=
                    array(
                            'id'=>$countId,
                            'course'=>$course
                            
                        );
        while($row=$querySubject->FETCH(PDO::FETCH_ASSOC)){
             $subjectArray['college_details']=
                    array(
                            'id'=>$countId,
                            'course'=>$course
                            
                        );
           // $page= ceil($row['countId']/$perPage);
              //$totalRecord = $row['xntsubId'];

            
            $next = min($totalPage , $pagecuurent + 1);
            $prev = max(0, $pagecuurent - 1);
            $first=1;
            $last=$totalPage;
                array_push($subjectArray['subject_details'],
                        array(
                                'subname'=>$row['subname'],
                                'subid'=>$row['subid'],
                                'countId'=>$countId,
                                'page'=>$totalPage,
                                'next'=>$next,
                                'pagecuurent'=>$pagecuurent,
                                'prev'=>$prev,
                                'first'=>$first,
                                'last'=>$last

                                )
                        );
           } //$subjectArray['ids']=array('idcourse'=>$id); 
       // print_r($subjectArray);
        array_push($subjectArray['ids'],array('id'=>$id) );
       //print_r($subjectArray);
     return $subjectArray ;
    }
    public function subjectCreate($id,$subjectName) 
    {        
        $queryCourseName=
            $this->con->
                prepare("insert into 
                            subject
                            (name,course_id)
                         values
                            (:subjectName,:userId) ");
        $queryCourseName->bindValue(':subjectName',$subjectName);
        $queryCourseName->bindValue(':userId',$id);
        $queryCourseName->execute();
        return $queryCourseName;
    }
    public function subjectSelectEdit($id,$page)
    {     
       $querySubject=
               $this->con->
                  prepare("
    		    select 
			    *
                    from 
			subject
                    where  
			id = $id  " );
            $querySubject->execute();
            $subjectArray=
                        array(
                            'subject_details' =>array(),
                            );
                          //array_push($couseArray, $ids);
            while($row=$querySubject->FETCH(PDO::FETCH_ASSOC)){
                    array_push($subjectArray['subject_details'],
                            array(
                                    'id'=>$row['id'],
                                    'name'=>$row['name'],
                                    'course_id'=>$row['course_id'],
                                    'page'=>$page
                                    )
                    );
            }
	   return $subjectArray;
    }
    public function subjectDelete($id) 
    {
         $select= $this->con->prepare("Delete
                                                                                   
                                      FROM 
                                            subject
                                      where
                                            id=:id");
        $select->bindValue(':id',$id);
        $select->execute();
        return $select;
    }
    public function subjectEdit($id,$courseName) 
    {
        $select= 
                $this->con->
                prepare("UPDATE
                                subject
                            SET
                                 name=:name
                            where
                                 id=:id");
        $select->bindValue(':name',$courseName);
        $select->bindValue(':id',$id);
        $select->execute();
        return $select;
    }
    public function subjectRoute($routeArray) 
    {
        if(in_array('subjectinsert', $routeArray)){
                $id = isset($_GET['id'])?$_GET['id']:NULL;
                $courseId= $this->subjectinsert($id);
                 include_once '/view/subject/subjectlist.php';
        }
        if(in_array('subjectcreate',$routeArray))
        {            
              
                if(isset($_POST['subject_name']))
                {
                    
                    if(empty($subjectName=$_POST['subject']) && empty( $id=$_POST['course_id']) && empty($collegeId=$_POST['collegeId']))
                    {
                            $_SESSION['k'] = array(
                                'test' => true
                            );
                           $error="plz Subject name input fild";
                           $_SESSION['error']=$error;
                           $_SESSION['college'] = array(
                                    'test' => true
                                );
                           $error1="plz college Select fild";
                           $_SESSION['error1']=$error1; 
                           $_SESSION['course'] = array(
                                            'test' => true
                                        );
                           $error2="plz course Select fild";
                           $_SESSION['error2']=$error2; 
                          header("Location:index.php?route=admin/subjectlist");
                           //return $error;
                          // echo "plz college name input fild";
                    }
                    else
                   {       echo $subjectName;
                           echo $collegeId=$_POST['collegeId'];
                           if($subjectName!=""){
                                if (preg_match('/^[a-z]{0,10}$/', $subjectName)){
                                     $_SESSION['subjecrName'] = array(
                                    'test' => true
                                     );
                                     $_SESSION['subject']=$subjectName;
                                    if($collegeId=="")
                                    {
                                        $_SESSION['subjectName'] = array(
                                                    'test' => true
                                                    );
                                        $_SESSION['subject']=$subjectName;
                                           echo $collegeId;
                                        $_SESSION['college'] = array(
                                           'test' => true
                                                        );
                                        $error1="plz college Select fild";
                                        $_SESSION['error1']=$error1; 
                                        $_SESSION['k'] = array(
                                        'test' => true
                                                     );
                                        $error="plz Subject name input fild";
                                        $_SESSION['error']=$error;
                                        header("Location:index.php?route=admin/subjectlist");
                                     //return $error1;
                                    // echo "plz college name input fild";
                                    } 
                                    else {
                                           if($subjectName==""){
                                               $_SESSION['k'] = array(
                                               'test' => true
                                                            );
                                               $error="plz Subject name input fild";
                                               $_SESSION['error']=$error;
                                               
                                           }
                                        if($id=="")
                                            {
                                            $_SESSION['subjectName'] = array(
                                                    'test' => true
                                                    );
                                            $_SESSION['subject']=$subjectName;
                                            $_SESSION['collegeName'] = array(
                                                    'test' => true
                                                    );
                                            $_SESSION['colleges']=$collegeId;
                                                echo $collegeId;
                                            $_SESSION['course'] = array(
                                                'test' => true
                                            );
                                            $_SESSION['k'] = array(
                                                'test' => true
                                                    );
                                            $error="plz Subject name input fild";
                                            $_SESSION['error']=$error;
                                           // $_SESSION['error']=$subjectName;
                                            $_SESSION['error']=$subjectName;
                                            $_SESSION['error1']=$collegeId;
                                            $error2="plz course Select fild";
                                            $_SESSION['error2']=$error2; 
                                             header("Location:index.php?route=admin/subjectlist");
                                             return $error2;
                                            // echo "plz college name input fild";
                                            }
                                        else {

                                            $collegeCreate= $this->subjectCreate($id,$subjectName);
                                            header("Location:index.php?route=admin/subjectlist&id=$id");
                                        }
                                    }


                                }
                                else {
                                     $_SESSION['k'] = array(
                                    'test' => true
                                            );
                               $error="Invalid String $subjectName";
                               $_SESSION['error']=$error;
                                 header("Location:index.php?route=admin/subjectlist");

                                }
                            
                           }
                           else{
                               
                             if($collegeId=="")
                                    {
                                        $_SESSION['subjectName'] = array(
                                                    'test' => true
                                                    );
                                        $_SESSION['subject']=$subjectName;
                                           echo $collegeId;
                                        $_SESSION['college'] = array(
                                           'test' => true
                                                        );
                                        $error1="plz college Select fild";
                                        $_SESSION['error1']=$error1; 
                                        $_SESSION['k'] = array(
                                        'test' => true
                                                     );
                                        $error="plz Subject name input fild";
                                        $_SESSION['error']=$error;
                                        header("Location:index.php?route=admin/subjectlist");
                                    } 
                                    else {
                                           if($subjectName=="" && $id==""){
                                                $_SESSION['k'] = array(
                                                'test' => true
                                                );
                                                 $_SESSION['course'] = array(
                                                'test' => true
                                                );
                                                $_SESSION['course']=$courseId;
                                                $error="plz Subject name input fild";
                                                $_SESSION['error']=$error;
                                                $_SESSION['error1']=$collegeId;
                                                $error2="plz course Select fild";
                                                $_SESSION['error2']=$error2;
                                                $_SESSION['collegeName'] = array(
                                                    'test' => true
                                                    );
                                               $_SESSION['colleges']=$collegeId;
                                                header("Location:index.php?route=admin/subjectlist");
                                            }
                                        if($id=="")
                                            {
                                            $_SESSION['subjectName'] = array(
                                                    'test' => true
                                                    );
                                            $_SESSION['subject']=$subjectName;
                                            $_SESSION['collegeName'] = array(
                                                    'test' => true
                                                    );
                                            $_SESSION['colleges']=$collegeId;
                                                echo $collegeId;
                                            $_SESSION['course'] = array(
                                                'test' => true
                                            );
                                            $_SESSION['k'] = array(
                                                'test' => true
                                                    );
                                            $error="plz Subject name input fild";
                                            $_SESSION['error']=$error;
                                           // $_SESSION['error']=$subjectName;
                                            $_SESSION['error']=$subjectName;
                                            $_SESSION['error1']=$collegeId;
                                            $error2="plz course Select fild";
                                            $_SESSION['error2']=$error2; 
                                             $_SESSION['k'] = array(
                                                'test' => true
                                                    );
                                            $error="plz Subject name input fild";
                                            $_SESSION['error']=$error;
                                             header("Location:index.php?route=admin/subjectlist");
                                            // return $error2;
                                            // echo "plz college name input fild";
                                            }
                                        else {
                                                if($subjectName==""){
                                                $_SESSION['k'] = array(
                                                'test' => true
                                                );
                                                $error="plz Subject name input fild";
                                                $_SESSION['error']=$error;
                                                 $_SESSION['collegeName'] = array(
                                                    'test' => true
                                                        );
                                                $_SESSION['colleges']=$collegeId;
                                                    echo $collegeId;
                                                $_SESSION['course'] = array(
                                                    'test' => true
                                                );
                                                $_SESSION['k'] = array(
                                                    'test' => true
                                                        );
                                                
                                                $_SESSION['courseId']=$id;
                                                $_SESSION['error1']=$collegeId;
                                                header("Location:index.php?route=admin/subjectlist");
                                                }
                                                else{

                                                    $collegeCreate= $this->subjectCreate($id,$subjectName);
                                                    header("Location:index.php?route=admin/subjectlist&id=$id");
                                                }
                                        }
                                        
                                    }
                             /*if($subjectName==""){
                                                $_SESSION['k'] = array(
                                                'test' => true
                                                );
                                               $error="plz Subject name input fild";
                                               $_SESSION['error']=$error;
                                                header("Location:index.php?route=admin/subjectlist");
                                            }*/
                             
                           }
                            
                    }
                 }
        }
        if(in_array('subjectlist',$routeArray)){
             //$page = isset($_GET['page'])?$_GET['page']:1;
             $collegeId= isset($_POST['collegeId'])?$_POST['collegeId']:1;
             $id = isset($_GET['id'])?$_GET['id']:NULL;
             $pagecuurent = isset($_GET['page'])?$_GET['page']:1;
             $subjectArray= $this->subjectList($id,$pagecuurent,$collegeId);
             include_once '/view/subject/subjectlist.php';
        }
        if(in_array('subjectDelete', $routeArray)){
            $id = isset($_GET['id'])?$_GET['id']:NULL;
            echo  $courseId = isset($_GET['classId'])?$_GET['classId']:NULL;
            echo  $page = isset($_GET['page'])?$_GET['page']:NULL;
            $subjectArray= $this->subjectDelete($id);
            header("Location:index.php?route=admin/subjectlist&id=$courseId &page=$page");
        }
        if(in_array('subjectSelectEdit', $routeArray)){
            $page=isset($_GET['page'])?$_GET['page']:NULL;
            $id = isset($_GET['id'])?$_GET['id']:NULL;
            $courseId= isset($_GET['courseId'])?$_GET['courseId']:NULL;
            $subjectSelectEdit=$this->subjectSelectEdit($id,$page);
            include_once 'view/subject/subjectEdit.php';
        }
        if(in_array('subjectedit',$routeArray)){
           $id_college_id= $_SESSION['college_id'];
            if(isset($_POST['subject_edit'])){
              echo  $course_id=$_POST['course_id'];
              echo $page=$_POST['page'];
                if(empty($subjectName=$_POST['subjectName'])){
                    echo "plz college name input fild";
                    header("Location:index.php?route=admin/subjectlist&id=$course_id &page=$page");
                }
                else{ 
                    
                    $id =$_POST['edit_subject'];
                    $course_edit= $this->subjectEdit($id,$subjectName);
                      header("Location:index.php?route=admin/subjectlist&id=$course_id &page=$page");
               }
            }
        }
        
    }
}
