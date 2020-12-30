<?php

  //form username
  function sanitizeFormUsername($inputText){
    $inputText = strip_tags($inputText);
    $inputText = str_replace(" ", "", $inputText);
    return $inputText;
  }
  //form password
  function sanitizeFormPassword($inputText){
    $inputText = strip_tags($inputText);
    return $inputText;
  }
  //form string
  function sanitizeFormString($inputText){
    $inputText = strip_tags($inputText);
  	$inputText = str_replace(" ", "", $inputText);
  	$inputText = strtolower($inputText);
  	return $inputText;
  }
  //form names
  function sanitizeFormName($inputText){
    $inputText = strip_tags($inputText);
  	$inputText = str_replace(" ", "", $inputText);
  	$inputText = ucfirst(strtolower($inputText));
  	return $inputText;
  }

  if(isset($_POST['registerButton'])){
    //login button was pressed
    $username = sanitizeFormUsername($_POST['registerUsername']);
    $firstname = sanitizeFormName($_POST['registerFirstName']);
    $lastname = sanitizeFormString($_POST['registerLastName']);
    $email = sanitizeFormString($_POST['registerEmail']);
    $email2 = sanitizeFormString($_POST['registerEmailConfirm']);
    $password = sanitizeFormPassword($_POST['registerPassword']);
    $password2 = sanitizeFormPassword($_POST['registerPasswordConfirm']);

    $wasSuccessful = $account->register($username, $firstname, $lastname, $email, $email2, $password, $password2);

    if ($wasSuccessful == true){
      $_SESSION['userLoggedIn'] = $username;
      header("Location: index.php");
    }

  }

?>
