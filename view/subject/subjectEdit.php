<script type="text/javascript">
function validateForm() {
    var x = document.getElementById("subject").value;
    var error=document.getElementById("error");
    if (x == "") {
        error.innerHTML="Please Subject Name Input";
         document.getElementById("subject").onkeypress= function(event){
                        document.getElementById("error").style.visibility = "hidden";}
        return false;
    }
}
function save()
{
        document.getElementById('myform').action="index.php?route=college/subjectedit";
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
                Subject Edit
            </span>
        </div>
        <form id="myform" onsubmit="return  validateForm()" method="post" enctype="multipart/form-data" >      
        <table class="table text-center table-bordered">
            <tr> 
                <td>Subject Name:</td>
                <td><input type="text" id="subject" name="subjectName" value="<?php echo  $subjectSelectEdit['subject_details'][0]['name']; ?>" />
                     <p id="error" class="btn-danger"></p>
                </td>
            </tr>
           
        </table>
            <input class="col-md-offset-4 btn col-md-2   btn-success" onclick="save()" type="submit" name="subject_edit"  value="Submit"/>
        <input type="hidden" name="edit_subject" value="<?php echo $subjectSelectEdit['subject_details'][0]['id']; ?>"/> 
        <input type="hidden" name="course_id" value="<?php echo $subjectSelectEdit['subject_details'][0]['course_id']; ?>"/>
        <input type="hidden" name="page" value="<?php echo $subjectSelectEdit['subject_details'][0]['page']; ?>"/>
    </div>
</div>
</div>
