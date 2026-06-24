<?php
session_start();
include('header/header.php');
include('header/connection.php');
if (isset($_SESSION['loggedin']) == true) {
  include('header/navadmin.php');
} else {
  include('header/navuser.php');
}
?>

<div class="page-wrap">
  <div class="page-title">Donor Registration</div>

  <?php
  if (isset($_POST['sub'])) {
    $name    = $_POST['name'];
    $bgroup  = $_POST['bgroup'];
    $gender  = @$_POST['gender'];
    $age     = $_POST['age'];
    $weight  = $_POST['weight'];
    $date    = $_POST['date'];
    $number  = $_POST['number'];
    $address = $_POST['address'];
    $id      = uniqid();

    $q = $db->prepare("INSERT INTO donor(id,name,bgroup,gender,age,weight,date,number,address) VALUES (:id,:name,:bgroup,:gender,:age,:weight,:date,:number,:address)");
    $q->bindValue('id', $id);
    $q->bindValue('name', $name);
    $q->bindValue('bgroup', $bgroup);
    $q->bindValue('gender', $gender);
    $q->bindValue('age', $age);
    $q->bindValue('weight', $weight);
    $q->bindValue('date', $date);
    $q->bindValue('number', $number);
    $q->bindValue('address', $address);

    if ($q->execute()) {
      echo '<div class="alert" style="background:#d1fae5;color:#065f46;border:1px solid #a7f3d0;">✅ Donor registered successfully!</div>';
    } else {
      echo '<div class="alert alert-error">❌ Registration failed. Please try again.</div>';
    }
  }
  ?>

  <div class="form-card">
    <form method="post">
      <div class="form-row">
        <label>Full Name</label>
        <input type="text" name="name" placeholder="Enter full name" required>
      </div>
      <div class="form-row">
        <label>Blood Group</label>
        <select name="bgroup" required>
          <option value="">Select blood group</option>
          <?php foreach (['A+','A-','B+','B-','AB+','AB-','O+','O-'] as $bg): ?>
            <option><?= $bg ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="form-row">
        <label>Gender</label>
        <div class="radio-group">
          <label><input type="radio" name="gender" value="Male"> Male</label>
          <label><input type="radio" name="gender" value="Female"> Female</label>
          <label><input type="radio" name="gender" value="Others"> Others</label>
        </div>
      </div>
      <div class="form-row">
        <label>Age</label>
        <input type="text" name="age" placeholder="e.g. 25">
      </div>
      <div class="form-row">
        <label>Weight (kg)</label>
        <input type="text" name="weight" placeholder="e.g. 65">
      </div>
      <div class="form-row">
        <label>Last Donated</label>
        <input type="date" name="date" value="<?= date('Y-m-d') ?>">
      </div>
      <div class="form-row">
        <label>Phone Number</label>
        <input type="tel" name="number" placeholder="+91XXXXXXXXXX" required>
      </div>
      <div class="form-row">
        <label>Address</label>
        <textarea name="address" placeholder="City, State"></textarea>
      </div>
      <div class="btn-row">
        <button type="submit" name="sub" class="btn btn-primary">Register Donor</button>
        <button type="reset" class="btn btn-secondary">Reset</button>
      </div>
    </form>
  </div>
</div>

</body>
</html>
