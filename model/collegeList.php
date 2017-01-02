<?php
class CollegeList
{
    private $con;
    public function __construct($con) {
        $this->con=$con;
    }
     //select the display show page
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
         //print_r($_SESSION['que']);
         //exit();
         foreach ($collegeArray as $key=>$value){
              $_SESSION['college_id']=$value['id'];
         }
         //echo $_SESSION['college_id'][1];
      return $collegeArray;
      }
}
?>
