    <table border="1" align="center">
	<center>
                <?php //print_r($courseArray['college_details']['cname']);?>
        </center>
        <center>
                <?php // print_r($courseArray['course_details'][0]['name']);?>
        </center>
        <center> 
          <!--   <a href="index.php?route=college/studentlist&id=<?php 
                       print_r($studentArray['student_id'][0]['course_id']); ?>
                "> -->
                <?php // print_r($courseArray['course_details'][0]['id']);
                   ?></a> 
            
        </center>
   <!-- <tr>
        <td>Course Id</td>
        <td>Course Name</td>
        <td>Subject Name</td>
     </tr>
          <?php
           /* if(empty($courseArray['course_details'][0]['name'])){
                echo "plz data input valus";
            }else{
            foreach( $teacherArray['techer_details'] as $k=>$v):*/
        ?>
     <tr>
          <td><?php // echo $k+1; ?></td>
          <td>
                <?php// echo $v['tname'];?>
           </td>
          <td>
              <?php// echo $v['subname'];?>
          </td>
   
     </tr>
        <?php
           // endforeach;
         // }
        ?>
    </table>
   <form action="index.php?route=college/coursecreate" method="post" enctype="multipart/form-data" >      
        <table>
        <center>
            <tr> <th>Course Name:</th><td><input type="text" name="course"  /></td><br>
            </tr>
            <tr>
               
                <th><input type="submit" name="course_name"  value="Submit"/></th>
            </tr>
             </center>
        </table>
    </form>
-->