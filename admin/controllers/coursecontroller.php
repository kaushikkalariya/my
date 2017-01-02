<?php
namespace controllers;
use PDO;
use controllers\TeacherController;
//use traits\studenttrait;

class coursecontroller extends TeacherController
{
  //  use studenttrait;
    
    public $con;
    public function __construct($con) {
        $this->con=$con;
    }
     //select the display show page
    public function courseList($page1,$pagecuurent)
    {      //echo $id;
       // echo'fdfgd';
        $query1=
                $this->con->
                    prepare("select 
                                   *
                             from
                                    college_name 
                            ");
        $query1->execute();
        $college=array(
                 );
        while($row=$query1->FETCH(PDO::FETCH_ASSOC)){
            array_push($college,array
                    (
                      'name'=>$row['name'],
                      'id'=>$row['id']
                    ));
            
        }
        //print_r($college);        echo 'dfg';
       $queryClass=
               $this->con->
                    prepare("
                             select 
                                    course.id as id,
                                    course.name as name,
                                    (SELECT 
                                            count(course.id) 
                                        FROM 
                                            course
                                        INNER JOIN
                                            college_name
                                        On
                                            college_name.id=course.college_id
                                    ) as countId
                                from 
                                    course
                                INNER JOIN
                                    college_name
                                On
                                    college_name.id=course.college_id
			        Limit $page1,10
                                " );
		$queryClass->execute();
              //  $ids=array('id'=>$id);
                
                $couseArray=
		    array(      
				'college_details'=>array(),
				'course_details' =>array(),
                                'ids'=>array()
				);
                 $couseArray['college_details']=
                                array(
                                    'college'=>$college
                                    );
                while($row=$queryClass->FETCH(PDO::FETCH_ASSOC)){
                        $page= ceil($row['countId']/10);
                        $next = min($page , $pagecuurent + 1);
                        $prev = max(0, $pagecuurent - 1);
                        $first=1;
                        $last=$page;
                        
                       
			array_push($couseArray['course_details'],
				array(
                                        
					'name'=>$row['name'],
					'id'=>$row['id'],
                                        'cid'=>$row['countId'],
                                        'page'=>$page,
                                        'next'=>$next,
                                        'pagecuurent'=>$pagecuurent,
                                        'prev'=>$prev,
                                        'first'=>$first,
                                        'last'=>$last
                                	)
                        );
                } 
          //      print_r($couseArray);
        return $couseArray;
    }
    public function courseGet() {
        
         $queryClass=$this->con->prepare("
                             select 
                                count(DISTINCT(course.name)) as name
                            from 
                                course
                            INNER JOIN
                                college_name
                            on
                                college_name.id=course.college_id
				" );
		$queryClass->execute();
                $couseArray=
		    array(      
				'course_details' =>array()
				);
                while($row=$queryClass->FETCH(PDO::FETCH_ASSOC)){
			array_push($couseArray['course_details'],
				array(
					'name'=>$row['name']
					
                                        
					)
				);
                     }
                    // print_r($couseArray);          
	   return $couseArray;
    }
    public function courseCreate($courseName,$college_id) 
    {
        $queryCourseName=
            $this->con->
                prepare("insert into 
                            course
                            (name,college_id)
                         values
                            (:courseName,:college_id) ");
        $queryCourseName->bindValue(':courseName',$courseName);
        $queryCourseName->bindValue(':college_id',$college_id);
        $queryCourseName->execute();
        print_r($queryCourseName);
        return $queryCourseName;
    }
    public function courseselect($id,$page) 
    {
        $select=
                $this->con->
                            prepare("select
                                            course.id as id ,
                                            course.name as name ,
                                            course.college_id as course_id,
                                            college_name.name as cname ,
                                            college_name.id as cid
                                    from 
                                    course
                                            Right  JOIN
                                    college_name
                                            On
                                            course.college_id=college_name.id
                                        where
                                           course.id=:id"
                                    );
        $select->bindValue(':id',$id);
        $select->execute();
        $editArray=array('course'=>array());
        while($row=$select->FETCH(PDO::FETCH_ASSOC)){
            $editArray['course']=
            array(
                 'course_id'=>$row['id'],
                 'course_name'=>$row['name'],
                 'college_id'=>$row['cid'],
                 'page'=>$page
                );
       }
      $_SESSION['course_id']=$row['id'];
      return $editArray;
    }
    public function courseEdit($id,$courseName,$page) 
    {
        $select= 
                $this->con->
                            prepare("UPDATE
                                           course
                                       SET
                                            name=:name
                                      where
                                            id=:id");
        $select->bindValue(':name',$courseName);
        $select->bindValue(':id',$id);
        $select->execute();
        return $select;
    }
    public function courseDelete($id,$page) 
    {
        $select= 
                $this->con->
                        prepare("
                                Delete
                                     FROM 
                                         course
                                     where
                                           id=:id");
        $select->bindValue(':id',$id);
        $select->execute();
        return $pageselected;
    }

    public function courseRoute($routeArray) {
        if(in_array('courselist', $routeArray)){
            $pagecuurent = isset($_GET['page'])?$_GET['page']:1;
            if($pagecuurent=="" || $pagecuurent=="1"){
               $page1=0;
             } else {
            $page1=($pagecuurent*10)-10;
            }
            $id = isset($_GET['id'])?$_GET['id']:NULL;
            $courseArray=$this->courseList($page1,$pagecuurent);
            include_once '/view/course/courseList.php';
                
        }
        if(in_array('courseview', $routeArray)){
                $id = isset($_GET['id'])?$_GET['id']:NULL;
                $pagecuurent = isset($_GET['page'])?$_GET['page']:1;
                $courseArray=$this->courseGet($id);
                $teacherArray= $this->teacherGet($id,$pagecuurent);
                $studentArray= $this->studentGet($id);
                $subjectArray= $this->subjectGet($id);
                include_once '/view/course/courseView.php';
        }
        if(in_array('coursecreate',$routeArray)){
                if(isset($_POST['course_name'])){
                     //echo $_POST['coursepost'];
                    echo $college_id=$_POST['college_id'];
                        if(empty($courseName=$_POST['course']) AND empty($college_id=$_POST['college_id'])){
                           echo "plz college name input fild";
                        }
                        else{       
                            $collegeCreate= $this->courseCreate($courseName,$college_id);
                            header("Location:index.php?route=admin/courselist");
                       }
               }
        }
        if(in_array('coursedelete',$routeArray)){
            $id = isset($_GET['id'])?$_GET['id']:NULL;
            $page = isset($_GET['page'])?$_GET['page']:NULL;
           // $totle = isset($_GET['totle'])?$_GET['totle']:NULL;
            if ( !$id ) {
                throw new Exception('Internal error.');
            }
            $college_id=$_GET['college_id'];
            $course_delete= $this->courseDelete($id,$page);
           // $setcurpage=$course_delete['page'];
            header("Location:index.php?route=admin/courselist&page=$page");
        }
        if(in_array('courseedit',$routeArray)){
           $id_college_id= $_SESSION['college_id'];
            if(isset($_POST['course_edit'])){
              echo  $college_id=$_POST['college_id'];
                echo $page=$_POST['page'];
                if(empty($courseName=$_POST['courseName'])){
                    echo "plz college name input fild";
                    header("Location:index.php?route=admin/courselist&page=$page");
                }
                else{ 
                    
                     $id =$_POST['edit_course'];
                    $course_edit= $this->courseEdit($id,$courseName);
                    header("Location:index.php?route=admin/courselist&page=$page");
               }
            }
        }
        if(in_array('courseeditselect', $routeArray)){
            $id = isset($_GET['id'])?$_GET['id']:NULL;
             $page = isset($_GET['page'])?$_GET['page']:1;
           $courseEditSelect= $this->courseselect($id,$page);
           print_r($courseEditSelect);
           include_once 'view/course/courseEdit.php';
        }
    }
}

?>
