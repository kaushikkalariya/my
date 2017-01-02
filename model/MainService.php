<?php
/*
require_once '/model/collegeList.php';
require_once '/model/courseList.php';
require_once '/model/teacherList.php';
require_once '/model/studentList.php';
require_once '/model/studentView.php';
require_once '/model/searchList.php';
require_once '/model/searchView.php';
require_once '/model/loginview.php';
require_once '/model/registercreate.php';
require_once '/model/collegeCreate.php';
require_once '/model/collegedelete.php';
require_once '/model/collegeedit.php';
require_once '/model/courseCreate.php';
require_once 'model/courseDelete.php';
require_once '/model/courseEdit.php';*/
namespace model;
use model\TeacherList as TeacherList;
use model\studentview;
use model\StudentList as StudentList;
use model\LoginView;
use model\RegisterCreate;
use PDO;
class MainService 
{
	private $CollegeGateway = NULL;
	public $con;
	public function __construct() 
	{	
             
             //$this->CollegeGateway = new CollegeController($con);
             //$this->Course =new CourseList($con);
             $con=new  PDO("mysql:host=localhost;dbname=college",'root','');
             $this->Teacher = new TeacherList($con);
             $this->Student =new StudentList($con);
             $this->StudentDetails =new studentview($con);
             $this->SearchList =new SearchList($con);
             $this->Personalsearch =new SearchView($con);
             $this->Login=new LoginView($con);
             $this->Register=new RegisterCreate($con);
           /*  $this->College=new CollegeCreate($con);
             $this->CollegeDelete=new CollegeDelete($con);
             $this->CollegeEdit=new CollegeEdit($con);
            // $this->collegeEditSelect=new CollegeEdit($id, $collegeName)
            $this->CourseCreate=new CourseCreate($con);
            $this->CourseDelete=new CourseDelete($con);
            $this->CourseEdit=new CourseEdit($con);*/
           
        }
	
         public function getcollege($user_id) 
	{ 
            try {
                $college = $this->CollegeGateway->selectAll($user_id);
                return $college;
            } catch (Exception $e) {
                throw $e;
            }
        }
        public function getCourse($id)
        {
            try{
                $course = $this->Course->courseDetails($id);
                return $course;
            } catch (Exception $e) {
                throw $e;
                
            }
           return $this->Course->find($id);
        }
        public function getTeacher($id) 
        {
            try{
                $teacher= $this->Teacher->teacherDetails($id);
                return $teacher;
            } catch (Exception $ex) {
                throw $ex;
            }
            return $this->Teacher->find($id);
        }
        public function getStudent($id) 
        {
            try{
                $student= $this->Student->studentDetails($id);
                return $student;
            } catch (Exception $ex) {
                throw $ex;
            }
            return $this->Student->find($id);
        }
        public function getPersonalStudent($id)
        {
            try{
                $privateStudent= $this->StudentDetails->personalStudent($id);
                return $privateStudent;
            } catch (Exception $ex) {
                throw $ex;
            }
            
        }
        public function getsearchList($id) 
       {
            try{
                $searchList= $this->SearchList->searchListDetails($id);
                return $searchList;
            } catch (Exception $ex) {
                throw $ex;
            }
        }
         public function getPersonalsearch($id) 
       {
            try{
                $searchList= $this->Personalsearch->personalmySearch($id);
                return $searchList;
            } catch (Exception $ex) {
                $this->closeDb();
                throw $ex;
            }
        }
        public function getLogin($username,$password) 
        {
            try{
                $logincreate= $this->Login->loginview($username,$password);
                return $logincreate;
               } catch (Exception $ex) {
                  throw $ex;   
               }
        }
        public function getRegister($fristname,$lastname,$email,$password,$phone_no,$address,$city) 
        {
            try {
                 $registercreate= $this->Register->create($fristname,$lastname,$email,$password,
                                                          $phone_no,$address,$city) ;
                 return $registercreate;
            } catch (Exception $ex) {
                throw $ex;
            }
                    
        }
        public function getCollegeName($username,$collegeName)
        {
            try {
                $college_names= $this->College->collegeCreate($username,$collegeName);
                return $college_names;
                
            } catch (Exception $exc) {
                return $exc;
            }
        }
        public function getCollegeDelete($id)
        {
            try{
                $college_delete= $this->CollegeDelete->collegeDelete($id);
                return $college_delete;
            } catch (Exception $ex) {
                return $ex;
            }
           
        }
        public function getCollegeEdit($id,$collegeName)
        {
            try{
                $college_edit= $this->CollegeEdit->collegeEdit($id,$collegeName);
                return $college_edit;
            } catch (Exception $ex) {
                return $ex;
            }
           
        }
        public function getCollegeEditSelect($id)
        {
            try{
                $college_edit= $this->CollegeEdit->collegeEditSelect($id);
                return $college_edit;
            } catch (Exception $ex) {
                return $ex;
            }
           
        }
        public function getCourseName($id,$courseName) {
            try{
                $course_create= $this->CourseCreate->courseCreate($id,$courseName);
                //print_r($course_create);
                return $course_create;
            } catch (Exception $ex) {
                return $ex;
            }

            
        }
        
        public function getCourseDelete($id)
        {
            try{
                $course_delete= $this->CourseDelete->courseDelete($id);
                return $course_delete;
            } catch (Exception $ex) {
                return $ex;
            }
           
        }
        public function getCourseSelect($id) {
            try{echo "fdfgdfg";
                $course_select= $this->CourseEdit->courseselect($id);
                return $course_select;
            } catch (Exception $ex) {
                return $ex;
            }
        }
        public function getCourseEdit($id,$courseName) {
            try{
                $course_edit= $this->CourseEdit->courseEdit($id,$courseName);
              echo "sffdsgf";  return $course_edit;
            } catch (Exception $ex) {
                return $ex;
            }
        }
        public function __destruct() 
	{
            $this->con=null;
        }
}
?>