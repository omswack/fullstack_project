<?php
		session_start();

		// Check if the admin is logged in
		if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) 
		{
		  // Redirect the user to the login page or display an error message
		  header("Location: login.php");
		  exit();
		}			

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
		
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin</title>
	<meta charset="utf-8">
	<meta name="description" content="This is the admin page. Not really sure why a metatag is needed here hehe. Only special people have access :)">
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

    <div class="container">
    	<h2>User Database</h2>

	    <?php
	    // Fetch data from the "User" table
			$sql = "SELECT * FROM User";
			$results = $mysqli->query($sql);

			// Check if any rows were returned
			if ($results->num_rows > 0) 
			{
			  // Loop through each row and display the data
			  while ($row = $results->fetch_assoc()) 
			  {
			  	// Assign the values to variables
			    $user_id = $row['user_id'];
			    $first_name = $row['first_name'];
			    $last_name = $row['last_name'];
			    $email = $row['email'];
			    $username = $row['username'];
			    $password = $row['password'];
			    $role_id = $row['role_id'];

			    // Display the row values in HTML format
			    echo "<p>User ID: " . $row['user_id'] . "</p>";
			    echo "<p>First name: " . $row['first_name'] . "</p>";
			    echo "<p>Last name: " . $row['last_name'] . "</p>";
			    echo "<p>Email: " . $row['email'] . "</p>";
			    echo "<p>Username: " . $row['username'] . "</p>";
			    echo "<p>Password: " . $row['password'] . "</p>";
			    echo "<p>Role: " . $row['role_id'] . "</p>";


			    // // Add edit and delete links/buttons for each row
			    // echo "<a href='edit_user.php?id=" . $row['user_id'] . "'>Edit</a>";
			    // echo "<br>";
			    // echo "<a href='delete_user.php?id=" . $row['user_id'] . "'>Delete</a>";

			    // echo "<hr>"; // Add a horizontal line between rows

			    // Create a form for each user with input fields for editing
				echo '<form method="POST" action="' . $_SERVER["PHP_SELF"] . '">';
				echo '<input type="hidden" name="id" value="'.$user_id.'">';
				echo '<div class="form-group">';
				echo '<label for="fname">First Name:</label>';
				echo '<input type="text" name="fname" id="fname" value="'.$first_name.'">';
				echo '</div>';
				echo '<div class="form-group">';
				echo '<label for="lname">Last Name:</label>';
				echo '<input type="text" name="lname" id="lname" value="'.$last_name.'">';
				echo '</div>';
				echo '<div class="form-group">';
				echo '<label for="email">Email:</label>';
				echo '<input type="email" name="email" id="email" value="'.$email.'">';
				echo '</div>';
				echo '<div class="form-group">';
				echo '<label for="username">Username:</label>';
				echo '<input type="text" name="username" id="username" value="'.$username.'">';
				echo '</div>';
				echo '<div class="form-group">';
				echo '<label for="password">Password:</label>';
				echo '<input type="password" name="password" id="password" value="'.$password.'">';
				echo '</div>';
				echo '<div class="form-group">';
				echo '<label for="role">Role:</label>';
				echo '<select name="role" id="role">';
				echo '<option value="2" '.($role_id == 2 ? 'selected' : '').'>Admin</option>';
				echo '<option value="1" '.($role_id == 1 ? 'selected' : '').'>User</option>';
				echo '</select>';
				echo '</div>';
				echo '<button type="submit">Save</button>';
				echo '</form>';

				// Add delete button for each row
			    echo "<form method='POST' action='".$_SERVER['PHP_SELF']."'>";
                echo "<input type='hidden' name='delete_user_id' value='".$user_id."'>";
                echo "<button type='submit' onclick=\"return confirm('Are you sure you want to delete this user?');\">Delete</button>";
                echo "</form>";
			  }
			}
			else 
			{
			  echo "No users found.";
			}

			$mysqli->close();
		?>

<!-- CHECKING FOR ANY CHANGES TO THE DATABASE -->

		<?php
			$host = "303.itpwebdev.com";
			$user = "swack_db_user";
			$pass = "Itp2023!";
			$db = "swack_user_dbs";

			// Establish connection
			$mysqli = new mysqli($host, $user, $pass, $db);

			// Check for connection errors
			if ($mysqli->connect_errno) {
			  echo $mysqli->connect_error;
			  exit();
			}

			$mysqli->set_charset('utf8');

			if ($_SERVER["REQUEST_METHOD"] == "POST") {
			  // Get the form data
			  $user_id = $_POST['id'];
			  $first_name = $_POST['fname'];
			  $last_name = $_POST['lname'];
			  $email = $_POST['email'];
			  $username = $_POST['username'];
			  $password = $_POST['password'];
			  $role_id = $_POST['role'];

			  // Update the user information in the database
			  $sql = "UPDATE User SET first_name = ?, last_name = ?, email = ?, username = ?, password = ?, role_id = ? WHERE user_id = ?";
			  $stmt = $mysqli->prepare($sql);
			  $stmt->bind_param("ssssssi", $first_name, $last_name, $email, $username, $password, $role_id, $user_id);
			  $stmt->execute();

			  // if ($stmt->affected_rows > 0) 
			  // {
			  //   header("Location: admin.php");
			  // } 

			  $stmt->close();
			}

			$mysqli->close();
		?>

<!-- DELETE BUTTON -->

		<?php
		    $host = "303.itpwebdev.com";
		    $user = "swack_db_user";
		    $pass = "Itp2023!";
		    $db = "swack_user_dbs";

		    // Establish connection
		    $mysqli = new mysqli($host, $user, $pass, $db);

		    // Check for connection errors
		    if ($mysqli->connect_errno) 
		    {
		        echo $mysqli->connect_error;
		        exit();
		    }

		    $mysqli->set_charset('utf8');

		    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_user_id'])) 
		    {
			    // Get the user ID to delete
			    $delete_user_id = $_POST['delete_user_id'];

			    // Prepare the delete statement
			    $sql = "DELETE FROM User WHERE user_id = ?";
			    $stmt = $mysqli->prepare($sql);
			    $stmt->bind_param("i", $delete_user_id);

			    // Execute the delete statement
			   
			    $stmt->close();
			}

		    $mysqli->close();
		?>
	</div>
</body>
</html>