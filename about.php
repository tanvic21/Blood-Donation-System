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

<div class="hero-banner">
  <h2>About BloodAid</h2>
  <p>Dedicated to connecting donors and patients, saving lives one drop at a time.</p>
</div>

<div class="page-wrap">
  <div class="about-grid">
    <div class="about-card">
      <div class="about-icon">👁️</div>
      <h3>Our Vision</h3>
      <p>A community united in saving lives, where every drop of blood becomes a beacon of hope. Through innovation and dedication, we strive for a world where no one suffers for lack of blood.</p>
    </div>
    <div class="about-card">
      <div class="about-icon">🎯</div>
      <h3>Our Goal</h3>
      <p>To ensure a steady, safe blood supply, meeting the needs of patients with timely aid. Empowering donors, saving lives — a healthier, brighter future where no call for blood is delayed.</p>
    </div>
    <div class="about-card">
      <div class="about-icon">❤️</div>
      <h3>Our Mission</h3>
      <p>To educate, inspire, and mobilize communities to embrace the gift of life through blood donation. With integrity and compassion, we bridge the gap between those in need and those who can provide.</p>
    </div>
  </div>
</div>

</body>
</html>
