<?php 
session_start();

include("connection.php");
include("functions.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Prikupljanje podataka iz forme
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];
    $ime=$_POST['ime'];
    $prezime=$_POST['prezime'];
    $uloga='pacijent';
    $telefon=$_POST['telefon'];

    if (!empty($user_name) && !empty($password) && !is_numeric($user_name)) {
        // Spremanje u tabelu `Osobe`
        $query_osobe = "INSERT INTO osobe (Email, Password, ime, Prezime, Uloga) VALUES ('$user_name', '$password', '$ime', '$prezime', '$uloga')";

        if (mysqli_query($con, $query_osobe)) {
            // Dobivanje ID-a novounesenog korisnika
            $osoba_id = mysqli_insert_id($con);

            // Spremanje u tabelu `Pacijenti`
            $query_pacijenti = "INSERT INTO pacijent (id, telefon, med_karton) VALUES ('$osoba_id', '$telefon', 'none')";

            if (mysqli_query($con, $query_pacijenti)) {
                // Uspješno spremljeno u obje tabele, preusmjeravanje na login stranicu
                header("Location: login.php");
                die;
            } else {
                // Greška pri unosu u tabelu `Pacijenti`
                echo "Došlo je do greške pri spremanju pacijenta: " . mysqli_error($con);
            }
        } else {
            // Greška pri unosu u tabelu `Osobe`
            echo "Došlo je do greške pri spremanju korisnika: " . mysqli_error($con);
        }
    } else {
        echo "Molimo unesite valjane podatke!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Register</title>
    <link rel="icon" href="img/favicon.png">
</head>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box" style="background: #1b1b42;">
            <a href="login.php">
                <div class="featured-image mb-3">
                    <img src="img\logo-bg.png" class="img-fluid" style="width: 250px;">
                </div>
            </a>
        </div>
        <div class="col-md-6 right-box">
            <div class="row align-items-center">
                <div class="header-text mb-4">
                    <h2>Registracija na servis</h2>
                </div>
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    
                    <div class="input-group mb-3">
                        <input type="text" class="form-control form-control-lg bg-light fs-6" placeholder="Ime" name="ime" required>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control form-control-lg bg-light fs-6" placeholder="Prezime" name="prezime"  required>
                    </div>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control form-control-lg bg-light fs-6" placeholder="Email" name="user_name"  required>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control form-control-lg bg-light fs-6" placeholder="Password" name="password" required>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control form-control-lg bg-light fs-6" placeholder="Telefon" name="telefon" required>
                    </div>
                    <div class="input-group mb-3 d-flex justify-content-between">
                        <div class="input-group mb-1">
                            <button class="btn btn-lg btn-primary w-100 fs-6" type="submit">Register</button>
                        </div>
                        <div class="row">
                            <small>Already a member? <a href="login.php">Sign In</a></small>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
