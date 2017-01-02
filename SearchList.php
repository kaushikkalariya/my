<?php
class SearchList
{
    public $con;
    public function __construct() 
    {
        $this->con=new PDO("mysql:host=localhost;dbname=college",'root','');
    }

    public function searchListDetails($searchTxt,$userId,$pagecuurent) 
    {   
       /* $query1=
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
                                where student.name like '%$searchTxt%' AND college_name.user= $userId
                                    ");*/
        /*$query1=
                $this->con->
                    prepare("select 
                                    *
                                from
                            college_name
                                where name like '%$searchTxt%' 
                                    ");
        $query1->execute();
        $countId=array(
                'all_details'=>array()
                 );
        while($row=$query1->FETCH(PDO::FETCH_ASSOC)){
            array_push($countId['all_details'],array
                    (
//                      'seaCountId'=>$row['seaCountId'],
                      'name'=>$row['name']
                    ));
          //  $totalRecord = $row['seaCountId'];

           // $totalPage = ceil($totalRecord/10);
        }
        
       // print_r($countId);
         $query2=
                $this->con->
                    prepare("select 
                                    *
                                from
                            course
                                where name like '%$searchTxt%' 
                                    ");
        $query2->execute();
        $course=array(
                'all_details'=>array()
                 );
        while($row=$query2->FETCH(PDO::FETCH_ASSOC)){
            array_push($course['all_details'],array
                    (
                      'name'=>$row['name']
                    ));
        }
        //print_r($course);
         $query3=
                $this->con->
                    prepare("select 
                                    *
                                from
                            teacher
                                where name like '%$searchTxt%' 
                                    ");
        $query3->execute();
        $teacher=array(
                'all_details'=>array()
                 );
        while($row=$query3->FETCH(PDO::FETCH_ASSOC)){
            array_push($teacher['all_details'],array
                    (
                      'name'=>$row['name']
                    ));
        }
        //print_r($teacher);
        if($totalPage < $pagecuurent){
            $pagecuurent--; 
        }
        $page1=$pagecuurent*10-10;
        $page2=$pagecuurent*10;*/
        $searchquery=
            $this->con->
                prepare("select
                            student.id as sid,
                            student.name as sname,
                            student.age as sage,
                            student.village as svillage,
                            student.phone_no as sphone_no,
                            '' as classname,
                            '' as classid,
                            '' as cname,
                            coll.id as cid,
                            '' as tname,
                            '' as subname,
                            'stu' as type
                        from 
                                student
                        LEFT JOIN
                            course as cou
                            ON 
                                cou.id = student.course_id
                        Right JOIN
                           
                            college_name   as coll
                            ON 
                                coll.id = cou.college_id
                        where
                            student.name like '%$searchTxt%'  
                        union 
                        select
                            '' as sid,
                            '' as sname,
                            '' as sage,
                            '' as svillage,
                            '' as sphone_no,
                            '' as classname,
                            '' as classid,
                            coll.name as cname,
                            coll.id as cid,
                            '' as tname,
                            '' as subname,
                            'coll' as type
                        from 
                               college_name as coll
                        where
                           coll.name like '%$searchTxt%' AND  coll.user=19  
                        union 
                        select
                            ''as sid,
                            '' as sname,
                            '' as sage,
                            '' as svillage,
                            '' as sphone_no,
                            cou.name as classname,
                            cou.id as classid,
                            '' as cname,
                            coll.id as cid,
                            '' as tname,
                            '' as subname,
                            'cou' as type
                            
                        from 
                            course as cou
                        Right JOIN
                            college_name   as coll
                            ON 
                                coll.id = cou.college_id
                        where
                            coll.user=19 AND cou.name like '%$searchTxt%'
                        union
                        select
                            '' as sid,
                            '' as sname,
                            '' as sage,
                            '' as svillage,
                            '' as sphone_no,
                            '' as classname,
                            '' as classid,
                            '' as cname,
                            '' as cid,
                            teacher.name as tname,
                            '' as subname,
                            'tea' as type
                        from 
                                teacher
                        INNER JOIN
                            course as cou
                            ON 
                                cou.id = teacher.course_id
                        Right JOIN
                           
                            college_name   as coll
                            ON 
                                coll.id = cou.college_id
                        where
                            teacher.name like '%$searchTxt%'  
                                
                         union
                        select
                            '' as sid,
                            '' as sname,
                            '' as sage,
                            '' as svillage,
                            '' as sphone_no,
                            '' as classname,
                            '' as classid,
                            '' as cname,
                            '' as cid,
                            '' as tname,
                            subject.name as subname,
                            'sub' as type
                        from 
                                subject
                        INNER JOIN
                            course as cou
                            ON 
                                cou.id = subject.course_id
                        Right JOIN
                           
                            college_name   as coll
                            ON 
                                coll.id = cou.college_id
                        where
                            subject.name like '%$searchTxt%' 
                        ");
        $searchquery->execute();
       // print_r($searchquery);
        $searchArray=
                array(
                    'college_details'=>array(),
                    'class_details'=>array(),
                    'teacher_details' =>array(),
                    'subject_details' =>array(),
                    'student_search'=>array(),
                    'studentall_datails'=>array()
               );
        
        while($row=$searchquery->FETCH(PDO::FETCH_ASSOC)){
            //print_r($row);
           /* $next = min($totalPage , $pagecuurent + 1);
            $prev = max(0, $pagecuurent - 1);
            $first=1;
            $last=$totalPage;
             'page'=>$totalPage,
                                'next'=>$next,
                                'pagecuurent'=>$pagecuurent,
                                'prev'=>$prev,
                                'first'=>$first,
                                'last'=>$last*/
            /*arrray_push($searchArray['class_details'],
                            array(
                                  'classname'=>$row['classname']
                                  ));*/
            array_push($searchArray['college_details'],
                            array(
                                  'cname'=>$row['cname'],
                                   'type'=>$row['type'],
                                
                                  ));
            array_push($searchArray['class_details'],
                            array(
                                  'classname'=>$row['classname'],
                                  'type'=>$row['type'],
                                  ));
             array_push($searchArray['subject_details'],
                            array(
                                  'subname'=>$row['subname'],
                                  'type'=>$row['type'],
                                  ));
            array_push($searchArray['teacher_details'],
                            array(
                                  'tname'=>$row['tname'],
                                  'type'=>$row['type'],
                                  )); 
           array_push($searchArray['student_search'],
                            array(
                                
                                'sname'=>$row['sname'],
                                'sid'=>$row['sid'],
                                'sage'=>$row['sage'],
                                'svillage'=>$row['svillage'],
                                'sphone_no'=>$row['sphone_no'],
                                'cname'=>$row['cname'],
                                'classname'=>$row['classname'],
                                'type'=>$row['type']
                               
                               
                              )
            );
        }
        print_r($searchArray);
       return $searchArray;
    }
    public function handle()
    {
            $route = isset($_GET['List'])?$_GET['List']:NULL;
            $routeArray = explode('/', $route);
            if(in_array('SearchList', $routeArray)){
                            $pagecuurent = isset($_GET['page'])?$_GET['page']:1;
                            $searchTxt=$_GET['value'];
                            $userId=$_GET['userId'];
                            
                           // echo $searchTxt.''.$userId;
                            //$collegeId=$_POST['collegeId'];$collegeId,$pagecuurent
                             $searchListArray= $this->searchListDetails($searchTxt,$userId,$pagecuurent);
                             require_once '/view/search/searchList.php';
                             return $searchListArray;
                    
                
            }
    }
}
$searchListList=new SearchList();
 $searchListList->handle();  
?>