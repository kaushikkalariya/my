<?php
namespace controller;
use PDO;
class TeacherController
{
    public $con;
    public function __construct($con) {
        $this->con=$con;
    }
    public function teacherDetails($id)
    {
       	$queryTeacher= 
             $this->con->
                prepare(" select 
                                teacher.id as tid ,
                                teacher.name as tname ,
                                college_name.name as cname ,
                                course.name as coursename,
                                course.id as courseid,
                                subject.name as subname,
                            (select 
                                        count(student.id) as stid 
                                from
                                        course
                                LEFT JOIN
                                       student on course.id=student.course_id
                                where 
                                        course.id=$id ) as studentall
                                
			  from 
					course
			  LEFT join 
                                (select 
                                    * 
                                from 
                                    teacher 
                                group by 
                                    teacher.id 
                                having 
                                    teacher.course_id=$id) as 
                                teacher oncourse.id=teacher.course_id 
                          
                          LEFT Join
                                college_name on course.college_id=college_name.id
                          LEFT JOIN
                                subject on course.id=subject.course_id
                          
			  where		 
			        class.id = $id") ;
        $queryTeacher->execute();
        $teacherArray=
                    array(
                            'college_details'=>array(),
                            'course_details'=>array(),
                            'techer_details' =>array(),
                            'student_id'=>array(),
                            'subject_details'=>array(),
                            'studentall_datails'=>array()
                            );
        while ($row=$queryTeacher->FETCH(PDO::FETCH_ASSOC)){
                $teacherArray['subject_details']=
                             array(
                                     'subname'=>$row['subname']
                                       );
                $teacherArray['course_details']=
                        array(
                                'coursename'=>$row['coursename'],
                                'courseid'=>$row['courseid']
                                  );
                $teacherArray['college_details']=
                        array(
                                'cname'=>$row['cname']
                                  );
                $teacherArray['studentall_datails']=
                        array(
                                'studentall'=>$row['studentall']
                                  );	
                $teacherArray['student_id']=
                        array(
                                 'classid'=>$row['classid']
                                  );
                array_push($teacherArray['techer_details'],
                        array(
                                'tname'=>$row['tname'],
                                'tid'=>$row['tid'],

                                'subname'=>$row['subname']
                                  )
                         );

           }
       return $teacherArray;
    }
    public function teacherGet($id,$pagecuurent)
    {  
        $query1=
                $this->con->
                    prepare("select 
                                    count(teacher.id )  as tid
                                from 
                                      teacher
                                where 
                                       course_id=$id
                                    ");
        $query1->execute();
        $countId=array(
                 );
        while($row=$query1->FETCH(PDO::FETCH_ASSOC)){
           $countId=array
                    (
                      'tid'=>$row['tid']
                    );
            $totalRecord = $row['tid'];

            $totalPage = ceil($totalRecord/10);
        }
        
        //print_r($totalPage);
        if($totalPage < $pagecuurent){
            $pagecuurent--; 
        }
        $page1=$pagecuurent*10-10;
        $page2=$pagecuurent*10-1;
        $queryTeacher= 
             $this->con->
                prepare(" select 
                                teacher.id as tid ,
                                teacher.name as tname ,
                                subject.name as subname,
                                course.id as cid
                                   
                	  from 
                                   teacher
			  INNER  join 
                                subject on teacher.subject_id=subject.id
                          INNER join
                                course on course.id =teacher.course_id
                          
			  where		 
			        teacher.course_id = $id ORDER BY teacher.name ASC  Limit $page1,$page2") ;
        $queryTeacher->execute();
        $teacherArray=
                    array(
                            
                            'techer_details' =>array(),
                            'subject_details'=>array(),
                            'course_details'=>array()
                            );
        $perPage=10;
        while ($row=$queryTeacher->FETCH(PDO::FETCH_ASSOC)){
               // $page= ceil($row['countId']/$perPage);
                $next = min($totalPage , $pagecuurent + 1);
                $prev = max(0, $pagecuurent - 1);
                $first=1;
                $last=$totalPage;
                echo $row['cid'];
                $teacherArray['course_details']=
                                 array(
                                         'cid'=>$row['cid']
                                           );
                $teacherArray['subject_details']=
                                 array(
                                         'subname'=>$row['subname']
                                           );
                array_push($teacherArray['techer_details'],
                        array(
                                'tname'=>$row['tname'],
                                'tid'=>$row['tid'],
                                'subname'=>$row['subname'],
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
     // print_r($teacherArray);
      return $teacherArray;
    }
    public function teacherCreates($user_id,$teacherName,$sub_id) 
    {
       $queryCourseName=
            $this->con->
                prepare("insert into 
                            teacher
                            (name,course_id,subject_id)
                         values
                            (:teacherName,:userId,:subject_id) ");
        $queryCourseName->bindValue(':teacherName',$teacherName);
        $queryCourseName->bindValue(':userId',$user_id);
        $queryCourseName->bindValue('subject_id',$sub_id);
        $queryCourseName->execute();
        return $queryCourseName;
    }
    public function teacherselect($id,$course_id,$page) 
    {   echo $course_id;echo $id,$page;
         $select= 
                 $this->con->
                    prepare("
                            select
                                    id as tid,
                                    name as tname,
                                   (select 
                                       course.id as courseid
                                       from
                                       course where course.id=:course_id) as course_id
                            from
                                  teacher
                            where
                                   id=:id");
        $select->bindValue(':course_id',$course_id);
        $select->bindValue(':id',$id);
        $select->execute();
        $editArray=array('teacher'=>array(),
                         'course'=>array()
                        );
        while($row=$select->FETCH(PDO::FETCH_ASSOC)){
            $editArray['course']=array('course_id'=>$row['course_id']);
            $editArray['teacher']=
            array('teacher_id'=>$row['tid'],
                 'teacher_name'=>$row['tname'],
                 'page'=>$page);
        }
        print_r($editArray);
        return $editArray;
    }
    public function teacherEdit($id,$teacherName,$course_id,$page) 
    {
        $select= 
                $this->con->
                prepare("UPDATE
                                teacher
                            SET
                                 name=:name
                           where
                                 id=:id");
         $select->bindValue(':name',$teacherName);
         $select->bindValue(':id',$id);
         $select->execute();
         $count=$select->rowcount();
        if($count>0)
        {
            header("Location:index.php?route=college/courseview&id=$course_id&page=$page");
        }
        else {
           header("Location:index.php?route=college/courseview&id=$course_id&page=$page");
        }
    }
    public function teacherDelete($id) 
    {
         $select= 
                 $this->con->
                        prepare("
                                Delete
                                      FROM 
                                            teacher
                                      where
                                            id=:id");
        $select->bindValue(':id',$id);
        $select->execute();
        return $select;
    }
    public function teacherRoute($routeArray) 
    {
        if(in_array('teacherlist', $routeArray)){
                $id = isset($_GET['id'])?$_GET['id']:NULL;
                if ( !$id ) {
                    throw new Exception('Internal error.');
                }
                $TeacherArray= $this->teacherGet($id);
                include_once '/view/teacher/teacherList.php';
                return $TeacherArray;
        }
        if(in_array('teachercreate',$routeArray)){
                if(isset($_POST['teacher_name'])){
                    $page= isset($_GET['page'])?$_GET['page']:1;
                        if(empty($teacherName=$_POST['teacherName'])){
                           echo "plz college name input fild";
                        }
                        else{       
                             $user_id=$_POST['course_id'];
                             $sub_id= $_POST['sub_id'];
                       $teacherCreate= $this->teacherCreates($user_id,$teacherName,$sub_id);
                       header("Location:index.php?route=college/courseview&id=$user_id&page=$page");
                       }
            }
        }
        if(in_array('teacherdelete',$routeArray)){
                $course_id= $_GET['ids']; 
                $page=$_GET['page'];
                $id = isset($_GET['id'])?$_GET['id']:NULL;
                if ( !$id ) {
                     throw new Exception('Internal error.');
                 }
                 $teacher_delete= $this->teacherDelete($id);echo 'kk';
                 header("Location:index.php?route=college/courseview&id=$course_id&page=$page");
        }
        if(in_array('teacheredit',$routeArray)){
                $id =$_POST['edit_teacher'];
                $page=$_POST['page'];
                $course_id=$_POST['course_id'];
                if(isset($_POST['teacher_edit'])){
                    if(empty($teacherName=$_POST['teacherName'])){
                        echo "plz college name input fild";
                    }
                    else{  
                         $course_edit= $this->teacherEdit($id,$teacherName,$course_id,$page);
                   }
                }
        }
        if(in_array('teacherselect', $routeArray)){
               $course_id=$_GET['ids'];
               $page=$_GET['page'];
               $id = isset($_GET['id'])?$_GET['id']:NULL;
               $TeacherEditSelect= $this->teacherselect($id,$course_id,$page);
               include_once 'view/teacher/teacherEdit.php';
        }
    }
}

