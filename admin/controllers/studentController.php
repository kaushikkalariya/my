<?php
namespace controllers;
use PDO;

class studentController {
    private $con;
    public function __construct($con) {
        $this->con=$con;
    }
    public function studentDetails($page1,$pagecuurent,$collegeId) 
    {    $query1=
                $this->con->
                    prepare("select 
                                 college_name.id as cid,
                                 college_name.name as cname,
                                 (select
                                    count(student.id)
                                from
                                    college_name 
                                INNER JOIN
                                    course on college_name.id =course.college_id
                                INNER JOIN 
                                    student on course.id =student.course_id)as stuCountId
                            from
                                college_name 
                          
                                    ");
        $query1->execute();
        $college=array(
                 );
        while($row=$query1->FETCH(PDO::FETCH_ASSOC)){
            array_push($college,array
                    (
                     
                      'cname'=>$row['cname'],
                      'cid'=>$row['cid'],
                      'stuCountId'=>$row['stuCountId']
                
                    ));
            $totalRecord = $row['stuCountId'];
            $totalPage = ceil($totalRecord/10);
        }
        //print_r($college);
        
        //print_r($college);
        if($totalPage < $pagecuurent){
            $pagecuurent--; 
        }
        $page1=$pagecuurent*10-10;
        $page2=$pagecuurent*10-1;

            
        
        //print_r($college);
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
        $queryStudent=
            $this->con->
                prepare("
                        select 
                               college_name.name as collegeName,
                               course.id as course_id,
                               course.name as courseName,
                               student.name as studentName ,
                               student.id as sid,
                               (select
                                    count(student.id)
                                from
                                    college_name 
                                INNER JOIN
                                    course on college_name.id =course.college_id
                                INNER JOIN 
                                    student on course.id =student.course_id)as sId
                         from
                            college_name 
                        INNER JOIN
                            course on college_name.id =course.college_id
                        INNER JOIN 
                            student on course.id =student.course_id
                        Limit $page1,10 ");			
		$queryStudent->execute();
		$studentArray=
			array(
                                'college_details'=>array(),
				'student_details'=>array()
				);
		$perPage=10;
                $studentArray['college_details']=
                        array(
                          'colandcou'=>$college,
                          'course'=>$course
                        );
                
		while($row=$queryStudent->FETCH(PDO::FETCH_ASSOC)){
                    $page= ceil($row['sId']/$perPage);
                    $next = min($page , $pagecuurent + 1);
                    $prev = max(0, $pagecuurent - 1);
                    $first=1;
                    $last=$page;
                    
                    array_push($studentArray['student_details'],
                                array(
                                        'collegeName'=>$row['collegeName'],
                                        'courseName'=>$row['courseName'],
                                        'studentName'=>$row['studentName'],
                                        'sid'=>$row['sid'],
                                        'course_id'=>$row['course_id'],
                                        'sId'=>$row['sId'],
                                        'page'=>$page,
                                        'next'=>$next,
                                        'pagecuurent'=>$pagecuurent,
                                        'prev'=>$prev,
                                        'first'=>$first,
                                        'last'=>$last
                                        )
                               );
                }
            // print_r($studentArray);
	return $studentArray;
    }
     public function studentView($id) {
        echo $id;
       	$queryStudent= 
             $this->con->
                prepare(" select 
                                college_name.name as coname,
                                course.name as coursename 
                	  from 
                                course
                           inner join 
                                college_name on course.college_id=college_name.id
                           where
                                course.id=$id") ;
        $queryStudent->execute();
        $studentArray=
                    array(
                            'student_details' =>array()
                            );
        while ($row=$queryStudent->FETCH(PDO::FETCH_ASSOC)){
            array_push($studentArray['student_details'],
                    array(
                            'coname'=>$row['coname'],
                            'coursename'=>$row['coursename']
                        )
             );
	}
       return $studentArray;
    }
    public function studentCreate($studentName,$course_id) 
    {   echo 'fg'.$studentName.'h'.$course_id;
        $queryCourseName=
            $this->con->
                prepare("insert into 
                            student
                            (name,course_id)
                         values
                            (:studentName,:course_id) ");
        $queryCourseName->bindValue(':studentName',$studentName);
        $queryCourseName->bindValue(':course_id',$course_id);
        $queryCourseName->execute();
        return $queryCourseName;
    }
    public function studentselect($id,$page) 
    {
         $select= 
                 $this->con->
                 prepare("
                          select
                                id as sid,
                                name as sname
                               
                          from
                              student
                           where
                               id=:id");
         $select->bindValue(':id',$id);
         //$select->bindValue(':course_id',$course_id);
         $select->execute();
        $editArray=array('student'=>array(),
                         'course'=>array()
                        );
        while($row=$select->FETCH(PDO::FETCH_ASSOC)){
            // $editArray['course']=array('course_id'=>$row['course_id']);
             $editArray['student']=
             array(
                 'student_id'=>$row['sid'],
                 'student_name'=>$row['sname'],
                 'page'=>$page 
                  );
        }
        return $editArray;
    }
    public function studentEdit($id,$studentName,$course_id,$page) 
    {
        $select= 
                $this->con->
                prepare("UPDATE
                                student
                        SET
                                name=:name
                        where
                                id=:id"
                        );
        $select->bindValue(':name',$studentName);
        $select->bindValue(':id',$id);
        $select->execute();
        $count=$select->rowcount();
        if($count>0)
        {
            header("Location:index.php?route=admin/studentlist&page=$page");
        }
        else {
           header("Location:index.php?route=admin/studentlist&page=$page");
        }
    }
     public function studentDelete($id) 
    {
         $select=
                 $this->con->
                           prepare("
                                    Delete
                                                                                   
                                      FROM 
                                            student
                                      where
                                            id=:id");
        $select->bindValue(':id',$id);
        $select->execute();
        return $select;
    }
        
    public function studentRoute($routeArray) {
        
        if(in_array('studentlist', $routeArray)){
            $collegeId= isset($_POST['college_id'])?$_POST['college_id']:1;
            $pagecuurent = isset($_GET['page'])?$_GET['page']:1;
           if($pagecuurent=="" || $pagecuurent=="1"){
               $page1=0;
           } else {
            $page1=($pagecuurent*10)-10;
           }
           /* $id = isset($_GET['id'])?$_GET['id']:NULL;
            if ( !$id ) {
                throw new Exception('Internal error.');
            }*/
            $StudentArray= $this->studentDetails($page1,$pagecuurent,$collegeId);
            include_once '/view/student/studentList.php';
            return $StudentArray;
        }
        if(in_array('studentcreate',$routeArray)){
                if(isset($_POST['student_name'])){
                          echo $studentName=$_POST['studentName']; echo $course_id=$_POST['course_id'];
                            if(empty($studentName=$_POST['studentName']) && empty($course_id=$_POST['course_id'])){
                               echo "plz college name input fild";
                            }
                            else{       
                                $studentCreate= $this->studentCreate($studentName,$course_id);
                                header("Location:index.php?route=admin/studentlist&page=1");
                           }
                }
        }
        if(in_array('studentdelete',$routeArray)){
               $page = isset($_GET['page'])?$_GET['page']:1;
              // $course_id= $_GET['ids'];          
               $id = isset($_GET['id'])?$_GET['id']:NULL;
               if ( !$id ) {
                   throw new Exception('Internal error.');
               }
               $teacher_delete= $this->studentDelete($id);
               header("Location:index.php?route=admin/studentlist&page=$page");
        }
        if(in_array('studentedit',$routeArray)){
               $id =$_POST['edit_student'];
               $page=$_POST['page'];
               echo $course_id=$_POST['course_id'];
               if(isset($_POST['student_edit'])){
                    if(empty($studentName=$_POST['studentName'])){
                        echo "plz college name input fild";
                    }
                    else{  
                         $course_edit= $this->studentEdit($id,$studentName,$course_id,$page);
                   }
               }
        }
        if(in_array('studentselect', $routeArray)){
             $page = isset($_GET['page'])?$_GET['page']:NULL;
             // $course_id=$_GET['ids']; 
              $id = isset($_GET['id'])?$_GET['id']:NULL;
              $studentEditSelect= $this->studentselect($id,$page);
              include_once 'view/student/studentEdit.php';
        }
        if(in_array('studentview', $routeArray)){
            $id = isset($_GET['id'])?$_GET['id']:NULL;
            if ( !$id ) {
                throw new Exception('Internal error.');
            }
            $StudentArray= $this->studentView($id);
            include_once '/view/student/studentView.php';
            return $StudentArray;
        }
       
    }
}
