<?php
  include("includes/config.php");
  include("includes/classes/Account.php");
  include("includes/classes/Constants.php");

  $account = new Account($dbh);

  include("includes/handlers/register-handler.php");
  include("includes/handlers/login-handler.php");

  //to remember values
  function getValue($fieldname){
    if(isset($_POST[$fieldname])){
      echo $_POST[$fieldname];
    }
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Stupefy!</title>
    <link rel="stylesheet" type="text/css" href="assets/css/register.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

</head>
<body>
  <div id="background" class="vh-100">

    <div class="row">

      <div class="col-md-7 text-center align-middle">
        <h1 class="register-title">Welcome to Stupefy</h1>
      </div>

      <div id="inputContainer" class="col-md-5">

          <form id="loginForm" class="login-form" action="register.php" method="POST">
              <h2>Login to your account</h2>

                <div class="form-group">
                  <?php echo $account->getError(Constants::$loginFailed); ?>
                  <label for="loginUsername" class="text-white-50">Username: </label>
                  <input id="loginUsername" class="form-control" name="loginUsername" type="text" value="<?php getValue('loginUsername'); ?>" placeholder="UserName" required>
                </div>

                <div class="form-group">
                  <label for="loginPassword" class="text-white-50">Password: </label>
                  <input id="loginPassword" class="form-control"  name="loginPassword" type="password" placeholder="Your Password" value="<?php getValue('loginPassword'); ?>" required>
                </div>

              <button class="btn btn-primary" type="submit" name="loginButton">Login</button>
          </form>


          <form id="registerForm" class="register-form" action="register.php" method="POST">
              <h2>Register your account</h2>
              <div class="form-group">
                <span><?php echo $account->getError(Constants::$usernameWrongLength); ?></span>
                <span><?php echo $account->getError(Constants::$usernameTaken); ?></span>
                <label class="text-white-50" for="registerUsername">Username: </label>
                <input id="registerUsername" class="form-control" name="registerUsername" type="text" value="<?php getValue('registerUsername'); ?>" placeholder="UserName" required>
              </div>
              <div class="form-group">
                <?php echo $account->getError(Constants::$firstNameWrongLength); ?>
                <label class="text-white-50" for="registerFirstName">First Name: </label>
                <input id="registerFirstName" class="form-control" type="text" name="registerFirstName" value="<?php getValue('registerFirstName'); ?>" placeholder="e.g. Bob">
              </div>
              <div class="form-group">
                <?php echo $account->getError(Constants::$lastNameWrongLength); ?>
                <label class="text-white-50" for="registerLastName">Last Name: </label>
                <input id="registerLastName" class="form-control" type="text" name="registerLastName"  value="<?php getValue('registerLastName'); ?>" placeholder="e.g. Smith">
              </div>
              <div class="form-group">
                <?php echo $account->getError(Constants::$emailsDoNotMatch); ?>
                <?php echo $account->getError(Constants::$emailInvalid); ?>
                <?php echo $account->getError(Constants::$emailTaken); ?>
                <label class="text-white-50" for="registerEmail">Email: </label>
                <input id="registerEmail" class="form-control" type="email" name="registerEmail" value="<?php getValue('registerEmail'); ?>" placeholder="e.g. user@email.com">
              </div>
              <div class="form-group">
                <?php echo $account->getError(Constants::$emailsDoNotMatch); ?>
                <?php echo $account->getError(Constants::$emailInvalid); ?>
                <?php echo $account->getError(Constants::$emailTaken); ?>
                <label class="text-white-50" for="registerEmailConfirm">Confirm Email: </label>
                <input id="registerEmailConfirm" class="form-control" type="email" name="registerEmailConfirm" value="<?php getValue('registerEmailConfirm'); ?>" placeholder="e.g. user@email.com">
              </div>
              <div class="form-group">
                <?php echo $account->getError(Constants::$passwordsDoNotMatch);?>
                <?php echo $account->getError(Constants::$passwordNotAlphanumeric); ?>
                <?php echo $account->getError(Constants::$passwordTooShort); ?>
                <label class="text-white-50" for="registerPassword">Password: </label>
                <input id="registerPassword" class="form-control" name="registerPassword" value="<?php getValue('registerPassword'); ?>" type="password" placeholder="Your password" required>
              </div>
              <div class="form-group">
                <?php echo $account->getError(Constants::$passwordsDoNotMatch); ?>
                <?php echo $account->getError(Constants::$passwordNotAlphanumeric); ?>
                <?php echo $account->getError(Constants::$passwordTooShort); ?>
                <label class="text-white-50" for="registerPasswordConfirm">Confirm Password: </label>
                <input id="registerPasswordConfirm" class="form-control" name="registerPasswordConfirm" value="<?php getValue('registerPasswordConfirm'); ?>" type="password" placeholder="Confirm Password" required>
              </div>

              <button class="btn btn-primary" type="submit" name="registerButton">Register</button>
          </form>
      </div>
    </div>

  </div>
</body>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</html>
