<?php
namespace controller;
use PDO;

class searchcontroller 
{
    public $con;
    public function __construct($con) {
        $this->con=$con;
    }
    public function searchListDetails($search_id,$collegeId,$pagecuurent) 
    {   
        $query1=
                $this->con->
                    prepare("select 
                                    count(student.id )  as seaCountId
                                from
                                    student
                                INNER JOIN 
                                    course
                                    on 
                                    student.course_id=course.id
                                INNER  JOIN
                                    college_name
                                     On
                                    course.college_id=college_name.id
                                where student.name like '%$search_id%' AND college_name.user= $collegeId
                                    ");
        $query1->execute();
        $countId=array(
                'all_details'=>array()
                 );
        while($row=$query1->FETCH(PDO::FETCH_ASSOC)){
           $countId['all_details']=array
                    (
                      'seaCountId'=>$row['seaCountId']
                    );
            $totalRecord = $row['seaCountId'];

            $totalPage = ceil($totalRecord/10);
        }
        
        print_r($countId);
        if($totalPage < $pagecuurent){
            $pagecuurent--; 
        }
        $page1=$pagecuurent*10-10;
        $page2=$pagecuurent*10;
        $searchquery=
            $this->con->
                prepare("
                        select 
                            student.id as sid,
                                student.name as sname,
                                student.age as sage,
                                student.village as svillage,
                                student.phone_no as sphone_no,
                                course.name as classname,
                                college_name.name as cname
                        from 
                                student 
                        INNER JOIN 
                                course
                                on 
                                student.course_id=course.id
                        INNER  JOIN
                                college_name
                                On
                                course.college_id=college_name.id
                        where  
                                student.name like '%$search_id%' "
                        . "AND "
                                . "college_name.user= $collegeId "
                        . "LIMIT $page1,$page2 ");
        $searchquery->execute();
        $searchArray=
                array(
                    'college_details'=>array(),
                    'class_details'=>array(),
                    'techer_details' =>array(),
                    'student_search'=>array(),
                    'studentall_datails'=>array()
               );
        
        while($row=$searchquery->FETCH(PDO::FETCH_ASSOC)){
            $next = min($totalPage , $pagecuurent + 1);
            $prev = max(0, $pagecuurent - 1);
            $first=1;
            $last=$totalPage;
            $searchArray['class_details']=
                            array(
                                  'classname'=>$row['classname']
                                  );
            $searchArray['college_details']=
                            array(
                                  'cname'=>$row['cname']
                                  );
            array_push($searchArray['student_search'],
                            array(
                                'sname'=>$row['sname'],
                                'sid'=>$row['sid'],
                                'sage'=>$row['sage'],
                                'svillage'=>$row['svillage'],
                                'sphone_no'=>$row['sphone_no'],
                                'cname'=>$row['cname'],
                                'classname'=>$row['classname'],
                                'seaCountId'=>$countId,
                                'page'=>$totalPage,
                                'next'=>$next,
                                'pagecuurent'=>$pagecuurent,
                                'prev'=>$prev,
                                'first'=>$first,
                                'last'=>$last
                              )
            );
        }
        print_r($searchArray);
       return $searchArray;
    }
    public function searchRoute($routeArray) {
         if(in_array('searchlist', $routeArray)){
             echo 'fgdf';
                 $pagecuurent = isset($_GET['page'])?$_GET['page']:1;
                if(isset($_POST['Submit'])){	
                    if(empty($_POST['value'])){
                         echo "plz name search<br>";
                    } else {
                            $search_id=$_POST['value'];
                            $collegeId=$_POST['collegeId'];
                             $searchListArray= $this->searchListDetails($search_id,$collegeId,$pagecuurent);
                             require_once '/view/search/searchList.php';
                             return $searchListArray;
                    }
                }
        }
    }
}
?>