<?php
class CollegeController
{
    private $con;
    public function __construct($con) {
        $this->con=$con;
    }
    public function selectAll($user_id) 
    {     
        $select= $this->con->prepare("SELECT
                                            college_name.id as id  ,
                                            college_name.name as name,
                                            register.email  
                                      FROM 
                                            college_name 
                                      inner Join 
                                            register 
                                      on
                                            college_name.user=register.id
                                      where
                                            college_name.user='$user_id'");
        $collegeArray = array();
        $select->execute();
        $_SESSION['que']=array();
        while($row=$select->FETCH(PDO::FETCH_ASSOC)){
            array_push($collegeArray,
		    array(
                            'id'=>$row['id'],
                            'name'=>$row['name']
                         )
                 );
                 array_push($_SESSION['que'],
                         array(
                             'id'=>$row['id']
                                )
                         );
                $que=$row['id'];
         }
         foreach ($collegeArray as $key=>$value){
              $_SESSION['college_id']=$value['id'];
         }
      return $collegeArray;
    }
     public function collegeCreate($username,$collegeName) {
        $queryCollegeName=
            $this->con->
                prepare("insert into 
                            college_name
                            (user,name)
                         values
                            (:username,:collegeName) ");
        $queryCollegeName->bindValue(':collegeName',$collegeName);
        $queryCollegeName->bindValue(':username',$username);
        $queryCollegeName->execute();
        
    }
    public function collegeEditSelect($id) {
         $select= $this->con->prepare("select
                                            *
                                       from
                                           college_name
                                        where
                                            id=:id");
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
            else {                
                echo 'fddfg';
            }
       return $editArray;
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
?>
