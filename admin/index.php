<?php
use controllers\controller;
function __autoload($className) {
    $file = $className . '.php';
    if(file_exists($file)) {
        require_once $file;
    }
   /* $prefix='traits/';
    $ext='.php';
    if(substr($className,0,6) == 'traits')include $prefix.'trait.' . $classNames . $ext; 
   // else include $prefix.'class.' . $class . $ext;*/
}

/*function __autoload($class)
    require_once ('/controller/'.$class . '.php');
    require_once  ('/model/'.$class . '.php');
    
}*/?>

<html>
    <head>
        <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
        <meta content="utf-8" http-equiv="encoding">
        <title>Mini project</title>
        <link href="#"  rel="stylesheet"/>
        <link href="public/bootstrap.min.css" rel="stylesheet"/>
        <script src="jquery-1.12.4.min.js" type="text/javascript"></script>
        
    </head>
    
    <body>
        <?php
                
                session_start();
                $controlle=new controller();
                $controlle->handleRequest();
            //header("Location:index.php?route=login")
        ?>
    </body>
</html>
