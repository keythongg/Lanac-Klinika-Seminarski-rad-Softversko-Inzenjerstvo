<?php 
session_start();

include '../connection.php';
include '../functions.php';
    

	$user_data = check_login($con);

	
function prikaziDashboardLink($user) {
    // Provjeri da li je uloga korisnika "admin" ili "doktor"
    if ($user['Uloga'] === 'admin' || $user['Uloga'] === 'doktor') {
        // Ako jeste, prikaži link ka dashboardu
        echo '<a href="dashboard/dashboard.php">Dashboard</a>'
        ;
    } 
}







?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="stil-landing.css">
    <link rel="stylesheet" href="navstyle.css">
    <link rel="stylesheet" href="icofont.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Klinika Bosna - Dobrodošli!</title>
    <link rel="icon" href="img/favicon.png">
    <style>
        .hover-effect:hover {
        background-color: #79bbed; /* Promjena pozadinske boje na plavu */
        color: white; /* Promjena boje teksta na bijelu */
    }

        .notification-dot {
            height: 12px;
            width: 12px;
            background-color: #E3170A;
            border-radius: 50%;
            display: inline-block;
            margin-left: 5px;
            position: relative;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
                opacity: 1;
            }

            50% {
                transform: scale(1.5);
                opacity: 0.5;
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }
    </style>
</head>

<body>

    <!-- Header Area -->
    <header class="header">
        <!-- Topbar -->
        <div class="topbar">
            <div class="container-lg">
                <div class="row">
                    <div class="col-lg-6 col-md-5 col-12">
                        <!-- Contact -->
                        <ul class="top-link">
                            <li><a href="#">O nama</a></li>
                            <li><a href="#">Doktori</a></li>
                            <li><a href="#">Kontakt</a></li>
                            <li><a href="#">FAQ</a></li>
                        </ul>
                        <!-- End Contact -->
                    </div>
                    <div class="col-lg-6 col-md-7 col-12">
                        <!-- Top Contact -->
                        <ul class="top-contact">
                            <li><i class="bi bi-telephone-fill"></i>+387 60 301 2288</li>
                            <li><i class="bi bi-envelope-fill"></i><a href="mailto:klinikabosna@gmail.com">štatrebaš@klinikabosna.ba</a></li>
                        </ul>
                        <!-- End Top Contact -->
                    </div>
                    <!-- Welcome message -->
                    <div class="welcome-message text-center">
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <?php echo "Dobrodošli, ", $user_data['ime'] ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Welcome message -->
                </div>
            </div>
        </div>
        <!-- End Topbar -->

        <!-- Header Inner -->
        <div class="header-inner">
            <div class="container-lg">
                <div class="inner">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-12">
                            <!-- Start Logo -->
                            <div class="logo">
                                <a href="landing.php"><img src="img\logo-transparent.png" alt="#"></a>
                            </div>
                            <!-- End Logo -->
                            <!-- Mobile Nav -->
                            <div class="mobile-nav"></div>
                            <!-- End Mobile Nav -->
                        </div>
                        <div class="col-lg-7 col-md-9 col-12">
                            <!-- Main Menu -->
                            <div class="main-menu">
                                <nav class="navigation">
                                    <ul class="nav menu">
                                        <li ><a href="#">Početna</a></li>
                                        <li><a href="obavijesti.php">Obavijesti</a></li>
                                        <li><a href="#">Doktori</a></li>
                                        <li><a href="#">Kontakt</a></li>
                                        <li><a>Korisnik</a>
                                            <ul class="dropdown">
                                                <?php if (!isset($_SESSION['id'])) { ?>
                                                    <li><a href="login.php">Prijava</a></li>
                                                    <li><a href="signup.php">Registracija</a></li>
                                                <?php } ?>
                                                <li><a href="profil.php">Profil</a></li>
                                                <li><a href="logout.php">Odjavi se</a></li>
                                            </ul>
                                        <li class="active">
                                        <?php prikaziDashboardLink($user_data); ?></li>
                                    </ul>
                                </nav>
                            </div>
                            <!--/ End Main Menu -->
                        </div>
                       
                    </div>
                </div>
            </div>
        </div>
        <!--/ End Header Inner -->
    </header>
    <!-- End Header Area -->


    <body>
        <div class="container-fluid mt-5 mx-0 px-5">
            <div class="row d-flex">
                <div class="col-2 bg-light px-0 d-flex flex-column align-items-center">
                    <div class="list-group w-100 text-center border-0">
                    <a href="#" class="list-group-item   border-0 hover-effect" id="users">Korisnici</a>    
                    <a href="#" class="list-group-item   border-0 hover-effect" id="doctors">Doktori</a>
                        <a href="#" class="list-group-item   border-0 hover-effect" id="patients">Pacijenti</a>
                        <a href="#" class="list-group-item   border-0 hover-effect" id="appointments">Termini</a>
                        <a href="#" class="list-group-item   border-0 hover-effect" id="services">Tretmani</a>
                    </div>
                </div>
                <div class="col-10 bg-secondary px-3 pt-3 d-flex flex-column align-items-center">
                    <div class="naslov" id="naslov">Main</div>
                    <div class="main" id="sadrzaj"></div>
                </div>
            </div>
        </div>
      <!-- Button trigger modal -->









        <script>
document.getElementById('users').addEventListener('click', function() {
    // Postavljanje naslova
    document.getElementById('naslov').innerHTML = '<h2>Lista korisnika</h2>';

    // Dohvaćanje podataka o korisnicima sa servera
    fetch('dohvatiKorisnike.php')
        .then(response => response.text())
        .then(text => {
              // Ispiši sirovi odgovor u konzolu
            let data = JSON.parse(text);

            // Kreiranje tabele
            let table = document.createElement('table');
            table.classList.add('table', 'table-striped', 'table-hover', 'mt-3'); // Dodavanje Bootstrap klasa za stilizaciju

            // Kreiranje zaglavlja tabele
            let thead = document.createElement('thead');
            let headerRow = document.createElement('tr');
            let headers = ['Ime', 'Prezime', 'Email', 'Uloga', 'Akcije'];
            headers.forEach(header => {
                let th = document.createElement('th');
                th.textContent = header;
                headerRow.appendChild(th);
            });
            thead.appendChild(headerRow);
            table.appendChild(thead);

            // Kreiranje tijela tabele
            let tbody = document.createElement('tbody');
            data.forEach(user => {
                let row = document.createElement('tr');
                row.innerHTML = `
                    <td>${user.Ime}</td>
                    <td>${user.Prezime}</td>
                    <td>${user.Email}</td>
                    <td>${user.Uloga}</td>
                    <td>
                        <button class="btn btn-danger btn-sm delete-btn" data-id="${user.ID}">Izbriši</button>
                    </td>
                `;
                tbody.appendChild(row);
            });
            table.appendChild(tbody);

            // Dodavanje tabele u sadrzaj div
            document.getElementById('sadrzaj').innerHTML = ''; // Čišćenje prethodnog sadržaja
            document.getElementById('sadrzaj').appendChild(table);

            // Dodavanje event listenera za dugmad "Ažuriraj" i "Izbriši"
          

            document.querySelectorAll('.delete-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const userId = this.getAttribute('data-id');
                    console.log("ID:", userId);
                    
                    if (confirm('Da li ste sigurni da želite izbrisati ovog korisnika?')) {
                        // Slanje zahtjeva za brisanje na deleteUser.php
                        fetch('deleteUser.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({ id: userId })
                        })
                        .then(response => response.text())
                        .then(text => {
                            console.log('Odgovor servera:', text); // Ispiši sirovi odgovor u konzolu
                            let data = JSON.parse(text);
                            if (data.success) {
                                alert('Korisnik je uspješno izbrisan.');
                                // Osvježite listu korisnika nakon brisanja
                                document.getElementById('users').click();
                            } else {
                                alert('Greška pri brisanju korisnika.');
                            }
                        })
                        .catch(error => {
                            console.error('Greška pri slanju zahtjeva za brisanje:', error);
                            alert('Greška pri slanju zahtjeva.');
                        });
                    }
                });
            });

        })
        .catch(error => console.error('Greška pri dohvaćanju korisnika:', error));
});





document.getElementById('doctors').addEventListener('click', function() {
    fetch('dohvatiDoktoreDashboard.php')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            const naslov = document.getElementById('naslov');
            const sadrzaj = document.getElementById('sadrzaj');
            
            naslov.textContent = "Lista Doktora";
            
            const table = document.createElement('table');
            table.classList.add('table', 'table-striped');
            
            // Kreiranje header reda
            const thead = document.createElement('thead');
            const headerRow = document.createElement('tr');
            
            const headers = ['Ime', 'Prezime', 'Email', 'Odjel', 'Grad', 'Akcije'];
            headers.forEach(headerText => {
                const th = document.createElement('th');
                th.textContent = headerText;
                headerRow.appendChild(th);
            });
            thead.appendChild(headerRow);
            table.appendChild(thead);
            
            // Kreiranje body reda
            const tbody = document.createElement('tbody');
            data.forEach(doctor => {
    console.log('Doctor:', doctor); // Provjerite vrijednosti
    const row = document.createElement('tr');
    
    Object.values(doctor).slice(0, 5).forEach(text => {
        const td = document.createElement('td');
        td.textContent = text;
        row.appendChild(td);
    });
                
                // Dodavanje dugmeta za ažuriranje
                const updateButton = document.createElement('button');
updateButton.textContent = 'Ažuriraj';
updateButton.classList.add('btn', 'btn-warning', 'btn-sm');
updateButton.setAttribute('data-id', doctor.ID);
updateButton.addEventListener('click', function() {
    const doctorId = this.getAttribute('data-id');
    console.log('Doctor ID:', doctorId); // Treba ispravno prikazivati ID
    if (doctorId) {
        window.open(`updateDoctor.php?id=${doctorId}`, '_blank', 'width=600,height=400');
    } else {
        console.error('No doctor ID found');
    }
});
                
                
                const actionTd = document.createElement('td');
                actionTd.appendChild(updateButton);
                row.appendChild(actionTd);
                
                tbody.appendChild(row);
            });
            table.appendChild(tbody);
            
            // Dodavanje tabele u sadrzaj div
            sadrzaj.innerHTML = ''; // Čisti prethodni sadržaj
            sadrzaj.appendChild(table);
        })
        .catch(error => {
            console.error('Greška pri dohvaćanju doktora:', error);
        });
});






document.getElementById('patients').addEventListener('click', function() {
    // Postavljanje naslova
    document.getElementById('naslov').innerHTML = '<h2>Pacijenti</h2>';

    // Dohvaćanje podataka iz dohvatiPacijenteDashboard.php
    fetch('dohvatiPacijenteDashboard.php')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            const content = document.getElementById('sadrzaj');
            content.innerHTML = ''; // Očisti prethodni sadržaj

            // Generisanje tabele
            const table = document.createElement('table');
            table.classList.add('table', 'table-bordered');

            // Generisanje zaglavlja tabele
            const thead = document.createElement('thead');
            thead.innerHTML = `
                <tr>
                    <th>Ime</th>
                    <th>Prezime</th>
                    <th>Email</th>
                    <th>Telefon</th>
                    <th>Med Karton</th>
                    <th>Akcije</th>
                </tr>
            `;
            table.appendChild(thead);

            // Generisanje tijela tabele
            const tbody = document.createElement('tbody');
            data.forEach(pacijent => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td>${pacijent.Ime}</td>
                    <td>${pacijent.Prezime}</td>
                    <td>${pacijent.Email}</td>
                    <td>${pacijent.Telefon}</td>
                    <td>${pacijent.MedKarton}</td>
                    <td>
                        <button class="btn btn-warning btn-sm" data-id="${pacijent.ID}" onclick="openUpdatePatient(${pacijent.ID})">Ažuriraj</button>
                    </td>
                `;
                tbody.appendChild(tr);
            });
            table.appendChild(tbody);

            // Dodavanje tabele u sadržaj
            content.appendChild(table);
        })
        .catch(error => {
            console.error('Greška pri dohvaćanju pacijenata:', error);
            document.getElementById('sadrzaj').innerHTML = '<p>Greška pri dohvaćanju podataka.</p>';
        });
});

function openUpdatePatient(patientId) {
    window.open(`updatePatient.php?id=${patientId}`, '_blank', 'width=600,height=400');
}





document.getElementById('appointments').addEventListener('click', function() {
    // Postavljanje naslova
    document.getElementById('naslov').innerHTML = '<h2>Termini</h2>';

    // Dohvaćanje podataka iz dohvatiTermine.php
    fetch('dohvatiTermine.php')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            console.log(data);
            const content = document.getElementById('sadrzaj');
            content.innerHTML = ''; // Očisti prethodni sadržaj

            // Generisanje tabele
            const table = document.createElement('table');
            table.classList.add('table', 'table-bordered');

            // Generisanje zaglavlja tabele
            const thead = document.createElement('thead');
            thead.innerHTML = `
                <tr>
                    <th>ID</th>
                    <th>Pacijent</th>
                    <th>Doktor</th>
                    <th>ID Tretmana</th>
                    <th>Datum</th>
                    <th>Napomena</th>
                    <th>Vrijeme</th>
                    <th>Status</th>
                    <th>Akcije</th>
                </tr>
            `;
            table.appendChild(thead);

            // Generisanje tijela tabele
            const tbody = document.createElement('tbody');
            data.forEach(termin => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td>${termin.id}</td>
                    <td>${termin.pacijent_ime} </td>
                    <td>${termin.doktor_ime} </td>
                    <td>${termin.tretman_id}</td>
                    <td>${termin.datum}</td>
                    <td>${termin.napomena}</td>
                    <td>${termin.vrijeme}</td>
                    <td>${termin.status}</td>
                    <td><button class="btn btn-primary btn-sm" onclick="changeStatus(${termin.id})">Promijeni status</button></td>
                `;
                tbody.appendChild(tr);
            });
            table.appendChild(tbody);

            // Dodavanje tabele u sadržaj
            content.appendChild(table);
        })
        .catch(error => {
            console.error('Greška pri dohvaćanju termina:', error);
            document.getElementById('sadrzaj').innerHTML = '<p>Greška pri dohvaćanju podataka.</p>';
        });
});

// Funkcija za promjenu statusa
function changeStatus(terminId) {
    const newStatus = prompt('Unesite novi status (1: Pending, 2: Confirmed, 3: Completed, 4: Cancelled):');
    
    if (newStatus !== null && (newStatus === '1' || newStatus === '2' || newStatus === '3' || newStatus === '4')) {
        // Ovdje možete dodati logiku za slanje novog statusa na server putem fetch ili AJAX zahtjeva
        fetch('updateStatus.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ id: terminId, status: newStatus }),
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Status uspješno promijenjen.');
                // Osvježite tabelu nakon promjene statusa
                document.getElementById('appointments').click();
            } else {
                alert('Greška pri promjeni statusa.');
            }
        })
        .catch(error => {
            console.error('Greška pri slanju zahtjeva:', error);
            alert('Greška pri slanju zahtjeva.');
        });
    } else {
        alert('Neispravan unos. Molimo unesite broj od 1 do 4.');
    }
}






document.getElementById('services').addEventListener('click', function() {
    // Postavljanje naslova
    document.getElementById('naslov').innerHTML = '<h2>Tretmani</h2>';

    // Dohvaćanje podataka iz dohvatiTermine.php
    fetch('dohvatiTretmane.php')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            console.log(data);
            const content = document.getElementById('sadrzaj');
            content.innerHTML = ''; // Očisti prethodni sadržaj

            // Generisanje tabele
            const table = document.createElement('table');
            table.classList.add('table', 'table-bordered');

            // Generisanje zaglavlja tabele
            const thead = document.createElement('thead');
            thead.innerHTML = `
                <tr>
                    <th>ID</th>
                    <th>Naziv</th>
                    <th>Cijena</th>
                    <th>Grad</th>
                    <th>Odjel</th>
                </tr>
            `;
            table.appendChild(thead);

            // Generisanje tijela tabele
            const tbody = document.createElement('tbody');
            data.forEach(tretman => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td>${tretman.id}</td>
                    <td>${tretman.naziv} </td>
                    <td>${tretman.cijena} </td>
                    <td>${tretman.grad}</td>
                    <td>${tretman.odjel}</td>
                `;
                tbody.appendChild(tr);
            });
            table.appendChild(tbody);

            // Dodavanje tabele u sadržaj
            content.appendChild(table);
        })
        .catch(error => {
            console.error('Greška pri dohvaćanju tretmana:', error);
            document.getElementById('sadrzaj').innerHTML = '<p>Greška pri dohvaćanju podataka.</p>';
        });
});



        </script>
    </body>