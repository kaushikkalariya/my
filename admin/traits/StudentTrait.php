<?php
namespace traits;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use PDO;
trait StudentTrait{
    
    public function studentGet() {
       $queryStudent=
            $this->con->
                prepare("
                        select 
                            count(student.course_id) as stid 
                        from
                            student
                        INNER JOIN
                            course
                        on
                            student.course_id=course.id");			
		$queryStudent->execute();
		$studentArray=
			array(
				'studentall_datails'=>array(),
                                
				);
		
		while($row=$queryStudent->FETCH(PDO::FETCH_ASSOC)){
                      $studentArray['studentall_datails']=
                                array(
                                        'stid'=>$row['stid']
                                      );	
                     
                }
             // print_r($studentArray);
	return $studentArray;
    
        
    }
    
    
}
