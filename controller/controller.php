<?php
namespace controller;
error_reporting(E_ALL);
use model\MainService;
use controller\CollegeController;
use controller\coursecontroller;
use controller\studentController;
use controller\TeacherController;
use controller\searchcontroller;
use controller\SubjectController;
use PDO;
class controller
{
    private $CollegeMainService = NULL;
    private $servarname="localhost";
    private $username="root";
    private $password="";
    public function __construct() 
    {
        $this->CollegeMainService = new MainService();
         $con=new PDO("mysql:host=localhost;dbname=college",'root','');
         $this->College=new CollegeController($con);
         $this->Course=new coursecontroller($con);
         $this->Student=new studentController($con);
         $this->Teacher=new TeacherController($con);
         $this->Search=new searchcontroller($con);
         $this->Subject=new SubjectController($con);
    }
    public function createDatabase() 
    {
        $conn=new PDO("mysql:host=$this->servarname;", $this->username, $this->password);
        // set the PDO error mode to exception
        //$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql="CREATE DATABASE IF NOT EXISTS college_login";
        //use exec() bacause no result are returned
        $conn->exec($sql);

        ECHO "DATABASE CREATE COLLEGE SUCCESSFULLY<BR>";
        $conn=null;
    }
    public function createTable() {
        $conn=new PDO("mysql:host=$this->servarname;dbname=college", $this->username, $this->password);
        // $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql="CREATE TABLE IF EXISTS login(
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    username VARCHAR(255) NOT NULL,
                    password VARCHAR(255) NOT NULL
                    )";
        $conn->exec($sql);
        echo "TABLE CREATE LOGIN SUCCESSFULLY<BR>";
        $conn=null;
    }
    public function handleRequest()
    {
        //isset($_SESSION["username"])?$_SESSION["username"]:$this->register();
       // isset($_SESSION["username"])?$_SESSION["username"]:$this->login();
       /*if(!isset($_SESSION["username"]))  {
            $this->register();
        } else {
            $this->login();
        }*/  
        $route = isset($_GET['route'])?$_GET['route']:NULL;
        $ids= isset($_GET['id'])?$_GET['id']:NULL;
        $routeArray = explode('/', $route);
        if (isset($_SESSION['username'])) {
            if(in_array('college', $routeArray)){
                echo '<h3>Login success,welcome-</h3>'.$_SESSION["username"];
                echo "<a href='index.php?route=logout'>logout</a><br>";
                if(in_array('list', $routeArray)){
                    $user_id=$_SESSION['user_id'];
                    $pagecuurent = isset($_GET['page'])?$_GET['page']:1;
                    $collegeArray=$this->College->selectAll($user_id,$pagecuurent);
                    include '/view/college/collegeList.php';
                }
            }
        } else {
            if(in_array("register", $routeArray)){
            $this->register() ;
            } else {
                if(in_array('registerview',$routeArray)){
                         $this->registerCreate();
                }
                else{
                    $this->login();
                }
            } 
          
        }
        
        /*if(!isset($_SESSION['username'])){
            if(in_array('login',$routeArray)){
               $this->login();
            }
        }*/
        if(in_array('loginview', $routeArray)){
            $this->LoginView();
        }
        if(in_array("logout", $routeArray)){
            $this->logout();
        }
        ////echo  $_SESSION['college_id'];echo $_SESSION['college_id'] ;
       //$sessionArray[]= $_SESSION['college_id'];
          //echo $sessionArray[0];
        if(in_array('college', $routeArray)){
            if(isset($_SESSION["username"]))
            {   
                $this->College->collegeroute($routeArray);
                $this->Course->courseRoute($routeArray);
                $this->Student->studentRoute($routeArray);
              //$class_ids=$this->Subject-> setClass_ids();
               // $class_ids= $this->Subject-> getClassIds();
                $this->Subject->subjectRoute($routeArray);
                if( $this->Search->searchRoute($routeArray)){
                    $this->Search->searchRoute($routeArray); 
                } else {
                    $this->Teacher->TeacherRoute($routeArray);
                }
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
        include_once 'view/login/loginview.php';
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
        header("Location:index.php?route=login");
        //include_once 'view/login/loginview.php';
    }
    public function registerCreate() {
        if(isset($_POST['ok'])){
            if(empty($fristname=$_POST['fristname']) || 
               empty($lastname=$_POST['lastname']) ||
               empty($email=$_POST['email'])  ||
               empty($password=$_POST['password'])||
               empty($address=$_POST['address'])||
               empty($phone_no=$_POST['phone_no'])||
               empty($city=$_POST['city'])){
                  include_once 'view/register/register.php';
                  echo "Plz input fild";
                  return FALSE;
            }else {
                 if (preg_match('/^[a-z]{0,20}$/', $fristname)){
                      if (preg_match('/^[a-z]{0,20}$/', $lastname)){
                           if (preg_match('/^[a-z]{0,10}$/', $email)){
                                if (preg_match('/^[a-z][1-10]{0,20}$/', $address)){
                                     if (preg_match('/^[1-10]{0,10}$/', $phone_no)){
                                          if (preg_match('/^[a-z]{0,20}$/', $city)){
                                               $register= $this->CollegeMainService->getRegister($fristname, $lastname, $email, $password,  $address,$phone_no, $city);
                                                 return $register;
                                          }
                                     }
                                }
                           }
                      }
                 }
                else {
                     
                    $_SESSION['fristname'] = array(
                        "one" => true
                     );
                    $error0="Pease UserName check ";
                    $_SESSION['error0']=$error0;
                    include_once 'view/register/register.php';
                    echo "Pease UserName check ";
                    return FALSE;
                }
           }
        }
     }
 }

?>
