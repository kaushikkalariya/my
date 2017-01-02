<?php
class TeacherDrop
{
    public $con;
    public function __construct($con) 
    {
        $this->con= $con;
    }
    function courseDropList($id) {
        if($_POST['id'])
        {
                $id=$_POST['id'];
                $stmt = $this->con->prepare("SELECT * FROM course WHERE college_id=:id");
                $stmt->execute(array(':id' => $id));
                ?><option selected="selected" value="">Select course</option><?php
                while($row=$stmt->fetch(PDO::FETCH_ASSOC))
                {
                        ?>
                        <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                <?php
                }
        }
    }
    function subjectDropList($id) {
        if($_POST['id'])
        {
                $id=$_POST['id'];
                $stmt = $this->con->prepare("SELECT * FROM subject WHERE course_id=:id");
                $stmt->execute(array(':id' => $id));
                ?><option selected="selected" value="">Select course</option><?php
                while($row=$stmt->fetch(PDO::FETCH_ASSOC))
                {
                        ?>
                        <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                <?php
                }
        }
    }
    
}