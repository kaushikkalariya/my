<?php
namespace model;
use PDO;
class TeacherList {
    //put your code here
    public $con;
    public function __construct($con) {
        $this->con=$con;
    }
    public function teacherDetails($id)
    {
        //echo $id;
       	$queryTeacher= 
             $this->con->
                prepare(" select 
                                teacher.id as tid ,
                                teacher.name as tname ,
                                student.id as sid,
                                student.name as sname,
                                student.class_id as class_id,
                                college_name.name as cname ,
                                class.name as classname,
                                class.id as classid,
                                subject.name as subname,
                            (select 
                                        count(student.id) as stid 
                                from
                                        student 
                                where 
                                        class_id=$id) as studentall
                               
			  from 
					class 
			  INNER join 
				  teacher on class.id=teacher.class_id 
                          INNER Join
                                  student on class.id=student.class_id
                          INNER Join
                                college_name on class.college_id=college_name.id
                          INNER JOIN
                                subject on class.id=subject.class_id
                          group by
				  teacher.name
			  HAVING
			 
			        student.class_id = $id") ;
        $queryTeacher->execute();
        $teacherArray=
                    array(
                            'college_details'=>array(),
                            'class_details'=>array(),
                            'techer_details' =>array(),
                            'student_id'=>array(),
                            'subject_details'=>array()
                            );
        while ($row=$queryTeacher->FETCH(PDO::FETCH_ASSOC)){
		//echo $row['class_id'];
		
            $teacherArray['subject_details']=
                             array(
                                     'subname'=>$row['subname']
                                       );
                     $teacherArray['class_details']=
                             array(
                                     'classname'=>$row['classname']
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
                                     'sname'=>$row['sname'],
                                     'sid'=>$row['sid'],
                                     'class_id'=>$row['class_id'],
                                     'subname'=>$row['subname']
                                       )
                              );

			}
                       // print_r($teacherArray);     
       return $teacherArray;

    }
}
