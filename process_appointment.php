<?php
session_start();
include 'Appointment.php';
include 'connection.php';






if (isset($_POST['service'], $_POST['doctor'], $_POST['date'], $_POST['time'], $_POST['message'])) {
    if (isset($_SESSION['user_id'])) {
        $userId = $_SESSION['user_id']; // Dohvaća ID korisnika iz sesije
    } else {
        echo "Greška: ID korisnika nije pronađen u sesiji.";
        exit; // Prekida izvršavanje ako ID korisnika nije pronađen
    }
    $serviceId = $_POST['service'];
    $doctorId = $_POST['doctor'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $message = $_POST['message'];
    $status=1;
     // Pretpostavljamo da je lokacija uključena u POST podatke

    $appointment = new Appointment($con);
    $response = $appointment->bookAppointment($doctorId, $userId, $serviceId, $date, $time, $message, $status);

    echo $response;
} else {
    echo "Greška: Nedostaju podaci.";
}
?>
