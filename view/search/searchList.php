<div class="container">
<div class="row">
    <div class="col-md-5 col-md-offset-4 table-bordered "> 
<table border="3" align="center" class="table table-bordered ">
     <div class="row">
            <div class="col-md-4 btn-lg btn-info ">College Name</div>
     </div>
     <div class="row">
         <?php 
         foreach ($searchListArray['college_details']  as $collegeKey=>$collegeValue)
         {      if($collegeValue['type']==='coll'){
          ?>
          <div class="col-sm-2- col-md-offset-4 btn-lg table-bordered btn-primary"> <?php echo $collegeValue['cname'];?></div>
          <?php
         }}
         ?>
     </div>
    <div class="row">
            <div class="col-md-4 btn-lg btn-info">Course Name</div>
     </div>
    <div class="row">
         <?php 
         foreach ($searchListArray['class_details']  as $collegeKey=>$collegeValue)
         {
              if($collegeValue['type']==='cou'){
          ?>
          <div class="col-sm-2- col-md-offset-4 btn-lg"> <?php echo $collegeValue['classname'];?></div>
          <?php
         }}
         ?>
     </div>
    <div class="row">
            <div class="col-md-4 btn-lg btn-info">Subject Name</div>
     </div>
    <div class="row">
         <?php      
         foreach ($searchListArray['subject_details']  as $collegeKey=>$collegeValue)
         {
              if($collegeValue['type']==='sub'){
          ?>
          <div class="col-sm-2- col-md-offset-4 btn-lg"> <?php echo $collegeValue['subname'];?></div>
          <?php
         }}
         ?>
     </div>
    <div class="row">
            <div class="col-md-4 btn-lg btn-info">Student Name</div>
     </div>
    <div class="row">
         <?php 
         foreach ($searchListArray['student_search']  as $collegeKey=>$collegeValue)
         {
              if($collegeValue['type']==='stu'){
          ?>
          <div class="col-sm-2- col-md-offset-4 btn-lg"> <?php echo $collegeValue['sname'];?></div>
          <?php
         }}
         ?>
     </div>
    <div class="row">
            <div class="col-md-4 btn-lg btn-info">Teacher Name</div>
     </div>
    <div class="row">
         <?php 
         foreach ($searchListArray['teacher_details']  as $collegeKey=>$collegeValue)
         {
              if($collegeValue['type']==='tea'){
          ?>
          <div class="col-sm-2- col-md-offset-4 btn-lg"> <?php echo $collegeValue['tname'];?></div>
          <?php
         }}
         ?>
     </div>
     
</div>
            
        
           </table>
    </div>
</div>
</div>
    <?php /*print_r($searchListArray['college_details']['cname']);?>
            <dl>
                <dt>College Name</dt>
                <?php foreach ($searchListArray['college_details']  as $collegeKey=>$collegeValue)
                {
                    ?>
                <dd><?php echo $collegeValue['cname'];?></dd>
                <?php }?>
                <dt>Course Name</dt>
                    <dd></dd>
                <dt>Student Name</dt>
            </dl>*/
            
            /*if( empty($searchListArray['class_details']['classname'])){
                    echo "plz data not found";
            } else { <?php
             }
             ?>*
            ?>
             
            <?php /*
select
                            student.id as sid,
                            student.name as sname,
                            student.age as sage,
                            student.village as svillage,
                            student.phone_no as sphone_no,
                            cou.name as classname,
                            coll.name as cname
                        from 
                                student
                        left JOIN
                            course 
                            ON 
                                course.id = student.course_id
                        left JOIN
                            college_name 
                            ON 
                                college_name.id = course.college_id
                        where  
                               college_name.user= $userId
                        AND 
                               student.name like '%$searchTxt%'
                        UNION ALL
                        select
                            student.id as sid,
                            student.name as sname,
                            student.age as sage,
                            student.village as svillage,
                            student.phone_no as sphone_no,
                            cou.name as classname,
                            coll.name as cname
                        from 
                                student
                        left JOIN
                            course 
                            ON 
                                course.id = student.course_id
                        left JOIN
                            college_name 
                            ON 
                                college_name.id = course.college_id
                        where  
                               college_name.user= $userId
                        AND 
                               student.name like '%$searchTxt%'
                        UNION ALL
                         select
                            student.id as sid,
                            student.name as sname,
                            student.age as sage,
                            student.village as svillage,
                            student.phone_no as sphone_no,
                            cou.name as classname,
                            coll.name as cname
                        from 
                                student
                        left JOIN
                            course 
                            ON 
                                course.id = student.course_id
                        left JOIN
                            college_name 
                            ON 
                                college_name.id = course.college_id
                        where  
                               college_name.user= $userId
                        AND 
                               student.name like '%$searchTxt%'"
                               
                               
                               
                               
                               
                               
                               <?php    $sercount=$searchListArray['student_search'][0]['seaCountId']['all_details']['seaCountId'];
            if($sercount<=10){
             
            }
            else {
        ?>
        <center>
            
                 <?php 
                    if($searchListArray['student_search'][0]['prev']<3){
                       
                    }
                     else {
                    ?>
                        <a href="index.php?route=college/searchlist
                           &page=<?php
                                 echo  $searchListArray['student_search'][0]['first'];?>">
                             First
                        </a>
                    <?php
                     }
                   ?>
            <ul class="pagination">
                <?php 
                    if($searchListArray['student_search'][0]['prev']<1){
                       
                    }
                     else {
                    ?>
                        <li><a href="index.php?route=college/searchlist&id=<?php echo $collgeId;?>&page=<?php
                                 echo  $searchListArray['student_search'][0]['prev'];?>">
                             Prev
                            </a>
                        </li>
                          
                    <?php
                     }
                   ?>
            </ul>
            <?php if($searchListArray['student_search'][0]['pagecuurent']==
                            $searchListArray['student_search'][0]['pagecuurent']){
     
            ?>
           
                <ul class="pagination">
                    <?php for($a=1;$a<=$searchListArray['student_search'][0]['page'];$a++)
                    {
                        if($searchListArray['student_search'][0]['pagecuurent']==$a){?>
                            <li class="active">
                                <a href="index.php?route=college/searchlist&page=<?php echo $a;?>">
                                    <?php echo $a;?>
                                </a>
                            </li>
                        <?php 
                        }else{?>
                            <li>
                                <a href="index.php?route=college/searchlist&page=<?php echo $a;?>">
                                    <?php echo $a;?>
                                </a>
                            </li>
                            <?php
                        }
                        ?>
                    <?php 
                        
                    }
                    ?>
                </ul>
            <?php
            }
            ?>
        <ul class="pagination">
             <?php 
                    if($searchListArray['student_search'][0]['next']==$searchListArray['student_search'][0]['pagecuurent']){
                    }
                     else {
                    ?>
            <li><a href="index.php?route=college/searchlist&id=<?php echo $collgeId; ?>&page=<?php
                        echo  $searchListArray['student_search'][0]['next'];?>">
                         Next
                </a></li>
                    <?php
                             }
                        ?>
            
             <?php 
                    if($searchListArray['student_search'][0]['last']==$searchListArray['student_search'][0]['pagecuurent']){
                    }
                     else {
                    ?>
                <li>  <a href="index.php?route=college/searchlist&id=<?php echo $collgeId; ?>&page=<?php
                echo  $searchListArray['student_search'][0]['last'];?>">
                 Last
                    </a></li>
            <?php
                     }
                    
                ?>
                </ul>
        </center>
         <?php  }?>*/

        
     
