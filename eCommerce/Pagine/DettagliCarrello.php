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

</head>

<body id="page-top" onload="changeVisable()">
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
            <div class="masthead-subheading">il tuo ordine</div>
            <div class="masthead-heading text-uppercase"></div>
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
                include("../Connessione/connection.php");

                if (isset($_GET['idcarello'])) {
                    $idcarello = $_GET['idcarello'];
                } else {
                    $idcarello = $_COOKIE["Anonymous"];
                }
               

                $stmt = $conn->prepare("SELECT * FROM contiene JOIN articolo ON contiene.IdArticolo=articolo.ID WHERE IdCarello = " . $idcarello . "");

                $stmt->execute();

                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    for ($i = 0; $i < $result->num_rows; $i++) {
                        if ($row = $result->fetch_assoc()) {
                            echo "<div class='col-lg-4 col-sm-6 mb-4'>";
                            echo "<div class='portfolio-item'>";
                            echo "<a class='portfolio-link' data-bs-toggle='modal' href='#portfolioModal1' onclick='setArticolo(" . $row['ID'] . ")'>";
                            echo "<div class='portfolio-hover'>";
                            echo "<div class='portfolio-hover-content'><i class='fas fa-plus fa-3x'></i></div>";
                            echo "</div>";
                            echo "<img class='img-fluid' src='../assets/img/articoli/" . $row['ImgArticolo'] . ".jpg' />";
                            echo "</a>";
                            echo "<div class='portfolio-caption'>";
                            echo "<div class='portfolio-caption-heading'>" . $row["Nome"] . "</div>";
                            echo "<div class='portfolio-caption-subheading text-muted'>" . $row["Preview"] . "</div>";
                            echo "<div class='portfolio-caption-subheading text-muted'>" . $row["QuantitaContiene"] . "</div>";
                            echo "<div class='portfolio-caption-subheading text-muted'>" . $row["Prezzo"] . "€</div>";
                            echo "<div class='portfolio-caption-subheading text-muted'>
                                    <a href=Controlli/ChkRimuovidaCarello.php?idarticolo=" . $row["ID"] . ">
                                    <button class='btn btn-primary'>Delete</button>
                                    </a>
                                    </div>";
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                        }
                    }
                    echo "<a class='btn btn-primary btn-xl text-uppercase' href='Controlli/ChkCompraCarello.php'>Buy Now</a>";
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