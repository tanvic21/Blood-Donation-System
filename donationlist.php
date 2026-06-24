<?php
include('header/header.php');
include('header/navadmin.php');
include('header/connection.php');
?>

<div class="page-wrap">
  <div class="page-title">Donation List</div>
  <div class="table-card">
    <table>
      <thead>
        <tr>
          <th>Donation ID</th>
          <th>Donor Name</th>
          <th>Patient Name</th>
          <th>Blood Group</th>
          <th>Date</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $q = $db->query("SELECT * FROM donation ORDER BY date DESC");
        while ($p = $q->fetch(PDO::FETCH_OBJ)):
        ?>
        <tr>
          <td style="font-size:12px;font-family:monospace;color:#6b7280;"><?= htmlspecialchars($p->donationid) ?></td>
          <td><?= htmlspecialchars($p->dname) ?></td>
          <td><?= htmlspecialchars($p->pname) ?></td>
          <td><span class="badge badge-red"><?= htmlspecialchars($p->bgroup) ?></span></td>
          <td><?= htmlspecialchars($p->date) ?></td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</div>

</body>
</html>
