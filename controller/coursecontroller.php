<?php
namespace controller;
use PDO;
use controller\TeacherController;
use traits\studenttrait;
use traits\subjecttrait;

class coursecontroller extends TeacherController
{
    use StudentTrait;
    use subjecttrait;
    public $con;
    public function __construct($con) {
        $this->con=$con;
    }
    public function courseList($id,$pagecuurent)
    {  
        $query1=
                $this->con->
                    prepare("select 
                                    count(course.id )  as couCountid,
                                    college_name.id as cid,
                                    college_name.name as cname
                                from 
                                    course
                                Left Join
                                    college_name on
                                    course.college_id=college_name.id
                                where 
                                       college_name.id=$id
                                    ");
        $query1->execute();
        $countId=array(
                    'all_details'
                 );
        while($row=$query1->FETCH(PDO::FETCH_ASSOC)){
           $countId['all_details']=array
                    (
                      'couCountid'=>$row['couCountid'],
                      'cname'=>$row['cname'],
                      'cid'=>$row['cid']
                    );
            $totalRecord = $row['couCountid'];

            $totalPage = ceil($totalRecord/10);
        }
        
        //print_r($countId);
        if($totalPage < $pagecuurent){
            $pagecuurent--; 
        }
        $page1=$pagecuurent*10-10;
        $page2=$pagecuurent*10-1;
        $queryClass=
                $this->con->
                    prepare("
                            select 
                                course.id as id ,
				course.name as name ,
				course.college_id as course_id
				
                            from 
                                course
				
                            where  
				college_id = $id   Limit $page1,$page2 " );
            $queryClass->execute();
            $perPage=10;
            $couseArray=
                array(      
                        'college_details'=>array(),
                        'class_details' =>array(),
                        'ids'=>array()
                      );
            $couseArray['college_details']=
                        array(
                                'id'=>$countId,
                            );
            while($row=$queryClass->FETCH(PDO::FETCH_ASSOC)){
               
               // $page= ceil($row['countId']/$perPage);
                $next = min($totalPage , $pagecuurent + 1);
                $prev = max(0, $pagecuurent - 1);
                $first=1;
                $last=$totalPage;
                
                array_push($couseArray['class_details'],
                        array(
                                'name'=>$row['name'],
                                'id'=>$row['id'],
                                'course_id'=>$row['course_id'],
                                'page'=>$totalPage,
                                'next'=>$next,
                                'pagecuurent'=>$pagecuurent,
                                'prev'=>$prev,
                                'first'=>$first,
                                'last'=>$last,
                                'countId'=>$countId
                                )
                        );
                array_push($couseArray['ids'],array('ids'=>$id));
            } 
            $couseArray['ids']=array('idcourse'=>$id); 
           // print_r($couseArray);
       return $couseArray;
    }
    public function courseView($id) 
    {
         $queryClass=
                 $this->con->
                 prepare("
                        select 
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
                               
				course.id = $id  " );
            $queryClass->execute();
            $couseArray=
                array(      
                        'college_details'=>array(),
                        'course_details' =>array(),
                        'ids'=>array()
                        );
            while($row=$queryClass->FETCH(PDO::FETCH_ASSOC)){
                $couseArray['college_details']=
                        array(
                                'cname'=>$row['cname'],
                                'cid'=>$row['cid']
                            );
                array_push($couseArray['course_details'],
                        array(
                                'name'=>$row['name'],
                                'id'=>$row['id'],
                                'course_id'=>$row['course_id']
                                )
                        );
                        array_push($couseArray['ids'],array('ids'=>$id));
            } //print_r($couseArray);
       return $couseArray;
    }
    public function courseCreate($id,$courseName) 
    {
        $queryCourseName=
            $this->con->
                prepare("insert into 
                            course
                            (name,college_id)
                         values
                            (:courseName,:userId) ");
        $queryCourseName->bindValue(':courseName',$courseName);
        $queryCourseName->bindValue(':userId',$id);
        $queryCourseName->execute();
        //print_r($queryCourseName);
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
    public function courseDelete($id,$page,$totle) 
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
    public function courseRoute($routeArray) 
    {
        if(in_array('view', $routeArray)){
            $pagecuurent = isset($_GET['page'])?$_GET['page']:1;
            $id = isset($_GET['id'])?$_GET['id']:NULL;
            $courseArray=$this->courseList($id,$pagecuurent);
            include_once '/view/course/courseList.php';
        }
        if(in_array('courseview', $routeArray)){
                $id = isset($_GET['id'])?$_GET['id']:NULL;
                $pagecuurent = isset($_GET['page'])?$_GET['page']:1;
                $courseArray=$this->courseView($id);
                $teacherArray= $this->teacherGet($id,$pagecuurent);
                $studentArray= $this->studentGet($id);
                $subjectArray= $this->subjectGet($id);
                include_once '/view/course/courseView.php';
        }
        if(in_array('coursecreate',$routeArray)){
                if(isset($_POST['course_name'])){
                        $college_id= $_POST['coursepost'];
                        $page =$_POST['page'];
                        if(empty($courseName=$_POST['course'])){
                           echo "plz college name input fild";
                        }
                        else{       
                            echo $user_id=$_POST['coursepost'];
                            $collegeCreate= $this->courseCreate($user_id,$courseName);
                       header("Location:index.php?route=college/view&id=$college_id");
                       }
               }
        }
        if(in_array('coursedelete',$routeArray)){
            $id = isset($_GET['id'])?$_GET['id']:NULL;
            $page = isset($_GET['page'])?$_GET['page']:NULL;
            $totle = isset($_GET['totle'])?$_GET['totle']:NULL;
            if ( !$id ) {
                throw new Exception('Internal error.');
            }
            $college_id=$_GET['college_id'];
            $course_delete= $this->courseDelete($id,$page,$totle);
           // $setcurpage=$course_delete['page'];
            header("Location:index.php?route=college/view&id=$college_id&page=$page");
        }
        if(in_array('courseedit',$routeArray)){
           $id_college_id= $_SESSION['college_id'];
            if(isset($_POST['course_edit'])){
              echo  $college_id=$_POST['college_id'];
                echo $page=$_POST['page'];
                if(empty($courseName=$_POST['courseName'])){
                    echo "plz college name input fild";
                    header("Location:index.php?route=college/view&id=$college_id&page=$page");
                }
                else{ 
                    
                     $id =$_POST['edit_course'];
                    $course_edit= $this->courseEdit($id,$courseName);
                    header("Location:index.php?route=college/view&id=$college_id&page=$page");
               }
            }
        }
        if(in_array('courseeditselect', $routeArray)){
            $id = isset($_GET['id'])?$_GET['id']:NULL;
             $page = isset($_GET['page'])?$_GET['page']:NULL;
           $courseEditSelect= $this->courseselect($id,$page);
          // print_r($courseEditSelect);
           include_once 'view/course/courseEdit.php';
        }
    }
}
?>
