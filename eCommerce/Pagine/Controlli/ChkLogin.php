<?php
session_start();
include("../../Connessione/connection.php");
$user =  $_POST["username"];
$pas =  md5($_POST["password"]);

$stmt = $conn->prepare("SELECT ID,Admin FROM utente WHERE Nome = '". $user ."' AND Password = '". $pas ."'");

$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
  // output data of each row
  if ($row = $result->fetch_assoc()) {
    if ($row["Admin"] == 1) {
      $_SESSION["admin"] = 1;
    }

    $_SESSION["id"] = $row['ID'];

    $stmt = $conn->prepare("UPDATE carello SET IdUtente = " . $row["ID"] . " WHERE ID = " . $_COOKIE['Anonymous'] . "");
    $stmt->execute();

    header("location:../../Index.php");
  }
} else {
  header("location:../Login.php");
}
