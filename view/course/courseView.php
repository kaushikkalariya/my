<script type="text/javascript">
function validateForm() {
    var x = document.getElementById("teacher").value;
    var y=document.getElementById("subject").value;
    var error=document.getElementById("error");
    var error1=document.getElementById("error1");
    if(x=="" && y==""){
        error1.innerHTML="Please Subejct Name Select";
            document.getElementById("subject").onchange= function(event){
                        document.getElementById("error1").style.visibility = "hidden";}
        error.innerHTML="Please Teacher Name Input";
        document.getElementById("teacher").onkeypress= function(event){
                        document.getElementById("error").style.visibility = "hidden";}
        return false;
    }else{
        if (x != "") {
            if(y ==""){
                error1.innerHTML="Please Subejct Name Select";
                document.getElementById("subject").onchange= function(event){
                            document.getElementById("error1").style.visibility = "hidden";}
                return false;
            }
            else{
                return true;
            }

        }else{
            error.innerHTML="Please Teacher Name Input";
             document.getElementById("teacher").onkeypress= function(event){
                            document.getElementById("error").style.visibility = "hidden";}
            return false;
        }
    }
}
function save(){
    document.getElementById("myform").action="index.php?route=college/teachercreate";
}
</script>
<div class="header">
    <div class="jumbotron" style="background: #9acfea">
       
    kaushik
    </div>
</div> 
<?php if(!empty( $teacherArray['techer_details'][0]['tname'])){?>
<div class="container">
<div class="row">
    <div class="col-md-6 col-md-offset-3 table-bordered ">
        <div class="col-md-5 col-md-offset-4 btn-lg">
            <span class="col-md-12 text-center">
                <?php echo $courseArray['college_details']['cname'].'<br>';?>
                 <?php echo $courseArray['course_details'][0]['name'].'<br>';
                     $classId= $courseArray['course_details'][0]['id'];
                     $studentArray['student_id'][0]['course_id'];
                     
                 ?><?php echo $teacherArray['techer_details'][0]['pagecuurent'];?>
                 student:<a href="index.php?route=college/studentlist&id=<?php 
                       echo $courseArray['course_details'][0]['id'];?>&page=1"/>
                <?php  echo $studentArray['studentall_datails']['stid'];
                      ?></a>
            </span>
        </div>
        <table  align="center" class="table-bordered table">
            <tr class="text-center btn-lg">
        <td>No</td>
        <td>teacher Name</td>
        <td>Subject Name</td>
        <td>Edit</td>
        <td>Delete</td>
     </tr>
        <?php
            if(empty($courseArray['course_details'][0]['name'])){
                echo "plz data input valus";
            }else{
            foreach( $teacherArray['techer_details'] as $k=>$v):
        ?>
     <tr class="text-center">
          <td><?php echo $k+1; ?></td>
          <td>
                <?php echo $v['tname'];?>
           </td>
          <td>
              <?php echo $v['subname'];?>
          </td>
          <td><a class="btn btn-danger" href="index.php?route=college/teacherdelete&id=<?php echo $v['tid'];?>&ids=<?php echo $courseArray['course_details'][0]['id'];?>&page=<?php echo $teacherArray['techer_details'][0]['pagecuurent'];?>">Delete</a></td>
          <td><a  class="btn-primary btn" href="index.php?route=college/teacherselect&id=<?php echo $v['tid'];?>&ids=<?php echo $courseArray['course_details'][0]['id'];?>&page=<?php echo $teacherArray['techer_details'][0]['pagecuurent'];?>">Edit</a></td>
   
     </tr>
        <?php
            endforeach;
          }
        ?>
    </table>
                  <?php
            if($teacherArray['techer_details'][0]['countId']['tid']<=10){
             
            }
            else {
        ?>
        <center>
            <ul class="pagination">
                 <?php 
                    if($teacherArray['techer_details'][0]['prev']<3){
                       
                    }
                     else {
                    ?>
                            <li>
                                <a href="index.php?route=college/courseview&id=<?php echo $classId; ?>
                                &page=<?php
                                 echo $teacherArray['techer_details'][0]['first'];?>">
                                    First
                                </a>
                            </li>
                    <?php
                     }
                   ?>
            </ul>
            <ul class="pagination">
                <?php 
                    if($teacherArray['techer_details'][0]['prev']<1){
                       
                    }
                     else {
                    ?>
                        <li><a href="index.php?route=college//courseview&id=<?php echo $classId; ?>&page=<?php
                                 echo $teacherArray['techer_details'][0]['prev'];?>">
                             Prev
                            </a>
                        </li>
                          
                    <?php
                     }
                   ?>
            </ul>
            <?php if($teacherArray['techer_details'][0]['pagecuurent']==
                           $teacherArray['techer_details'][0]['pagecuurent']){
     
            ?>
           
                <ul class="pagination">
                    <?php for($a=1;$a<=$teacherArray['techer_details'][0]['page'];$a++)
                    {
                        if($teacherArray['techer_details'][0]['pagecuurent']==$a){?>
                            <li class="active">
                                <a href="index.php?route=college//courseview&id=<?php echo $classId; ?>&page=<?php echo $a;?>">
                                    <?php echo $a;?>
                                </a>
                            </li>
                        <?php 
                        }else{?>
                            <li>
                                <a href="index.php?route=college/courseview&id=<?php echo $classId; ?>&page=<?php echo $a;?>">
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
                    if($teacherArray['techer_details'][0]['next']==$teacherArray['techer_details'][0]['pagecuurent']){
                    }
                     else {
                    ?>
            <li><a href="index.php?route=college/courseview&id=<?php echo $classId; ?>&page=<?php
                        echo $teacherArray['techer_details'][0]['next'];?>">
                         Next
                </a></li>
                    <?php
                             }
                        ?>
            
             <?php 
                    if($teacherArray['techer_details'][0]['last']==$teacherArray['techer_details'][0]['pagecuurent']){
                    }
                     else {
                    ?>
                <li>  <a href="index.php?route=college/courseview&id=<?php echo $classId; ?>&page=<?php
                echo  $teacherArray['techer_details'][0]['last'];?>">
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
     <!--<form action="index.php?route=college/teachercreate" method="post" enctype="multipart/form-data" >      
        <table border="1" align="center">
        
            <tr> 
                <th>Teacher Name:</th>
                <td><input type="text" name="teacherName"  /></td>
            </tr>
            <tr>
                <th>Select Subject</th>
                <td>
                    <select name="sub_id">
                        <option>Select Subject</option>
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
-->
<div class="container">
<div class="row">
    <div class="col-md-5 col-md-offset-3 table-bordered table-hover">
        <form id="myform" onsubmit="return validateForm()" method="post" class="form-group" enctype="multipart/form-data" >      
        <div class="col-md-5 col-md-offset-4 btn-lg">
            Teacher Add
        </div>
            <table class="table table-bordered">
                <center>
                    <tr> 
                        <th class="col-md-4 btn-lg">Teacher Name:</th>
                        <td><input id="teacher" class="t-danger " type="text" name="teacherName" />
                             <p id="error" class="btn-danger"></p>
                        </td>
                    </tr>
                    <tr> 
                        <th class="col-md-4 btn-lg">Select Subject:</th>
                        <td>
                            <select id="subject" name="sub_id">
                                <option value="">Select Subject</option>
                                    <?php 
                                       foreach ($subjectArray['subject_datails'] as $k=>$v)
                                       {
                                       ?>
                                       <option value="<?php echo $v['subid'];?>"><?php echo $v['subname'];?></option>
                                    <?php }?>
                            </select>
                             <p id="error1" class="btn-danger"></p>
                        </td>
                    </tr>
                </center>
            </table>
            <input class="col-md-offset-3 btn col-md-2  btn-success" onclick="save()" type="submit" name="teacher_name" value="Add"/>
            <input type="hidden" name="course_id" value="<?php echo $courseArray['course_details'][0]['id'];?>" />       
        </form>
        </div>
    </div>
</div>
 