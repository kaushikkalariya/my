<?php



namespace traits;
use PDO;

trait TeacherTeait {
    //put your code here
    public function teacherGet() {
       $queryStudent=
            $this->con->
                prepare("
                        select 
			     count(teacher.course_id) as tid 
                        from
			    teacher
                        INNER JOIN
                            course
                        on
                            teacher.course_id=course.id");			
		$queryStudent->execute();
		$techerArray=
			array(
				'teacher_datails'=>array(),
                                
				);
		
		while($row=$queryStudent->FETCH(PDO::FETCH_ASSOC)){
                      $techerArray['teacher_datails']=
                                array(
                                        'tid'=>$row['tid']
                                      );	
                     
                }
             // print_r($studentArray);
	return $techerArray;
    
        
    }
    
    


}
