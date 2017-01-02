<?php
function course($id) {
    
}
if($_POST['id'])
{
	$id=$_POST['id'];
	$con=new PDO("mysql:host=localhost;dbname=college",'root','');
	$stmt = $con->prepare("SELECT * FROM course WHERE college_id=:id");
	$stmt->execute(array(':id' => $id));
	?><option selected="selected">Select State :</option><?php
	while($row=$stmt->fetch(PDO::FETCH_ASSOC))
	{
		?>
        	<option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
         <?php
	}
}
?>
