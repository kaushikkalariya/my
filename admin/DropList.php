<?php
class DropList{
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

    public function handle()
    {
            $route = isset($_GET['drop'])?$_GET['drop']:NULL;
            $ids= isset($_GET['id'])?$_GET['id']:NULL;
           //$_SESSION['user_id'];
            $routeArray = explode('/', $route);
            if(in_array('admin', $routeArray)){
                if(in_array('TeaDropCourse', $routeArray)){
                  if($_POST['id']){
                      $courseDrop=$this->courseDropList($id);
                      return $courseDrop;
                  }   
                }
            }
    }
}
$teacherDropList=new DropList();
echo  $teacherDropList->handle();  
?>