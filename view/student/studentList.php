<script type="text/javascript">
function validateForm() {
    var x = document.getElementById("student").value;
    var error=document.getElementById("error");
    if (x == "") {
        error.innerHTML="Please Student Name Input";
         document.getElementById("student").onkeypress= function(event){
                        document.getElementById("error").style.visibility = "hidden";}
        return false;
    }
}
function save(){
    document.getElementById("myform").action="index.php?route=college/studentcreate";
}
</script>
<div class="header">
    <div class="jumbotron" style="background: #9acfea">
       
    kaushik
    </div>
</div> 

<?php  $all_details=$StudentArray['course_details']['id']['all_details'];
        if(!empty($StudentArray['student_details'][0]['sname'])){?>
<div class="container">
<div class="row">
    <div class="col-md-6 col-md-offset-3 table-bordered ">
        <div class="col-md-5 col-md-offset-4 btn-lg">
            <span class="col-md-12 text-center">
               <?php  
                    
                     echo $all_details['cname'].'<br>';
                     echo $all_details['name'];
                     $classId=$all_details['id'];
                     $page=$StudentArray['student_details'][0]['pagecuurent'];
               ?>
            </span>
        </div>
        <table  align="center" class="table-bordered table">
        <tr class="btn-lg">
                <th class="text-center">Student Id</th>
                <th class="text-center">Student Name</th>
                <th class="text-center">Edit</th>
                <th class="text-center">Delete</th>
            </tr>
            <?php foreach($StudentArray['student_details']  as $k=>$v):
            ?>
            <tr class="text-center">
                 <td>
                     <?php echo $k+1;?>
                 </td>
                 <td><a href="index.php?route=college/studentview&id=<?php echo $v['sid'];?>"><?php echo $v['sname'];?></a></td>
                 
                 <td><a class="btn-danger btn" href="index.php?route=college/studentselect&id=<?php echo $v['sid'];?>&ids=<?php echo $all_details['id'];?>&page=<?php echo  $page ?>">Edit</a></td>
                 <td><a class="btn-primary btn" href="index.php?route=college/studentdelete&id=<?php echo $v['sid'];?>&ids=<?php echo $all_details['id'];?>&page=<?php echo $page ?>">Delete</a></td>
            </tr>
            <?php
            endforeach;
            ?>
    </table>
               <?php 
            if($all_details['stuCountId']<=10){
             
            }
            else {
        ?>
        <center>
            <ul class="pagination">
                 <?php 
                    if($StudentArray['student_details'][0]['prev']<3){
                       
                    }
                     else {
                    ?>
                        <li> 
                            <a href="index.php?route=college/studentlist&id=<?php echo $classId; ?>
                           &page=<?php
                                 echo  $StudentArray['student_details'][0]['first'];?>">
                             First
                             </a>
                        </li>
                    <?php
                     }
                   ?>
            </ul>
            <ul class="pagination">
                <?php 
                    if($StudentArray['student_details'][0]['prev']<1){
                       
                    }
                     else {
                    ?>
                        <li><a href="index.php?route=college/studentlist&id=<?php echo $classId; ?>&page=<?php
                                 echo  $StudentArray['student_details'][0]['prev'];?>">
                             Prev
                            </a>
                        </li>
                          
                    <?php
                     }
                   ?>
            </ul>
            <?php if($StudentArray['student_details'][0]['pagecuurent']==
                           $StudentArray['student_details'][0]['pagecuurent']){
     
            ?>
           
                <ul class="pagination">
                    <?php for($a=1;$a<=$StudentArray['student_details'][0]['page'];$a++)
                    {
                        if($StudentArray['student_details'][0]['pagecuurent']==$a){?>
                            <li class="active">
                                <a href="index.php?route=college/studentlist&id=<?php echo $classId; ?>&page=<?php echo $a;?>">
                                    <?php echo $a;?>
                                </a>
                            </li>
                        <?php 
                        }else{?>
                            <li>
                                <a href="index.php?route=college/studentlist&id=<?php echo $classId; ?>&page=<?php echo $a;?>">
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
                    if($StudentArray['student_details'][0]['next']==$StudentArray['student_details'][0]['pagecuurent']){
                    }
                     else {
                    ?>
            <li><a href="index.php?route=college/studentlist&id=<?php echo $classId; ?>&page=<?php
                        echo  $StudentArray['student_details'][0]['next'];?>">
                         Next
                </a></li>
                    <?php
                             }
                        ?>
            
             <?php 
                    if($StudentArray['student_details'][0]['last']==$StudentArray['student_details'][0]['pagecuurent']){
                    }
                     else {
                    ?>
                <li>  <a href="index.php?route=college/studentlist&id=<?php echo $classId; ?>&page=<?php
                echo  $StudentArray['student_details'][0]['last'];?>">
                 Last
                    </a></li>
            <?php
                     }
                    
                ?>
                </ul>
        </center>
         <?php  }?>
        
     </div>
  </div>
</div>
        <?php }?>

 <!--  <form action="index.php?route=college/studentcreate" method="post" enctype="multipart/form-data" >      
        <table>
        <center>
            <tr> <th>Course Name:</th><td><input type="text" name="studentName"  /></td><br>
            </tr>
            <tr>
               
                <th><input type="submit" name="student_name"  value="Submit"/></th>
            </tr>
             </center>
        </table><input type="hidden" name="studentpost" value=" <?php echo $StudentArray['class_details']['classid'];?>" />
    </form>-->
<div class="container">
<div class="row">
    <div class="col-sm-5 col-sm-offset-3 table-bordered table-hover">
        <form id="myform" onsubmit="return validateForm()" method="post" class="form-group" enctype="multipart/form-data" >      
        <div class="col-md-5 col-md-offset-3 btn-lg">
            Student Add
        </div>
            <table class="table table-bordered">
                <center>
                    <tr> 
                        <th class="col-md-4 btn-lg">student Name:</th>
                        <td><input id="student" class="t-danger " type="text" name="studentName" />
                         <p id="error" class="btn-danger"></p></td>
                    </tr>
                </center>
            </table>
            <input class="col-md-offset-3 btn col-md-2  btn-success" type="submit" onclick="save()" name="student_name"  value="Add"/>
            <input type="hidden" name="studentpost" value=" <?php echo $all_details['id'];?>" />       
        </form>
        </div>
    </div>
</div>