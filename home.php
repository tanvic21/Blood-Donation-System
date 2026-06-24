<?php
include('header/header.php');
include('header/navadmin.php');
?>

<div class="hero-banner">
  <h2>Admin Dashboard</h2>
  <p>Manage donors, patients, and donations from one place.</p>
</div>

<div class="cards-grid">
  <a href="reg.php" class="action-card">
    <div class="card-icon">➕</div>
    <h3>Add Donor</h3>
    <p>Register a new blood donor in the system.</p>
  </a>
  <a href="blood.php" class="action-card">
    <div class="card-icon">🔍</div>
    <h3>Search Blood</h3>
    <p>Find eligible donors by blood group.</p>
  </a>
  <a href="reg2.php" class="action-card">
    <div class="card-icon">🏥</div>
    <h3>Add Patient</h3>
    <p>Register a patient requiring blood.</p>
  </a>
  <a href="donorlist.php" class="action-card">
    <div class="card-icon">📋</div>
    <h3>Donor List</h3>
    <p>View all registered donors and eligibility.</p>
  </a>
  <a href="patientlist.php" class="action-card">
    <div class="card-icon">📄</div>
    <h3>Patient List</h3>
    <p>View all registered patients.</p>
  </a>
  <a href="delete.php" class="action-card">
    <div class="card-icon">🗑️</div>
    <h3>Delete Record</h3>
    <p>Remove a donor or patient from the database.</p>
  </a>
</div>

</body>
</html>
