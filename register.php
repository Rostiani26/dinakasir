<?php
@ob_start();
session_start();

// Cek apakah sudah login dan memiliki akses admin
if (isset($_SESSION['admin']) && $_SESSION['admin']['id_member'] == 1) {
    // Hanya admin yang dapat mengakses halaman ini
    if (isset($_POST['register'])) {
        require 'config.php';

        $user = strip_tags($_POST['user']);
        $pass = strip_tags($_POST['pass']);
        $level = strip_tags($_POST['id_member']);
        $nama = strip_tags($_POST['nm_member']);
        $alamat = strip_tags($_POST['alamat_member']);
        $telepon = strip_tags($_POST['telepon']);
        $email = strip_tags($_POST['email']);
        $gambar = ''; //anda perlu menyesuaikan proses upload gambar jika diperlukan
        $nik = strip_tags($_POST['NIK']);
        $status = strip_tags($_POST['id_member']);

        // Insert user data into the login table
        $insertLoginSql = 'INSERT INTO member (id_member, nm_member, alamat_member, telepon, email, gambar, NIK, status, user, pass) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, md5(?))';
        $insertLoginStmt = $config->prepare($insertLoginSql);
        $insertLoginStmt->execute([$nama, $alamat, $telepon, $email, $gambar, $nik, $status, $user, $pass]);

        echo '<script>alert("Registration successful. You can now login.");window.location="login.php"</script>';
    }
} else {
    // Jika bukan admin, beri pesan alert dan kembalikan ke halaman sebelumnya
    echo '<script>alert("Hanya Admin Yang Dapat Mengakses Ini!");history.go(-1);</script>';
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword">

    <title>Login To Admin</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        
    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body style="background:#a0ced9;color:#fff;">

      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->

	  <div id="login-page" style="padding-top:3pc;">
	  	<div class="container">
		      <form class="form-login" method="POST">
		        <h2 class="form-login-heading">Toko AANDIR</h2>
		        <div class="login-wrap">
		            <input type="text" class="form-control form-control-user" name="user" placeholder="Username" required>
		            <br>
		            <input type="password" class="form-control form-control-user" name="pass" placeholder="Password" required>
		            <br>
                    <input type="text" class="form-control form-control-user" name="nm_member" placeholder="Full Name" required>
                    <br>
                    <input type="text" class="form-control form-control-user" name="alamat_member" placeholder="Adress" required>
                    <br>
                    <input type="tel" class="form-control form-control-user" name="telepon" placeholder="Phone Number" required>
                    <br>
                    <input type="email" class="form-control form-control-user" name="email" placeholder="Email Address" required>
                    <br>
                    <input type="text" class="form-control form-control-user" name="NIK" placeholder="NIK" required>
                                <div class="form-group">
                                    <label for="id_member">Level:</label>
                                    <select class="form-control" name="id_member" required>
                                        <option value="1">Admin</option>
                                        <option value="2">Petugas</option>
                                    </select>
                                </div>
                                <button class="btn btn-primary btn-block" name="register" type="submit"><i class="fa fa-user-plus"></i>
                                    REGISTER</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>