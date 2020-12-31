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
    <link rel="preconnect" href="https://fonts.gstatic.com">

    <link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@400;700;900&family=Eagle+Lake&family=Montserrat:wght@400;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/register.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="assets/js/register.js"></script>

</head>
<body>
  <?php
  if(isset($_POST['registerButton'])){
    echo '<script>
            $(document).ready(function(){
              $("#loginForm").hide();
              $("#registerForm").show();
            });
            </script>';
  } else {
    echo '<script>
            $(document).ready(function(){
              $("#registerForm").hide();
              $("#loginForm").show();
            });
            </script>';
  }

   ?>




  <div id="background" class="vh-100 m-0">

    <div class="row m-auto container-fluid">

      <div class="col-md-6 m-auto">
        <h1 class="register-title text-center"><span class="smaller-register-title">Welcome to</span> <br/>Stupefy</h1>
      </div>

      <div id="inputContainer" class="col-md-6 vh-100 container-fluid">

          <form id="loginForm" class="login-form text-md-left vertical-center" action="register.php" method="POST">
              <h2 class="form-title">Login to your account</h2>

                <div class="form-group">
                  <span class="errorMessage"><?php echo $account->getError(Constants::$loginFailed); ?></span>
                  <label for="loginUsername" class="text-white">Username: </label>
                  <input id="loginUsername" class="form-control" name="loginUsername" type="text" value="<?php getValue('loginUsername'); ?>" placeholder="UserName" required>
                </div>

                <div class="form-group">
                  <label for="loginPassword" class="text-white">Password: </label>
                  <input id="loginPassword" class="form-control"  name="loginPassword" type="password" placeholder="Your Password" value="<?php getValue('loginPassword'); ?>" required>
                </div>

              <button class="btn btn-lg btn-block" type="submit" name="loginButton">Login</button>

              <div class="hasAccountText">
                <span id="hideLogin">Haven't been sorted into a house yet? Signup here.</span>
              </div>
          </form>


          <form id="registerForm" class="register-form vertical-center collapse" action="register.php" method="POST">
              <h2 class="form-title">Register your account</h2>
              <div class="form-group">
                <span class="errorMessage"><?php echo $account->getError(Constants::$usernameWrongLength); ?></span>
                <span class="errorMessage"><?php echo $account->getError(Constants::$usernameTaken); ?></span>
                <label class="text-white" for="registerUsername">Username: </label>
                <input id="registerUsername" class="form-control" name="registerUsername" type="text" value="<?php getValue('registerUsername'); ?>" placeholder="UserName" required>
              </div>
              <div class="form-group">
                <span class="errorMessage"><?php echo $account->getError(Constants::$firstNameWrongLength); ?></span>
                <label class="text-white" for="registerFirstName">First Name: </label>
                <input id="registerFirstName" class="form-control" type="text" name="registerFirstName" value="<?php getValue('registerFirstName'); ?>" placeholder="e.g. Bob">
              </div>
              <div class="form-group">
                <span class="errorMessage"><?php echo $account->getError(Constants::$lastNameWrongLength); ?></span>
                <label class="text-white" for="registerLastName">Last Name: </label>
                <input id="registerLastName" class="form-control" type="text" name="registerLastName"  value="<?php getValue('registerLastName'); ?>" placeholder="e.g. Smith">
              </div>
              <div class="form-group">
                <span class="errorMessage"><?php echo $account->getError(Constants::$emailsDoNotMatch); ?></span>
                <span class="errorMessage"><?php echo $account->getError(Constants::$emailInvalid); ?></span>
                <span class="errorMessage"><?php echo $account->getError(Constants::$emailTaken); ?></span>

                <label class="text-white" for="registerEmail">Email: </label>
                <input id="registerEmail" class="form-control" type="email" name="registerEmail" value="<?php getValue('registerEmail'); ?>" placeholder="e.g. user@email.com">
              </div>
              <div class="form-group">

                <label class="text-white" for="registerEmailConfirm">Confirm Email: </label>
                <input id="registerEmailConfirm" class="form-control" type="email" name="registerEmailConfirm" value="<?php getValue('registerEmailConfirm'); ?>" placeholder="e.g. user@email.com">
              </div>
              <div class="form-group">
                <span class="errorMessage"><?php echo $account->getError(Constants::$passwordsDoNotMatch);?></span>
                <span class="errorMessage"><?php echo $account->getError(Constants::$passwordNotAlphanumeric); ?></span>
                <span class="errorMessage"><?php echo $account->getError(Constants::$passwordTooShort); ?></span>

                <label class="text-white" for="registerPassword">Password: </label>
                <input id="registerPassword" class="form-control" name="registerPassword" value="<?php getValue('registerPassword'); ?>" type="password" placeholder="Your password" required>
              </div>
              <div class="form-group">

                <label class="text-white" for="registerPasswordConfirm">Confirm Password: </label>
                <input id="registerPasswordConfirm" class="form-control" name="registerPasswordConfirm" value="<?php getValue('registerPasswordConfirm'); ?>" type="password" placeholder="Confirm Password" required>
              </div>

              <button class="btn btn-lg btn-block" type="submit" name="registerButton">Register</button>

              <div class="hasAccountText">
                <span id="hideRegister">Already in a house? Login here.</span>
              </div>
          </form>
      </div>
    </div>

  </div>
</body>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</html>
