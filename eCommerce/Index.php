<?php
session_start();
include("Connessione/DefaultSetCookies.php")
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>al bazar</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
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
                        echo "<li class='nav-item'><a class='nav-link' href='Pagine/Login.php'>LOG IN</a></li>";
                    } else {
                        echo "<li class='nav-item'><a class='nav-link' href='Pagine/Logout.php'>LOG OUT</a></li>";
                        echo "<li class='nav-item'><a class='nav-link' href='Pagine/Ordini.php'>Ordini</a></li>";
                        echo "<li class='nav-item'><a class='nav-link' href='Pagine/AggiungiIndirizzo.php'>Aggiungi indirizzo</a></li>";
                    }
                    if (isset($_SESSION['admin'])) {
                        echo "<li class='nav-item'><a class='nav-link' href='Pagine/AggiungiArticolo.php'>AGGIUNGI ARTICOLO</a></li>";
                    }
                    ?>

                </ul>
            </div>
        </div>
    </nav>
    <!-- Masthead-->
    <header class="masthead">
        <div class="container">
            <div class="masthead-subheading">Welcome To Our Store!</div>
            <div class="masthead-heading text-uppercase">It's Nice To Meet You</div>
            <a class="btn btn-primary btn-xl text-uppercase" href="Pagine/DettagliCarrello.php">See your cart</a>
            <br><br>

        </div>
    </header>
    <!-- Portfolio Grid-->
    <section class="page-section bg-light" id="portfolio">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">Articoli</h2>
                <h3 class="section-subheading text-muted"></h3>
            </div>
            <div class="row">
                <?php
                include("Connessione/connection.php");
                echo "<div class='col-md-12'>";
                echo "<div class='col-md-6'>";
                   //FILTRI
                   $stmt = $conn->prepare("SELECT * FROM categoria WHERE 1");

                   $stmt->execute();
                   $result = $stmt->get_result();
   
                   echo "<form method='GET'>";
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
                   echo "<button class='btn btn-primary'>filtra</button>";
                   echo "</form>";
                echo "</div>";
                echo "<div class='col-md-6'>";
                    //PRODOTTI
                    echo "<form method='GET'>";
                    echo "<input type='text' name='txtFiltro' class='form-select' aria-label='Default select example'>";
                    echo "<button class='btn btn-primary'>filtra</button>";
                    echo "</form>";   
                echo "</div>";
                echo "</div>";
             
               
                if (isset($_GET['combocategoria']) && $_GET['combocategoria'] != '') {
                    $stmt = $conn->prepare("SELECT * FROM articolo WHERE Quantita > '0' AND IdCategoria = " . $_GET['combocategoria'] . "");
                } else if(isset($_GET['txtFiltro']) && $_GET['txtFiltro'] != ''){
                    $stmt = $conn->prepare("SELECT * FROM articolo WHERE Quantita > '0' AND Nome LIKE '%" . $_GET['txtFiltro'] . "%'");
                } else {
                    $stmt = $conn->prepare("SELECT * FROM articolo WHERE Quantita > '0'");
                }


                $stmt->execute();
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {

                    for ($i = 0; $i < $result->num_rows; $i++) {

                        if ($row = $result->fetch_assoc()) {
                            echo "<div class='col-lg-4 col-sm-6 mb-4'>";
                            echo "<div class='portfolio-item'>";
                            echo "<div class='portfolio-hover'>";
                            echo "<input type='hidden' name='Nome' value='" . $row['Nome'] . "'>";
                            echo "</div>";
                            echo "<img class='img-fluid' src='assets/img/articoli/" . $row['ImgArticolo'] . ".jpg' />";
                            echo "</a>";
                            echo "<div class='portfolio-caption'>";
                            echo "<div class='portfolio-caption-heading'>" . $row["Nome"] . "</div>";
                            echo "<div class='portfolio-caption-subheading text-muted'>" . $row["Preview"] . "</div>";
                            echo "<div class='portfolio-caption-subheading text-muted'>";

                            if (isset($_SESSION['admin'])) {
                                echo "<a href=Pagine/RimuoviArticolo.php?Articolo=" . $row["Nome"] . ">
                                    <button class='btn btn-primary'>Remove</button>
                                    </a>";
                                echo "<a href=Pagine/ModificaQuantita.php?Articolo=" . $row["Nome"] . ">
                                    <button class='btn btn-primary'>Update</button>
                                    </a>";
                            } else {
                                echo "<a href=Pagine/DettaglioArticolo.php?Articolo=" . $row["Nome"] . ">
                                    <button class='btn btn-primary'>Add</button>
                                    </a>";
                            }
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                        }
                    }
                }

                // visualizzo gli articoli eliminati
                if (isset($_SESSION['admin'])) {
                    echo "<div class='text-center'>";
                    echo "<h2 class='section-heading text-uppercase'>ARTICOLI</h2>";
                    echo "<h3 class='section-subheading text-muted'>non in vendita</h3>";
                    echo "</div>";

                    $stmt = $conn->prepare("SELECT * FROM articolo WHERE Quantita = 0");

                    $stmt->execute();
                    $result = $stmt->get_result();
                    if ($result->num_rows > 0) {

                        for ($i = 0; $i < $result->num_rows; $i++) {

                            if ($row = $result->fetch_assoc()) {
                                echo "<div class='col-lg-4 col-sm-6 mb-4'>";
                                echo "<div class='portfolio-item'>";
                                echo "<div class='portfolio-hover'>";
                                echo "<input type='hidden' name='Nome' value='" . $row['Nome'] . "'>";
                                echo "</div>";
                                echo "<img class='img-fluid' src='assets/img/articoli/" . $row['ImgArticolo'] . ".jpg' />";
                                echo "</a>";
                                echo "<div class='portfolio-caption'>";
                                echo "<div class='portfolio-caption-heading'>" . $row["Nome"] . "</div>";
                                echo "<div class='portfolio-caption-subheading text-muted'>" . $row["Preview"] . "</div>";
                                echo "<div class='portfolio-caption-subheading text-muted'>";
                                echo "<a href=Pagine/ModificaQuantita.php?Articolo=" . $row["Nome"] . ">
                                        <button class='btn btn-primary'>Add</button>
                                        </a>";
                                echo "</div>";
                                echo "</div>";
                                echo "</div>";
                                echo "</div>";
                            }
                        }
                    }
                }

                ?>
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