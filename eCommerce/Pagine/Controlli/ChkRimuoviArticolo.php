<?php
session_start();
include("../../Connessione/connection.php");
include("../../Connessione/chkConnection.php");

//recupero i valori dal form
$Nome = $_POST['articolo'];

//MODIFICO LA QUANTITA NEL MAGAZZINO
$newquantita = 0;

//aggiorno il db
$stmt = $conn->prepare("UPDATE articolo SET Quantita = ". $newquantita ." WHERE Nome = '" . $Nome . "'");
$stmt->execute();

header("location:../../Index.php");    