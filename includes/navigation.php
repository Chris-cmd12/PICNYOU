<header class="header">
      <a href="index.php">
        <img
          src="assets/img/favicon-32x32.png"
          alt="Pic'n You logo"
          class="logo"
        />
      </a>

      <!-- NAVBAR -->
      <nav class="main-nav">
        <ul class="main-nav-list">

          <?php
          if(isset($_SESSION['user_id'])){
            
            if($_SESSION['user_role'] === 'Admin'){
              echo "<li><a href='admin/index.php' class='main-nav-link nav-cta'>My profile</a></li>";
            } else {
              echo "<li><a href='admin/user_index.php' class='main-nav-link nav-cta'>My profile</a></li>";
            }
          } else {
           echo "<li><a href='login.php' class='main-nav-link nav-cta'>LOGIN</a></li>";
           echo "<li><a href='create_user.php' class='main-nav-link nav-cta'>CREATE ACCOUNT</a></li>";
          }
          ?>
        </ul>
      </nav>

      <button class="btn-mobile-nav">
        <ion-icon class="icon-mobile-nav" name="menu-outline"></ion-icon>
        <ion-icon class="icon-mobile-nav" name="close-outline"></ion-icon>
      </button>
    </header>