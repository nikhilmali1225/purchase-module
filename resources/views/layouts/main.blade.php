<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar Example</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .sidebar {
            height: 100vh;
            background-color: #7b4fff;
            color: white;
            padding: 20px 10px;
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            transition: transform 0.3s ease;
        }
        .sidebar.collapsed {
            transform: translateX(-100%);
        }
        .sidebar h2 {
            font-weight: bold;
            margin-bottom: 30px;
        }
        .sidebar a {
            display: block;
            padding: 10px;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            transition: background 0.2s;
        }
        .sidebar a:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }
        .newsletter {
            margin-top: 20px;
        }
        .newsletter input {
            width: 100%;
            padding: 8px;
            border: none;
            border-radius: 4px;
            margin-top: 5px;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
            transition: margin-left 0.3s ease;
        }
        .collapsed + .content {
            margin-left: 0;
        }
        .toggle-btn {
            position: absolute;
            top: 15px;
            right: -40px;
            background-color: #7b4fff;
            color: white;
            border: none;
            padding: 8px 10px;
            cursor: pointer;
            border-radius: 0 4px 4px 0;
        }
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .sidebar.show {
                transform: translateX(0);
            }
            .content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>

<div class="sidebar" id="sidebar">
    <button class="toggle-btn" id="toggle-btn">☰</button>
    <h2>Splash</h2>
    <a href="#">Home</a>
    <a href="#">About</a>
    <a href="#">Pages</a>
    <a href="#">Portfolio</a>
    <a href="#">Contact</a>

    <div class="newsletter">
        <p><strong>Subscribe for newsletter</strong></p>
        <input type="email" placeholder="Enter Email Address">
    </div>

    <p style="margin-top: 20px; font-size: 12px;">Copyright ©2021 All rights reserved</p>
</div>

<div class="content">
  <br><br>
    <h3>Sidebar #02</h3>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit...</p>
</div>

<script>
    const toggleBtn = document.getElementById('toggle-btn');
    const sidebar = document.getElementById('sidebar');

    toggleBtn.addEventListener('click', () => {
        if (window.innerWidth <= 768) {
            sidebar.classList.toggle('show');
        } else {
            sidebar.classList.toggle('collapsed');
        }
    });
</script>

</body>
</html>
