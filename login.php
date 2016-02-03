<?php
session_start();

if($_GET["logout"]==1 AND $_SESSION['id']) { session_destroy();

  $message = "You have been logged out. Have a nice day!";

}

include("connection.php");

if($_POST['submit']=="Sign Up") {

  if(!$_POST['email'])  $error.="<br />Please enter your email";

      else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))  $error.="Please enter a valid email address";

  if(!$_POST['password']) $error.="<br />Please enter your password";

      else {

        if(strlen($_POST['password'])<8)  $error.="<br />Please enter a password with atleast 8 characters";
        if(!preg_match('`[A-Z]`',$_POST['password']))  $error.="<br />Please include atleast one capital letter in your password";
        if(!preg_match('`[0-9]`',$_POST['password']))  $error.="<br />Please include atleast one Number in your password";

      }

      if($error)  $error = "There were error(s) in your signup details:".$error;

      else {

        //this will escape any of the real escape character that could do any damage to our db
        //Here we are checking 2 users of same email address
       //$query ="SELECT * FROM User WHERE email="'.mysqli_real_escape_string($link, $_POST['email'])."'";

        $query= "SELECT * FROM `users` WHERE email ='".mysqli_real_escape_string($link, $_POST['email'])."'";
        $result = mysqli_query($link,$query);
        $results = mysqli_num_rows($result);

        if($results) $error = "That email address is already registered. Do you want to log in?";

        else {

          //$query = "INSERT INTO `User` (`email`, `password`) VALUES ('".mysqli_real_escape_string($link, $_POST['email'])."', md5(md5($_POST['email']).$_POST['password'])"')";
          $query = "INSERT INTO `users` (`email`, `password`) VALUES ('".mysqli_real_escape_string($link, $_POST['email'])."', '".md5(md5($_POST['email']).$_POST['password'])."')";

          mysqli_query($link,$query);
          echo "You've been signed up" ;
          //For login purpose we need to setup session
          //mysqli_insert_id; is the id of the user whom we have inserted just into the table
          $_SESSION['id'] = mysqli_insert_id($link);
          //print_r($_SESSION);
          // redirect to logged in page
          header("Location:mainpage.php");
        }
      }
    }

    if($_POST['submit']=="Log In") {

      $query = "SELECT * FROM `users` WHERE email='".mysqli_real_escape_string($link, $_POST['loginemail'])."' AND password='" .md5(md5($_POST['loginemail']) .$_POST['loginpassword']). "'LIMIT 1";
      $result=mysqli_query($link,$query);
      $row = mysqli_fetch_array($result);

      if($row) {

        $_SESSION['id'] = $row['id'];

        //print_r($_SESSION);
        // Redirect to logged in page
        header("Location:mainpage.php");

      } else {

        $error = "We could not find a user with that email and password. Please try again.";

      }
    }

?>
