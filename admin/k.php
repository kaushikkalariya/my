<script>
function ValidationEvent() {
// Storing Field Values In Variables
var name = document.getElementById("name").value;
var email = document.getElementById("email").value;
var contact = document.getElementById("contact").value;
// Regular Expression For Email
var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
// Conditions
if (name != '') {
    alert("dfsf");
        } else {
alert("All fields are required.....!");
return false;
}
}</script>
<html>
<head>
<title>Javascript Onsubmit Event Example</title>
<link href="css/style.css" rel="stylesheet"> <!-- Include CSS File Here-->
</head>
<body>
<div class="container">
<div class="main">
<form action="#" method="post" onsubmit="return ValidationEvent()">
<h2>Javascript Onsubmit Event Example</h2>
<label>Name :</label>
<input id="name" name="name" placeholder="Name" type="text">
<label>Email :</label>
<input id="email" name="email" placeholder="Valid Email" type="text">
<label>Gender :</label>
<input id="male" name="gender" type="radio" value="Male">
<label>Male</label>
<input id="female" name="gender" type="radio" value="Female">
<label>Female</label>
<label>Contact No. :</label>
<input id="contact" name="contact" placeholder="Contact No." type="text">
<input type="submit" value="Submit">
<span>All type of validation will execute on OnSubmit Event.</span>
</form>
</div>
</div>
</body>
</html>
