<?php
class CourseCreate {
    public $con;
    public function __construct($con) {
        $this->con=$con;
        //echo"fddfgfdg";
    }
    public function courseCreate($id,$courseName) {
        //echo $user_id;
        $queryCourseName=
            $this->con->
                prepare("insert into 
                            class
                            (name,college_id)
                         values
                            (:courseName,:userId) ");
        //echo $collegeName;
        $queryCourseName->bindValue(':courseName',$courseName);
        $queryCourseName->bindValue(':userId',$id);
        $queryCourseName->execute();
        print_r($queryCourseName);
        return $queryCourseName;
       // print_r($queryCourseName);
    }
}

?>
