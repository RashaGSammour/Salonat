<?php 
	session_start();

	// connect to database
	$db = mysqli_connect('localhost', 'root', '12345678', 'Salonat');
	define('DBINFO', 'mysql:host=localhost;dbname=Salonat');
	define('DBUSER','root');
    define('DBPASS','12345678');
	// variable declaration
	$username = "";
	$email    = "";
	$errors   = array(); 

	// call the register() function if register_btn is clicked
	if (isset($_POST['register_btn'])) {
		register();
	}

	// call the login() function if login_btn is clicked
	if (isset($_POST['login_btn'])) {
		login();
	}

	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['user']);
		header("location: login.php");
	}

	//Notification Function
	function fetchAll($query){
		$con = new PDO(DBINFO, DBUSER, DBPASS);
        $stmt = $con->query($query);
        return $stmt->fetchAll();
    }

    function performQuery($query){
    	$con = new PDO(DBINFO, DBUSER, DBPASS);
        $stmt = $con->prepare($query);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

	// REGISTER USER
	function register(){
		global $db, $errors;

		// receive all input values from the form
		$name        =  e($_POST['name']);
		$username    =  e($_POST['username']);
		$city        =  e($_POST['city']);
		$phone       =  e($_POST['phone']);
		$email       =  e($_POST['email']);
		$password_1  =  e($_POST['password_1']);
		$password_2  =  e($_POST['password_2']);

		// form validation: ensure that the form is correctly filled
		if (empty($name)) { 
			array_push($errors, "name is required"); 
		}
		if (empty($username)) { 
			array_push($errors, "Username is required"); 
		}
		if (empty($city)) { 
			array_push($errors, "city is required"); 
		}
		if (empty($phone)) { 
			array_push($errors, "Phone is required"); 
		}
		if (empty($email)) { 
			array_push($errors, "Email is required"); 
		}
		if (!empty($email)) {
		$sqlE="select * from users where email ='$email' ";
		$resultEmail = mysqli_query($db,$sqlE);
		if($row = mysqli_fetch_assoc($resultEmail)){
				array_push($errors, "Email is Exist");
			}
		} 
		if (empty($password_1)) { 
			array_push($errors, "Password is required"); 
		}
		if ($password_1 != $password_2) {
			array_push($errors, "The two passwords do not match");
		}

		// register user if there are no errors in the form
		if (count($errors) == 0) {
			$password = md5($password_1);//encrypt the password before saving in the database

			if (isset($_POST['email'])) {
				$user_type = e($_POST['user_type']);
				$query = "INSERT INTO users (name, username, city, mobile, email, user_type, password) 
						  VALUES('$name' ,'$username','$city' ,'$phone', '$email', 'user', '$password')";
				mysqli_query($db, $query);
				$logged_in_user_id = mysqli_insert_id($db);

				$_SESSION['user'] = getUserById($logged_in_user_id); 
				$_SESSION['success']  = "New user successfully created!!";
				header('location: login.php');
			}else{
				$query = "INSERT INTO users (name, username, city, mobile, email, user_type, password) 
						  VALUES('$name' ,'$username','$city' ,'$phone', '$email', 'user', '$password')";
				mysqli_query($db, $query);

				// get id of the created user
				$logged_in_user_id = mysqli_insert_id($db);

				$_SESSION['user'] = getUserById($logged_in_user_id); // put logged in user in session
				$_SESSION['success']  = "You are now logged in";
				header('location: index.php');				
			}

		}

	}

	// return user array from their id
	function getUserById($id){
		global $db;
		$query = "SELECT * FROM users WHERE id=" . $id;
		$result = mysqli_query($db, $query);
		$user = mysqli_fetch_assoc($result);

		return $user;
	}

	// LOGIN USER
	function login(){
		global $db, $username, $errors;

		// grap form values
		$username = e($_POST['username']);
		$password = e($_POST['password']);

		// make sure form is filled properly
		if (empty($username)) {
			array_push($errors, "Username is required");
		}
		if (empty($password)) {
			array_push($errors, "Password is required");
		}

		// attempt login if no errors on form
		if (count($errors) == 0) {
			$password = md5($password);

			$query = "SELECT * FROM users WHERE username='$username' AND password='$password' LIMIT 1";
			$results = mysqli_query($db, $query);

			if (mysqli_num_rows($results) == 1) { // user found
				// check if user is admin or user
				$logged_in_user = mysqli_fetch_assoc($results);
				$user_id = $logged_in_user['id'];
				$_SESSION['UserId'] = $user_id;

				if ($logged_in_user['user_type'] == 'admin') {

					$_SESSION['user'] = $logged_in_user;
					$_SESSION['success']  = "You are now logged in";
					header('location: admin/menus.php');		  
				}else{
					$_SESSION['user'] = $logged_in_user;
					$_SESSION['success']  = "You are now logged in";
					header('location: index.php');
				}
			}else {
				array_push($errors, "Wrong username/password combination");
			}
		}
	}

	function isLoggedIn()
	{
		if (isset($_SESSION['user'])) {
			return true;
		}else{
			return false;
		}
	}

	function isAdmin()
	{
		if (isset($_SESSION['user']) && $_SESSION['user']['user_type'] == 'admin' ) {
			return true;
		}else{
			return false;
		}
	}

	// escape string
	function e($val){
		global $db;
		return mysqli_real_escape_string($db, trim($val));
	}

	function display_error() {
		global $errors;

		if (count($errors) > 0){
			echo '<div class="error">';
				foreach ($errors as $error){
					echo $error .'<br>';
				}
			echo '</div>';
		}
	}

?>