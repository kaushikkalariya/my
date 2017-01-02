<script type="text/javascript">
function validateForm() {
    var x = document.getElementById("course").value;
    if (x == "") {
        alert("Please Course Name Input");
         document.getElementById("course").onkeypress= function(event){
                        document.getElementById("error").style.visibility = "hidden";}
        return false;
    }
}
function save(){
    document.getElementById("myform").action="index.php?route=college/teachercreate";
}
</script>
<table border="1" align="center">
                <center>
                    <?php print_r($TeacherArray['college_details']['cname'])?>
                </center>
                <center>
                    <?php print_r($TeacherArray['class_details']['classname'])?>
                </center>
               
                <center>
                    <a href="index.php?route=college/studentlist&id=<?php 
                        print_r($TeacherArray['student_id']['classid'])?>
                    ">
                <?php print_r($TeacherArray['studentall_datails']['studentall']); ?>
                        </a>
                </center>

                <tr>
                    <th>Teacher Id</th>
                    <th>Teacher Name</th>
                    <th>Subject Name</th>
                    <th>Delete</th>
                    <th>Edit</th>
                </tr>
                    <?php 
                    /*if(empty($TeacherArray['techer_details'][0]['name'])){
                        echo "plz teacher name input valus";
                    }else{*/
                    foreach($TeacherArray['techer_details']  as $k=>$v):	
                    ?>
                <tr>
                    <td><?php echo $k+1; ?></td>
                    <td><?php echo $v['tname'];?></td>
                    <td><?php print_r($TeacherArray['subject_details']['subname']);?></td>
                    <td><a href="index.php?route=college/teacherdelete&id=<?php echo $v['tid']; ?>&ids=<?php print_r($TeacherArray['class_details']['classid']);?>">Delete</a></td>
                    <td><a href="index.php?route=college/teacherselect&id=<?php echo $v['tid']; ?>&ids=<?php print_r($TeacherArray['class_details']['classid']);?>">Edit</a></td>
                </tr

                  <?php
                        endforeach;
                        //}
                    ?>  
          </table>
<form id="myform" onsubmit="return validateForm()" method="post" enctype="multipart/form-data" >      
        <table border="1" align="center">
         <tr> <th>Course Name:</th><td><input type="text" name="teacherName"  /></td><br>
         <tr> <th>Course Name:</th><td><input type="text" name="teacherName"  /></td><br>
            </tr>
            <tr>
            </tr>
            
            <tr>
               
                <th><input type="submit" name="teacher_name"  value="Submit"/></th>
            </tr>
        </table><input type="hidden" name="teacherpost" value=" <?php print_r($TeacherArray['class_details']['classid']);?>" />
    </form>
  
