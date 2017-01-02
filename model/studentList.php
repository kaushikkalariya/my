<?php
namespace model;

class StudentList {
    public $con;
    public function __construct($con) {
        $this->con=$con;
    }
    public function studentDetails($id) 
    {
       $queryStudent=
            $this->con->
                prepare("
                    select 
				s.id as sid,
				s.name as sname,
				s.class_id as class_id,
				college_name.name as cname ,
				class.name as classname,
			  (select 
				count(student.class_id) as stid 
			  from
				student 
			  where 
				s.class_id=$id) as studentall
		  from 
			   class 
		  INNER JOIN
			   college_name on class.id=college_name.id
		  INNER JOIN 
			   student as s on class.id=s.class_id
		  where 
			   s.class_id=$id");			
		$queryStudent->execute();
		$studentArray=
			array(
				'college_details'=>array(),
				'class_details'=>array(),
				'techer_details' =>array(),
				'student_details'=>array(),
				'studentall_datails'=>array()
				);
		
		while($row=$queryStudent->FETCH(PDO::FETCH_ASSOC)){
                      $studentArray['class_details']=
                               array(
                                       'classname'=>$row['classname']
                                     );
                      $studentArray['college_details']=
                                array(
                                       'cname'=>$row['cname']
                                      );
                      $studentArray['studentall_datails']=
                                array(
                                        'studentall'=>$row['studentall']
                                      );	
                      array_push($studentArray['student_details'],
                                array(
                                        'sname'=>$row['sname'],
                                        'sid'=>$row['sid'],
                                        'class_id'=>$row['class_id']
                                        )
                               );
                }
             //print_r($studentArray);
	return $studentArray;
    }
}
?>