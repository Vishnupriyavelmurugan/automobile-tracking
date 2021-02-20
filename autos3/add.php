<?php
require_once "pdo.php";
session_start();
if ( !isset($_SESSION['name'] ) ) {
 die("ACCESS DENIED");
}
?>
<?php
if(isset($_POST['make']) && isset($_POST['year']) && isset($_POST['mileage']) && isset($_POST['model']))
{   

	 if ( strlen($_POST['make']) < 1 && strlen($_POST['model']) < 1)
	 {
	  $failure="All fields are required";
	  $_SESSION['error']=$failure;
	  header("Location: add.php");
            return;	 	
	 }
	else if(!is_numeric($_POST['mileage']) || !is_numeric($_POST['year']))
	{
      $failure="Mileage and year must be numeric";
      $_SESSION['error']=$failure;
       header("Location: add.php");
            return;
   }
     else{

	$sql="INSERT INTO autos(make,model,year,mileage) VALUES (:make,:model,:year,:mileage)";
	$stmt=$pdo->prepare($sql);
	$stmt->execute(array(
		':make'=> $_POST['make'],
		':model'=> $_POST['model'],
	    ':year'=> $_POST['year'],
	    ':mileage'=> $_POST['mileage']));
	$_SESSION['make']=':make';
	$_SESSION['model']=':model';
	$_SESSION['year']=':year';
	$_SESSION['mileage']=':mileage';
	   $success="Record Added";
	   $_SESSION['smsg']=$success;
	   header("Location: index1.php");
            return;
        }
}
?>
<?php
if (isset($_SESSION['error'])) {
    echo('<p style="color: red;">'.htmlentities($_SESSION['error'])."</p>\n");
    unset($_SESSION['error']);
}
?>
<?php
if(isset($_POST['logout'])){
	header('Location: index1.php');
}
?>
<p>Add a new user</p>
<form method="post">
	<p>Make:
		<input type="text" name="make"></p>
		<p>Model
			<input type="text" name="model"></p>
			<p>Year
			<input type="text" name="year"></p>
			<p>Mileage
			<input type="text" name="mileage"></p>
			<p><input type="submit" name="Add"/>
				<input type="submit" name="logout" value="cancel"></p>
		</form>