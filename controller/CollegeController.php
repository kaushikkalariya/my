<?php
namespace controller;
use PDO;
class CollegeController
{
    private $con;
    public function __construct($con) {
        $this->con=$con;
    }
    public function selectAll($user_id,$pagecuurent) 
    {  // echo $user_id;
        $query1=
                $this->con->
                    prepare("select 
                                    count(college_name.id )  as cId
                                from 
                                      college_name
                                where 
                                      user=$user_id
                                    ");
        $query1->execute();
        $countId=array();
        while($row=$query1->FETCH(PDO::FETCH_ASSOC)){
            $countId=array('cId'=>$row['cId']);
            $totalRecord = $row['cId'];
            $totalPage = ceil($totalRecord/10);
            
        }
        //print_r($countId);
        if($totalPage < $pagecuurent){
           echo  $pagecuurent--; 
        }
        $page1=$pagecuurent*10-10;
        $page2=$pagecuurent*10;
          
        $select= 
            $this->con->
                prepare("SELECT
                                college_name.id as id  ,
                                college_name.name as name,
                                register.email,
                                register.id as userId
                                
                          FROM 
                                college_name 
                          inner Join 
                                register 
                          on
                                college_name.user=register.id

                          where
                                college_name.user='$user_id' 
                          Limit $page1,$page2");
        $collegeArray = array(
                
                              );
        $select->execute();
        $_SESSION['que']=array();
        $perPage=10;
        while($row=$select->FETCH(PDO::FETCH_ASSOC)){
           // $page= ceil($row['cId']/$perPage);
            $next = min($totalPage , $pagecuurent + 1);
            $prev = max(0, $pagecuurent - 1);
            $first=1;
            $last=$totalPage;
            array_push($collegeArray,
		    array(
                            'id'=>$row['id'],
                            'name'=>$row['name'],
                            'userId'=>$row['userId'],
                            'cId'=>$countId,
                            'page'=>$totalPage,
                            'next'=>$next,
                            'pagecuurent'=>$pagecuurent,
                            'prev'=>$prev,
                            'first'=>$first,
                            'last'=>$last,
                            'user_id'=>$user_id
                         )
                 );
        }
         foreach ($collegeArray as $key=>$value){
              $_SESSION['college_id']=$value['id'];
              $_SESSION['college_name']=$value['name'];
         }
       // print_r($collegeArray);
      return $collegeArray;
    }
    public function collegeCreate($username,$collegeName) 
    {
        $queryCollegeName=
            $this->con->
                prepare("insert 
                            into 
                        college_name
                            (user,name)
                        values
                            (:username,:collegeName) ");
        $queryCollegeName->bindValue(':collegeName',$collegeName);
        $queryCollegeName->bindValue(':username',$username);
        $queryCollegeName->execute();
    }
    public function collegeEditSelect($id,$page) 
    {
        $select=
                 $this->con->
                    prepare("select
                                     *
                             from
                                    college_name
                            where
                                     id=:id");
        $select->bindValue(':id',$id);
        $select->execute();
        $editArray=array('college'=>array());
        while($row=$select->FETCH(PDO::FETCH_ASSOC)){
           $editArray['college']=
           array('college_id'=>$row['id'],
                 'college_name'=>$row['name'],
                 'page'=>$page);
       }
       $count=$select->rowcount();    
       return $editArray;
    }
    public function collegeEdit($id,$collegeName,$page) 
    {
        $select= 
                $this->con->
                prepare("UPDATE
                               college_name
                         SET
                               name=:name
                         where
                               id=:id");
        $select->bindValue(':name',$collegeName);
        $select->bindValue(':id',$id);
        $select->execute();
        $count=$select->rowcount();
        if($count>0)
        {
            header("Location:index.php?route=college/list&page=$page ");
        }
        else {
            echo"thisss";
          header("Location:index.php?route=college/list&page=$page");
        }
        return $select;
    }
    public function collegeDelete($id,$page) {
        $select= 
                $this->con->
                prepare("Delete
                               FROM 
                               college_name 
                       where
                               id=:id");
        $select->bindValue(':id',$id);
        $select->execute();
        $count=$select->rowcount();
        echo $page;
        
        if($count>0)
        {
            header("Location:index.php?route=college/list&page=$page");
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
                        else{       
                            $username=$_SESSION['user_id'];
                        $collegeCreate= $this->collegeCreate($username,$collegeName);
                        header("Location:index.php?route=college/list&id=$id");
                       }
                    }
                }
         if(in_array('collegedelete',$routeArray )){
            //  $ids= $_GET['coursepost'];
              $id = isset($_GET['id'])?$_GET['id']:NULL;
              $page = isset($_GET['page'])?$_GET['page']:NULL;
              $delete_id=$_SESSION['user_id'];
              if ( !$id ) {
                  throw new Exception('Internal error.');
              }
              $course_delete= $this->collegeDelete($id,$page);
             header("Location:index.php?route=college/list");
        }
        if(in_array('collegeeditmain',$routeArray)){
            $id = isset($_GET['id'])?$_GET['id']:NULL;
            if ( !$id ) {
               throw new Exception('Internal error.');
            }
            $page=$_GET['page'];
            $collegeEditSelect= $this->collegeEditSelect($id,$page);
            include_once 'view/college/collegeEdit.php';//return $collegeEditSelect;
       }
       if(in_array('collegeedit',$routeArray)){
            $id=$_POST['college_id'];
           echo  $page=$_POST['page'];
            if(isset($_POST['college_edit'])){
               if(empty($collegeName=$_POST['college'])){
                   echo "plz college name input fild";
                   include_once 'view/college/collegeList.php';
               }
               else{  
                    $college_edit= $this->CollegeEdit($id,$collegeName,$page);
                }
            }
       }
    }
  }
}
?>