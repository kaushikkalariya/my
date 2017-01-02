<?php  
namespace model;
use PDO;
class LoginView {
    //put your code here
    public $con;
    public function __construct($con) {
        $this->con=$con;
    }
    public function loginView($username,$password) {
       
       $query= $this->con->prepare("select * from register where email=:email AND password=:password");
       $query->bindparam(':email',$username);
       $query->bindparam(':password',$password);
       $query->execute();
       $loginArray=array('username'=>array());
      
       while($row=$query->FETCH(PDO::FETCH_ASSOC)){
           //echo $row['email'];
           $loginArray['username']=
           array('email'=>$row['email'],
                 'user_id'=>$row['id'],
                 'onoroff'=>$row['onoroff']
               );
       } 
       print_r($loginArray);
       $count=$query->rowcount();    
            if($count > 0)
            {   
               foreach ($loginArray as $k=>$v){
                  $_SESSION['username'] = $v['email'];
                  $_SESSION['user_id'] = $v['user_id'];
                 echo  $_SESSION['admin']=$v['onoroff'];
               }
                if ($_SESSION['admin'] == 1) {
                    echo "You are an Admin!";
                     header("Location:admin/index.php?route=admin/MainDetails");
                }else{
                    echo "You are a normal user";
                    header("Location:index.php?route=college/list&page=1");
                }
                
                  //("location: welcome.php");
          }else {
              include_once 'view/login/loginview.php';
             echo "Your Login Name or Password is invalid";
          }
     
    }
    
}
