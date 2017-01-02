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
function save()
{
        document.getElementById('myform').action="index.php?route=college/studentedit";
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
        <div class="col-md-5 col-md-offset-4 btn-lg">
            
            <span class="col-md-12 text-center">
                Student Edit
            </span>
        </div>
        <form id="myform" method="post" onsubmit="return validateForm()" enctype="multipart/form-data" >      
       <table class="table text-center table-bordered">
            <tr>
                <td class="text-center btn-lg">Student Name:</td>
                <td><input type="text" id="student" name="studentName" value="<?php print($studentEditSelect['student']['student_name']); ?>" />
                     <p id="error" class="btn-danger"></p>
                </td><br>
            </tr>
       </table>
            <input  class="col-md-offset-3 btn col-md-2   btn-success"  onclick="save()"type="submit" name="student_edit"  value="Submit"/>
       <input type="hidden" name="edit_student" value="<?php print($studentEditSelect['student']['student_id']); ?>"/> 
       <input type="hidden" name="course_id" value="<?php print($studentEditSelect['course']['course_id']); ?>"/> 
       <input type="hidden" name="page" value="<?php print($studentEditSelect['student']['page']); ?>"/> 
    </form>
    </div>
</div>
</div>