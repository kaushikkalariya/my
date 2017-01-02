<script>
function validateForm() {
    var x = document.forms["myform"]["college"].value;
    var error=document.getElementById("error");
    if (x == "") {
        error.innerHTML="Please College Name Input";
         document.getElementById("colleges").onkeypress= function(event){
         document.getElementById("error").style.visibility = "hidden"}
        return false;
    }
}
</script>



<div class="header">
    <div class="jumbotron">
       
    kaushik
    </div>
</div> 
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3 table-bordered ">
            <div class="col-md-5 col-md-offset-4 btn-lg">
                <span class="col-md-12 text-center">
                    College Details
                </span>
            </div>

        <table class="table-bordered table">
            <tr>
                <th class="text-center">No</th>
                <th class="text-center"><a href="#">College Name</a></th>
                <th class="text-center">Edit</th>
                <th class="text-center">Delete</th>
            </tr> 
            <?php  foreach ($collegeArray as $key=>$values) { ?>
            <tr class="text-center">
                <td>
                    <?php echo  $values['id']; ?>
                </td>
                <td>
                    <a href="index.php?route=college/view&id=<?php echo  $values['id']; ?>">
                            <?php echo $values['name']; ?>
                     </a>
                </td>
                <td>
                 <a href="index.php?route=admin/collegeeditmain&id=<?php echo  $values['id'];?>
                    &page=<?php echo $collegeArray[0]['pagecuurent'];?>" 
                    class="btn btn-danger">Edit
                 </a>
             </td>
             <td>
                 <a href="index.php?route=admin/collegedelete&id=<?php echo  $values['id']; ?>
                    &page=<?php echo $collegeArray[0]['pagecuurent'];?>" 
                    class=" btn btn-primary">Delete
                 </a>
             </td>

            </tr>
            <input type="hidden" name="college_name" value="<?php echo $values['name']; ?>"/>
                <?php } ?>

        </table>
       <?php
            if($collegeArray[0]['cid']<=10){
             
            }
            else {
        ?>
        <center>
             <ul class="pagination">
                 <?php 
                    if($collegeArray[0]['prev']<3){
                       
                    }
                     else {
                    ?>
                 <li>  <a href="index.php?route=admin/collegelist&page=<?php echo  $collegeArray[0]['first'];?>">
                             First
                     </a></li>
                    <?php
                     }
                   ?>
             </ul>
            <ul class="pagination">
                <?php 
                    if($collegeArray[0]['prev']<1){
                       
                    }
                     else {
                    ?>
                        <li><a href="index.php?route=admin/collegelist&page=<?php
                                 echo  $collegeArray[0]['prev'];?>">
                             Prev
                            </a>
                        </li>
                          
                    <?php
                     }
                   ?>
            </ul>
            <?php if($collegeArray[0]['pagecuurent']==
                            $collegeArray[0]['pagecuurent']){
     
            ?>
           
                <ul class="pagination">
                    <?php for($a=1;$a<=$collegeArray[0]['page'];$a++)
                    {
                        if($collegeArray[0]['pagecuurent']==$a){?>
                            <li class="active">
                                <a href="index.php?route=admin/collegelist&page=<?php echo $a;?>">
                                    <?php echo $a;?>
                                </a>
                            </li>
                        <?php 
                        }else{?>
                            <li>
                                <a href="index.php?route=admin/collegelist&page=<?php echo $a;?>">
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
                    if($collegeArray[0]['next']==$collegeArray[0]['pagecuurent']){
                    }
                     else {
                    ?>
            <li><a href="index.php?route=admin/collegelist&page=<?php
                        echo  $collegeArray[0]['next'];?>">
                         Next
                </a></li>
                    <?php
                             }
                        ?>
            
             <?php 
                    if($collegeArray[0]['last']==$collegeArray[0]['pagecuurent']){
                    }
                     else {
                    ?>
                <li>  <a href="index.php?route=admin/collegelist&page=<?php
                echo  $collegeArray[0]['last'];?>">
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
      <form action="index.php?route=admin/collegecreate"  name="myform" onsubmit="return validateForm()"
            id="myfrom" class="form-group" method="post" enctype="multipart/form-data" >
        <div class="col-md-5 col-md-offset-4 btn-lg">
            College Add
        </div>
                <table class="table table-bordered">
                    <center>
                        <tr> 
                            <th class="col-md-4 btn-lg">College Name:</th>
                            <td><input  class="t-danger " id="colleges" type="text" name="college" />
                                 <p id="error" class="btn-danger"></p>
                            </td>
                        </tr>
                    </center>
                </table>
                <input class="col-md-offset-3 btn col-md-2  btn-success" type="submit" name="college_name"  value="Add"/>
               <div         
    </form>
        </div>
    </div>
</div>
