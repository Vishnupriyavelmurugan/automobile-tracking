<?php
session_start();
if ( isset($_POST['cancel'] ) ) {
    header("Location: logout.php");
    return;
}
?>
<?php
$salt = 'XyZzy12*_';
$stored_hash = '1a52e17fa899cf40fb04cfc42e6352f1';  // Pw is php123
$failure = false;
$emailErr= false;
if ( isset($_POST['email']) && isset($_POST['pass']) )
 {
    if ( strlen($_POST['email']) < 1 || strlen($_POST['pass']) < 1 )
     {
        $_SESSION['error'] = "username and password are required";
       header("Location: login.php");
       return;
        
    }
   else if (preg_match("/[@]/",$_POST['email'])) 
   {
        $check = hash('md5', $salt.$_POST['pass']);
        if ( $check == $stored_hash ) 
        {
          $_SESSION['name'] = $_POST['email'];
          error_log("Login success ".$_POST['email']);
          header("Location: index1.php");
            return;
        } else 
        {
            $_SESSION['error'] = "Incorrect password";
            error_log("Login fail ".$_POST['email']." $check");
            header("Location: login.php");
            return;

        }
    }
            else
            {
        $_SESSION['error']="Email must have an at-sign (@)";
        header("Location: login.php");
            return;

    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>VISHNUPRIYA G.V Login Page</title>

<link rel="stylesheet" 
    href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" 
    integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" 
    crossorigin="anonymous">

<link rel="stylesheet" 
    href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" 
    integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" 
    crossorigin="anonymous">

<link rel="stylesheet" 
    href="https://code.jquery.com/ui/1.12.1/themes/ui-lightness/jquery-ui.css">

<script
  src="https://code.jquery.com/jquery-3.2.1.js"
  integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
  crossorigin="anonymous"></script>

<script
  src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"
  integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30="
  crossorigin="anonymous"></script>

</head>
<body>
<div class="container">
<h1>Please log in</h1>
<?php
if ( isset($_SESSION['error']) )
 {
  echo('<p style="color: red;">'.htmlentities($_SESSION['error'])."</p>\n");
  unset($_SESSION['error']);

}
?>
<form method="POST">
<label for="nam">username</label>
<input type="text" name="email" id="nam"><br/>
<label for="id_1723">Password</label>
<input type="text" name="pass" id="id_1723"><br/>
<input type="submit" value="Log In">
<input type="submit" name="cancel" value="Cancel">
</form>
</div>
</body>
</html>
