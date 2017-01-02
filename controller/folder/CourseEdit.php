<?php
class CourseEdit
{
    
    public $con;
    public function __construct($con) {
        $this->con=$con;
    }
    public function courseselect($id) {
   // echo 'SDFSDF';
     $select= $this->con->prepare("select
                                            *
                                       from
                                           class
                                        where
                                            id=:id");
       // $collegeArray = array();
        // $select->bindValue(':name',$collegeName);
         $select->bindValue(':id',$id);
        $select->execute();
        $editArray=array('course'=>array());
       $id;
        while($row=$select->FETCH(PDO::FETCH_ASSOC)){
           //echo $row['id'];
           $editArray['course']=
           array('course_id'=>$row['id'],
                 'course_name'=>$row['name']);
       }
      
       $count=$select->rowcount();    
            if($count > 0)
            {   
               foreach ($editArray as $k=>$v){
                      $_SESSION['course_id'] = $v['course_id'];
                    print_r($editArray);
               }
            }
            else {
                // echo 'fddfg';
                }
 
          
         return $editArray;
           }
    public function courseEdit($id,$courseName) {
        //echo 'reter';
        //echo $id;
         $select= $this->con->prepare("UPDATE
                                           class
                                       SET
                                            name=:name
                                      where
                                            id=:id");
       // $collegeArray = array();
         $select->bindValue(':name',$collegeName);
         $select->bindValue(':id',$id);
        $select->execute();
        $count=$select->rowcount();
        if($count>0)
        {
            echo "delete";
            header('Location:index.php?route=college/list');
        }
        else {
            echo"thisss";
           header('Location:index.php?route=college/list');
        }
        return $select;
    }
}
