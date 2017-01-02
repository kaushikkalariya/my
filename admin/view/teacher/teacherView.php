<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title></title>
    </head>
    <body>
            <table border="1" align="center">
      
                <tr>
                    <th>No</th>
                    <th>College Name</th>
                    <th>Course Name</th>
                   
                </tr>
                    <?php 
                    /*if(empty($TeacherArray['techer_details'][0]['name'])){
                        echo "plz teacher name input valus";
                    }else{*/
                    foreach($TeacherArray['teacher_details']  as $k=>$v):	
                    ?>
                <tr>
                    <td><?php echo $k+1; ?></td>
                    <td><?php echo $v['coname'];?></td>
                     <td><?php echo $v['coursename'];?></td>
                </tr>

                  <?php
                        endforeach;
                        //}
                    ?>  
            </table>
  </body>
</html>
