<?php
use controller\controller ;
function __autoload($className) {
    $file = $className . '.php';
    if(file_exists($file)) {
        require_once $file;
    }
}
 session_start();
 ?>
<html lang="en">

<head>
     <meta charset="UTF-8">
    <title>College Management</title>
    <link href="#" rel="stylesheet" >
    <link href="public/css/style.css" rel="stylesheet">
    <link href="public/bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="public/bootstrap-3.3.7-dist/css/bootstrap-theme.min.css" rel="stylesheet">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
</head>
        
<body>
            <?php
                $controlle=new controller();
                $controlle->handleRequest();
            ?>
               </body>
              
</html>
