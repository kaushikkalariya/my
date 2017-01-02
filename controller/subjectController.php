<?php

namespace controller;
use PDO;
class SubjectController 
{
    public $con;
    public $course_ids;
    public function __construct($con) {
        $this->con=$con;
    }
    public function subjectList($id,$pagecuurent)
    {   echo $id;
        $ids=array();
        $query1=
                $this->con->
                    prepare("select 
                                    count(subject.id )  as subCountId,
                                    subject.course_id as ssid,
                                    course.id as id,
                                    course.name as name,
                                    college_name.name as cname ,
                                    college_name.id as cid
                                from 
                                      subject
                                Left Join 
                                    course on
                                    course.id=subject.course_id
                                INNER  JOIN
                                    college_name
				On
                                    course.college_id=college_name.id
                                where 
                                       course.id=$id
                                    ");
        $query1->execute();
        $countId=array(
                'all_details'=>array()
                 );
        while($row=$query1->FETCH(PDO::FETCH_ASSOC)){
            echo $row['id'];
           $countId['all_details']=array
                    (
                      'cname'=>$row['cname'],
                      'collegeid'=>$row['cid'],
                      'id'=>$row['id'],
                      'name'=>$row['name'],
                      'subCountId'=>$row['subCountId']
                      
                    );
            $totalRecord = $row['subCountId'];

            $totalPage = ceil($totalRecord/10);
        }
        
       // print_r($countId);
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
			where  
				subject.course_id = $id 
                        LIMIT
                            $page1,$page2
                        
                        ");
        $querySubject->execute();
        $subjectArray=
                     array(      
                        'course_details' =>array(),
                        'subject_details'=>array(),
                        'ids'=>array()
                        );
         $subjectArray['course_details']=
                    array(
                            'id'=>$countId
                            
                        );
        
        $perPage=10;
        while($row=$querySubject->FETCH(PDO::FETCH_ASSOC)){
           // $page= ceil($row['countId']/$perPage);
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
                 include_once '/view/subject/subjectcreate.php';
        }
        if(in_array('subjectcreate',$routeArray))
        {            
              
                if(isset($_POST['subject_name']))
                {
                    echo  $id=$_POST['coursepost'];
                    if(empty($subjectName=$_POST['subject']))
                    {
                           echo "plz college name input fild";
                    }
                    else
                    {       
                            $collegeCreate= $this->subjectCreate($id,$subjectName);
                            header("Location:index.php?route=college/subjectlist&id=$id");
                    }
                 }
        }
        if(in_array('subjectlist',$routeArray)){
             //$page = isset($_GET['page'])?$_GET['page']:1;
             $id = isset($_GET['id'])?$_GET['id']:NULL;
             $pagecuurent = isset($_GET['page'])?$_GET['page']:1;
             $subjectArray= $this->subjectList($id,$pagecuurent);
             include_once '/view/subject/subjectcreate.php';
        }
        if(in_array('subjectDelete', $routeArray)){
            $id = isset($_GET['id'])?$_GET['id']:NULL;
            echo  $courseId = isset($_GET['classId'])?$_GET['classId']:NULL;
            echo  $page = isset($_GET['page'])?$_GET['page']:NULL;
            $subjectArray= $this->subjectDelete($id);
            header("Location:index.php?route=college/subjectlist&id=$courseId &page=$page");
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
                    header("Location:index.php?route=college/subjectlist&id=$course_id &page=$page");
                }
                else{ 
                    
                    $id =$_POST['edit_subject'];
                    $course_edit= $this->subjectEdit($id,$subjectName);
                      header("Location:index.php?route=college/subjectlist&id=$course_id &page=$page");
               }
            }
        }
        
    }
}
