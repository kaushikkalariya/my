<?php
class CollegeEdit {
   
    public $con;
    public function __construct($con) {
        $this->con=$con;
    }
    public function collegeEditSelect($id) {
       // echo 'reter';
         $select= $this->con->prepare("select
                                            *
                                       from
                                           college_name
                                        where
                                            id=:id");
       // $collegeArray = array();
        // $select->bindValue(':name',$collegeName);
         $select->bindValue(':id',$id);
        $select->execute();
        $editArray=array('college'=>array());
       
        while($row=$select->FETCH(PDO::FETCH_ASSOC)){
           //echo $row['id'];
           $editArray['college']=
           array('college_id'=>$row['id'],
                 'college_name'=>$row['name']);
       }
       $count=$select->rowcount();    
            if($count > 0)
            {   
               foreach ($editArray as $k=>$v){
                   echo "dsfdgf";
                      $_SESSION['college_ids'] = $v['college_id'];
                   
               }
            }
 else {                echo 'fddfg';}
          
         //return $select;
      /*  $count=$select->rowcount();
        if($count>0)
        {
            header('Location:index.php?route=college/list');
        }
        else {
            echo"thisss";
        }*/ return $editArray;
           }
    public function collegeEdit($id,$collegeName) {
        //echo 'reter';
        //echo $id;
         $select= $this->con->prepare("UPDATE
                                           college_name
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
            header('Location:index.php?route=college/list');
        }
        else {
            echo"thisss";
           header('Location:index.php?route=college/list');
        }
        return $select;
    }
}
