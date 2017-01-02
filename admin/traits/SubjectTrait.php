<?php



namespace traits;
use PDO;

trait SubjectTrait {
    //put your code here
     public function subjectGet() {
       $querySubject=
            $this->con->
                prepare("
                    select 
                                count(subject.id) as countSubId
                               
                         from
                            college_name 
                        INNER JOIN
                            course on college_name.id =course.college_id
                        INNER JOIN
                           subject on subject.course_id=course.id ");			
		$querySubject->execute();
		$subjectArray=
			array(
				'subject_datails'=>array(),
                               );
		
		while($row=$querySubject->FETCH(PDO::FETCH_ASSOC)){
                     	
                      array_push($subjectArray['subject_datails'],
                                array(
                                        'countSubId'=>$row['countSubId']
                                        )
                               );
                }
	return $subjectArray;
    
        
    }
    
    
}


