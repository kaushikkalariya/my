<?php 
namespace controllers;
error_reporting(E_ALL);
//use model\MainService;
use controllers\CollegeController;
use controllers\coursecontroller;
use controllers\studentController;
use controllers\TeacherController;
use controllers\SubjectController;
use controllers\UserName;
use controllers\MainController;
use PDO;
class controller
{
    private $CollegeMainService = NULL;
    private $servarname="localhost";
    private $username="root";
    private $password="";
    
    public function __construct() 
    {
         $con=new PDO("mysql:host=localhost;dbname=college",'root','');
         $this->College=new CollegeController($con);
         $this->Course=new coursecontroller($con);
         $this->Student=new studentController($con);
         $this->Teacher=new TeacherController($con);
         $this->User=new UserName($con);
         $this->MainController=new MainController($con);
         $this->Subject=new SubjectController($con);
       
        
    }
    
    public function handleRequest()
    {
        $route = isset($_GET['route'])?$_GET['route']:NULL;
        $ids= isset($_GET['id'])?$_GET['id']:NULL;
       //$_SESSION['user_id'];
        $routeArray = explode('/', $route);
        print_r($routeArray);
        if (isset($_SESSION['username'])) {
            if(in_array('admin', $routeArray)){
                echo '<h3>Login success,welcome To Admin-'.$_SESSION["username"];
                echo "<a href='index.php?route=logout'>logout</a><br>";
                if(in_array('MainDetails', $routeArray)){
                     $collegeArray= $this->MainController->mainRoute($routeArray);
                }
            }else{
                echo '<h3>Login success,welcome-'.$_SESSION["username"];
                echo "<a href='admin\index.php?route=logout'>logout</a><br>";
               // $this->College->selectAll();
            }
        } else {
           if(in_array("register", $routeArray)){
            $this->register();
            } else {
                $this->login();
            } 
        }
        if(in_array('registerview',$routeArray)){
            $this->registerCreate();
        }
        if(!isset($_SESSION['username'])){
          if(in_array('login',$routeArray)){
              $this->login();
        }}
        if(in_array('loginview', $routeArray)){
        $this->LoginView();
        }if(in_array("logout", $routeArray)){
            $this->logout();
        }
        
       /*if(in_array('list', $routeArray)){
                     $user_id=$_SESSION['user_id'];
                     $collegeArray=$this->College->selectAll();
                     include '/view/college/collegeList.php';
                
            }else{
                echo '<h3>Login success,welcome-'.$_SESSION["username"];
                echo "<a href='index.php?route=AdminLogout'>logout</a><br>";
                $this->College->selectAll();
            }
          
            if(in_array('logout', $routeArray)){ echo "fgdfg";
                echo '<h3>Login success,welcome To Admin-'.$_SESSION["username"];
                echo "<a href='admin\index.php?route=logout'>logout</a><br>";       
            }*/
       /* } else {
           if(in_array("register", $routeArray)){
            $this->register();
            } else {
                $this->login();
            } 
        }*/
        
        /*if(in_array('registerview',$routeArray)){
            $this->registerCreate();
        }
        if(!isset($_SESSION['username'])){
          if(in_array('login',$routeArray)){
              $this->login();
        }}
        if(in_array('loginview', $routeArray)){
        $this->LoginView();
        }if(in_array("logout", $routeArray)){
            $this->logout();
        }*///echo  $_SESSION['college_id'];echo $_SESSION['college_id'] ;
       //$sessionArray[]= $_SESSION['college_id'];
          //echo $sessionArray[0];
        if(in_array('admin', $routeArray)){
            if(isset($_SESSION["username"]))
            {   
                $this->College->collegeRoute($routeArray);
                $this->Course->courseRoute($routeArray);
                 $this->Teacher->TeacherRoute($routeArray);
                $this->Student->studentRoute($routeArray);
                $this->User->userRoute($routeArray);
                $this->Subject->subjectRoute($routeArray);
                
              
                //echo '<h3>Login success,welcome-'.$_SESSION["username"];
                //echo "<a href='index.php?route=logout'>logout</a><br>";
                /*if(in_array('list', $routeArray)){
                    $this->collegeList();
                }*/
                /*if(in_array('collegecreate',$routeArray )){
                    if(isset($_POST['college_name'])){
                        if(empty($collegeName=$_POST['college'])){
                            echo "plz college name input fild";
                            //include_once 'view/college/collegeList.php';
                        }
                        else{       $username=$_SESSION['user_id'];
                        $collegeCreate= $this->College->collegeCreate($username,$collegeName);
                        header("Location:index.php?route=college/list&id=$id");
                       }
                    }
                }
                
                }*/
               
                
                       
                     
                
            } else {
                    header("location:index.php?route=");
            }   
        }
     
   }
    public function showError($title, $message)
    {
        include 'view/error/errorList.php';
    }
    public function SearchView() 
    {
        $id = isset($_GET['id'])?$_GET['id']:NULL;
        if ( !$id ) {
            throw new Exception('Internal error.');
        }
        $searchPersonal= $this->CollegeMainService->getPersonalsearch($id);
        include_once '/view/search/personalsearchView.php';
        return $searchPersonal;   
    }
    public function login() 
    {
        //include_once '../../view/login/loginview.php';
        include_once '../../view/login/loginview.php';
    }
    public function register() 
    {
        include_once 'view/register/register.php';
    }
    public function LoginView() 
    {
     
      if(isset($_POST['submit'])){
         if(empty($username=$_POST['username']) || empty($password=$_POST['password']) )
            {
              include_once 'view/login/loginview.php';
              echo "pzl input username and password search<br>";  
            } else {

                $login= $this->CollegeMainService->getLogin($username,$password);
                return $login;
            }
        }
                   
    }
    public function logout() {
        session_destroy();
        header("Location:../index.php?route=logout");
        //include_once 'view/login/loginview.php';
    }
    
}


?>
