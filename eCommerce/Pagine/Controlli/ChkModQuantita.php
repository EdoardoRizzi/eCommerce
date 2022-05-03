<?php
session_start();
include("../../Connessione/connection.php");
include("../../Connessione/chkConnection.php");

//recupero i valori dal form
$Nome = $_POST['articolo'];
$quantita = $_POST['quantita'];

//MODIFICO LA QUANTITA NEL MAGAZZINO
$stmt = $conn->prepare("UPDATE articolo SET Quantita = ". $quantita ." WHERE Nome = '" . $Nome . "'");
$stmt->execute();

header("location:../../Index.php");    