<?php
session_start();
include("../../Connessione/connection.php");

$idArticolo =  $_SESSION['idarticolo'];
$idUtente = $_SESSION['id'];
$testo = $_POST['testo'];

$stmt = $conn->prepare("INSERT INTO commento (IdArticolo, IdUtente, Testo) VALUES (?,?,?)");
$stmt->bind_param("iis", $idArticolo, $idUtente, $testo);

$stmt->execute();



$stmt->close();
$conn->close();
header("location:../../Index.php");