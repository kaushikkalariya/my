<script type="text/javascript">
function validateForm() {
    var x = document.getElementById("course").value;
    var error=document.getElementById("error");
    error.innerHTML="";
    if (x == "") {
         error.innerHTML="Please Course Name Input";
          document.getElementById("course").onkeypress= function(event){
                        document.getElementById("error").style.visibility = "hidden";}
       // alert("Please Course Name Input");
        return false;
    }
}
function save(){
    document.getElementById("myform").action="index.php?route=college/coursecreate";
}
</script>
<div class="header">
    <div class="jumbotron" style="background: #9acfea">
       
    kaushik
    </div>
</div> 
<?php   $all_details=$courseArray['college_details']['id']['all_details'];
if(!empty($courseArray['class_details'][0]['name'])){?>
<div class="container">
<div class="row">
    <div class="col-md-6 col-md-offset-3 table-bordered ">
        <div class="col-md-5 col-md-offset-4 btn-lg">
            <span class="col-md-12 text-center">
                <?php 
              
                 $collgeId= $all_details['cid'];
                $page=$courseArray['class_details'][0]['pagecuurent'];
                $totle=$courseArray['class_details'][0]['countId'];
                $countId=$all_details['couCountid'];
               // echo $courseArray['class_details'][0]['course_id'];
                    echo $all_details['cname'].'<br>';
                  
                ?>
                Course List
            </span>
            
        </div>
        <table  class="table-bordered table">
            <tr class="btn-lg text-center">
                <th class="text-center">Course Id</th>
                <th class="text-center">Course Name</th>
                <th class="text-center">subject Create</th>
                <th class="text-center">Edit</th>
                <th class="text-center">Delete</th>
            </tr>
                <?php
                    if(empty($courseArray['class_details'][0]['name'])){
                        echo "plz data input valus";
                    }else{
                        foreach($courseArray['class_details'] as $k=>$v):
                ?>
             <tr class="text-center">
                 <td><?php echo $k+1; ?></td>
                  <td>
                     <a href="index.php?route=college/courseview&id=<?php echo $v['id'];?>&page=1">
                        <?php echo $v['name'];?>
                     </a>
                  </td>
                  <td>
                     <a href="index.php?route=college/subjectlist&id=<?php echo $v['id'];?>&page=1
                        ">Subject
                     </a>
                  </td>
                  <td>
                      <a class="btn btn-danger" href="index.php?route=college/courseeditselect&id=<?php echo $v['id'];?>
                         &page=<?php echo $courseArray['class_details'][0]['pagecuurent']; ?>&totle=<?php $totle ?>">
                          Edit
                      </a>
                  </td>
                   <td>
                     <a class="btn btn-primary" href="index.php?route=college/coursedelete&id=<?php echo $v['id'];?>
                        &college_id=<?php echo $all_details['cid'];?> &page=<?php echo $courseArray
                                ['class_details'][0]['pagecuurent'];?>&totle=<?php echo $totle ?>">Delete
                     </a>
                  </td>
             </tr>
                <?php
                    endforeach;
                  }
                ?>
        </table>
        <?php
            if($all_details['couCountid']<=10){
             
            }
            else {
        ?>
        <center>
            <ul class="pagination">
                 <?php 
                    if($courseArray['class_details'][0]['prev']<3){
                       
                    }
                     else {
                    ?>
                        <li>
                            <a href="index.php?route=college/view&id=<?php echo $collgeId ;?>
                            &page=<?php
                                 echo  $courseArray['class_details'][0]['first'];?>">
                                 First
                            </a>
                        </li>
                    <?php
                     }
                   ?>
            </ul>
            <ul class="pagination">
                <?php 
                    if($courseArray['class_details'][0]['prev']<1){
                       
                    }
                     else {
                    ?>
                        <li><a href="index.php?route=college/view&id=<?php echo $collgeId;?>&page=<?php
                                 echo  $courseArray['class_details'][0]['prev'];?>">
                             Prev
                            </a>
                        </li>
                          
                    <?php
                     }
                   ?>
            </ul>
            <?php if($courseArray['class_details'][0]['pagecuurent']==
                            $courseArray['class_details'][0]['pagecuurent']){
     
            ?>
           
                <ul class="pagination">
                    <?php for($a=1;$a<=$courseArray['class_details'][0]['page'];$a++)
                    {
                        if($courseArray['class_details'][0]['pagecuurent']==$a){?>
                            <li class="active">
                                <a href="index.php?route=college/view&id=<?php echo $collgeId ;?>&page=<?php echo $a;?>">
                                    <?php echo $a;?>
                                </a>
                            </li>
                        <?php 
                        }else{?>
                            <li>
                                <a href="index.php?route=college/view&id=<?php echo $collgeId ;?>&page=<?php echo $a;?>">
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
                    if($courseArray['class_details'][0]['next']==$courseArray['class_details'][0]['pagecuurent']){
                    }
                     else {
                    ?>
            <li><a href="index.php?route=college/view&id=<?php echo $collgeId; ?>&page=<?php
                        echo  $courseArray['class_details'][0]['next'];?>">
                         Next
                </a></li>
                    <?php
                             }
                        ?>
            
             <?php 
                    if($courseArray['class_details'][0]['last']==$courseArray['class_details'][0]['pagecuurent']){
                    }
                     else {
                    ?>
                <li>  <a href="index.php?route=college/view&id=<?php echo $collgeId; ?>&page=<?php
                echo  $courseArray['class_details'][0]['last'];?>">
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
<?php }?>    

<div class="container">
<div class="row">
    <div class="col-md-5 col-md-offset-3 table-bordered table-hover">
        <form  method="post" id="myform" class="form-group" onsubmit="return validateForm()" enctype="multipart/form-data" >      
        <div class="col-md-5 col-md-offset-4 btn-lg">
            Course Add
        </div>
            <table class="table table-bordered">
                <center>
                    <tr> 
                        <th class="col-md-4 btn-lg">College Name:</th>
                        <td><input id="course" class="t-danger " type="text" name="course" /> <p id="error" class="btn-danger"></td>
                    </tr>
                </center>
            </table>
            <input class="col-md-offset-3 btn col-md-2  btn-success" onclick="save()" type="submit" name="course_name"  value="Add"/>
            <input type="hidden" name="coursepost" value=" <?php echo $all_details['cid'];?>" /> 
            <input type="hidden" name="page" value="<?php echo $page;?>" />
        </form>
        </div>
    </div>
</div>