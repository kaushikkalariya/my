<script type="text/javascript">
function validation(){
   
    var error=document.getElementById("error");
    var error1=document.getElementById("error1");
    var username=document.getElementById("user").value;
    var pass=document.getElementById("password").value;
    if(username=="" && pass==""){
        
          error.innerHTML="Please username Name Input";
          error1.innerHTML="Please Password Input";
           document.getElementById("user").onkeypress= function(event){
                        document.getElementById("error").style.visibility = "hidden";}
            document.getElementById("password").onkeypress= function(event){
                        document.getElementById("error1").style.visibility = "hidden";}
          return false;
    }
    else{
        if(username !=""){
            if(pass=""){
                 document.getElementById("password").onkeypress= function(event){
                        document.getElementById("error1").style.visibility = "hidden";}
                  error1.innerHTML="Please Password Input";
                  return false;
            }
            else{
                return true;
            }
        }
        else{
             document.getElementById("user").onkeypress= function(event){
                        document.getElementById("error").style.visibility = "hidden";}
              error.innerHTML="Please UserName Input";
              return false;
        }
    }
    
}
</script>
<form action="index.php?route=loginview" class="login" onsubmit="return  validation()" enctype="multipart/form-data" method="post">
           <h1>Login</h1>
           <input type="text" name="username"id="user" class="login-input" placeholder="Email Address" >
           <p id="error" class="btn-danger"></p>
            <input type="password" name="password" id="password" class="login-input" placeholder="Password">
            <p id="error1" class="btn-danger"></p>
            <input type="submit" value="Login" name="submit" class="login-submit">
            <p class="login-help"><a href="index.php?route=register" >Register</a></p>

    </form>

  