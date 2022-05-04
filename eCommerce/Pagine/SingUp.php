<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Registrati</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="../assets/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="../css/styles.css" rel="stylesheet" />
    <!-- Link necessari al date picker-->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <script>
        function formatData() {
            $data = document.getElementById("date").value;
            $mese = $data.substr(0, 2);
            $giorno = $data.substr(3, 2);
            $anno = $data.substr(6, 4);
            $formatdate = $anno + "-" + $mese + "-" + $giorno;
            document.getElementById("formatadata").value = $formatdate;
        }

        function validaProfilo() {
            if (document.getElementById("nome").value != "" || document.getElementById("cognome").value != "" ||
                document.getElementById("mail").value != "" || document.getElementById("numTel").value != "" ||
                document.getElementById("password").value == document.getElementById("nome").value) {

                document.getElementById("btnInvia").disabled = false;
            }

        }

        function disabledBtn() {
            document.getElementById("btnInvia").disabled = true;
        }
    </script>

</head>

<body id="page-top" onload="disabledBtn()">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand" href="#page-top"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars ms-1"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                    <li class="nav-item"><a class="nav-link" href="../Index.php">Home</a></li>
                    <?php
                    if (!isset($_SESSION['id'])) {
                        echo "<li class='nav-item'><a class='nav-link' href='Login.php'>LOG IN</a></li>";
                    } else {
                        echo "<li class='nav-item'><a class='nav-link' href='Logout.php'>LOG OUT</a></li>";
                        echo "<li class='nav-item'><a class='nav-link' href='Ordini.php'>Ordini</a></li>";
                        echo "<li class='nav-item'><a class='nav-link' href='AggiungiIndirizzo.php'>Aggiungi indirizzo</a></li>";
                    }
                    if (isset($_SESSION['admin'])) {
                        echo "<li class='nav-item'><a class='nav-link' href='AggiungiArticolo.php'>AGGIUNGI ARTICOLO</a></li>";
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Masthead-->
    <header class="masthead">
        <div class="container">
        </div>
    </header>
    <!-- Portfolio Grid-->
    <section class="page-section bg-light" id="portfolio">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">Registrati</h2>
            </div>
            <div class="row">
                <div class="text-center">
                    <form action="Controlli/chkSingUp.php" method="POST">
                        <!-- Nome -->
                        <p>Nome:</p>
                        <input type="text" name="nome" id="nome">
                        <!-- Cognome -->
                        <p>Cognome:</p>
                        <input type="text" name="cognome" id="cognome">
                        <!-- Data -->
                        <p>Data di nascita:</p>
                        <input type="text" name="date" id="date" value="" />
                        <script>
                            $(function() {
                                $('input[name="date"]').daterangepicker({
                                    singleDatePicker: true,
                                    showDropdowns: true,
                                    minYear: 1901,
                                    maxYear: parseInt(moment().format('YYYY'), 10)
                                });
                            });
                        </script>
                        <input type="hidden" name="formatdata" id="formatadata">
                        <!-- Mail -->
                        <p>Email:</p>
                        <input id="mail" type="email" name="email">
                        <!-- Tel -->
                        <p>Numero di telefono:</p>
                        <input id="numTel" type="text" name="numerotelefono">
                        <!-- Immagine -->
                        <p>Imaggine:</p>
                        <input class="btn btn" type="file" name="imgarticolo" placeholder="Carica Immagine"></a>
                        <!-- Pass -->
                        <p>Password:</p>
                        <input type="password" name="password" id="password">
                        <!-- Conferma Pass -->
                        <p>Conferma password:</p>
                        <input type="password" name="conferma" id="conferma" onchange="validaProfilo()">
                        <br><br>
                        <button id="btnInvia" class="btn btn-primary" onclick="formatData()">Invia</button>
                    </form>
                </div>
                <!-- Footer-->
                <footer class="footer py-4">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-lg-4 text-lg-start">Copyright &copy; Your Website 2022</div>
                            <div class="col-lg-4 my-3 my-lg-0">
                                <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                            </div>
                            <div class="col-lg-4 text-lg-end">
                                <a class="link-dark text-decoration-none me-3" href="#!">Privacy Policy</a>
                                <a class="link-dark text-decoration-none" href="#!">Terms of Use</a>
                            </div>
                        </div>
                    </div>
                </footer>

            </div>


            <!-- Bootstrap core JS-->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
            <!-- Core theme JS-->
            <script src="js/scripts.js"></script>
            <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
            <!-- * *                               SB Forms JS                               * *-->
            <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
            <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
            <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
</body>

</html>