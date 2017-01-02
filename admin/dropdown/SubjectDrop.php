<?php
class SubjectDrop
{
 public $con;
    public function __construct($con) 
    {
        $this->con= $con;
    }
    function courseDropList($id,$courseId) {
        $id=$_POST['id'];
        echo $courseId;
        $stmt = $this->con->prepare("SELECT * FROM course WHERE college_id=:id");
        $stmt->execute(array(':id' => $id));
        
       
             $courseArray=array('course'=>array());
        while($row=$stmt->fetch(PDO::FETCH_ASSOC))
        {
            array_push($courseArray['course'], array(
                'id'=>$row['id'],
                'name'=>$row['name']
            )) ; 
        }
        
        
        
        if($courseArray['course'][0]['id']==$courseId){ echo'cvcx'; ?>
        
        <option selected="selected" value="<?php echo $courseArray['course'][0]['id']; ?>"><?php echo $courseArray['course'][0]['name'] ?></option>
        
       <?php }
        else{
                if($courseArray['course'][0]['id']){
        ?>
             <option selected="selected" value="">Select courses</option>
             <option value="<?php echo $courseArray['course'][0]['id']; ?>"><?php echo $courseArray['course'][0]['name'] ?></option>
                <?php }}?><?php
    }
}?>