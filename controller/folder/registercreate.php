<?php
class Register {
    public $con;
    public function __construct($con) {
        $this->con=$con;
    }
    public function create($fristname,$lastname,$email,$password,$address,$phone_no,$city) {
        $queryRegister= 
            $this->con->
                prepare("insert into 
                            register 
                                (fristname,lastname,email,password,address,phone_no,city)values
                                (:fristname,:lastname,:email,:password,:address,:phone_no,:city) ");
        $queryRegister->bindValue(':fristname',$fristname);
        $queryRegister->bindValue(':lastname',$lastname);
        $queryRegister->bindValue(':email',$email);
        $queryRegister->bindValue(':password',$password);
        $queryRegister->bindValue(':address',$address);
        $queryRegister->bindValue(':phone_no',$phone_no);
        $queryRegister->bindValue(':city',$city);
        $queryRegister->execute();
        
        $count=$queryRegister->rowCount();
			if($count > 0)
			{
				
                                 header("location:index.php?route=login");
			}
			else
			{
					echo "Register succefully ";
			}
			
        
    }

}
