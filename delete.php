<?php
include('header/header.php');
include('header/connection.php');
include('header/navadmin.php');
?>

<div class="page-wrap">
  <div class="page-title">Delete Record</div>

  <?php
  if (isset($_POST['sub'])) {
    $dp = @$_POST['dp'];
    $id = $_POST['id'];

    if ($dp == "Donor") {
      $count = $db->query("SELECT * FROM donor WHERE id='$id'")->fetchColumn();
      $q = $db->prepare("DELETE FROM donor WHERE id='$id'");
    } else {
      $count = $db->query("SELECT * FROM patient WHERE id='$id'")->fetchColumn();
      $q = $db->prepare("DELETE FROM patient WHERE id='$id'");
    }

    if ($q->execute() && $count != 0) {
      echo '<div class="alert" style="background:#d1fae5;color:#065f46;border:1px solid #a7f3d0;">✅ Record deleted successfully.</div>';
    } else {
      echo '<div class="alert alert-error">❌ Deletion failed. ID not found or invalid.</div>';
    }
  }
  ?>

  <div class="form-card">
    <form method="post">
      <div class="form-row">
        <label>Select Type</label>
        <select name="dp" required>
          <option value="">Select Donor or Patient</option>
          <option>Donor</option>
          <option>Patient</option>
        </select>
      </div>
      <div class="form-row">
        <label>Record ID</label>
        <input type="text" name="id" placeholder="Enter the ID to delete" required>
      </div>
      <div class="btn-row">
        <button type="submit" name="sub" class="btn btn-danger" style="background:#C0202A;color:white;">Delete Record</button>
        <button type="reset" class="btn btn-secondary">Clear</button>
      </div>
    </form>
    <div style="margin-top:20px;padding:14px;background:#fff5f5;border:1px solid #fecaca;border-radius:10px;font-size:13px;color:#b91c1c;">
      ⚠️ This action is permanent and cannot be undone. Double-check the ID before deleting.
    </div>
  </div>
</div>

</body>
</html>
