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
function save(){
    document.getElementById("myform").action="index.php?route=college/subjectcreate";
}
</script>
<div class="header">
    <div class="jumbotron" style="background: #9acfea">
       
    kaushik
    </div>
</div> 

<?php   $all_details=$subjectArray['course_details']['id']['all_details'];
if(!empty($subjectArray['subject_details'][0]['subname'])){?>
<div class="container">
<div class="row">
    <div class="col-md-6 col-md-offset-3 table-bordered ">
        <div class="col-md-5 col-md-offset-4 btn-lg">
            <span class="col-md-12 text-center">
                Subject
               <?php 
              
               //print_r($subjectArray['course_details']['id']['all_details']['cname']);
               $classId=$subjectArray['course_details']['id']['all_details']['id'];
               $page=$subjectArray['subject_details'][0]['pagecuurent'];
               echo '<br>'. $all_details['cname'].'<br>';
               echo $all_details['name'];
                    
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
           
               // echo "plz data input valus";
            
            foreach($subjectArray['subject_details'] as $k=>$v):
        ?>
            <tr class="text-center">
                <td><?php echo $k+1; ?></td>
                 <td>
             <a href="index.php?route=college/subjectinsert&id=<?php echo $v['subname'];?>
                "><?php echo $v['subname'];?>
             </a>
          </td>
           <td><a  class="btn-danger btn " href="index.php?route=college/subjectSelectEdit&id=<?php echo $v['subid'];?>&page=<?php echo $page;?>">Edit</a>
          </td>
         
          <td>
             <a  class="btn-primary btn" href="index.php?route=college/subjectDelete&id=<?php echo $v['subid'];?>&classId=
                 <?php echo $all_details['id'];?>&page=<?php echo $page;?>">Delete
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
                               <a href="index.php?route=college/subjectlist&id=<?php echo $classId; ?>
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
                        <li><a href="index.php?route=college/subjectlist&id=<?php echo $classId; ?>&page=<?php
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
                                <a href="index.php?route=college/subjectlist&id=<?php echo $classId; ?>&page=<?php echo $a;?>">
                                    <?php echo $a;?>
                                </a>
                            </li>
                        <?php 
                        }else{?>
                            <li>
                                <a href="index.php?route=college/subjectlist&id=<?php echo $classId; ?>&page=<?php echo $a;?>">
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
            <li><a href="index.php?route=college/subjectlist&id=<?php echo $classId; ?>&page=<?php
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
                <li>  <a href="index.php?route=college/subjectlist&id=<?php echo $classId; ?>&page=<?php
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
        <form id="myform" onsubmit="return  validateForm()" method="post" class="form-group" enctype="multipart/form-data" >      
        <div class="col-md-5 col-md-offset-3 btn-lg">
            Subject Add
        </div>
             <table class="table table-bordered">
                <center>
                    <tr> 
                        <th class="col-md-4 btn-lg">Subject Name:</th>
                        <td><input id="subject" class="t-danger " type="text" name="subject" />
                            <p id="error" class="btn-danger"></p>
                        </td>
                    </tr>
                </center>
            </table>
            <input class="col-md-offset-3 btn col-md-2  btn-success" type="submit" onclick="save()" name="subject_name"  value="Add"/>
            <input type="hidden" name="coursepost" value=" <?php echo $all_details['id'];?>" />
        </form>
        </div>
    </div>
</div>
   