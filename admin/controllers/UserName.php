<?php



namespace controllers;
use PDO;

class UserName {
    private $con;
    public function __construct($con) {
        $this->con=$con;
    }
    
    public function userDetails() 
    { 
        
         //echo $id;
       $queryuser=
            $this->con->
                prepare("
                    select 
				*
                    from
                            register   ");			
		$queryuser->execute();
		$userArray=
			array(
				'user_details'=>array(),
				);
		
		while($row=$queryuser->FETCH(PDO::FETCH_ASSOC)){
                     
                      array_push($userArray['user_details'],
                                array(
                                        'id'=>$row['id'],
                                        'fristname'=>$row['fristname'],
                                        'lastname'=>$row['lastname'],
                                        'email'=>$row['email'],
                                        'password'=>$row['password'],
                                        'address'=>$row['address'],
                                        'phone_no'=>$row['phone_no'],
                                        'city'=>$row['city'],
                                        'onoroff'=>$row['onoroff']
                                        )
                               );
                }
             //print_r($userArray);
	return $userArray;
    }
     public function userRoute($routeArray) {
        
        if(in_array('userlist', $routeArray)){
           /* $id = isset($_GET['id'])?$_GET['id']:NULL;
            if ( !$id ) {
                throw new Exception('Internal error.');
            }*/
            $userArray= $this->userDetails();
            include_once '/view/user/user.php';
            return $userArray;
        }
    }
}