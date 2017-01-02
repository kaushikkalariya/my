<script type="text/javascript">
function validateForm() {
    var x = document.getElementById("college").value;
    var error=document.getElementById("error");
    if (x == "") {
        error.innerHTML="Please College Name Input";
         document.getElementById("college").onkeypress= function(event){
                        document.getElementById("error").style.visibility = "hidden";}
        return false;
    }
}
function save()
{
        document.getElementById('myform').action="index.php?route=college/collegeedit";
}
</script>
<div class="header">
    <div class="jumbotron" style="background: #9acfea">
       
    kaushik
    </div>
</div> 
<div class="container">
<div class="row">
    <div class="col-md-5 col-md-offset-3 table-bordered ">
        <div class="col-md-6 col-md-offset-4 btn-lg">
            
            <span class="col-md-12 text-center">
                College Edit
            </span>
        </div>
        <form  method="post"id="myform" onsubmit="return validateForm()" enctype="multipart/form-data" >      
        <table class="table text-center table-bordered">
            <tr> 
                <td>CollegeName:</td>
                <td><input type="text" id="college" name="college" value="<?php  echo $collegeEditSelect['college']['college_name']; ?>"  />
                    <p id="error" class="btn-danger"></p></td>
                <br>
            </tr>
        </table>
            <input class="col-md-offset-3 btn col-md-2   btn-success" onclick="save()"type="submit" name="college_edit"  value="submit"/>
        <input type="hidden"  name="college_id" value="<?php  echo $collegeEditSelect['college']['college_id']; ?>"/> 
        <input type="hidden" name="course_id" value="<?php echo $TeacherEditSelect['class']['class_id']; ?>"/> 
        <input type="hidden" name="page" value="<?php echo $collegeEditSelect['college']['page']; ?>"/> 
    </div>
</div>
</div>
