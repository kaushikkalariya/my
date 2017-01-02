<script type="text/javascript">
function validateForm() {
    var x = document.getElementById("teacher").value;
    var error=document.getElementById("error");
    if (x == "") {
            error.innerHTML="Please Teacher Name Input";
             document.getElementById("teacher").onkeypress= function(event){
                        document.getElementById("error").style.visibility = "hidden";}
        
        return false;
    }
}
function save()
{
        document.getElementById('myform').action="index.php?route=admin/teacheredit";
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
                Teacher Edit
            </span>
        </div>
        <form  method="post" enctype="multipart/form-data" id="myform"  onsubmit="return validateForm()">      
        <table class="table text-center table-bordered">
            <tr> 
                <td>Teacher Name:</td>
                <td><input type="text" name="teacherName" id="teacher" value="<?php echo  $TeacherEditSelect['teacher']['teacher_name']; ?>" />
                    <p id="error" class="btn-danger"></p>
                </td>
                <br>
            </tr>
            
        </table>
            <input class="col-md-offset-3 btn col-md-2   btn-success" onclick="save()"type="submit" name="teacher_edit"  value="submit"/>
        <input type="hidden" name="edit_teacher" value="<?php echo $TeacherEditSelect['teacher']['teacher_id']; ?>"/> 
        <input type="hidden" name="course_id" value="<?php echo $TeacherEditSelect['course']['course_id']; ?>"/> 
        <input type="hidden" name="page" value="<?php echo $TeacherEditSelect['teacher']['page']; ?>"/> 
    </div>
</div>
</div>