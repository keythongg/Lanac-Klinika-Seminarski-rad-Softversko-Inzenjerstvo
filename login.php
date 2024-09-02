<?php 

session_start();

	include("connection.php");
	include("functions.php");


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$user_name = $_POST['user_name'];
		$password = $_POST['password'];

		if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
		{

			//read from database
			$query = "select * from Osobe where Email = '$user_name' limit 1";
			$result = mysqli_query($con, $query);

			if($result)
			{
				if($result && mysqli_num_rows($result) > 0)
				{

					$user_data = mysqli_fetch_assoc($result);
					
					if($user_data['Password'] === $password)
					{

						$_SESSION['user_id'] = $user_data['ID_Korisnika'];
                        $_SESSION['ime'] = $user_data['ime'];
                        $_SESSION['prezime'] = $user_data['Prezime'];
						header("Location: index.php");
						die;
					}
				}
			}
			
			echo "wrong username or password!";
		}else
		{
			echo "wrong username or password!";
		}
	}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Login forma</title>
    <link rel="icon" href="img/favicon.png">
</head>
<body>

    <!-- Main Container -->
    <div class="container d-flex justify-content-center align-items-center min-vh-100">

        <!-- Login Container -->
        <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box" style="background: #1b1b42;">
            <a href="landing.php">
                <div class="featured-image mb-3">
                    <img src="img\logo-bg.png" class="img-fluid" style="width: 250px;">
                </div>
            </a>
        </div>

        <!-- Right Box -->
        <div class="col-md-6 right-box">
            <div class="row align-items-center">
                <div class="header-text mb-4">
                    <h2>Prijava na servis</h2>
                </div>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control form-control-lg bg-light fs-6" placeholder="Email adresa" name="user_name">
                    </div>
                    <div class="input-group mb-1">
                        <input type="password" class="form-control form-control-lg bg-light fs-6" placeholder="Lozinka" name="password">
                    </div>
                    <div class="input-group mb-3 d-flex justify-content-between">
                         <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="rememberMe" name="rememberMe">
                            <label for="rememberMe" class="form-check-label text-secondary"><small>Zapamti me</small></label>
                        </div>
                        <div class="forgot">
                             <small><a href="password-recovery.php">Zaboravili ste lozinku?</a></small>
                        </div>
                    </div>
                    <div class="input-group mb-1">
                        <button class="btn btn-lg btn-primary w-100 fs-6">Prijavi se</button>
                    </div>
                </form>
                <div class="row">
                    <small>Nemate račun? <a href="signup.php">Registrirajte se</a></small>
                </div>
            </div>
        </div> 

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-tuZV3ta2uuP5H6k9SRmK+95CzKqL1W7/CGpv+aCrt2GhcYb+l0lWywpZ+9v+dAIf" crossorigin="anonymous"></script>

</body>
</html>
