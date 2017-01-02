<?php
include './TeacherDrop.php';
include './StudentDrop.php';
include './SubjectDrop.php';

class MainDropDwonList{
    public $con;
    public function __construct() 
    {
        $this->con=new PDO("mysql:host=localhost;dbname=college",'root','');
    }
    public function handle()
    {
            $route = isset($_GET['drop'])?$_GET['drop']:NULL;
            $routeArray = explode('/', $route);
            if(in_array('Teacher', $routeArray)){
                $teacher=new TeacherDrop($this->con);
                    if(in_array('DropCourse', $routeArray)){
                            $id=$_POST['id'];
                            $courseDrop=$teacher->courseDropList($id);
                            return $courseDrop;

                    } 
                    if(in_array('Dropsubject', $routeArray)){
                            $id=$_POST['id'];
                            $subjectDrop=$teacher->subjectDropList($id);
                            return $subjectDrop;

                    }
            }
            if(in_array('Student', $routeArray)){
                $student=new StudentDrop($this->con);
                    if(in_array('DropCourse', $routeArray)){
                            $id=$_POST['id'];
                            $courseDrop=$student->courseDropList($id);
                            return $courseDrop;

                    } 
            }
            if(in_array('Subject', $routeArray)){
                $subject=new SubjectDrop($this->con);
                    if(in_array('DropCourse', $routeArray)){
                            $id=$_POST['id'];
                            $courseId=$_POST['courseId'];
                            $courseDrop=$subject->courseDropList($id,$courseId);
                            return $courseDrop;

                    } 
            }
                
    }
}
$MainDropDwonList=new MainDropDwonList();
echo  $MainDropDwonList->handle();  

?>