<script type="text/javascript">
//     document.getElementById("error").style.visibility="hidden";
    function ok(){
   // alert('dfsdf');
    document.getElementById("error").style.visibility="hidden";
        return true;
    }
    function ok1(){
   // alert('dfsdf');
    document.getElementById("error1").style.visibility="hidden";
        return true;
    }
    function ok2(){
   // alert('dfsdf');
    document.getElementById("error2").style.visibility="hidden";
        return true;
    }
    
$(document).ready(function()
  {     
        var courseId=document.getElementById("courseId").value;
     //   alert(courseId);
        //$_SESSION['colleges'];
        
	$(".college").change(function()
	{
       //       alert(courseId);
		var id=$(this).val();
		var dataString = 'id='+ id +'&courseId='+courseId;
                //alert(id);
		$.ajax
		({
			type: "POST",
			url: "dropdown/MainDropDwonList.php?drop=Subject/DropCourse",
			data: dataString,
			cache: false,
			success: function(html)
			{
				$(".course").html(html);
			} 
                        
		});
	});
               
        if(courseId){
         //   alert("jj");
            $(".college").trigger("change");
            //$()
        }
        
});
function save()
{
        document.getElementById('myform').action="index.php?route=admin/subjectcreate";
}
function validateForm() {
    var subject = document.getElementById("subject").value;
    var college_id=document.getElementById("college").value;
    //alert(college_id);
    var error=document.getElementById("error");
    var error1=document.getElementById("error1");
    var error2=document.getElementById("error2");
   // var error3=document.getElementById("error3");
    var course=document.getElementById("course").value;
    if(subject =="" && course=="" && college_id==""){
         error1.innerHTML="Please Select College name";
         error.innerHTML="Please Subject Name Input";
          document.getElementById("subject").onkeypress= function(event){
                  document.getElementById("error").style.visibility = "hidden"}
          document.getElementById("college").onchange=function(event){
               document.getElementById("error1").style.visibility = "hidden";}
          return false;
     }else{
        if (subject != "") {
            
           if(college_id !=""){
                if(course ==""){
                    document.getElementById("course").onchange= function(event){
                        document.getElementById("error2").style.visibility = "hidden"}
                   error2.innerHTML="Please Select Couse name";
                    return  false;
                }
                else{
                   // alert(course);
                     return true;
                }
           }
           else{
               document.getElementById("college").onchange=function(event){
               document.getElementById("error1").style.visibility = "hidden";
              }
                 error1.innerHTML="Please Select College name";
               return  false;
           }
        }else{
                document.getElementById("subject").onkeypress= function(event){
                  document.getElementById("error").style.visibility = "hidden"}
            error.innerHTML="Please Subject Name Input";
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
                Subject List
               <?php 
              $all_details=$subjectArray['college_details']['id']['all_details'][0];
               //print_r($subjectArray['course_details']['id']['all_details']['cname']);
              // $classId=$subjectArray['college_details']['id']['all_details'][0]['id'];
               $page=$subjectArray['subject_details'][0]['pagecuurent'];
              // echo '<br>'. $all_details['cname'].'<br>';
              // echo $all_details['name'];
                    
               ?>
            </span>
        </div>
        <table  align="center" class="table-bordered table">
        <tr class="btn-lg">
        <th class="text-center">Course Id</th>
        <th class="text-center">subject Name</th>
        <th class="text-center">Edit</th>
        <th class="text-center">Delete</th>
           <?php
            if(empty($subjectArray['subject_details'][0]['subname'])){
                echo "plz data input valus";
            }else{
            foreach($subjectArray['subject_details'] as $k=>$v):
        ?>
            <tr class="text-center">
                <td><?php echo $k+1; ?></td>
                 <td>
             <a href="index.php?route=admin/subjectinsert&id=<?php echo $v['subname'];?>
                "><?php echo $v['subname'];?>
             </a>
          </td>
           <td><a  class="btn-danger btn " href="index.php?route=admin/subjectSelectEdit&id=<?php echo $v['subid'];?>&page=<?php echo $page;?>">Edit</a>
          </td>
         
          <td>
             <a  class="btn-primary btn" href="index.php?route=admin/subjectDelete&id=<?php echo $v['subid'];?>&page=<?php echo $page;?>">Delete
             </a>
          </td>
            </tr>
            <?php
            endforeach;}
            ?>
    </table>
               <?php
            if($all_details['subCountId']<=10){
                
            }
            else {
        ?>
        <center>
            <ul class="pagination">
                 <?php 
                    if($subjectArray['subject_details'][0]['prev']<3){
                       
                    }
                     else {
                    ?>
                        <li>
                            <a href="index.php?route=admin/subjectlist&id=<?php echo $classId; ?>
                           &page=<?php
                                 echo  $subjectArray['subject_details'][0]['first'];?>">
                             First
                            </a>
                        </li>
                    <?php
                     }
                   ?>
            </ul>
            <ul class="pagination">
                <?php 
                    if($subjectArray['subject_details'][0]['prev']<1){
                       
                    }
                     else {
                    ?>
                        <li><a href="index.php?route=admin/subjectlist&id=<?php echo $classId; ?>&page=<?php
                                 echo  $subjectArray['subject_details'][0]['prev'];?>">
                             Prev
                            </a>
                        </li>
                          
                    <?php
                     }
                   ?>
            </ul>
            <?php if($subjectArray['subject_details'][0]['pagecuurent']==
                           $subjectArray['subject_details'][0]['pagecuurent']){
     
            ?>
           
                <ul class="pagination">
                    <?php for($a=1;$a<=$subjectArray['subject_details'][0]['page'];$a++)
                    {
                        if($subjectArray['subject_details'][0]['pagecuurent']==$a){?>
                            <li class="active">
                                <a href="index.php?route=admin/subjectlist&id=<?php echo $classId; ?>&page=<?php echo $a;?>">
                                    <?php echo $a;?>
                                </a>
                            </li>
                        <?php 
                        }else{?>
                            <li>
                                <a href="index.php?route=admin/subjectlist&id=<?php echo $classId; ?>&page=<?php echo $a;?>">
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
                    if($subjectArray['subject_details'][0]['next']==$subjectArray['subject_details'][0]['pagecuurent']){
                    }
                     else {
                    ?>
            <li><a href="index.php?route=admin/subjectlist&id=<?php echo $classId; ?>&page=<?php
                        echo  $subjectArray['subject_details'][0]['next'];?>">
                         Next
                </a></li>
                    <?php
                             }
                        ?>
            
             <?php 
                    if($subjectArray['subject_details'][0]['last']==$subjectArray['subject_details'][0]['pagecuurent']){
                    }
                     else {
                    ?>
                <li>  <a href="index.php?route=admin/subjectlist&id=<?php echo $classId; ?>&page=<?php
                echo  $subjectArray['subject_details'][0]['last'];?>">
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
    <div class="col-sm-5 col-sm-offset-3 table-bordered table-hover">
        <form   method="post" class="form-group" 
              enctype="multipart/form-data" id="myform">      
        <div class="col-md-6 col-md-offset-3 btn-lg">
            Subject Add
        </div>
            <table class="table table-bordered">
                <center>
                    <tr>
                        <th class="col-md-4 btn-lg">Subject Name:</th>
                        <td><input  class="t-danger " id="subject" type="text" onkeypress="" value="<?php if(isset($_SESSION['subjectName']['test'])){echo  $_SESSION['subject'];}?>" name="subject" />
                                 
                                    <p id="error" name="error" class="btn-danger">
                                        <?php if(isset($_SESSION['k']['test'])){ echo $_SESSION['error'];?>
                                           <button type="button" onclick="ok()" class="close" data-dismiss="modal">&times;</button></p>
                                        <?php } ?> 
                             
                        </td>
                    </tr>
                     <tr> 
                        <th class="col-md-4 btn-lg">Select College:</th>
                        <td>
                            <select name="collegeId" class="college"  id="college"  >
                                <option value="" selected="<?php if(isset($_SESSION['collegeName']['test'])){echo  $_SESSION['colleges'];}?>" >Select College</option>
                                    <?php  $collgeIds=$subjectArray['college_details']['course']['course_details'];
                                            echo $collgeIds['id'];
                                       foreach ($subjectArray['college_details']['id']['all_details'] as $kc=>$vc)
                                       {
                                           if($_SESSION['colleges']==$vc['collegeid']){
                                               
                                               ?>
                                <option selected="<?php echo $vc['collegeid'];?>" value="<?php echo $vc['collegeid'];?>"><?php echo $vc['cname']; ?></option>
                                            <?php 
                                               
                                            echo  $_SESSION['colleges'];}
                                            else{
                                          ?> 
                                       <option  value="<?php echo $vc['collegeid'];?>"><?php echo $vc['cname'];?></option>
                                       <?php }}?>
                                       
                            </select>
                            <p id="error1" name="error1" class="btn-danger">
                                        <?php if(isset($_SESSION['college']['test'])){ echo $_SESSION['error1'];?>
                                <button type="button" onclick="ok1()" class="close" data-dismiss="modal">&times;</button>
                                        <?php } ?></p>
                            <p id="error1" class="btn-danger"></p>
                        </td>
                    </tr>
                    <tr>
                        <th class="col-md-4 btn-lg">Select Course:</th>
                        <td>
                            <select name="course_id" class="course" id="course">
                                <option value="">Select course</option>
                                 <?php  
                                    if($courseDrop['course'][0]){
                                    echo $courseDrop['course'][0];}?>
                            </select>
                            <p id="error2" name="error2" class="btn-danger">
                                        <?php if(isset($_SESSION['course']['test'])){ echo  $_SESSION['error2'];?>
                                <button type="button" onclick="ok2()" class="close" data-dismiss="modal">&times;</button></p>
                                        <?php } ?></p>
                            <p id="error2" class="btn-danger"></p>
                            <p id="error2" class="btn-danger"></p>
                        </td>
                    </tr>
                </center>
            </table>
            <input class="col-md-offset-3 btn col-md-2  btn-success add"  type="submit" name="subject_name" onclick="save();"  value="Add"/>
            <input type="hidden" name="courseID" value=" <?php echo $subjectArray['college_details']['course']['course_details'][0]['id'];?>" />
            <input type="hidden" id="courseId" value="<?php   echo  $_SESSION['courseId'];?>">
        </form>
        </div>
    </div>
</div>

<?php //print_r($_SESSION['k']['test']); 
                                      unset($_SESSION['k']['test']);
                                      unset($_SESSION['college']['test']);
                                      unset($_SESSION['course']['test']);
                                      unset($_SESSION['subjectName']['test']);
                                      unset($_SESSION['collegeName']['test']);
                                      unset($_SESSION['colleges']);
                                      unset($_SESSION['courseId']);
                                      unset($_SESSION['error']);
                                      unset($_SESSION['error1']);
                                      unset($_SESSION['error2']);
                                      ?>