<?php 
include 'config.php';

$username = $_POST['username'];
$password = md5($_POST['password']);

$login 	= mysqli_query($connect, "SELECT * FROM user WHERE username='$username' AND PASSWORD='$password'");
$cek 		= mysqli_num_rows($login);
$data 	= mysqli_fetch_array($login);

if($cek > 0){
	session_start();
	$_SESSION['username']	= $username;
	$_SESSION['id_user']	= $data['id_user'];
	$_SESSION['nama']			= $data['nama'];
	$_SESSION['akses']		= $data['akses'];
	$_SESSION['status']		= "login";
	header("location:../index.php");
}
else{
	echo "<script>
				alert('Username atau Password Salah')
				</script>
				
				<script>
				location.href='../login.php'
				</script>";
}

?>