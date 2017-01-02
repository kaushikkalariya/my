<?php
namespace controller;
use PDO;

class studentController {
    private $con;
    public function __construct($con) {
        $this->con=$con;
    }
    public function studentDetails($id,$pagecuurent) 
    {   
          $query1=
                $this->con->
                    prepare("select 
                                    count(student.id )  as stuCountId,
                                    course.id as id,
                                    course.name as name,
                                    college_name.name as cname ,
                                    college_name.id as cid
                                from 
                                     student
                                Left Join 
                                    course on
                                    course.id=student.course_id
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
           $countId['all_details']=array
                    (
                      'cname'=>$row['cname'],
                      'collegeid'=>$row['cid'],
                      'id'=>$row['id'],
                      'name'=>$row['name'],
                      'stuCountId'=>$row['stuCountId']
                      
                    );
            $totalRecord = $row['stuCountId'];
            $totalPage=ceil($totalRecord/10);
        }
       // print_r($countId);
        if($totalPage < $pagecuurent){
            $pagecuurent--; 
        }
        $page1=$pagecuurent*10-10;
        $page2=$pagecuurent*10;
        $queryStudent=
            $this->con->
                prepare("
                    select 
                            student.id as sid,
                            student.name as sname,
                            student.course_id as course_id
                    from
			   student 
                    where 
			  course_id=$id 
                    Limit $page1,$page2");			
        $queryStudent->execute();
        $studentArray=
                array(
                        
                        'course_details'=>array(),
                        'techer_details' =>array(),
                        'student_details'=>array(),
                        'studentall_datails'=>array()
                        );
        $studentArray['course_details']=
                       array(
                             'id'=>$countId,
                             );
        $perPage=10;
        while($row=$queryStudent->FETCH(PDO::FETCH_ASSOC)){
              // $page= ceil($row['countId']/$perPage);
               $next = min($totalPage , $pagecuurent + 1);
               $prev = max(0, $pagecuurent - 1);
               $first=1;
               $last=$totalPage;
               
              
               array_push($studentArray['student_details'],
                        array(
                                'sname'=>$row['sname'],
                                'sid'=>$row['sid'],
                                'course_id'=>$row['course_id'],
                                'countId'=>$countId,
                                'page'=>$totalPage,
                                'next'=>$next,
                                'pagecuurent'=>$pagecuurent,
                                'prev'=>$prev,
                                'first'=>$first,
                                'last'=>$last
                                )
                       );
        }
        //print_r($studentArray);
     return $studentArray;
    }
     public function personalStudent($id) 
    {
         $querystudentDetails=
               $this->con->
                  prepare("select 
                                student.id as sid,
                                student.name as sname,
                                student.age as sage,
                                student.village as svillage,
                                student.phone_no as sphone_no,
                                course.name as coursename,
                                college_name.name as cname
                        from 
                                student 
                        INNER JOIN 
                                course
                                on 
                                student.course_id=course.id
                        INNER  JOIN
                                college_name
                                On
                                course.college_id=college_name.id
                        where  
                                student.id = $id");
        $querystudentDetails->execute();
        $studentdetailsArray=
                array(
                                'college_datails'=>array(),
                                'course_datils'=>array(),
                                'student_details'=>array()
                        );
        while($row=$querystudentDetails->FETCH(PDO::FETCH_ASSOC)){
            $studentdetailsArray['course_datils']=
                    array(
                             'coursename'=>$row['coursename']
                             );
            $studentdetailsArray['college_datails']=
                    array(
                             'cname'=>$row['cname']
                              );
            array_push($studentdetailsArray['student_details'],
                    array(
                            'sid'=>$row['sid'],
                            'sname'=>$row['sname'],
                            'sage'=>$row['sage'],
                            'svillage'=>$row['svillage'],
                            'sphone_no'=>$row['sphone_no']
                             )
                    );
        }
        return $studentdetailsArray;
    }
    public function studentCreate($user_id,$studentName) 
    {
        $queryCourseName=
            $this->con->
                prepare("insert into 
                            student
                            (name,course_id)
                         values
                            (:studentName,:userId) ");
        $queryCourseName->bindValue(':studentName',$studentName);
        $queryCourseName->bindValue(':userId',$user_id);
        $queryCourseName->execute();
        print_r($queryCourseName);
        return $queryCourseName;
    }
    public function studentselect($id,$course_id,$page) 
    {
         $select= 
                 $this->con->
                 prepare("
                          select
                                id as sid,
                                name as sname,
                               (select 
                                   course.id as courseid
                                   from
                                   course where course.id=:course_id) as course_id
                          from
                              student
                           where
                               id=:id");
         $select->bindValue(':id',$id);
         $select->bindValue(':course_id',$course_id);
         $select->execute();
        $editArray=array('student'=>array(),
                         'course'=>array()
                        );
        while($row=$select->FETCH(PDO::FETCH_ASSOC)){
             $editArray['course']=array('course_id'=>$row['course_id']);
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
            header("Location:index.php?route=college/studentlist&id=$course_id&page=$page");
        }
        else {
           header("Location:index.php?route=college/studentlist&id=$course_id&page=$page");
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
    public function studentRoute($routeArray) 
    {
        if(in_array('studentlist', $routeArray)){           
                $id = isset($_GET['id'])?$_GET['id']:NULL;
                if ( !$id ) {
                    throw new Exception('Internal error.');
                }
                $pagecuurent = isset($_GET['page'])?$_GET['page']:1;
                $StudentArray= $this->studentDetails($id,$pagecuurent);
                include_once '/view/student/studentList.php';           
                return $StudentArray;
        }
        if(in_array('studentcreate',$routeArray)){
                if(isset($_POST['student_name'])){
                            echo $_POST['studentpost'];
                            if(empty($studentName=$_POST['studentName'])){
                               echo "plz college name input fild";
                            }
                            else{       
                                $user_id=$_POST['studentpost'];
                                $studentCreate= $this->studentCreate($user_id,$studentName);
                                header("Location:index.php?route=college/studentlist&id=$user_id");
                           }
                }
        }
        if(in_array('studentdelete',$routeArray)){
               $page = isset($_GET['page'])?$_GET['page']:NULL;
               $course_id= $_GET['ids'];          
               $id = isset($_GET['id'])?$_GET['id']:NULL;
               if ( !$id ) {
                   throw new Exception('Internal error.');
               }
               $teacher_delete= $this->studentDelete($id);
               header("Location:index.php?route=college/studentlist&id=$course_id&page=$page");
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
              $course_id=$_GET['ids']; 
              $id = isset($_GET['id'])?$_GET['id']:NULL;
              $studentEditSelect= $this->studentselect($id,$course_id,$page);
              include_once 'view/student/studentEdit.php';
        }
        if(in_array('studentview', $routeArray)){
             $id = isset($_GET['id'])?$_GET['id']:NULL;
             if ( !$id ) {
                throw new Exception('Internal error.');
            }
            $StudenDetailstArray= $this->personalStudent($id);
            include_once '/view/student/personalStudentView.php';
            return $StudenDetailstArray;   
        }
    }
}