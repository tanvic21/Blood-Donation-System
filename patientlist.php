<?php
include('header/header.php');
include('header/navadmin.php');
include('header/connection.php');
$q = $db->query("SELECT * FROM patient");
?>

<div class="page-wrap">
  <div class="page-title">Patient List</div>
  <div class="table-card">
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Blood Group</th>
          <th>Gender</th>
          <th>Age</th>
          <th>Weight</th>
          <th>Phone</th>
          <th>Address</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($p = $q->fetch(PDO::FETCH_OBJ)): ?>
        <tr>
          <td style="font-family:monospace;font-size:12px;color:#6b7280;"><?= htmlspecialchars($p->id) ?></td>
          <td><?= htmlspecialchars($p->name) ?></td>
          <td><span class="badge badge-red"><?= htmlspecialchars($p->bgroup) ?></span></td>
          <td><?= htmlspecialchars($p->gender) ?></td>
          <td><?= htmlspecialchars($p->age) ?></td>
          <td><?= htmlspecialchars($p->weight) ?> kg</td>
          <td><?= htmlspecialchars($p->number) ?></td>
          <td><?= htmlspecialchars($p->address) ?></td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</div>

</body>
</html>
