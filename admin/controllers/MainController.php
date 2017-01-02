<?php
namespace controllers;
use PDO;
use controllers\coursecontroller;
use traits\StudentTrait;
use traits\TeacherTeait;
use traits\SubjectTrait;
class MainController extends coursecontroller {
   
    use StudentTrait;
    use TeacherTeait;
    use SubjectTrait;
    public $con;
    public function __construct($con) {
        $this->con=$con;
    }
    public function selectAll() 
    {     
        $select= $this->con->prepare("SELECT
                                          count(DISTINCT(name)) as collegename    
                                      FROM 
                                            college_name ");
        $collegeArray = array();
        $select->execute();
        //$_SESSION['que']=array();
        $collegeArray=array();
        while($row=$select->FETCH(PDO::FETCH_ASSOC)){
            array_push($collegeArray,
		    array(
                           
                            'name'=>$row['collegename']
                         )
                 );
         }
       // print_r($collegeArray);
      return $collegeArray;
    }
    
    public function mainRoute($routeArray) {

        if(in_array('MainDetails',$routeArray )){
                  // $username=$_SESSION['user_id'];
                
                $collegeArray= $this->selectAll();
                //print_r($collegeArray);
                $courseArray= $this->courseGet();
               // print_r($courseArray);
                $studentArray= $this->studentGet();
               // print_r($studentArray);
                $teacherArray= $this->teacherGet();
                //print_r($teacherArray);
                $subjectArray= $this->subjectGet();
               // print_r($subjectArray);
              // header("Location:index.php?route=college/list&id=$id");
                include '/view/AllDetails/AllDetails.php';
               }
     }
                
}
    
