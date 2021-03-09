<?php 
session_start();

$errors   = array(); 

// LOGIN USER
if (isset($_POST['login_user'])) {

  if (empty($username)) {
  	array_push($errors, "Username is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }

 $username = trim($_POST['username']);
 $password = trim($_POST['password']);

 $username = strip_tags($_POST['username']);
 $password = strip_tags($_POST['password']);

 $username = $DBcon->real_escape_string($username);
 $password = $DBcon->real_escape_string($password);
 $pass = sha1($password);

 $query = $DBcon->query("SELECT username, login_status, user_type, `password` FROM users WHERE username ='$username' AND `password` = '$pass' ");
 $row = $query->fetch_array();
 $count = $query->num_rows; // if username/password are correct returns must be 1 row
 if ($count == 1) {

  if ($row['login_status'] == 1) {
   if ($row['user_type'] == 0) {
   $_SESSION['username'] = $row['username']; 
    $_SESSION['user_type'] = $row['user_type'];
    $_SESSION['login_status'] = $row['login_status'];
    header("Location: staff");
    exit;
   }
   if ($row['user_type'] == 1) {
    $_SESSION['username'] = $row['username'];
    $_SESSION['user_type'] = $row['user_type'];
    $_SESSION['login_status'] = $row['login_status'];

    header("Location: admin");
    exit;
   }
  }
  if ($row['login_status'] == 2) {
    array_push($errors, "Account is deactivated. Contact Admin");
  }
 } else {
     array_push($errors,"Incorrect Username or Password.");
 }

}
}


// return user array from their id
function getUserById($id){
	global $db;
	$query = "SELECT * FROM users WHERE id=" . $id;
	$result = mysqli_query($db, $query);

	$user = mysqli_fetch_assoc($result);
	return $user;
}