<?php
class CourseDelete {
   
    public $con;
    public function __construct($con) {
        $this->con=$con;
    }
    public function courseDelete($id) 
    {
         $select= $this->con->prepare("Delete
                                                                                   
                                      FROM 
                                            class
                                      where
                                            id=:id");
        $select->bindValue(':id',$id);
        $select->execute();
       /* $count=$select->rowcount();
        if($count>0)
        {
            header('Location:index.php?route=college/view');
        }
        else {
            echo"thisss";
        }*/
        return $select;
    }
}


