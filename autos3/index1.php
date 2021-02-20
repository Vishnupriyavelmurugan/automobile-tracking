<?php
require_once "pdo.php";
session_start(); 
?>
<html>
 <head></head><body>
 <?php
if ( isset($_SESSION['error']) ) {  
echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
unset($_SESSION['error']);
}
if ( isset($_SESSION['smsg']) ) {
 echo '<p style="color:green">'.$_SESSION['smsg']."</p>\n";
    unset($_SESSION['smsg']);
}
echo('<table border="1">'."\n");
$stmt = $pdo->query("SELECT * FROM autos");
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if($row==false) {
    
   $_SESSION['msg']="No records inserted";
 
}

$stmt = $pdo->query("SELECT * FROM autos");
 while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) { 
    echo "<tr><td>";
   echo(htmlentities($row['make']));
  echo("</td><td>");
    echo(htmlentities($row['model']));
  echo("</td><td>");
  echo(htmlentities($row['mileage']));
  echo("</td><td>");
   echo(htmlentities($row['year']));
  echo("</td><td>");
  echo('<a href="edit.php?autos_id='.$row['autos_id'].'">Edit</a> / ');
  echo('<a href="delete.php?autos_id='.$row['autos_id'].'">Delete</a>');
  echo("</td></tr>\n");
} 


 ?>
</table>
<?php
if ( isset($_SESSION['msg']) ) {
 echo '<p style="color:black">'.$_SESSION['msg']."</p>\n";
    unset($_SESSION['msg']);
}
?>
<p><a href="add.php">Add New Entry</a>
<a href="logout.php">Logout</a></p>
</body>
</html>