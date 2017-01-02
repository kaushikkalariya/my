<?php


class CourseList {

    public $con;
    public function __construct($con) {
        $this->con=$con;
    }
    public function courseDetails($id)
    {
       $queryClass=$this->con->prepare("
		    select 
			    class.id as id ,
				class.name as name ,
				class.college_id as college,
				college_name.name as cname ,
                                college_name.id as cid
			from 
			class
				INNER  JOIN
			college_name
				On
				class.college_id=college_name.id	 
			where  
				college_id = $id  " );
		$queryClass->execute();
              //  $ids=array('id'=>$id);
                
                $couseArray=
		    array(      
				'college_details'=>array(),
				'class_details' =>array(),
                                'ids'=>array()
				);
		
                                //array_push($couseArray, $ids);
                while($row=$queryClass->FETCH(PDO::FETCH_ASSOC)){
		    $couseArray['college_details']=
			    array(
				    'cname'=>$row['cname'],
                                    'cid'=>$row['cid']
                                    
					 );
                    //$array=array_merge($id,$couseArray);
                   // echo $row['id'];
                    //exit;
			array_push($couseArray['class_details'],
				array(
					'name'=>$row['name'],
					'id'=>$row['id']
					)
				);
                               // array_push($couseArray['ids'],array('ids'=>$id));
			} $couseArray['ids']=array('idcourse'=>$id); 
                       
	   return $couseArray;

    }
}
