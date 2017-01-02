
        <table  align="center">
	<center>
                <?php echo $courseArray['college_details']['cname'];?>
        </center>
        <center>
                <?php echo $courseArray['class_details'][0]['name'];?>
        </center>
        <center> 
             <a href="index.php?route=college/studentlist&id=<?php 
                       echo $studentArray['student_id'][0]['class_id']; ?>"/>
                <?php  echo $studentArray['studentall_datails']['stid'];
                      ?></a>
            
        </center>
    <tr>
        <td>Course Id</td>
        <td>Course Name</td>
        <td>Subject Name</td>
     </tr>
        <?php
            if(empty($courseArray['class_details'][0]['name'])){
                echo "plz data input valus";
            }else{
            foreach( $teacherArray['techer_details'] as $k=>$v):
        ?>
     <tr>
          <td><?php echo $k+1; ?></td>
          <td>
                <?php echo $v['tname'];?>
           </td>
          <td>
              <?php echo $v['subname'];?>
          </td>
   
     </tr>
        <?php
            endforeach;
          }
        ?>
    </table>
     <form action="index.php?route=college/teachercreate" method="post" enctype="multipart/form-data" >      
        <table border="1" align="center">
        
            <tr> 
                <th>Teacher Name:</th>
                <td><input type="text" name="teacherName"  /></td>
            </tr>
            <tr>
                <th>Select Subject</th>
                <td>
                    <select name="sub_id">
                     <?php 
                        foreach ($subjectArray['subject_datails'] as $k=>$v)
                            {
                        ?>

                        <option value="<?php echo $v['subid'];?>"><?php echo $v['subname'];?></option>
                            <?php }?>
                    </select>
                    </td>
            </tr>
            <tr>
                <th><input type="submit" name="teacher_name"  value="Submit"/></th>
            </tr>
            
        </table><input type="hidden" name="class_id" value="<?php echo $courseArray['class_details'][0]['id'];?>" />
    </form>
