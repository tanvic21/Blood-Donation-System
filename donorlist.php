<?php
include('header/header.php');
include('header/navadmin.php');
include('header/connection.php');
?>

<div class="page-wrap">
  <div class="page-title">Donor List</div>
  <div class="table-card">
    <table>
      <thead>
        <tr>
          <th>Name</th>
          <th>Blood Group</th>
          <th>Gender</th>
          <th>Age</th>
          <th>Weight</th>
          <th>Last Donated</th>
          <th>Phone</th>
          <th>Address</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $q = $db->query("SELECT * FROM donor");
        while ($p = $q->fetch(PDO::FETCH_OBJ)):
          $d = $p->date;
          $current = date("Y/m/d");
          $month = ((strtotime($current) - strtotime($d)) / 60 / 60 / 24) / 30;
          $eligible = $month >= 3.0;
        ?>
        <tr class="<?= !$eligible ? 'ineligible' : '' ?>">
          <td><?= htmlspecialchars($p->name) ?></td>
          <td><span class="badge badge-red"><?= htmlspecialchars($p->bgroup) ?></span></td>
          <td><?= htmlspecialchars($p->gender) ?></td>
          <td><?= htmlspecialchars($p->age) ?></td>
          <td><?= htmlspecialchars($p->weight) ?> kg</td>
          <td><?= htmlspecialchars($p->date) ?></td>
          <td><?= htmlspecialchars($p->number) ?></td>
          <td><?= htmlspecialchars($p->address) ?></td>
          <td>
            <?php if ($eligible): ?>
              <span class="badge badge-green">Eligible</span>
            <?php else: ?>
              <span class="badge badge-red">Not Eligible</span>
            <?php endif; ?>
          </td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
    <div class="table-note">🔴 Red rows indicate donors who donated within the last 3 months and are not currently eligible.</div>
  </div>
</div>

</body>
</html>
