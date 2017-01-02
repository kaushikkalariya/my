<?php

class CollegeCreate {
    //put your code here
    public $con;
    public function __construct($con) {
        $this->con=$con;
        //echo"fddfgfdg";
    }
    public function collegeCreate($username,$collegeName) {
        $queryCollegeName=
            $this->con->
                prepare("insert into 
                            college_name
                            (user,name)
                         values
                            (:username,:collegeName) ");
        //echo $collegeName;
        $queryCollegeName->bindValue(':collegeName',$collegeName);
        $queryCollegeName->bindValue(':username',$username);
        $queryCollegeName->execute();
        
    }
}
