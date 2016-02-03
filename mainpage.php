<?php

  session_start();

  include ("connection.php");

  $query = "SELECT diary FROM users WHERE id='".$_SESSION['id']."' LIMIT 1";

	$result = mysqli_query($link,$query);

	$row = mysqli_fetch_array($result);

	$diary=$row['diary'];

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Secret Diary</title>

    <script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    <!-- Optional theme -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">

    <style>

   		.navbar-brand{
   			font-size:1.8em;

   		}

   		#topContainer{
   			background-image:url("background.jpg");
   			height:400px;
   			width:100%;
   			background-size:cover;
   		}

   		#topRow {
   			margin-top:80px;
        text-align:center;
   		}

   		#topRow h1{
   			font-size:300%;

   		}

   		.bold{
   			font-weight:bold;
   		}

   		.marginTop{
   			margin-top:30px;

   		}

   		.center{
   			text-align:center;

   		}

   		.title {
   			margin-top:100px;
   			font-size:300%;

   		}

   		#footer{
   			background-color: #B0D1FB;
   			padding-top:70px;
   			width:100%;
   		}

   		.marginBottom{
   			margin-bottom:30px;

   		}

   		.appstoreImage{
   			width:250px;

   		}
   </style>


  </head>

<body data-spy="scroll" data-target=".navbar-collapse">

  <div class="navbar navbar-inverse navbar-fixed-top">

  	<div class="container">

  		<div class="navbar-header pull-left">


  			<a class="navbar-brand">Secret Diary</a>

  		</div>

  		<div class="pull-right">
        <ul class="navbar-nav nav">
          <!--href is set to index.php and then a get variable is amde using ? and then set logout =1 and then we go to our main page and write a biti of script that if logout=1 and then log user out  -->

          <li><a href="index.php?logout=1">Log Out</a></li>
        </ul>

  		</div>

  	</div>

  </div>


 <div class="container contentContainer" id="topContainer">
  		<div class="row">

  			<div class="col-md-6 col-md-offset-3" id="topRow">
          <textarea class="form-control"><?php echo $diary; ?></textarea>
        </div>

		</div>

  </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

    <!-- Include all compiled plugins (below), or include individual files as needed -->

    <script src="js/bootstrap.min.js"></script>
    <script>

      $(".contentContainer").css("min-height",$(window).height());
      $("textarea").css("height",$(window).height()-110);
      //Now we need to run our script whenever user update the text area field
      //keyup runs whenever user writes anything on the screen
      $("textarea").keyup(function(){
        //We are using post method to post our data to the db. We can use ajax call for this as well
        /*It will post updateddiary.php with the contents of textarea field as the diary variable*/
        //We rae setting diary equal to the value of our testarea field
        $.post("updatediary.php",{diary:$("textarea").val()} );
        //alert("Changed!");
      });

      /*$("textarea").keyup(function() {

  $.post("updatediary.php", {diary:$("textarea").val()} );

});*/


    </script>
  </body>
</html>
