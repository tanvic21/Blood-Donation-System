<?php
include('header/header.php');
include('header/navadmin.php');
include('header/connection.php');
?>

<div class="page-wrap">
  <div class="page-title">Proceed a Donation</div>

  <!-- Donor List -->
  <div class="section-label">All Donors</div>
  <div class="table-card" style="margin-bottom:32px;">
    <table>
      <thead>
        <tr><th>ID</th><th>Name</th><th>Blood Group</th><th>Gender</th><th>Phone</th><th>Address</th></tr>
      </thead>
      <tbody>
        <?php
        $q = $db->query("SELECT * FROM donor");
        while ($p = $q->fetch(PDO::FETCH_OBJ)):
          $d = $p->date;
          $month = ((strtotime(date("Y/m/d")) - strtotime($d)) / 60 / 60 / 24) / 30;
          if ($month >= 3.0):
        ?>
        <tr>
          <td style="font-size:12px;font-family:monospace;color:#6b7280;"><?= htmlspecialchars($p->id) ?></td>
          <td><?= htmlspecialchars($p->name) ?></td>
          <td><span class="badge badge-red"><?= htmlspecialchars($p->bgroup) ?></span></td>
          <td><?= htmlspecialchars($p->gender) ?></td>
          <td><?= htmlspecialchars($p->number) ?></td>
          <td><?= htmlspecialchars($p->address) ?></td>
        </tr>
        <?php endif; endwhile; ?>
      </tbody>
    </table>
  </div>

  <!-- Patient List -->
  <div class="section-label">All Patients</div>
  <div class="table-card" style="margin-bottom:32px;">
    <table>
      <thead>
        <tr><th>ID</th><th>Name</th><th>Blood Group</th><th>Gender</th><th>Phone</th><th>Address</th></tr>
      </thead>
      <tbody>
        <?php
        $q = $db->query("SELECT * FROM patient");
        while ($p = $q->fetch(PDO::FETCH_OBJ)):
        ?>
        <tr>
          <td style="font-size:12px;font-family:monospace;color:#6b7280;"><?= htmlspecialchars($p->id) ?></td>
          <td><?= htmlspecialchars($p->name) ?></td>
          <td><span class="badge badge-red"><?= htmlspecialchars($p->bgroup) ?></span></td>
          <td><?= htmlspecialchars($p->gender) ?></td>
          <td><?= htmlspecialchars($p->number) ?></td>
          <td><?= htmlspecialchars($p->address) ?></td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>

  <!-- Match Donors for a Patient -->
  <div class="section-label">Match Donors to a Patient</div>
  <div class="search-bar" style="margin-bottom:20px;">
    <form method="post" style="display:flex;gap:16px;align-items:flex-end;flex-wrap:wrap;width:100%;">
      <div class="form-row" style="margin:0;flex:1;min-width:200px;">
        <label>Patient ID</label>
        <input type="text" name="patient_id" placeholder="Enter Patient ID" value="<?= isset($_POST['patient_id']) ? htmlspecialchars($_POST['patient_id']) : '' ?>">
      </div>
      <button type="submit" name="search_donors" class="btn btn-primary">Find Matching Donors</button>
    </form>
  </div>

  <?php if (isset($_POST['search_donors'])): ?>
    <?php
    $patient_id = $_POST['patient_id'];
    $patient_query = $db->query("SELECT * FROM patient WHERE id='$patient_id'");
    $patient = $patient_query->fetch(PDO::FETCH_OBJ);
    if ($patient):
      $blood_group = $patient->bgroup;
      $donor_query = $db->query("SELECT * FROM donor WHERE bgroup='$blood_group'");
    ?>
    <div class="section-label">Matching donors for <?= htmlspecialchars($patient->name) ?> (<?= htmlspecialchars($blood_group) ?>)</div>
    <div class="table-card">
      <table>
        <thead>
          <tr><th>Name</th><th>Blood Group</th><th>Gender</th><th>Phone</th><th>Address</th><th>Action</th></tr>
        </thead>
        <tbody>
          <?php while ($donor = $donor_query->fetch(PDO::FETCH_OBJ)): ?>
          <tr>
            <td><?= htmlspecialchars($donor->name) ?></td>
            <td><span class="badge badge-red"><?= htmlspecialchars($donor->bgroup) ?></span></td>
            <td><?= htmlspecialchars($donor->gender) ?></td>
            <td><?= htmlspecialchars($donor->number) ?></td>
            <td><?= htmlspecialchars($donor->address) ?></td>
            <td>
              <form method="post">
                <input type="hidden" name="pid" value="<?= htmlspecialchars($patient_id) ?>">
                <input type="hidden" name="donor_id" value="<?= htmlspecialchars($donor->id) ?>">
                <button type="submit" name="select_donor" class="btn btn-primary" style="padding:6px 14px;font-size:13px;">Proceed</button>
              </form>
            </td>
          </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
    <?php else: ?>
      <div class="alert alert-error">No patient found with that ID.</div>
    <?php endif; ?>
  <?php endif; ?>

  <?php if (isset($_POST['select_donor'])): ?>
    <div class="alert" style="background:#d1fae5;color:#065f46;border:1px solid #a7f3d0;margin-top:20px;">✅ Donor selected successfully for the patient!</div>
  <?php endif; ?>
</div>

</body>
</html>
