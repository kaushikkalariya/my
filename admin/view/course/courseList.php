<script>
function validateForm() {
    var course = document.getElementById("course").value;
    var college_id=document.getElementById("college_id").value;
    var error=document.getElementById("error");
    var error1=document.getElementById("error1");
    if(course =="" && college_id==""){
        error.innerHTML="Please Course Name Input";
        error1.innerHTML="Please Select College name";
        document.getElementById("course").onkeypress= function(event){
                      document.getElementById("error").style.visibility = "hidden"}
        document.getElementById("college_id").onchange= function(event){
                        document.getElementById("error1").style.visibility = "hidden"}
        return false;
    }else{
        if (course != "") {
           if(college_id ==""){
               document.getElementById("college_id").onchange= function(event){
                        document.getElementById("error1").style.visibility = "hidden"}
               error1.innerHTML="Please Select College name";
               return  false;
           }
           else{
                return true;
           }
        }else{
             document.getElementById("course").onkeypress= function(event){
                      document.getElementById("error").style.visibility = "hidden"}
            error.innerHTML="Please Course Name Input";
            return false;
        }
    }
}
</script>
<div class="header">
    <div class="jumbotron" style="background: #9acfea">
       
    kaushik
    </div>
</div> 
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3 table-bordered ">
            <div class="col-md-5 col-md-offset-4 btn-lg">
                <span class="col-md-12 text-center">
                    Course Details
                </span>
            </div>

        <table class="table-bordered table">
            <tr>
                <th class="text-center">No</th>
                <th class="text-center"><a href="#">Course Name</a></th>
                <th class="text-center">Edit</th>
                <th class="text-center">Delete</th>
            </tr> 
             <?php $course=$courseArray['course_details'];
            if(empty($courseArray['course_details'][0]['name'])){
                echo "plz data input valus";
            }else{   $courseArray['course_details'][0]['pagecuurent'];
            foreach($courseArray['course_details'] as $k=>$v):
            ?>
            <tr class="text-center">
                 <td><?php echo $k+1; ?></td>
                 <td>
                    <a href="index.php?route=college/courseview&id=<?php echo $v['id'];?>">
                       <?php echo $v['name'];?>
                    </a>
                 </td>
                 <td>
                      <a class="btn btn-danger" href="index.php?route=admin/courseeditselect&id=<?php echo $v['id'];?>
                         &page=<?php echo $courseArray['course_details'][0]['pagecuurent']; ?>">
                          Edit
                      </a>
                  </td>
                   <td>
                     <a class="btn btn-primary" href="index.php?route=admin/coursedelete&id=<?php echo $v['id'];?>
                        &page=<?php echo  $courseArray['course_details'][0]['pagecuurent'];?>">Delete
                     </a>
                  </td>
            </tr>
            <?php endforeach; } ?>
        </table>
             <?php
            if($courseArray['course_details'][0]['cid']<=10){
             
            }
            else {
        ?>
        <center>
            <ul class="pagination">
                 <?php 
                    if($courseArray['course_details'][0]['prev']<3){
                       
                    }
                     else {
                    ?>
                    <li>    
                        <a href="index.php?route=admin/courselist&page=<?php echo $courseArray['course_details'][0]['first'];?>">
                             First
                        </a>
                    </li>
                    <?php
                     }
                   ?>
            </ul>
            <ul class="pagination">
                <?php 
                    if($courseArray['course_details'][0]['prev']<1){
                       
                    }
                     else {
                    ?>
                        <li><a href="index.php?route=admin/courselist&page=<?php
                                 echo $courseArray['course_details'][0]['prev'];?>">
                             Prev
                            </a>
                        </li>
                          
                    <?php
                     }
                   ?>
            </ul>
            <?php if($courseArray['course_details'][0]['pagecuurent']==
                           $courseArray['course_details'][0]['pagecuurent']){
     
            ?>
           
                <ul class="pagination">
                    <?php for($a=1;$a<=$courseArray['course_details'][0]['page'];$a++)
                    {
                        if($courseArray['course_details'][0]['pagecuurent']==$a){?>
                            <li class="active">
                                <a href="index.php?route=admin/courselist&page=<?php echo $a;?>">
                                    <?php echo $a;?>
                                </a>
                            </li>
                        <?php 
                        }else{?>
                            <li>
                                <a href="index.php?route=admin/courselist&page=<?php echo $a;?>">
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
                    if($courseArray['course_details'][0]['next']==$courseArray['course_details'][0]['pagecuurent']){
                    }
                     else {
                    ?>
            <li><a href="index.php?route=admin/courselist&page=<?php
                        echo $courseArray['course_details'][0]['next'];?>">
                         Next
                </a></li>
                    <?php
                             }
                        ?>
            
             <?php 
                    if($courseArray['course_details'][0]['last']==$courseArray['course_details'][0]['pagecuurent']){
                    }
                     else {
                    ?>
                <li>  <a href="index.php?route=admin/courselist&page=<?php
                echo $courseArray['course_details'][0]['last'];?>">
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
<div class="container">
<div class="row">
    <div class="col-md-5 col-md-offset-3 table-bordered table-hover">
        <form action="index.php?route=admin/coursecreate" name="myform" 
              onsubmit="return validateForm()" method="post" class="form-group" enctype="multipart/form-data" >      
        <div class="col-md-5 col-md-offset-4 btn-lg">
            Course Add
        </div>
            <table class="table table-bordered">
                <center>
                    <tr> 
                        <th class="col-md-4 btn-lg">course Name:</th>
                        <td><input  class="t-danger " type="text" id="course" name="course" />
                             <p id="error" class="btn-danger"></p>
                        </td>
                    
                    </tr>
                    <tr>
                        <th class="col-md-4 btn-lg">Select College:</th>
                        <td>
                            <select name="college_id" id="college_id">
                                <option value="">Select College</option>
                                    <?php 
                                       foreach ($courseArray['college_details']['college'] as $kc=>$vc)
                                       {
                                       ?>
                                       <option value="<?php echo $vc['id'];?>"><?php echo $vc['name'];?></option>
                                    <?php }?>
                            </select>
                             <p id="error1" class="btn-danger"></p>
                        </td>
                    </tr>
                </center>
            </table>
            <input class="col-md-offset-3 btn col-md-2  btn-success" type="submit" name="course_name"  value="Add"/>
        </form>
        </div>
    </div>
</div>

 