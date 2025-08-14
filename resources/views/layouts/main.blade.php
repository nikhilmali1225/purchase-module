<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Responsive Black Sidebar</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    /* Sidebar styling */
    .sidebar {
      background-color: #000;
      color: white;
      height: 100vh;
      position: fixed;
      top: 0;
      left: 0;
      width: 250px;
      padding-top: 60px;
    }
    .sidebar a {
      color: #bbb;
      padding: 12px 20px;
      display: flex;
      align-items: center;
      gap: 10px;
      text-decoration: none;
      transition: all 0.3s;
    }
    .sidebar a:hover, .sidebar a.active {
      background-color: #111;
      color: white;
    }

    /* Main content with left padding for desktop */
    .content {
      margin-left: 250px;
      padding: 20px;
    }

    /* Hide sidebar on mobile/tablet */
    @media (max-width: 991px) {
      .sidebar {
        display: none;
      }
      .content {
        margin-left: 0;
      }
    }
  </style>
</head>
<body>

<!-- Navbar for mobile/tablet -->
<nav class="navbar navbar-dark bg-dark d-lg-none">
  <div class="container-fluid">
    <button class="btn btn-outline-light" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar">
      ☰ Menu
    </button>
    <span class="navbar-brand">My Website</span>
  </div>
</nav>

<!-- Sidebar for desktop -->
<div class="sidebar d-none d-lg-block">
  <a href="#" class="active"><i class="bi bi-house"></i> Home</a>
  <a href="#"><i class="bi bi-info-circle"></i> About</a>
  <a href="#"><i class="bi bi-briefcase"></i> Services</a>
  <a href="#"><i class="bi bi-envelope"></i> Contact</a>
</div>

<!-- Offcanvas Sidebar for mobile/tablet -->
<div class="offcanvas offcanvas-start bg-black text-white" tabindex="-1" id="mobileSidebar">
  <div class="offcanvas-header">
    <h5>Menu</h5>
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
  </div>
  <div class="offcanvas-body">
    <a href="#" class="d-block mb-2 text-white"><i class="bi bi-house"></i> Home</a>
    <a href="#" class="d-block mb-2 text-white"><i class="bi bi-info-circle"></i> About</a>
    <a href="#" class="d-block mb-2 text-white"><i class="bi bi-briefcase"></i> Services</a>
    <a href="#" class="d-block text-white"><i class="bi bi-envelope"></i> Contact</a>
  </div>
</div>

<!-- Main Content -->
<div class="content">
  <h1>Responsive Black Sidebar</h1>
  <p>On desktop: Sidebar is always open.<br>On mobile/tablet: Sidebar is hidden and toggles from the left.</p>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
