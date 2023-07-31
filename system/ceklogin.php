<script tipe="text/Javascript">
function myFunction() {
 alert("Data Berhasil Di Update");
<?php 
// mengaktifkan session php
session_start();
 
// menghubungkan dengan koneksi
include 'koneksi.php';
 
// menangkap data yang dikirim dari form
$username = $_POST['username'];
$password = $_POST['password'];
 
// menyeleksi data admin dengan username dan password yang sesuai
$data = mysqli_query($mysqli,"select * from user where username='$username' and password='$password'");
 
// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($data);
 
if($cek > 0 ){
	$login = mysqli_fetch_assoc($data);
	
	if($login['role'] == "admin"){
			$_SESSION['username'] = $username;
			$_SESSION['status'] = "login";
			header("location:../pages/dashboard.php");
			session_start();
			$_SESSION['pesan'] = "Selamat Datang Admin ^_^";
	}else{
	$_SESSION['username'] = $username;
	$_SESSION['status'] = "login";
	header("location:.index.php");
	}
}
else{
	header("location:../index.php?pesan=gagal");
	session_start();
	$_SESSION['pesan'] = "Username atau password salah!";
}
?>
}
</Script>
