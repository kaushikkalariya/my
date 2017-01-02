<script type="text/javascript">
function validateForm() {
    var x = document.getElementById("college").value;
    var error=document.getElementById("error");
    error.innerHTML="";
    if (x == "") {
        error.innerHTML="Please College Name Input"
        //alert("Please College Name Input");
        return false;
    }
}
function createSave()
    document.getElementById("myforms").action="index.php?route=college/collegecreate"

function showTxt(str)
{
	var xhttp;
	if(str.length==0)
	{
		document.getElementById("searchlist").innerHTML="";
		return ;
	}
        var userId=document.getElementById("user").value;
      // alert(userId);
	xhttp=new XMLHttpRequest();
	xhttp.onreadystatechange=function(){
		if(this.readyState==4 && this.status==200)
		{
			document.getElementById("searchlist").innerHTML=this.responseText;
		}
	};
       
	xhttp.open("GET","SearchList.php?List=SearchList&value="+str+"&userId="+userId,true);
	xhttp.send();
        // alert(xhttp.responseText);
	
}
function save()
{
        document.getElementById('myform').action="index.php?route=admin/studentcreate";
}
</script>
<div class="header">
    <div class="jumbotron" style="background: #9acfea">
       
    kaushik
    </div>
</div> 
<nav class="navbar ">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->


    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse bg-primary" id="bs-example-navbar-collapse-1" >
    
        <center>
            <form class="navbar-form" action="#" 
                  method="post" enctype="multipart/form-data">
              <div class="form-group">
                  <input type="text" class="search form-control" name="value" onkeyup="showTxt(this.value)"  placeholder="Search College Name">
              </div>
                <button type="submit" name="Submit"  class="btn btn-primary">Submit</button>
              <input type="hidden" name="collegeId" value="<?php   echo $collegeArray[0]['userId']; ?>">
            </form>
            <input type="hidden" id="user" value="<?php  echo $user_id=$collegeArray[0]['userId'];;?>" />       
        </center>
      
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<!-- <form class="form-group" action="index.php?route=college/searchlist" method="post" enctype="multipart/form-data">
		<center>
            Search Name <input type="text" name="value" />:
            <input class="" type="submit" name="Submit"  value="Submit"/>
         </center>
	</form>-->
<div id="searchlist">
    
</div>
<?php if (!empty($collegeArray[0]['name'])){?>
<div class="container">
<div class="row">
    <div class="col-md-5 col-md-offset-4 table-bordered ">
        <div id="searchlist">
        <div class="col-md-5 col-md-offset-4 btn-lg text-center">
            College List
        </div>
    <table border="3" align="center" class="table table-bordered ">
        <tr class="btn-lg">
            <th class="text-center">No</th>
            <th class="text-center">College Name</th>
            <th class="text-center">Edit</th>
            <th class="text-center">Delete</th>
            
        </tr> 
            <?php //print($collgeArray['[0]['userId']); 
                    $collegeArray[0]['pagecuurent'];
                
            foreach ($collegeArray as $key=>$values) { ?>
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
                 <a href="index.php?route=college/collegeeditmain&id=<?php echo  $values['id'];?>&userId=<?php echo $collegeArray[0]['userId'] ?>&page=<?php echo $collegeArray[0]['pagecuurent'];?>"  class="btn btn-danger">Edit
                 </a>
             </td>
             <td>
                 <a href="index.php?route=college/collegedelete&id=<?php echo  $values['id']; ?>&userId=<?php echo $collegeArray[0]['userId'] ?>&page=<?php echo $collegeArray[0]['pagecuurent'];?>" class=" btn btn-primary">Delete
                 </a>
             </td>

        </tr>
        <from>
        <input type="hidden" name="college_name" value="<?php echo $values['name']; ?>"/>
            <?php } ?>
        </from>
    </table>
        <?php 
            if($collegeArray[0]['cId']['cId']<=10){
             
            }
            else {                echo 'nnn';
        ?>
        <center>
             <ul class="pagination">
                 <?php 
                    if($collegeArray[0]['prev']<3){
                       
                    }
                     else {
                    ?>
                            <li>
                                <a href="index.php?route=college/list&page=<?php
                                 echo  $collegeArray[0]['first'];?>">
                                     First
                                </a>
                            </li>
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
                        <li><a href="index.php?route=college/list&page=<?php
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
                                <a href="index.php?route=college/list&page=<?php echo $a;?>">
                                    <?php echo $a;?>
                                </a>
                            </li>
                        <?php 
                        }else{?>
                            <li>
                                <a href="index.php?route=college/list&page=<?php echo $a;?>">
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
            <li><a href="index.php?route=college/list&page=<?php
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
                <li>  <a href="index.php?route=college/list&page=<?php
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
</div>
<?php }?>

<div class="container">
<div class="row">
    <div class="col-md-5 col-md-offset-4 table-bordered table-hover">
        <form   id="myforms" onsubmit="return validateForm()"class="form-group "  method="post" enctype="multipart/form-data" >
        <div class="col-md-5 col-md-offset-4 btn-lg">
            College Add
        </div>
                <table class="table table-bordered">
                    <center>
                        <tr> 
                            <th class="col-md-4 btn-lg">College Name:</th>
                            <td><input  class="t-danger " id="college" type="text" name="college"  /> <p id="error" class="btn-danger"></p></td>
                       
                        </tr>
                         </center>
                    </table>
            <input class="col-md-offset-3 btn col-md-2  btn-success" onclick="createSave()()"type="submit" name="college_name"  value="Add"/>
                        
    </form>
        </div>
    </div>
</div>

