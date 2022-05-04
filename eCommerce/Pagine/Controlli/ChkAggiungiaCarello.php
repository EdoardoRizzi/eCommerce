<?php
session_start();
include("../../Connessione/connection.php");
include("../../Connessione/chkConnection.php");

//recupero i valori dal form
$IdArticolo = $_SESSION['idarticolo'];
$quantita = $_POST["comboQuantita"];

//inserisco l'articolo nel carello
$stmt = $conn->prepare("INSERT INTO contiene (IdCarello, IdArticolo, QuantitaContiene) VALUES (?,?,?)");
$stmt->bind_param("iii", $_COOKIE["Anonymous"], $IdArticolo, $quantita);


$stmt->execute();

//MODIFICO LA QUANTITA NEL MAGAZZINO

//recupero la quantita originaria
$stmt = $conn->prepare("SELECT Quantita FROM articolo WHERE ID = " .  $IdArticolo . "");
$stmt->execute();
$result = $stmt->get_result();


if ($result->num_rows > 0) {
    if ($row = $result->fetch_assoc()) {
        $quantitamagazzino = $row['Quantita'];
    }
}

//sottraggo la quantita appena presa da quella in magazzino
$quantita = $quantitamagazzino - $quantita;
//aggiorno il db
$stmt = $conn->prepare("UPDATE articolo SET Quantita = " . $quantita . " WHERE ID = " . $IdArticolo . "");
$stmt->execute();

header("location:../../Index.php");
