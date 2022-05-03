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
    <title>Agency - Start Bootstrap Theme</title>
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
    </script>

</head>

<body id="page-top">
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
                        echo "<li class='nav-item'><a class='nav-link' href='RimuoviArticolo.php'>RIMUOVI ARTICOLO</a></li>";
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
            <div class="row align-items-center">
                <div class="text-center">
                    <form enctype="multipart/form-data" action="Controlli/chkAggiungiArticolo.php" method="POST">
                        <!-- Nome -->
                        <p>Nome:</p>
                        <input type="text" name="nome">
                        <!-- Preview -->
                        <p>Preview:</p>
                        <input type="text" name="preview">
                        <!-- Descrizione -->
                        <p>Descrizione:</p>
                        <input type="text" name="descrizione">
                        <!-- Quantita -->
                        <p>Quantita:</p>
                        <input type="number" name="quantita">
                        <!-- Prezzo -->
                        <p>Prezzo:</p>
                        <input type="number" name="prezzo">
                        <!-- Immagine -->
                        <p>Imaggine:</p>
                        <input class="btn btn" type="file" name="imgarticolo" placeholder="Carica Immagine"></a>
                        <!-- Venditore -->
                        <p>Venditore:</p>
                        <input type="text" name="venditore">
                        <br><br>
                        <!-- Categoria -->
                        <?php
                        include("../Connessione/connection.php");

                        $stmt = $conn->prepare("SELECT * FROM categoria WHERE 1");

                        $stmt->execute();
                        $result = $stmt->get_result();

                        echo "<select name='combocategoria' class='form-select' aria-label='Default select example'>";
                        echo "<option value=''></option>";
                        if ($result->num_rows > 0) {
                            for ($i = 1; $i < $result->num_rows + 1; $i++) {
                                if ($row = $result->fetch_assoc()) {
                                    echo "<option value='" . $row['ID'] . "'>" . $row['Nome'] . "</option>";
                                }
                            }
                        }
                        echo "</select>";
                        ?>
                        <br><br>
                        <button class="btn btn-primary">Invia</button>
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