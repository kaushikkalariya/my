<html>
    <head>
        <title>
            
        </title>
        <link href="../../public/style.css">
        <script type="text/javascript">
    function validition(){
    var error=document.getElementById("error");
    var error1=document.getElementById("error1");
    var error2=document.getElementById("error2");
    var error3=document.getElementById("error3");
    var error4=document.getElementById("error4");
    var error5=document.getElementById("error5");
    var error6=document.getElementById("error6");
    var fristname=document.getElementById("fristname").value;
    var lastname=document.getElementById("lastname").value;
    var email=document.getElementById("email").value;
    var password=document.getElementById("password").value;
    var address=document.getElementById("address").value;
    var phone_no=document.getElementById("phone_no").value; 
    var city=document.getElementById("city").value;
    if(fristname=="" || lastname=="" || email=="" || password=="" && address=="" && phone_no==""&& city==""){
        error.innerHTML="Please Frist Name Input";
        error1.innerHTML="Please Last Name Input";
        error2.innerHTML="Please Email Name Input";
        error3.innerHTML="Please Password Input";
        error4.innerHTML="Please address Name Input";
        error5.innerHTML="Please Phone No Input";
        error6.innerHTML="Please city Name Input";
        document.getElementById("fristname").onkeypress= function(event){
                        document.getElementById("error").style.visibility = "hidden";}
        document.getElementById("lastname").onkeypress= function(event){
                        document.getElementById("error1").style.visibility = "hidden";}
        document.getElementById("email").onkeypress= function(event){
                        document.getElementById("error2").style.visibility = "hidden";}
        document.getElementById("password").onkeypress= function(event){
                        document.getElementById("error3").style.visibility = "hidden";}
        document.getElementById("address").onkeypress= function(event){
                        document.getElementById("error4").style.visibility = "hidden";}
        document.getElementById("phone_no").onkeypress= function(event){
                        document.getElementById("error5").style.visibility = "hidden";}
        document.getElementById("city").onkeypress= function(event){
                        document.getElementById("error6").style.visibility = "hidden";}
        return false;
    }else{
        if(fristname!=""){
            if (preg_match('/^[a-z]{0,10}$/', fristname)){
                     if(lastname!=""){
                if(email!=""){
                    if(password!=""){
                        if(address!=""){
                            if(phone_no!=""){
                                if(city!=""){
                                    return true;
                                }else{
                                     error6.innerHTML="Please city Name Input";
                                     document.getElementById("city").onkeypress= function(event){
                                        document.getElementById("error6").style.visibility = "hidden";}
                                     return false;
                                }
                                
                            }else{
                                document.getElementById("phone_no").onkeypress= function(event){
                                document.getElementById("error5").style.visibility = "hidden";}
                                 error5.innerHTML="Please Phone No Input";
                                 return false;
                            }
                            
                        }else{
                            document.getElementById("address").onkeypress= function(event){
                                document.getElementById("error4").style.visibility = "hidden";}
                             error4.innerHTML="Please address Name Input";
                             return  false;
                        }
                        
                    }else{
                        document.getElementById("password").onkeypress= function(event){
                        document.getElementById("error3").style.visibility = "hidden";}
                         error3.innerHTML="Please Password Input";
                         return false;
                    }
                    
                }else{
                    document.getElementById("email").onkeypress= function(event){
                        document.getElementById("error").style.visibility = "hidden";}
                      error2.innerHTML="Please Email Name Input";
                      return false;
                }
                
            }else{
                document.getElementById("lastname").onkeypress= function(event){
                        document.getElementById("error1").style.visibility = "hidden";}
                 error1.innerHTML="Please Last Name Input";
                 return false;
            }
            }else{
                error.innerHTML="Please check User Name";
            }
        }else{
            document.getElementById("fristname").onkeypress= function(event){
                        document.getElementById("error").style.visibility = "hidden";}
            error.innerHTML="Please Frist Name Input";
            return false;
        }
    
    }
}
 function ok1(){
   // alert('dfsdf');
    document.getElementById("error0").style.visibility="hidden";
        return false;
    }
function bit(){
    document.getElementById("btn").innerHTML;
    alert("ccvxcv");
}
</script>
    </head>
    <body>
       <div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-3 table-bordered table-hover">
         <div class="col-md-5 col-md-offset-4 btn-lg">
            <span class="col-md-12 text-center">
                Register
            </span>
        </div>
            <form  action="index.php?route=registerview" enctype="multipart/form-data" onsubmit="return validition()" method="post">
        <table align="center" class="table table-bordered">
            <tr>
                <th class="col-md-4 btn-lg ">frist name :</th>
                <td><input type="text" id="fristname" name="fristname"  />
                    <p id="error0" class="btn-danger">
                         <?php if(isset($_SESSION['fristname']['one'])){ echo  $_SESSION['error0'];?>
                                <button type="button" onclick="ok1()" class="close" data-dismiss="modal">&times;</button>
                                        <?php } ?>
                    </p>
                </td>
            </tr>
            <tr>
                <th class="col-md-4 btn-lg">last name  :</th>
                <td><input type="text" name="lastname" id="lastname" />
                    <p id="error1" class="btn-danger">
                         <?php if(isset($_SESSION['lastname']['one'])){ echo  $_SESSION['error1'];?>
                                <button type="button" onclick="ok1()" class="close" data-dismiss="modal">&times;</button>
                                        <?php } ?>
                    </p>
                </td>
            </tr>
            <tr>
                <th class="col-md-4 btn-lg">Email      :</th> 
                <td><input type="text" name="email" id="email"  />
                    <p id="error2" class="btn-danger"></p>
                </td>
            </tr>
            <tr>
                <th class="col-md-4 btn-lg">Password   :</th> 
                <td><input type="password" name="password" id="password"  />
                    <p id="error3" class="btn-danger"></p>
                </td>
            </tr>
            <tr>
                <th class="col-md-4 btn-lg">Address    :</th> 
                <td><input type="text" name="address" id="address" />
                    <p id="error4" class="btn-danger"></p>
                </td>
            </tr>
            <tr>
                <th class="col-md-4 btn-lg">Phone No:   :</th> 
                <td><input type="text" name="phone_no" id="phone_no" />
                    <p id="error5" class="btn-danger"></p>
                </td>
            </tr>
            <tr>
                <th class="col-md-4 btn-lg">city       :</th>
                <td><input type="text" name="city" id="city">
                <p id="error6" class="btn-danger"></p>
                </td>
            </tr>
            
        </table><input type="submit" name="ok" class="center-block"  value="submit"/>
        </form>
        <a href="index.php?route=login">Login</a>
     </div>
    </div>
</div> 
        <button id="btn" value="pppp" onclick="bit()"></button>
    </body>
</html>
<?php
unset($_SESSION['fristname']['one']);
unset( $_SESSION['error0']);
?>

