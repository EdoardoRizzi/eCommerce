<?php
session_start();
include("../../Connessione/connection.php");
include("../../Connessione/chkConnection.php");

if (isset($_SESSION['IdCarello'])) {
    $stmt = $conn->prepare("SELECT * FROM contiene JOIN articolo ON contiene.IdArticolo=articolo.ID WHERE IdCarello = " .  $_SESSION['IdCarello'] . "");
} else {
    $stmt = $conn->prepare("SELECT * FROM contiene JOIN articolo ON contiene.IdArticolo=articolo.ID WHERE IdCarello = " .  $_COOKIE["Anonymous"] . "");
}

$stmt->execute();
$result = $stmt->get_result();

$totale = 0;

if ($result->num_rows > 0) {
    for ($i = 0; $i < $result->num_rows; $i++) {
        if ($row = $result->fetch_assoc()) {
            $totale += $row['QuantitaContiene'] * $row['Prezzo'];
        }
    }
}

if (isset($_SESSION['IdCarello'])) {
    $stmt = $conn->prepare("INSERT INTO ordine (IdCarello, Prezzo) VALUES (?,?)");
    $stmt->bind_param("ii", $_SESSION["IdCarello"],  $totale);
} else {
    $stmt = $conn->prepare("INSERT INTO ordine (IdCarello, Prezzo) VALUES (?,?)");
    $stmt->bind_param("ii", $_COOKIE['Anonymous'],  $totale);
}

$cookie_name = "Anonymous";

$sql = "INSERT INTO carello () VALUES ()";

if (mysqli_query($conn, $sql)) {
    $cookie_value = mysqli_insert_id($conn);
}

setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day

$stmt->execute();

header("location:../../Index.php");
