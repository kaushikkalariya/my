<?php

class CollegeDelete {
   
    public $con;
    public function __construct($con) {
        $this->con=$con;
    }
    public function collegeDelete($id) {
        echo 'reter';
         $select= $this->con->prepare("Delete
                                                                                   
                                      FROM 
                                            college_name 
                                      where
                                            id=:id");
       // $collegeArray = array();
         $select->bindValue(':id',$id);
        $select->execute();
        $count=$select->rowcount();
        if($count>0)
        {
            header('Location:index.php?route=college/list');
        }
        else {
            echo"thisss";
        }
        return $select;
    }
}
