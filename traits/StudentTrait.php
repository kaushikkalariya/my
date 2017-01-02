<?php
namespace traits;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use PDO;
trait StudentTrait{
    
    public function studentGet($id) {
       $queryStudent=
            $this->con->
                prepare("
                    select 
				count(student.course_id) as stid ,
                                student.course_id as courseid
			  from
				student 
			  where 
				student.course_id=$id  ");			
		$queryStudent->execute();
		$studentArray=
			array(
				'studentall_datails'=>array(),
                                'student_id'=>array()
				);
		
		while($row=$queryStudent->FETCH(PDO::FETCH_ASSOC)){
                      $studentArray['studentall_datails']=
                                array(
                                        'stid'=>$row['stid']
                                      );	
                      array_push($studentArray['student_id'],
                                array(
                                        'course_id'=>$row['courseid']
                                        )
                               );
                }
              //print_r($studentArray);
	return $studentArray;
    
        
    }
    
    
}
