<?php
include('header/connection.php');
session_start();
$page = 'http://localhost/blood-donation-system-master/home.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login — BloodAid</title>
  <link rel="stylesheet" href="./css/style.css">
</head>
<body>

<div class="login-wrap">
  <div class="login-card">
    <div class="login-logo">
      <div class="logo-icon">
        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="width:28px;height:28px;fill:white;">
          <path d="M12 2C12 2 4 9.5 4 14.5a8 8 0 0016 0C20 9.5 12 2 12 2z"/>
        </svg>
      </div>
      <h2>BloodAid Admin</h2>
      <p>Sign in to manage the system</p>
    </div>

    <?php
    if (isset($_POST['sub'])) {
      $un = $_POST['un'];
      $ps = $_POST['ps'];
      $q = $db->prepare("SELECT * FROM admin WHERE uname = :uname AND pass = :pass");
      $q->execute([':uname' => $un, ':pass' => $ps]);
      $res = $q->fetchAll(PDO::FETCH_OBJ);
      if ($res) {
        $_SESSION['loggedin'] = true;
        $_SESSION['uname'] = $un;
        header('Location: ' . $page);
        exit;
      } else {
        echo '<div class="alert alert-error">⚠️ Invalid username or password. Please try again.</div>';
      }
    }
    ?>

    <form method="post">
      <div class="form-row">
        <label>Username</label>
        <input type="text" name="un" placeholder="Enter username" required>
      </div>
      <div class="form-row">
        <label>Password</label>
        <input type="password" name="ps" placeholder="Enter password" id="passInput" required>
        <label class="show-pass-row">
          <input type="checkbox" onchange="document.getElementById('passInput').type = this.checked ? 'text' : 'password'">
          Show password
        </label>
      </div>
      <div class="btn-row" style="margin-top:24px;">
        <button type="submit" name="sub" class="btn btn-primary" style="width:100%;justify-content:center;">Sign In</button>
      </div>
    </form>
  </div>
</div>

</body>
</html>
