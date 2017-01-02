<?php
namespace controllers;
use PDO;
class TeacherController
{
    public $con;
    public function __construct($con) {
        $this->con=$con;
    }
   
    public function teacherGet()
    {
        
       	$queryTeacher= 
             $this->con->
                prepare(" select 
                               college_name.name as collegeName,
                               course.name as courseName,
                               course.id as courseid,
                               teacher.name as teacherName,
                               subject.name as subjectName,
                               teacher.id as tid,
                               (select
                                     count(teacher.id)
                                from
                                    teacher
                                where 
                                    course_id=courseid) as tId
                               
                         from
                            college_name 
                        INNER JOIN
                            course on college_name.id =course.college_id
                        INNER JOIN 
                           teacher on course.id =teacher.course_id 
                        INNER JOIN
                           subject on teacher.subject_id=subject.id
                        
                	  ") ;
        $perPage=10;
        $queryTeacher->execute();
        $teacherArray=
                    array(
                            'college_details'=>array(),
                            'teacher_details' =>array()
                            
                            );
        while ($row=$queryTeacher->FETCH(PDO::FETCH_ASSOC)){
            $teacherArray['college_details']=
                    array(
                             'collegeName'=>$row['collegeName'],
                             'colandcou'=>$college
                         );
            $page= ceil($row['tId']/$perPage);
            array_push($teacherArray['teacher_details'],
                    array(
                            'collegeName'=>$row['collegeName'],
                            'courseName'=>$row['courseName'],
                            'courseid'=>$row['courseid'],
                            'teacherName'=>$row['teacherName'],
                            'subjectName'=>$row['subjectName'],
                            'tId'=>$row['tId'],
                            'page'=>$page
                        )
                    
             );
       
	}
       return $teacherArray;
    }
    public function teacherList($page1,$pagecuurent,$collegeId,$courseId)
    {   echo'sdfd'. $collegeId;
        $query1=
                $this->con->
                    prepare("select 
                                 college_name.id as cid,
                                 college_name.name as cname,
                                 course.id as id ,
                                 course.name name
                                 
                            from
                                college_name 
                            INNER JOIN
                                course 
                            ON
                                college_name.id=course.college_id
                            
                                    ");
        $query1->execute();
        $college=array(
                 );
        while($row=$query1->FETCH(PDO::FETCH_ASSOC)){
            array_push($college,array
                    (
                      'name'=>$row['name'],
                      'id'=>$row['id'],
                      'cname'=>$row['cname'],
                      'cid'=>$row['cid']
                     
                    ));
            
        }//print_r($college);
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
      //  print_r($course); 
        $query3=
                $this->con->
                    prepare("select 
                                *
                            from
                               subject
                            where
                              course_id=$courseId");
        $query3->execute();
        $subject=array(
                'subject_details'=>array()
                 );
        while($row=$query3->FETCH(PDO::FETCH_ASSOC)){
            array_push($subject['subject_details'],array
                    (
                      'subname'=>$row['name'],
                      'subid'=>$row['id'],
                      'collegeId'=>$collegeId,
                      'courseId'=>$courseId
                    ));
        }
       // print_r($subject); 
       	$queryTeacher= 
             $this->con->
                prepare(" select 
                               college_name.name as collegeName,
                               course.name as courseName,
                               course.id as courseid,
                               teacher.name as teacherName,
                               subject.name as subjectName,
                               teacher.id as tid,
                               (select
                                     count(teacher.id)
                                from
                                    teacher
                                where 
                                    course_id=courseid) as tId
                               
                         from
                            college_name 
                        INNER JOIN
                            course on college_name.id =course.college_id
                        INNER JOIN 
                           teacher on course.id =teacher.course_id 
                        INNER JOIN
                           subject on teacher.subject_id=subject.id
                        Limit $page1,10
                	  ") ;
        $perPage=10;
        $queryTeacher->execute();
        $teacherArray=
                    array(
                            'college_details'=>array(),
                            'teacher_details' =>array()
                            
                            );
        $teacherArray['college_details']=
                    array(
                             'colandcou'=>$college  ,
                             'course'=>$course,
                             'subject'=>$subject
                         );
        while ($row=$queryTeacher->FETCH(PDO::FETCH_ASSOC)){
            
            $page= ceil($row['tId']/$perPage);
            $next = min($page , $pagecuurent + 1);
            $prev = max(0, $pagecuurent - 1);
            $first=1;
            $last=$page;
            array_push($teacherArray['teacher_details'],
                    array(
                            'collegeName'=>$row['collegeName'],
                            'courseName'=>$row['courseName'],
                            'courseid'=>$row['courseid'],
                            'teacherName'=>$row['teacherName'],
                            'subjectName'=>$row['subjectName'],
                            'tId'=>$row['tId'],
                            'tid'=>$row['tid'],
                            'page'=>$page,
                            'next'=>$next,
                            'pagecuurent'=>$pagecuurent,
                            'prev'=>$prev,
                            'first'=>$first,
                            'last'=>$last
                        )
             );
	}
       return $teacherArray;
    }
    public function teachetView($id) {
        echo $id;
       	$queryTeacher= 
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
        $queryTeacher->execute();
        $teacherArray=
                    array(
                            
                            'techer_details' =>array()
                            
                            );
        while ($row=$queryTeacher->FETCH(PDO::FETCH_ASSOC)){
            array_push($teacherArray['techer_details'],
                    array(
                            'coname'=>$row['coname'],
                            'coursename'=>$row['coursename']

                        )
             );

	}
       return $teacherArray;
    }
    public function teacherCreates($teacherName,$courseId,$subId) 
    { 
       $queryCourseName=
            $this->con->
                prepare("insert into 
                            teacher
                            (name,course_id,subject_id)
                         values
                            (:teacherName,:courseId,:subject_id) ");
        $queryCourseName->bindValue(':teacherName',$teacherName);
        $queryCourseName->bindValue(':courseId',$courseId);
        $queryCourseName->bindValue('subject_id',$subId);
        $queryCourseName->execute();
        return $queryCourseName;
    }
    public function teacherselect($id,$page) 
    {   echo $id,$page;
         $select= 
                 $this->con->
                    prepare("
                            select
                                    id as tid,
                                    name as tname
                                   
                            from
                                  teacher
                            where
                                   id=:id");
        $select->bindValue(':id',$id);
        $select->execute();
        $editArray=array('teacher'=>array(),
                         'course'=>array()
                        );
        while($row=$select->FETCH(PDO::FETCH_ASSOC)){
            $editArray['teacher']=
            array('teacher_id'=>$row['tid'],
                 'teacher_name'=>$row['tname'],
                 'page'=>$page);
        }
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
            header("Location:index.php?route=admin/teacherlist&id&page=$page");
        }
        else {
           header("Location:index.php?route=admin/teacherlist&page=$page");
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
    public function courseListDrop($id) {
        //echo 'fdfd'.$id;()
	$stmt = $this->con->prepare("SELECT * FROM course WHERE college_id=:id");
	$stmt->execute(array(':id' => $id));
	while($row=$stmt->fetch(PDO::FETCH_ASSOC))
	{
		
		echo"<option>"; echo $row['name']; echo"</option>";
		
	}
    }
    public function teacherRoute($routeArray) {
        if(in_array('teacherlist', $routeArray)){
           $pagecuurent = isset($_GET['page'])?$_GET['page']:1;
            $collegeId= isset($_POST['collegeId'])?$_POST['collegeId']:1;
           $courseId= isset($_POST['courseId'])?$_POST['courseId']:1;
           $subId= isset($_POST['subId'])?$_POST['subId']:1;
           if($pagecuurent=="" || $pagecuurent=="1"){
               $page1=0;
           } else {
            $page1=($pagecuurent*10)-10;
           }
            $TeacherArray= $this->teacherList($page1,$pagecuurent,$collegeId,$courseId,$subId);
            include_once '/view/teacher/teacherList.php';
            return $TeacherArray;
        }
        if(in_array('teacherDropCourse', $routeArray)){
                $id=$_POST['id'];
                $courseDrop= $this->courseListDrop($id);
                return $courseDrop;
        }
        if(in_array('teacherview', $routeArray)){
            $id = isset($_GET['id'])?$_GET['id']:NULL;
            if ( !$id ) {
                throw new Exception('Internal error.');
            }
            $TeacherArray= $this->teachetView($id);
            include_once '/view/teacher/teacherView.php';
            return $TeacherArray;
        }
        if(in_array('teachercreate',$routeArray)){
                if(isset($_POST['teacher_name'])){
                 echo   $courseId= isset($_POST['courseId'])?$_POST['courseId']:1;
                 echo  $subId= isset($_POST['subId'])?$_POST['subId']:1;
                        $page= isset($_GET['page'])?$_GET['page']:1;
                    if(empty($teacherName=$_POST['teacherName']) || empty($courseId=$_POST['courseId']) || empty($subId=$_POST['subId'])){
                           echo "plz college name input fild";
                        }
                        else{       
                            $teacherCreate= $this->teacherCreates($teacherName,$courseId,$subId);
                            header("Location:index.php?route=admin/teacherlist&page=$page");
                       }
            }
        }
        if(in_array('teacherdelete',$routeArray)){
                $page=$_GET['page'];
                $id = isset($_GET['id'])?$_GET['id']:NULL;
                if ( !$id ) {
                     throw new Exception('Internal error.');
                 }
                 $teacher_delete= $this->teacherDelete($id);echo 'kk';
                 header("Location:index.php?route=admin/teacherlist&&page=$page");
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
               $page=$_GET['page'];
               $id = isset($_GET['id'])?$_GET['id']:NULL;
               $TeacherEditSelect= $this->teacherselect($id,$page);
               include_once 'view/teacher/teacherEdit.php';
        }
    }
}

