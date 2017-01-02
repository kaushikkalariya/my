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
			url: "dropdown/MainDropDwonList.php?drop=Teacher/DropCourse",
			data: dataString,
			cache: false,
			success: function(html)
			{
				$(".course").html(html);
			} 
                        
		});
	});
        $(".course").change(function()
	{
		var id=$(this).val();
		var dataString = 'id='+ id;
	
		$.ajax
		({
			type: "POST",
			url: "dropdown/MainDropDwonList.php?drop=Teacher/Dropsubject",
			data: dataString,
			cache: false,
			success: function(html)
			{
				$(".subject").html(html);
			} 
		});
	});
});
function save()
{
        document.getElementById('myform').action="index.php?route=admin/teachercreate";
}
function validateForm() {
    var student = document.getElementById("teacherName").value;
    var college_id=document.getElementById("college").value;
    var course=document.getElementById("course").value;
    var subjact=document.getElementById("subjectName").value;
    var error=document.getElementById("error");
    var error1=document.getElementById("error1");
    var error2=document.getElementById("error2");
    var error3=document.getElementById("error3");
    if(student=="" && college_id=="" ){
           document.getElementById("college").onchange= function(event){
                        document.getElementById("error1").style.visibility = "hidden";}
               error1.innerHTML="Please Select College name";
           document.getElementById("teacherName").onkeypress= function(event){
                        document.getElementById("error").style.visibility = "hidden";}
             error.innerHTML="Please Teacher Name Input";
          return false;
    }
    else{
        if (student != "") {
           if(college_id !=""){
                if(course !==""){
                    if(subjact==""){
                      document.getElementById("subjectName").onchange= function(event){
                       document.getElementById("error3").style.visibility = "hidden"}
                        error3.innerHTML="Please Select Subject name";
                         return  false;
                    }
                    else{
                        return  true;
                    }

                }  
                else{
                    //alert('gdfg');
                     error2.innerHTML="Please Select Couse name";
                    document.getElementById("course").onchange= function(event){
                        document.getElementById("error2").style.visibility = "hidden";}
                  
                    return  false;

                }
           }
           else{
               document.getElementById("college").onchange= function(event){
                        document.getElementById("error1").style.visibility = "hidden";}
               error1.innerHTML="Please Select College name";
               return  false;
           }
        }else{
            document.getElementById("teacherName").onkeypress= function(event){
                        document.getElementById("error").style.visibility = "hidden";}
             error.innerHTML="Please Teacher Name Input";
             
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
        <div class="col-md-8 col-md-offset-2 table-bordered ">
            <div class="col-md-5 col-md-offset-4 btn-lg">
                <span class="col-md-12 text-center">
                    student Details
                </span>
            </div>

        <table class="table-bordered table">
            <tr>
                <th class="text-center">No</th>
                <th class="text-center">College Name</th>
                <th class="text-center"> college Name</th>
                <th class="text-center">Teacher Name</th>
                <th class="text-center">subject Name</th>
                <th class="text-center">Edit</th>
                <th class="text-center">Delete</th>
            </tr> 
            <?php  
                    foreach($TeacherArray['teacher_details']  as $k=>$v):	
                    ?>
                <tr>
                    <td><?php echo $k+1; ?></td>
                    <td><?php echo $v['collegeName'];?></td>
                    <td><?php echo $v['courseName'];?></td>
                    <td><?php echo $v['teacherName'];?></td>
                    <td><?php echo $v['subjectName'];?></td>
                     <td><a  class="btn-primary btn" href="index.php?route=admin/teacherselect&id=<?php echo $v['tid'];?>&page=<?php echo $TeacherArray['teacher_details'][0]['pagecuurent'];?>">Edit</a></td>
                    <td><a class="btn btn-danger" href="index.php?route=admin/teacherdelete&id=<?php echo $v['tid'];?>&page=<?php echo $TeacherArray['teacher_details'][0]['pagecuurent'];?>">Delete</a></td>
                   
   
                </tr>

                  <?php
                        endforeach;
                        //}
                ?>
        </table>
              <?php
            if($TeacherArray['teacher_details'][0]['tId']<=10){
             
            }
            else {
        ?>
        <center>
            <ul class="pagination">
                 <?php 
                    if($TeacherArray['teacher_details'][0]['prev']<3){
                       
                    }
                     else {
                    ?>
                        <li>
                            <a href="index.php?route=admin/teacherlist&page=<?php echo $a;?>" >
                           &page=<?php echo  $TeacherArray['teacher_details'][0]['first'];?>">
                             First
                            </a>
                        </li>
                    <?php
                     }
                   ?>
            </ul>
            <ul class="pagination">
                <?php 
                    if($TeacherArray['teacher_details'][0]['prev']<1){
                       
                    }
                     else {
                    ?>
                        <li><a href="index.php?route=admin/teacherlist&page==<?php echo $collgeId;?>&page=<?php
                                 echo  $TeacherArray['teacher_details'][0]['prev'];?>">
                             Prev
                            </a>
                        </li>
                          
                    <?php
                     }
                   ?>
            </ul>
            <?php if($TeacherArray['teacher_details'][0]['pagecuurent']==
                            $TeacherArray['teacher_details'][0]['pagecuurent']){
     
            ?>
           
                <ul class="pagination">
                    <?php for($a=1;$a<=$TeacherArray['teacher_details'][0]['page'];$a++)
                    {
                        if($TeacherArray['teacher_details'][0]['pagecuurent']==$a){?>
                            <li class="active">
                                <a href="index.php?route=admin/teacherlist&page=<?php echo $a;?>">
                                    <?php echo $a;?>
                                </a>
                            </li>
                        <?php 
                        }else{?>
                            <li>
                                <a href="index.php?route=admin/teacherlist&page=<?php echo $a;?>">
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
                    if($TeacherArray['teacher_details'][0]['next']==$TeacherArray['teacher_details'][0]['pagecuurent']){
                    }
                     else {
                    ?>
            <li><a href="index.php?route=admin/admin/teacherlist&page==<?php echo $collgeId; ?>&page=<?php
                        echo  $TeacherArray['teacher_details'][0]['next'];?>">
                         Next
                </a></li>
                    <?php
                             }
                        ?>
            
             <?php 
                    if($TeacherArray['teacher_details'][0]['last']==$TeacherArray['teacher_details'][0]['pagecuurent']){
                    }
                     else {
                    ?>
                <li>  <a href="index.php?route=college/list&page=<?php
                echo  $TeacherArray['teacher_details'][0]['last'];?>">
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
        <form action="#" method="POST" class="form-group" onsubmit="return  validateForm()" enctype="multipart/form-data" id="myform" >      
        <div class="col-md-5 col-md-offset-4 btn-lg">
            Teacher Add
        </div>
            <table class="table table-bordered">
                <center>
                    <tr> 
                        <th class="col-md-4 btn-lg">Teacher Name:</th>
                        <td><input  class="t-danger " type="text" id="teacherName" name="teacherName" />
                            <p id="error" class="btn-danger"></p>
                        </td>
                    </tr>
                    <tr> 
                        <th class="col-md-4 btn-lg">Select College:</th>
                        <td>
                            <select name="collegeId" class="college" id="college">
                                <option value="">Select College</option>
                                    <?php 
                                       foreach ($TeacherArray['college_details']['colandcou'] as $kc=>$vc)
                                       {
                                        ?>
                                       <option value="<?php echo $vc['cid'];?>"><?php echo $vc['cname'];?></option>
                                       <?php }?>
                            </select>
                            <p id="error1" class="btn-danger"></p>
                        </td>
                    </tr>
                    <tr>
                        <th class="col-md-4 btn-lg">Select Course:</th>
                        <td>
                            <select name="courseId" class="course" id="course" >
                                <option>Select course</option>
                                <?php echo $courseDrop;?>
                            </select>
                            <p id="error2" class="btn-danger"></p>
                        </td>
                    </tr>
                    <tr>
                        <th class="col-md-4 btn-lg">Select Subject:</th>
                        <td>
                            <select name="subId" class="subject" id="subjectName">
                                <option>Select Subject</option>
                                    
                            </select>
                            <p id="error3" class="btn-danger"></p>
                        </td>
                        
                    </tr>
                </center>
            </table>
            <input class="col-md-offset-3 btn col-md-2  btn-success" type="submit" name="teacher_name" onclick="save();"value="Add"/>
        </form>
        </div>
    </div>
</div>
 