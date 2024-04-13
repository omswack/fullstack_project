<?php
						session_start();
						// var_dump($_POST);
						if (isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['email']) && isset($_POST['uname']) && isset($_POST['pword']))
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

						// Get the data from the form

						$firstname = $_POST['fname'];
						$lastname = $_POST['lname'];
						$email = $_POST['email'];
						$password = $_POST['pword'];
						$username = $_POST['uname'];


						// Check if the username already exists
						$sql = "SELECT * FROM User WHERE username='$username'";
						$results = $mysqli->query($sql);

						if (!$results) 
						{
						    echo $mysqli->error;
						}

						if ($results->num_rows > 0) 
						{
		    			// User was not found, so display an error message
    					$error_message = "This username is already taken, please choose a different one.";
						}

						else
						{
							// inset row
							$insertSql = "INSERT INTO User (`first_name`, `last_name`, `email`, `password`, `username`, `role_id`) VALUES ('$firstname', '$lastname', '$email', '$password', '$username', '1')";

							$insertResult = $mysqli->query($insertSql);
							$_SESSION['logged_in'] = true;
			       	header("Location: program.php");
			        exit();
						}

						$mysqli->close();

					}
	?>
<!DOCTYPE html>
<html>
<head>
	<title>signup</title>
	<meta charset="utf-8">
	<meta name="description" content="Congrats on making your GeoListen account! I am so proud of you. What are you waiting for? Explore!">
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
			<h2 class="col-12 mt-5 mb-4">Sign Up</h2>

			<!-- We want a section that spans all 12 columns -->
			<div class="col-12">

				<form id="signup-form" action="signup.php" method="POST">

					<!-- This is a form so we use the bootstrap class 'form-group row' -->
					<div class="form-group row">
						<!-- For all of the labels, we want them to span 2 columns and align as a form normally would (use bootstrap col-form-label) -->
						<label for="fname" class="required col-sm-2 col-form-label">First Name:</label>
						<div class="col-sm-8">
							<input type="text" name="fname" class="form-control" placeholder="Tommy" id="fname">

							<!-- Error message that we will use javascript to display -->
							<small id="fname-error" class="form-text text-danger"></small>

						</div>
					</div> <!-- .form-group -->

					<div class="form-group row">
						<!-- For all of the labels, we want them to span 2 columns and align as a form normally would (use bootstrap col-form-label) -->
						<label for="lname" class="required col-sm-2 col-form-label">Last Name:</label>
						<!-- For all of our accessible content (the box where users can submit information), we want it to span the remaining 10 columns and we use the form-control class from bootstrap to make it a text field with placeholders-->
						<div class="col-sm-8">
							<input type="text" name="lname" class="form-control" placeholder="Trojan" id="lname">

							<!-- Error message that we will use javascript to display -->
							<small id="lname-error" class="form-text text-danger"></small>

						</div>
					</div> <!-- .form-group -->

					<div class="form-group row">
						<label for="email" class="required col-sm-2 col-form-label">Email:</label>
						<div class="col-sm-8">
							<input type="text" name="email" class="form-control" placeholder="ttrojan@usc.edu" id="email">

							<small id="email-error" class="form-text text-danger"></small>

						</div>
					</div> <!-- .form-group -->

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

<!-- Javascript for creating account submission, using regex etc. -->
<script>
	
		document.querySelector("#signup-form").onsubmit = function() {
			
			let validForm = true;

			// Store the name and trim the spacing from the front and end 
			const fname = document.querySelector("#fname").value.trim();
			const regexFirstName = /^[A-Z][a-z]*$/;

			if (fname.length === 0)
			{
				validForm = false;
				console.log('name is empty')
				// grab email error from above
				document.querySelector("#fname-error").innerHTML = "First Name cannot be empty.";
			}
			
			else if (!regexFirstName.test(fname)) 
			{
				document.getElementById("fname-error").innerHTML = "First Name must start with an uppercase letter followed by lowercase letters only.";
				validForm = false;
			}
			
			else
			{
				document.querySelector("#fname-error").innerHTML = ``;
			}

			// Store the name and trim the spacing from the front and end 
			const lname = document.querySelector("#lname").value.trim();
			const regexLastName = /^[A-Z][a-z]*$/;

			if (lname.length === 0)
			{
				validForm = false;
				// grab email error from above
				document.querySelector("#lname-error").innerHTML = "Last Name cannot be empty.";
			}
			
			else if (!regexFirstName.test(fname)) 
			{
				document.getElementById("lname-error").innerHTML = "Last Name must start with an uppercase letter followed by lowercase letters only.";
				validForm = false;
			}
			
			else
			{
				document.querySelector("#lname-error").innerHTML = ``;
			}


			const email = document.querySelector("#email").value.trim();
			const regexEmail = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;

			
			if (email.length === 0)
			{
					validForm = false;
					// grab email error from above
					document.querySelector("#email-error").innerHTML = "You must provide an email.";
			}
			else if (email.indexOf("@usc.edu") == -1) 
			{
				validForm = false;
				// grab email error from above
				document.querySelector("#email-error").innerHTML = `Email must end with "@usc.edu"`;
			}
			else if (!regexEmail.test(email)) 
			{
				document.querySelector("#email-error").innerHTML = "Please enter a valid email address.";
				validForm = false;
			} 
			else 	
			{		
				document.querySelector("#email-error").innerHTML = "";
			}


			const uname = document.querySelector("#uname").value.trim();

			
			if (uname.length == 0)
			{
				validForm = false;
				document.querySelector("#uname-error").innerHTML = 'Please enter a username.';
			}

			else if (uname.length < 3)
			{
				validForm = false;
				document.querySelector("#uname-error").innerHTML = 'Your username should be atleast three characters long.';
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
