<?php

function courseDropList($id) {
    $con=new PDO("mysql:host=localhost;dbname=college",'root','');	
    if($_POST['id'])
    {
            $id=$_POST['id'];
            $con=new PDO("mysql:host=localhost;dbname=college",'root','');		
            $stmt = $con->prepare("SELECT * FROM course WHERE college_id=:id");
            $stmt->execute(array(':id' => $id));
            ?><option selected="selected">Select course</option><?php
            while($row=$stmt->fetch(PDO::FETCH_ASSOC))
            {
                    ?>
                    <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
            <?php
            }
    }
}
class TeacherDropList{
    public function handle()
    {
            $route = isset($_GET['route'])?$_GET['route']:NULL;
            $ids= isset($_GET['id'])?$_GET['id']:NULL;
           //$_SESSION['user_id'];
            $routeArray = explode('/', $route);
            
    }

}
?>