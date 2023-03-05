<?php require_once("admin/includes/init.php"); ?>

<?php
$message = "";
if(isset($_POST['create'])){
$user = new User();
$user->user_username = $_POST['username'];
$user->user_password = $_POST['password'];
$user->user_password = password_hash($user->user_password, PASSWORD_BCRYPT, array('cost' => 10));
$user->user_role = "User";
$user->user_firstname =  null;
$user->user_lastname = null;
$user->user_image = null ;

if($user->save()){
    $message = "ACCOUNT CREATED : <a href='login.php'>GO TO THE LOGIN PAGE</a>";
} else {
    $message = join("<br>", $user->errors);
}

}

?>




<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- LINK -->
    <link rel="icon" href="assets/img/favicon-32x32.png" />
    <!-- CUSTOM CSS -->
    <link rel="stylesheet" href="css/general.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/queries.css" />

    <!-- GOOGLE FONT -->
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap"
      rel="stylesheet"
    />
    <!-- JS -->
    <script
      type="module"
      src="https://unpkg.com/ionicons@5.4.0/dist/ionicons/ionicons.esm.js"
    ></script>
    <script
      nomodule=""
      src="https://unpkg.com/ionicons@5.4.0/dist/ionicons/ionicons.js"
    ></script>

    <script
      defer
      src="https://unpkg.com/smoothscroll-polyfill@0.4.4/dist/smoothscroll.min.js"
    ></script>
    <script defer src="js/script.js"></script>
    <title>Pic'N You</title>
  </head>
  <body>
    <!-- MAIN -->
    <main>
      <!-- SECTION HERO -->
      <section class="section-login">
        <div class="login-box">
          <div class="login-img align-items-center ">
            <h2 class="login-form-element">CREATE YOUR ACCOUNT</h2>
          </div>
          <div class="login-form">
            <form action="" method="post" id="login-id">
              <div class="login-form-element">
                <label for="Username">Username</label>
                <input type="text" name="username" />
              </div>
              <div class="login-form-element">
                <label for="Password">Password</label>
                <input type="password" name="password" />
              </div>
              <input
                class="login-btn"
                type="submit"
                name="create"
                value="CREATE"
              />
              <?php echo '<p>' . $message . '</p>' ?>
              <a class="btn btn--full" href="index.php">BACK</a>
            </form>
          </div>
          <br>
          <h4 class="login-form-element"></h4>
        </div>
      </section>
    </main>
  </body>
</html>