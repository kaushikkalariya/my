<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title></title>
    </head>
    <body>
            <center>
		<?php// print_r($StudentArray['college_details']['cname']);?>
            </center>
            <center>
                        <?php //print_r($StudentArray['course_details']['coursename'])?>
            </center>
            <table border="1" align="center">
                <tr>
                    <th>user No</th>
                    <th>user Id</th>
                    <th>frist Name</th>
                    <th>Last Name</th>
                    <th>email</th>
                    <th>passwword</th>
                    <th>addess</th>
                    <th>Phone No</th>
                    <th>city</th>
                    <th>user&0/admin1</th>
                </tr>
                    <?php foreach($userArray['user_details']  as $k=>$v):

                    ?>
                <tr>
                     <td><?php echo $k+1;?></td>
                     <td><?php echo $v['id'];?></td>
                     <td><?php echo $v['fristname'];?></td>
                     <td><?php echo $v['lastname'];?></td>
                     <td><?php echo $v['email'];?></td>
                     <td><?php echo $v['password'];?></td>
                     <td><?php echo $v['address'];?></td>
                     <td><?php echo $v['phone_no'];?></td>
                     <td><?php echo $v['city'];?></td>
                     <td><?php echo $v['onoroff'];?></td>
                </tr>
                    <?php
                    endforeach;

                    ?>
            </table>
   <!--     <form action="index.php?route=college/studentcreate" method="post" enctype="multipart/form-data" >      
        <table>
        <center>
            <tr> <th>Course Name:</th><td><input type="text" name="studentName"  /></td><br>
            </tr>
            <tr>
               
                <th><input type="submit" name="student_name"  value="Submit"/></th>
            </tr>
             </center>
        </table><input type="hidden" name="studentpost" value=" <?php// print_r($StudentArray['course_details']['courseid']);?>" />
    </form>-->
    </body>
</html> 



