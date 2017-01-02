<!--<script type="text/javascript">
    function myfunction(){
        document.getElementById("label").innerHTML = document.getElementById("collegeId").value;
        document.getElementById("myform").submit();
    }
    function save()
    {
        document.getElementById('myform').action="index.php?route=admin/studentcreate";
    }
   
</script>-->
<script type="text/javascript">
$(document).ready(function()
  {
	$(".college").change(function()
	{
            
		var id=$(this).val();
		var dataString = 'id='+ id;
		$(".course").find('option').remove();
		$(".subject").find('option').remove();
		$.ajax
		({
			type: "POST",
			url: "dropdown/MainDropDwonList.php?drop=Student/DropCourse",
			data: dataString,
			cache: false,
			success: function(html)
			{
				$(".course").html(html);
			} 
                        
		});
	});
});
function save()
{
        document.getElementById('myform').action="index.php?route=admin/studentcreate";
}
function validateForm() {
    var student = document.getElementById("studentName").value;
    var college_id=document.getElementById("college").value;
    var error=document.getElementById("error");
    var error1=document.getElementById("error1");
    var error2=document.getElementById("error2");
    //alert(college_id);
    var course=document.getElementById("course").value;
    if(student=="" && college_id=="" && course==""){
        error1.innerHTML="Please Select College name";
        error.innerHTML="Please Student Name Input";
        document.getElementById("studentName").onkeypress= function(event){
                        document.getElementById("error1").style.visibility = "hidden"}
        document.getElementById("college").onchange= function(event){
                        document.getElementById("error1").style.visibility = "hidden"}
    }
    if (student != "") {
       if(college_id !=""){
            if(course ==""){
                document.getElementById("course").onchange= function(event){
                        document.getElementById("error2").style.visibility = "hidden"}
                error2.innerHTML="Please Select Couse name";
                return  false;
            }
            else{
                alert(course);
                 return true;
            }
       }
       else{
           document.getElementById("college").onchange= function(event){
                        document.getElementById("error1").style.visibility = "hidden"}
           error1.innerHTML="Please Select College name";
           return  false;
       }
    }else{
        document.getElementById("studentName").onkeypress= function(event){
                        document.getElementById("error").style.visibility = "hidden"}
         error.innerHTML="Please Student Name Input";
        return false;
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
        <div class="col-md-8 col-md-offset-2 table-bordered ">
            <div class="col-md-5 col-md-offset-4 btn-lg">
                <span class="col-md-12 text-center">
                    student Details
                </span>
            </div>

        <table class="table-bordered table">
            <tr>
                <th class="text-center">Student Id</th>
                <th class="text-center">College Name</th>
                <th class="text-center"> college Name</th>
                <th class="text-center">Student Name</th>
                <th class="text-center">Edit</th>
                <th class="text-center">Delete</th>
            </tr> 
            <?php foreach($StudentArray['student_details']  as $k=>$v):

                    ?>
            <tr class="text-center">
                     <td><?php echo $k+1;?></td>
                     <td><?php echo $v['collegeName'];?></td>
                     <td><?php echo $v['courseName'];?></td>
                     <td><?php echo $v['studentName'];?></td>
                     <td><a class="btn-danger btn" href="index.php?route=admin/studentselect&id=<?php echo $v['sid'];?>
                            &page=<?php echo $StudentArray['student_details'][0]['pagecuurent'] ?>">Edit</a></td>
                     <td><a class="btn-primary btn" href="index.php?route=admin/studentdelete&id=<?php echo $v['sid'];?>
                            &page=<?php echo $StudentArray['student_details'][0]['pagecuurent']?>">Delete</a></td>
                </tr>
                    <?php
                    endforeach;
                    ?>
        </table>
          <?php
            if($StudentArray['college_details']['colandcou'][0]['stuCountId']<=10){
             
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
                            <a href="index.php?route=admin/studentlist&page=<?php echo $StudentArray['student_details'][0]['first'];?>">
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
                        <li><a href="index.php?route=admin/studentlist&page=<?php
                                 echo $StudentArray['student_details'][0]['prev'];?>">
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
                                <a href="index.php?route=admin/studentlist&page=<?php echo $a;?>">
                                    <?php echo $a;?>
                                </a>
                            </li>
                        <?php 
                        }else{?>
                            <li>
                                <a href="index.php?route=admin/studentlist&page=<?php echo $a;?>">
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
            <li><a href="index.php?route=admin/studentlist&page=<?php
                        echo $StudentArray['student_details'][0]['next'];?>">
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
                <li>  <a href="index.php?route=admin/studentlist&page=<?php
                echo $StudentArray['student_details'][0]['last'];?>">
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
        <form action="" method="post" id="myform" class="form-group" 
              onsubmit="return  validateForm()" enctype="multipart/form-data" >      
        <div class="col-md-5 col-md-offset-4 btn-lg">
            Student Add
        </div>
            <table class="table table-bordered">
                <center>
                    <tr> 
                        <th class="col-md-4 btn-lg">student Name:</th>
                        <td><input  class="t-danger " type="text" id="studentName" name="studentName" />
                            <p id="error" class="btn-danger"></p>
                        </td>
                    
                    </tr>
                    <tr>
                        <th class="col-md-4 btn-lg">Select College:</th>
                        <td>
                            <select name="college_id" id="college" class="college">
                                <option value="">Select College</option>
                                    <?php 
                                       foreach ($StudentArray['college_details']['colandcou'] as $kc=>$vc){
                                         ?>
                                           <option value="<?php echo $vc['cid'];?>"><?php echo $vc['cname'];?></option>
                                    <?php } ?>
                            </select>
                            <p id="error1" class="btn-danger"></p>
                        </td>
                    </tr>
                    <tr>
                        <th class="col-md-4 btn-lg">Select College:</th>
                        <td>
                            <select name="course_id" id="course" class="course">
                                <option value="">Select course</option>
                                   
                            </select>
                            <p id="error2" class="btn-danger"></p>
                        </td>
                    </tr>
                </center>
            </table>
            <input class="col-md-offset-3 btn col-md-2  btn-success" type="submit" name="student_name" onclick="save();" value="Add"/>
        </form>
        </div>
    </div>
</div>
<div id="label" ></div>
<?php