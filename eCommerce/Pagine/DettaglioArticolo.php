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
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="../css/styles.css" rel="stylesheet" />

    <script>
        function setArticolo(Nome) {
            if (document.getElementById("IDARTICOLOSELEZIONATO").value != Nome) {

                document.getElementById("IDARTICOLOSELEZIONATO").value = Nome;
                window.location.assign("index.php?Nome=" + Nome);
            }
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
                    }
                    ?>
                    <li class="nav-item"><a class="nav-link" href="#contact">Comment</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Masthead-->
    <header class="masthead">
        <div class="container">
            <div class="masthead-subheading">Welcome To Our Store!</div>
            <div class="masthead-heading text-uppercase">It's Nice To Meet You</div>
            <a class="btn btn-primary btn-xl text-uppercase" href="DettagliCarrello.php">See your cart</a>
        </div>
    </header>
    <!-- Portfolio Grid-->
    <section class="page-section bg-light" id="portfolio">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">Articolo</h2>
                <h3 class="section-subheading text-muted"></h3>
            </div>
            <div class="row">
                <?php

                include("../Connessione/connection.php");

                $sql = "SELECT * FROM articolo WHERE Nome = '" . $_GET["Articolo"] . "'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    if ($row = $result->fetch_assoc()) {
                        $_SESSION['idarticolo'] = $row['ID'];
                        echo "<div class='container'>";
                        echo "<div class='row'>";
                        //colonna 1
                        echo "<div class='col-6'>";
                        echo "<img class='img-fluid' src='../assets/img/articoli/" . $row['ImgArticolo'] . ".jpg' />";
                        echo "</div>";
                        //colonna 2
                        echo "<div class='col-6'>";
                        //riga del nome
                        echo "<div class = 'row'>";
                        echo "<div class='col-2'>";
                        echo "<p> Nome:</p>";
                        echo "</div>";
                        echo "<div class='col-5'>";
                        echo "<p>"  .  $row["Nome"] . "</p>";
                        echo "</div>";
                        echo "</div>";
                        //riga della descrizione
                        echo "<div class = 'row'>";
                        echo "<div class='col-2'>";
                        echo "<p> Descrizione:</p>";
                        echo "</div>";
                        echo "<div class='col-5'>";
                        echo "<p>"  .  $row["Descrizione"] . "</p>";
                        echo "</div>";
                        echo "</div>";
                        //riga del prezzo
                        echo "<div class = 'row'>";
                        echo "<div class='col-2'>";
                        echo "<p> Prezzo:</p>";
                        echo "</div>";
                        echo "<div class='col-5'>";
                        echo "<p>"  .  $row["Prezzo"] . "</p>";
                        echo "</div>";
                        echo "</div>";
                        //riga del venditore
                        echo "<div class = 'row'>";
                        echo "<div class='col-2'>";
                        echo "<p> Venditore:</p>";
                        echo "</div>";
                        echo "<div class='col-5'>";
                        echo "<p>"  .  $row["Venditore"] . "</p>";
                        echo "</div>";
                        echo "</div>";
                        //riga della quantita
                        echo "<div class = 'row'>";
                        echo "<div class='col-2'>";
                        echo "<p>" . "Quantità: " . "</p>";
                        echo "</div>";
                        $stmt = $conn->prepare("SELECT Quantita FROM Articolo WHERE Nome = '" . $_GET["Articolo"] . "'");

                        $stmt->execute();
                        $result = $stmt->get_result();

                        echo "<form action='Controlli/ChkAggiungiaCarello.php' method = 'POST'>";
                        echo "<div class='col-3'>";
                        echo "<select name='comboQuantita' class='form-select' aria-label='Default select example'>";
                        if ($result->num_rows > 0) {
                            if ($row = $result->fetch_assoc()) {
                                for ($i = 1; $i < $row['Quantita'] + 1; $i++) {
                                    echo "<option value='" . $i . "'>" . $i . "</option>";
                                }
                            }
                        }
                        echo "</select>";
                        echo "</div>";
                        echo "</div>";
                        echo "<div><button class='btn btn-primary'>Aggiungi</button></div>";
                        echo "</form>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                    }
                }
                ?>

                <!-- Leggi Commenti -->
                <section class="page-section" id="comment">
                    <div class="container">
                        <div class="text-center">
                            <h2 class="section-heading text-uppercase">Comment</h2>
                            <h3 class="section-subheading text-muted"></h3>
                        </div>
                        <?php

                        include("../Connessione/connection.php");

                        $sql = "SELECT * FROM commento JOIN utente ON IdUtente = utente.ID WHERE IdArticolo = " . $_SESSION['idarticolo'] . "";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            echo "<table class='table'>";
                            echo "<thead>";
                            echo "<tr>";
                            echo "<th scope='col'>Nome</th>";
                            echo "<th scope='col'>Testo</th>";
                            echo "<th scope='col'>Data</th>";
                            echo "</tr>";
                            echo "</thead>";

                            for ($i = 0; $i < $result->num_rows; $i++) {
                                if ($row = $result->fetch_assoc()) {
                                    echo "<tbody>";
                                    echo "<tr>";
                                    echo "<td>" . $row['Nome'] . "</td>";
                                    echo "<td>" . $row['Testo'] . "</td>";
                                    echo "<td>" . $row['DataScrittura'] . "</td>";
                                    echo "</tr>";
                                    echo "</tbody>";
                                }
                            }

                            echo "</table>";
                        }
                        ?>
                    </div>
                </section>
                <!-- Scrivi Commenti -->
                <section class="page-section" id="contact">
                    <div class="container">
                        <?php
                        if (isset($_SESSION['id'])) {
                            echo "<div class='text-center'>";
                            echo "<h2 class='section-heading text-uppercase'>Lascia il tuo commento</h2>";
                            echo " <h3 class='section-subheading text-muted'></h3>";
                            echo " </div>";
                            echo "<form id='contactForm' action='Controlli/ChkInviaCommento.php' method='post'>";
                            echo "<div class='row align-items-stretch mb-5'>";
                            echo "<div class='col-md-6'>";
                            echo "<div class='form-group form-group-textarea mb-md-0'>";
                            //Message input
                            echo "<textarea class='form-control' name='testo' id='message' placeholder='Your Message *' data-sb-validations='required'></textarea>";
                            echo "<div class='invalid-feedback' data-sb-feedback='message:required'>A message is required.</div>";
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                            //Submit Button
                            echo " <div class='text-center'><button class='btn btn-primary btn-xl text-uppercase' id='submitButton' type='submit'>Send Message</button></div>";
                            echo "</form>";
                        } else {
                            echo "<div class='text-center'>";
                            echo "<h2 class='section-heading text-uppercase'>Lascia il tuo commento</h2>";
                            echo "<h3 class='section-subheading text-muted'>Accedi o registrati per poter scrivere il tuo commento</h3>";
                            echo "</div>";
                        }
                        ?>
                    </div>
                </section>
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