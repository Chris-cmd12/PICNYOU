<?php ob_start(); ?>
<?php require_once("admin/includes/init.php"); ?>
<?php

if($session->is_signed_in()) {
    redirect("admin/index.php");
}

if(isset($_POST['submit'])) {

    $user_username = trim($_POST['username']);
    $user_password = trim($_POST['password']);


  $sql = "SELECT * FROM users WHERE user_username = '{$user_username}'";
  $check_user = User::find_by_query($sql);



  foreach($check_user as $user){
    $db_id =  $user->user_id;
    $db_username =  $user->user_username;
    $db_password =  $user->user_password;
    $db_firstname =  $user->user_firstname;
    $db_lastname =  $user->user_lastname;
    $db_role =  $user->user_role;
  }

  if(empty($user)){
    $db_password = "";
  }

  // echo $user_password;
  // echo $db_password;

  if(password_verify($user_password,$db_password)){

    $_SESSION['user_id'] = $db_id;
    $_SESSION['user_username'] = $db_username;
    $_SESSION['user_firstname'] = $db_firstname;
    $_SESSION['user_lastname'] = $db_lastname;
    $_SESSION['user_role'] = $db_role;

    if($db_role === "Admin"){
      redirect("admin/index.php");
    } elseif($db_role === "User"){
      redirect("admin/user_index.php");
    } else {
      redirect("login.php");
    }

  }


else {
    $user_username = "";
    $user_password = "";
    $the_message = "Vos identifiants sont incorrect";
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
          <div class="login-img">
            <img src="assets/img/favicon-32x32.png" alt="" />
          </div>
          <div class="login-form">
            <form action="" method="post" id="login-id">
              <div class="login-form-element">
                <label for="Username">Username</label>
                <input type="text" name="username" " />
              </div>
              <div class="login-form-element">
                <label for="Password">Password</label>
                <input type="password" name="password" " />
              </div>
              <input
                class="login-btn"
                type="submit"
                name="submit"
                value="LOGIN"
              />
            <a class="btn btn--full" href="create_user.php">CREATE ACCOUNT</a>
            </form>
          </div>
          <br>
          <br>
          <h4 class="login-form-element"><?php if (isset($the_message)) {echo $the_message;}  ?></h4>
        </div>
      </section>
    </main>
  </body>
</html>
