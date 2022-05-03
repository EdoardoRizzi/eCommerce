<?php
session_start();
include("../../Connessione/connection.php");

$idcat = $_POST['combocategoria'];
$nome = $_POST['nome'];
$preview = $_POST['preview'];
$descrizione = $_POST['descrizione'];
$quantita = $_POST['quantita'];
$prezzo = $_POST['prezzo'];
$venditore = $_POST['venditore'];


if ($_FILES['imgarticolo']['name'] != "") {
  $nomefile = $_FILES['imgarticolo']['name'];
  $uploaddir = "../../assets/img/articoli/";
  $uploadfile = $uploaddir . basename($_FILES['imgarticolo']['name']);
  move_uploaded_file($_FILES['imgarticolo']['tmp_name'], $uploadfile);
}

$imgarticolo = substr($nomefile,0, strlen($nomefile)-4 );

$stmt = $conn->prepare("INSERT INTO articolo (IdCategoria, Nome, Preview, Descrizione, Quantita, Prezzo, ImgArticolo, Venditore) VALUES (?,?,?,?,?,?,?,?)");
$stmt->bind_param("isssiiss", $idcat, $nome, $preview, $descrizione, $quantita, $prezzo, $imgarticolo, $venditore);

$stmt->execute();
echo $stmt->error;


header("location:../../Index.php");

$stmt->close();
$conn->close();