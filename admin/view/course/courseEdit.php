<script type="text/javascript">
function validateForm() {
    var x = document.getElementById("course").value;
    var error=document.getElementById("error").value;
    if (x == "") {
        error.innerHTML="Please Course Name Input";
         document.getElementById("college").onkeypress= function(event){
                        document.getElementById("error").style.visibility = "hidden";}
        
        return false;
    }
}
function save()
{
        document.getElementById('myform').action="index.php?route=admin/courseedit";
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
                Course Edit
            </span>
        </div>
        <form id="myform" name="myform" onsubmit="return  validateForm();" method="post" enctype="multipart/form-data" >      
        <table class="table text-center table-bordered">
            <tr> 
                <td>Course Name:</td>
                <td><input type="text" name="courseName" id="course" value="<?php echo  $courseEditSelect['course']['course_name']; ?>" />
                    <p id="error" class="btn-danger"></p>
                </td>
            </tr>
           
        </table>
            <input class="col-md-offset-4 btn col-md-2   btn-success" type="submit" onclick="save()" name="course_edit"  value="Submit"/>
        <input type="hidden" name="edit_course" value="<?php echo $courseEditSelect['course']['course_id']; ?>"/> 
        <input type="hidden" name="college_id" value="<?php echo $courseEditSelect['course']['college_id']; ?>"/>
        <input type="hidden" name="page" value="<?php  echo $courseEditSelect['course']['page']; ?>"/> 
    </div>
</div>
</div>
