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
                    <th>NO</th>
                    <th>College Name</th>
                    <th>Course Name</th>
                   
                </tr>
                    <?php foreach($StudentArray['student_details']  as $k=>$v):

                    ?>
                <tr>
                     <td><?php echo $k+1;?></td>
                     <td><?php echo $v['coname'];?></td>
                     <td><?php echo $v['coursename'];?></td>
                </tr>
                    <?php
                    endforeach;
                    ?>
            </table>
    </body>
</html> 



