<?php

  class Account{

    private $errorArray;
    private $dbh;

    public function __construct($dbh){
      $this->dbh = $dbh;
      $this->errorArray = array();
    }

    //register account
    public function register($un, $fn, $ln, $e, $e2, $pw, $pw2){
      $this->validateUsername($un);
      $this->validateFirstName($fn);
      $this->validateLastName($ln);
      $this->validateEmails($e, $e2);
      $this->validatePasswords($pw, $pw2);

      if(empty($this->errorArray) == true){
        //successfully registered insert into db
        return $this->insertUserDetails($un, $fn, $ln, $e, $pw);
      } else {
        //errors
        return false;
      }
    }

    //login to Account
    public function login($un, $pw){
      $pw = md5($pw);

      $sth = $this->dbh->query("SELECT * FROM users WHERE username='$un' AND password='$pw'");

      if($sth->rowCount() == 1){
        return true;
      } else {
        //login failed
        array_push($this->errorArray, Constants::$loginFailed);
        return false;
      }
    }

    public function getError($error) {
      if(!in_array($error, $this->errorArray)) {
        $error = "";
      }
      return "<span class='errorMessage'>$error</span>";
    }

    /*query functions */
    private function insertUserDetails($un, $fn, $ln, $em, $pw){
      $encryptedPw = md5($pw);
      $date = date("Y-m-d");
      $profilepic = "assets/images/profile-pics/def_profile_pic.png";

      //insert using a prepared stmt
      $insertUserStmt = "INSERT INTO users (username,firstName,lastName,email,password,signUpDate,profilePic) VALUES (?, ?, ?, ?, ?, ?, ?)";
      $stmt = $this->dbh->prepare($insertUserStmt);
      $result = $stmt->execute([$un, $fn, $ln, $em, $encryptedPw, $date, $profilepic]);

      return $result;
    }

    /* validation*/
    private function validateUsername($un){
      if(strlen($un) > 25 || strlen($un) < 5){
        //error invalid length
        array_push($this->errorArray, Constants::$usernameWrongLength);
        return;
      }
      //check if username exists
      $sth = $this->dbh->query("SELECT username FROM users WHERE username='$un'");
      if($sth->rowCount() > 0){
        //error username already taken
        array_push($this->errorArray, Constants::$usernameTaken);
        return;
      }
    }

    private function validateFirstName($fn){
      if(strlen($fn) > 25 || strlen($fn) < 2){
        //error invalid length
        array_push($this->errorArray, Constants::$firstNameWrongLength);
        return;
      }
    }

    private function validateLastName($ln){
      if(strlen($ln) > 25 || strlen($ln) < 2){
        //error invalid length
        array_push($this->errorArray, Constants::$lastNameWrongLength);
        return;
      }
    }

    private function validateEmails($e, $e2){
      if($e != $e2){
        //error emails dont match
        array_push($this->errorArray, Constants::$emailsDoNotMatch);
        return;
      }

      if(!filter_var($e, FILTER_VALIDATE_EMAIL)){
        //error invalid email format
        array_push($this->errorArray, Constants::$emailInvalid);
        return;
      }

      // check that email hasn't already been used.
      $sth = $this->dbh->query("SELECT email FROM users WHERE email='$e'");
      if($sth->rowCount() > 0){
        //email already associated with an account
        array_push($this->errorArray, Constants::$emailTaken);
        return;
      }
    }

    private function validatePasswords($pw, $pw2){
      if($pw != $pw2){
        //error passwords dont match
        array_push($this->errorArray, Constants::$passwordsDoNotMatch);
        return;
      }

      if(preg_match('/[^A-Za-Z0-9]/', $pw)){
        //error invalid password
        array_push($this->errorArray, Constants::$passwordNotAlphanumeric);
        return;
      }

      if(strlen($pw) < 5){
        //error invalid pw length
        array_push($this->errorArray, Constants::$passwordTooShort);
        return;
      }
    }

  }


 ?>
