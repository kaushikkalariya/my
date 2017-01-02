<?php
namespace controllers;

class AdminController {


    private $con;
    public function __construct($con) {
        $this->con=$con;
    }
    public function selectAll() 
    {     
        $select= $this->con->prepare("SELECT
                                            college_name.id as id  ,
                                            college_name.name as name,
                                             
                                      FROM 
                                            college_name ");
        $collegeArray = array();
        $select->execute();
        //$_SESSION['que']=array();
        while($row=$select->FETCH(PDO::FETCH_ASSOC)){
            array_push($collegeArray,
		    array(
                            'id'=>$row['id'],
                            'name'=>$row['name']
                         )
                 );
                /* array_push($_SESSION['que'],
                         array(
                             'id'=>$row['id']
                                )
                         );
                $que=$row['id'];*/
         }
         foreach ($collegeArray as $key=>$value){
              $_SESSION['college_id']=$value['id'];
              $_SESSION['college_name']=$value['name'];
         }
         print_r($collegeArray);
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
              /* foreach ($editArray as $k=>$v){
                   echo "dsfdgf";
                      $_SESSION['college_ids'] = $v['college_id'];
                      
               }*/
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
    public function collegeRoute($routeArray) {
         if(isset($_SESSION["username"]))
            {   
                if(in_array('collegecreate',$routeArray )){
                    if(isset($_POST['college_name'])){
                        if(empty($collegeName=$_POST['college'])){
                            echo "plz college name input fild";
                            //include_once 'view/college/collegeList.php';
                        }
                        else{       $username=$_SESSION['user_id'];
                        $collegeCreate= $this->collegeCreate($username,$collegeName);
                        header("Location:index.php?route=college/list&id=$id");
                       }
                    }
                }
         if(in_array('collegedelete',$routeArray )){
                $ids= $_POST['coursepost'];
                $id = isset($_GET['id'])?$_GET['id']:NULL;
                //echo $id;
                $delete_id=$_SESSION['user_id'];
                if ( !$id ) {
                    throw new Exception('Internal error.');
                }
                $course_delete= $this->collegeDelete($id);
                header("Location:index.php?route=college/list");
        }
        if(in_array('collegeeditmain',$routeArray)){
          // $this->collegeEditMain();
           $id = isset($_GET['id'])?$_GET['id']:NULL;
           if ( !$id ) {
               throw new Exception('Internal error.');
           }
           $collegeEditSelect= $this->collegeEditSelect($id);
           include_once 'view/college/collegeEdit.php';return $collegeEditSelect;
       }
       if(in_array('collegeedit',$routeArray)){
           $id= $_SESSION['college_id'];
           // echo  $_SESSION['college_id'];
            if(isset($_POST['college_edit'])){
               if(empty($collegeName=$_POST['college'])){
                   echo "plz college name input fild";
                   include_once 'view/college/collegeList.php';
               }
               else{  
                    $college_edit= $this->CollegeEdit($id,$collegeName);
                }
            }
       }
       

    }
  }

}
