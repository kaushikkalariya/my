<?php



namespace traits;
use PDO;

trait SubjectTrait {
    //put your code here
     public function subjectGet($id) {
       $querySubject=
            $this->con->
                prepare("
                    select 
				*
			  from
				subject 
			  where 
				course_id=$id  ");			
		$querySubject->execute();
		$subjectArray=
			array(
				'subject_datails'=>array(),
                               );
		
		while($row=$querySubject->FETCH(PDO::FETCH_ASSOC)){
                     	
                      array_push($subjectArray['subject_datails'],
                                array(
                                        'subname'=>$row['name'],
                                        'subid'=>$row['id']
                                        )
                               );
                }
             // print_r($studentArray);
	return $subjectArray;
    
        
    }
    
    
}


