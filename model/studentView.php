<?php
namespace model;
class studentview {
    public $con;
    public function __construct($con) {
         $this->con=$con;
    }
    public function personalStudent($id) 
    {
         $querystudentDetails=
               $this->con->
                  prepare("select 
                                student.id as sid,
                                student.name as sname,
                                student.age as sage,
                                student.village as svillage,
                                student.phone_no as sphone_no,
                                class.name as classname,
                                college_name.name as cname
                        from 
                                student 
                        INNER JOIN 
                                class
                                on 
                                student.class_id=class.id
                        INNER  JOIN
                                college_name
                                On
                                class.college_id=college_name.id
                        where  
                                student.id = $id");
        $querystudentDetails->execute();
        $studentdetailsArray=
                array(
                                'college_datails'=>array(),
                                'class_datils'=>array(),
                                'student_details'=>array()
                        );
        while($row=$querystudentDetails->FETCH(PDO::FETCH_ASSOC)){
            $studentdetailsArray['class_datils']=
                    array(
                             'classname'=>$row['classname']
                             );
            $studentdetailsArray['college_datails']=
                    array(
                             'cname'=>$row['cname']
                              );
            array_push($studentdetailsArray['student_details'],
                    array(
                            'sid'=>$row['sid'],
                            'sname'=>$row['sname'],
                            'sage'=>$row['sage'],
                            'svillage'=>$row['svillage'],
                            'sphone_no'=>$row['sphone_no']
                             )
                    );
        }
        return $studentdetailsArray;
    }
}
?>
