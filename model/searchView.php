<?php
namespace model;
class SearchView {
    //put your code here
    public function personalmySearch($id) 
    {
        $querySearchPersonal="
		    select 
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
                            student.id= $id";
		$select=mysql_query($querySearchPersonal);
		$searchArray=
			array(
                            'college_details'=>array(),
                            'class_details'=>array(),
                            'techer_details' =>array(),
                            'student_search'=>array(),
                            'studentall_datails'=>array()
                              );
            while($row=mysql_fetch_assoc($select)){
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
                                                'sphone_no'=>$row['sphone_no']
                                                )
                               );
            }
            return $searchArray;
    }
}
?>