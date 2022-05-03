<?php
session_start();

include("../../Connessione/connection.php");

$stmt = $conn->prepare("INSERT INTO indirizzo (`IdUtente`, `Stato`, `Regione`, `Provincia`, `Citta`, `Via`, `Civico`, `Cap`) VALUES (?,?,?,?,?,?,?,?)");
$stmt->bind_param("isssssii", $idutente, $stato, $regione, $provincia, $citta, $via, $civico, $cap);

$idutente = $_SESSION['id'];
$stato = $_POST['stato'];
$regione = $_POST['regione'];
$provincia = $_POST['provincia'];
$citta = $_POST['citta'];
$via = $_POST['via'];
$civico = $_POST["civico"];
$cap = $_POST['cap'];

$stmt->execute();

header("location:../../Index.php");

$stmt->close();
$conn->close();
