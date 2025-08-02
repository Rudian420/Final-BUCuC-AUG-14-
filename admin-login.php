<?php 
    session_start();
    require 'Database/db.php';

    $database = new Database();

    $conn = $database->createConnection();

    
    $success = "";
    $error = "";

    if($_SERVER["REQUEST_METHOD"]=="POST"){

        
        $adminEmail = htmlspecialchars($_POST["adminEmail"]);

        $adminPassword = $_POST["adminPassword"];

        $sql = "SELECT * FROM adminpanel WHERE email=:adminemail";

        $stmt = $conn->prepare($sql);

        $stmt->bindParam(":adminemail",$adminEmail);

        $stmt->execute();

        $admin = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if($admin && $admin[0]['password']===$adminPassword){
          $success = "Login successful! Redirecting to dashboard...";
          $_SESSION['username'] = $admin[0]['username'];
          $_SESSION['admin'] = true;
          $_SESSION['admin_id'] = $admin[0]['id'];
          $_SESSION['admin_role'] = $admin[0]['role'];
          header("refresh:1;url=admin_dashboard.php");

        }else{
            $error = "Invalid admin credentials. Contact: bucuc@support.ac.bd";
        }



        

    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Login - BRAC University Cultural Club</title>

    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/bootstrap-icons.css" rel="stylesheet" />
    <link href="css/templatemo-festava-live.css" rel="stylesheet" />

    <!-- Font Awesome -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    />

    <link rel="stylesheet" href="AdminCss/admin.css">
  </head>
  <body>
    <!-- Floating Particles -->
    <div class="particles" id="particles"></div>

    <div class="login-container">
      <div class="logo-section">
        <div class="logo-icon">
          <i class="fas fa-user-shield"></i>
        </div>
        <h1 class="login-title">Admin Login</h1>
        <p class="login-subtitle">
          Enter your credentials to access the dashboard
        </p>
      </div>

    <?php if (!empty($error)): ?>
      <div class="error-message" id="errorMessage" style="display: block;">
        <i class="fas fa-exclamation-triangle me-2"></i>
        <span id="errorText"><?= htmlspecialchars($error) ?></span>
      </div>
    <?php endif; ?>

    <?php if (!empty($success)): ?>
      <div class="success-message" id="successMessage" style="display: block;">
        <i class="fas fa-check-circle me-2"></i>
        <span id="successText"><?= htmlspecialchars($success) ?></span>
      </div>
    <?php endif; ?>

      <form action="" method="POST" id="adminLoginForm">
        <div class="form-group">
          <i class="fas fa-envelope input-icon"></i>
          <input
            type="email"
            class="form-control"
            id="adminEmail"
            name="adminEmail"
            placeholder="Admin Email"
            required
          />
        </div>

        <div class="form-group">
          <i class="fas fa-lock input-icon"></i>
          <input
            type="password"
            class="form-control"
            id="adminPassword"
            name="adminPassword"
            placeholder="Admin Password"
            required
          />
        </div>

        <button type="submit" class="btn btn-login">
          <i class="fas fa-sign-in-alt me-2"></i>
          Login to Dashboard
        </button>
      </form>

      <div class="back-link">
        <a href="index.php">
          <i class="fas fa-arrow-left"></i>
          Back to Main Site
        </a>
      </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="js/bootstrap.min.js"></script>

    <script>
      // Create floating particles
      function createParticles() {
        const particlesContainer = document.getElementById("particles");
        const particleCount = 20;

        for (let i = 0; i < particleCount; i++) {
          const particle = document.createElement("div");
          particle.className = "particle";
          particle.style.left = Math.random() * 100 + "%";
          particle.style.animationDelay = Math.random() * 6 + "s";
          particle.style.animationDuration = Math.random() * 3 + 3 + "s";
          particlesContainer.appendChild(particle);
        }
      }


      // Add interactive effects
      document.querySelectorAll(".form-control").forEach((input) => {
        input.addEventListener("focus", function () {
          this.parentElement.style.transform = "scale(1.02)";
        });

        input.addEventListener("blur", function () {
          this.parentElement.style.transform = "scale(1)";
        });
      });

      // Initialize particles when page loads
      document.addEventListener("DOMContentLoaded", function () {
        createParticles();
      });
    </script>
  </body>
</html> -->
