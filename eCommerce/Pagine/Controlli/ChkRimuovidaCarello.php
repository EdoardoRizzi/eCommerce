<?php
session_start();
include("../../Connessione/connection.php");
include("../../Connessione/chkConnection.php");

//recupero i valori dal form
$IdArticolo = $_GET['idarticolo'];

//recupero la quantita presente nel carello
$stmt = $conn->prepare("SELECT ID, QuantitaContiene FROM contiene WHERE IdArticolo = " .  $IdArticolo . "");
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    if ($row = $result->fetch_assoc()) {
        $quantita = $row['QuantitaContiene'];   
        $IdContiene =  $row['ID'];   
    }    
}

//cancello record
$stmt = $conn->prepare("DELETE FROM contiene WHERE ID = ". $IdContiene ."");
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
$newquantita = $quantitamagazzino + $quantita;
//aggiorno il db
$stmt = $conn->prepare("UPDATE articolo SET Quantita = ". $newquantita ." WHERE ID = " . $IdArticolo . "");
$stmt->execute();

header("location:../DettagliCarrello.php");    
