<?php 
session_start();
include 'koneksi.php';

?>

<!DOCTYPE html>
<html>
<head>
  <title>Admin</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="style.css">
  <script src="https://use.fontawesome.com/2472639833.js"></script>
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-md-6 offset-md-3">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h1 class="panel-title" align="center">Login Sebagai Admin</h1>
        </div>
        
         <form role="form" method="post">
            <div class="form-group col-md-6 offset-md-3">
              <label>Username</label>
              <input type="text" class="form-control" name="user" placeholder="Masukkan Username">
            </div>
            <div class="form-group col-md-6 offset-md-3">
              <label>Password</label>
              <input type="password" class="form-control" name="pass" placeholder="Masukkan Password">
            </div>
            <div class="form-group col-md-6 offset-md-3">
              <button class="btn btn-primary" name="login">Login</button>
            </div>
          </form>
          <div class="col-md-6 offset-md-3">
            <?php 
              if (isset($_POST['login'])) 
              {
                $ambil=$koneksi->query("SELECT * FROM admin WHERE username='$_POST[user]'
                  AND password='$_POST[pass]'");
                $yangcocok=$ambil->num_rows;
                if ($yangcocok==1) 
                {
                  $_SESSION['admin']=$ambil->fetch_assoc();
                  echo "<div class='alert alert-info'>Login Sukses</div>";
                  echo "<meta http-equiv='refresh' content='1;url=index.php'>";
                }
                else
                {
                  echo "<div class='alert alert-danger'>Login Gagal</div>";
                  echo "<meta http-equiv='refresh' content='1;url=login.php'>";
                }
              }
            ?>
          </div>
        </div>
       </div>
      </div>
    </div>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>

</body>
</html>
