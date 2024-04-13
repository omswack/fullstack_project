<?php
				if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) 
				{
  				// User is logged in.
 					header('Location: program.php');
 				}
					else  
					{
						if (isset($_POST['uname']) && isset($_POST['pword']))
						{
						$host = "303.itpwebdev.com";
						$user = "swack_db_user";
						$pass = "Itp2023!";
						$db = "swack_user_dbs";

						// establish connection

						$mysqli = new mysqli($host, $user, $pass, $db);

						// check for connections errors

						if ($mysqli->connect_errno)
						{
							echo $mysqli->connect_error;
							exit();
						}
						$mysqli->set_charset('utf8');

						// Get the username and password from the form

						$password = $_POST['pword'];
						$username = $_POST['uname'];

						// Retrieve results from the DB.
						$sql = "SELECT * FROM User WHERE username='$username' AND password='$password'";

						$results = $mysqli->query($sql);		

						if(!$results)
						{
							echo $mysqli->error;
						}

						$adminFind = "SELECT * FROM Admin WHERE username='$username' AND password='$password'";
						$isAdmin = $mysqli->query($adminFind);

						// close connection
						$mysqli->close();

						if ($results->num_rows > 0) 
						{
							 $row = $results->fetch_assoc();
               $role_id = $row['role_id'];;
							if ($role_id == 2)
							{

								if ($isAdmin && $isAdmin->num_rows > 0) 
								{
                  // User is an admin
                  $_SESSION['logged_in'] = true;
                  header("Location: admin.php");
                  exit();
                }
							}

							else
							{
							$_SESSION['logged_in'] = true;
		   			 	header("Location: program.php");
		    			exit();
		   			 }
						}

						else 
						{
		    			// User was not found, so display an error message
    					$error_message = "Invalid username or password";
						}

					}
				}
	?>
<!DOCTYPE html>
<html>
<head>
	<title>login</title>
	<meta name="description" content="Here is GeoListen's login page. Login to your account and start exploring!">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">


	<style>
		body 
		{
			background: blueviolet;
			background: linear-gradient(225.24deg, #000205 -4.36%, #131518 118.8%);
			text-align: center;
			font-family: 'Noto Sans', sans-serif;
			color: whitesmoke;

/*			height: 3000px;*/
		}

		p
		{
			color: whitesmoke;
			text-align: left;
			font-size: 2em;

		}

		h1 {
			color: whitesmoke;
			margin-top: 0;
			font-size: 4.5em;
			position: absolute;
			left: 50%;
			top: 35%;
			transform: translate(-50%, -50%);
			width: 80%;
			line-height: 1.5;
		}

		h2
		{
			color: #7289da;
			font-size: 3em;

		}

		nav 
		{
 		   margin-left: 75px;
 		   margin-top: 50px;

		}
		nav ul 
		{

  			list-style-type: none;
		}

		nav li 
		{
  			float: left;
		}

		nav li a 
		{
  			display: block;
  			color: white;
  			text-align: center;
  			padding: 14px 16px;
 			text-decoration: none;
 			font-size: 1.5em;
		}

		nav li a:hover 
		{
 			color: #5865F2;
/* 			color: #8684BD;*/

		}

	</style>
</head>
<body>

	<nav>
      <ul>
        <li><a href="m2.html">Home</a></li>
      </ul>
    </nav>
	
	<!-- The overall structure of my code is copied from the in-class form example. We start with a container to keep everything aligned -->
	<div class="container">
		<!-- Use row class for bootstrap to keep things aligned row to row -->
		<div class="row">
			<!-- Our first row will display our header - "Contact Form" -->
			<h2 class="col-12 mt-5 mb-4">Log In</h2>

				<div class="col-12">

				<form id="signup-form" action="login.php" method="POST">

					<div class="form-group row">
						<label for="pword" class="required col-sm-2 col-form-label">Username:</label>
						<div class="col-sm-8">
							<input type="text" name="uname" class="form-control" placeholder="bob" id="uname">

							<small id="uname-error" class="form-text text-danger"></small>

						</div>
					</div> <!-- .form-group -->

					<div class="form-group row">
						<label for="pword" class="required col-sm-2 col-form-label">Password:</label>
						<div class="col-sm-8">
							<input type="text" name="pword" class="form-control" placeholder="Hello1!" id="pword">

							<small id="pword-error" class="form-text text-danger"></small>

						</div>
					</div> <!-- .form-group -->


					<div class="form-group row">
						<div class="col-sm-10">
							<button type="submit" class="btn btn-primary">Submit</button>
						</div> <!-- .col -->
					</div> <!-- .form-group -->

				</form>
				<div id="error_message" class="text-danger"></div> <!-- Error message container -->
			</div> <!-- .col -->
		</div> <!-- .row -->
	</div> <!-- .container -->

</body>

<!-- The script below is for displaying error message -->
<script>
    <?php if (isset($error_message)): ?>
        document.getElementById("error_message").innerText = "<?php echo $error_message; ?>";
    <?php endif; ?>
</script>

<!-- Javascript for username/password submission -->
<script>
	
		document.querySelector("#signup-form").onsubmit = function() {
			
			let validForm = true;

			const uname = document.querySelector("#uname").value.trim();

			if (uname.length == 0)
			{
				validForm = false;
				document.querySelector("#uname-error").innerHTML = 'Please enter a username.';
			}
			else
			{
				document.querySelector("#uname-error").innerHTML = '';

			}

			const pword = document.querySelector("#pword").value.trim();

			if (pword.length === 0)
			{
				validForm = false;
				document.querySelector("#pword-error").innerHTML = 'Please enter a password.';
			}
			else
			{
				document.querySelector("#pword-error").innerHTML = '';

			}

				return validForm; 

		}

	</script>

</html>
