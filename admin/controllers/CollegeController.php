<?php
namespace controllers;
use PDO;
class CollegeController
{
    private $con;
    public function __construct($con) {
        $this->con=$con;
    }
    public function selectAll($page1,$pagecuurent) 
    {   // echo $username=$_SESSION['user_id'];
        $select= $this->con->prepare("SELECT 
                                         name,id,
                                            (SELECT 
                                                 count(college_name.id) 
                                            FROM 
                                                college_name) as cid
                                      FROM 
                                            college_name 
                                      Limit $page1,10
                                       ");
        $collegeArray = array();
        $select->execute();
        $paePage=10;
        //$_SESSION['que']=array();
        while($row=$select->FETCH(PDO::FETCH_ASSOC)){
            $page= ceil($row['cid']/10);
            $next = min($page , $pagecuurent + 1);
            $prev = max(0, $pagecuurent - 1);
            $first=1;
            $last=$page;
        
            array_push($collegeArray,
		    array(
                            'id'=>$row['id'],
                            'name'=>$row['name'],
                            'cid'=>$row['cid'],
                            'page'=>$page,
                            'next'=>$next,
                            'pagecuurent'=>$pagecuurent,
                            'prev'=>$prev,
                            'first'=>$first,
                            'last'=>$last
                         )
                 );
               
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
            header("Location:index.php?route=admin/collegelist&page=$page ");
        }
        else {
            echo"thisss";
          header("Location:index.php?route=admin/collegelist&page=$page");
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
        if(in_array('collegelist',$routeArray)){
             $pagecuurent = isset($_GET['page'])?$_GET['page']:1;
             if($pagecuurent=="" || $pagecuurent=="1"){
                   $page1=0;
             } else {
              $page1=($pagecuurent*10)-10;
             }
             $collegeArray=$this->selectAll($page1,$pagecuurent);
             include_once '/view/college/collegeList.php';
        }
        if(in_array('collegecreate',$routeArray )){
                if(isset($_POST['college_name'])){
                    if(empty($collegeName=$_POST['college'])){
                        echo "plz college name input fild";
                        //include_once 'view/college/collegeList.php';
                    }
                    else{       
                        $username=$_SESSION['user_id'];
                    $collegeCreate= $this->collegeCreate($username,$collegeName);
                    header("Location:index.php?route=admin/collegelist&page=");
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
             header("Location:index.php?route=admin/collegelist&page=$page");
        }        if(in_array('collegeeditmain',$routeArray)){

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
?>
