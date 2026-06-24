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
  <div class="page-title">Search for Blood</div>

  <div class="search-bar">
    <form method="post" style="display:flex;gap:16px;align-items:flex-end;flex-wrap:wrap;width:100%;">
      <div class="form-row" style="margin:0;flex:1;min-width:180px;">
        <label>Blood Group</label>
        <select name="bgroup">
          <option value="">Select blood group</option>
          <?php foreach (['A+','A-','B+','B-','AB+','AB-','O+','O-'] as $bg): ?>
            <option <?= (isset($_POST['bgroup']) && $_POST['bgroup']==$bg) ? 'selected' : '' ?>><?= $bg ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div style="display:flex;gap:10px;">
        <button type="submit" name="sub" class="btn btn-primary">Search</button>
        <button type="reset" class="btn btn-secondary">Reset</button>
      </div>
    </form>
  </div>

  <?php if (isset($_POST['sub'])): ?>
    <?php
    $bgroup = $_POST['bgroup'];

    // Fetch eligible donors
    $q = $db->query("SELECT * FROM donor WHERE bgroup='$bgroup'");
    $donors = [];
    while ($p = $q->fetch(PDO::FETCH_OBJ)) {
      $month = ((strtotime(date("Y/m/d")) - strtotime($p->date)) / 60 / 60 / 24) / 30;
      if ($month >= 3.0) $donors[] = $p;
    }

    // Fetch patients needing this blood group
    $q2 = $db->query("SELECT * FROM patient WHERE bgroup='$bgroup'");
    $patients = [];
    while ($p = $q2->fetch(PDO::FETCH_OBJ)) {
      $patients[] = $p;
    }
    ?>

    <!-- Summary bar -->
    <div style="display:flex;gap:16px;margin-bottom:24px;flex-wrap:wrap;">
      <div style="flex:1;min-width:180px;background:white;border:1px solid #e5e7eb;border-radius:12px;padding:20px 24px;display:flex;align-items:center;gap:14px;box-shadow:0 2px 8px rgba(0,0,0,0.06);">
        <div style="width:44px;height:44px;background:#fdf1f2;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:22px;">🩸</div>
        <div>
          <div style="font-size:26px;font-weight:700;color:#C0202A;"><?= count($donors) ?></div>
          <div style="font-size:13px;color:#6b7280;">Eligible Donors</div>
        </div>
      </div>
      <div style="flex:1;min-width:180px;background:white;border:1px solid #e5e7eb;border-radius:12px;padding:20px 24px;display:flex;align-items:center;gap:14px;box-shadow:0 2px 8px rgba(0,0,0,0.06);">
        <div style="width:44px;height:44px;background:#eff6ff;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:22px;">🏥</div>
        <div>
          <div style="font-size:26px;font-weight:700;color:#1d4ed8;"><?= count($patients) ?></div>
          <div style="font-size:13px;color:#6b7280;">Patients Needing <?= htmlspecialchars($bgroup) ?></div>
        </div>
      </div>
    </div>

    <!-- Two column layout -->
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:24px;align-items:start;">

      <!-- Donors -->
      <div>
        <div class="section-label" style="margin-bottom:12px;">✅ Available Donors</div>
        <div class="table-card">
          <table>
            <thead>
              <tr>
                <th>Name</th>
                <th>Blood Group</th>
                <th>Phone</th>
                <th>Address</th>
              </tr>
            </thead>
            <tbody>
              <?php if (empty($donors)): ?>
                <tr><td colspan="4" style="text-align:center;padding:28px;color:#6b7280;">No eligible donors found.</td></tr>
              <?php else: ?>
                <?php foreach ($donors as $p): ?>
                  <tr>
                    <td><?= htmlspecialchars($p->name) ?></td>
                    <td><span class="badge badge-red"><?= htmlspecialchars($p->bgroup) ?></span></td>
                    <td><?= htmlspecialchars($p->number) ?></td>
                    <td><?= htmlspecialchars($p->address) ?></td>
                  </tr>
                <?php endforeach; ?>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>

      <!-- Patients -->
      <div>
        <div class="section-label" style="margin-bottom:12px;">🏥 Patients in Need</div>
        <div class="table-card">
          <table>
            <thead>
              <tr>
                <th>Name</th>
                <th>Blood Group</th>
                <th>Phone</th>
                <th>Address</th>
              </tr>
            </thead>
            <tbody>
              <?php if (empty($patients)): ?>
                <tr><td colspan="4" style="text-align:center;padding:28px;color:#6b7280;">No patients registered for this blood group.</td></tr>
              <?php else: ?>
                <?php foreach ($patients as $p): ?>
                  <tr>
                    <td><?= htmlspecialchars($p->name) ?></td>
                    <td><span class="badge" style="background:#dbeafe;color:#1d4ed8;"><?= htmlspecialchars($p->bgroup) ?></span></td>
                    <td><?= htmlspecialchars($p->number) ?></td>
                    <td><?= htmlspecialchars($p->address) ?></td>
                  </tr>
                <?php endforeach; ?>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>

    </div><!-- end grid -->

  <?php endif; ?>
</div>

</body>
</html>
