<?php
session_start();
ob_start();
include("../../Connessione/connection.php");

if ($_POST["password"] == $_POST["conferma"]) {
    // inserisco il nuovo utente
    $stmt = $conn->prepare("INSERT INTO utente (Nome, Cognome, DataNascita, Email, NumTelefono, Password, ImgProfilo) VALUES (?,?,?,?,?,?,?)");
    $stmt->bind_param("sssssss", $nome, $cognome, $datanascita, $email, $numtelefono, $password, $imgarticolo);

    $nome = $_POST['nome'];
    $cognome = $_POST['cognome'];
    $datanascita = $_POST['formatdata'];
    $email = $_POST['email'];
    $numtelefono = $_POST['numtelefono'];

    if ($_FILES['imgarticolo']['name'] != "") {
        $nomefile = $_FILES['imgarticolo']['name'];
        $uploaddir = "../../assets/img/utenti/";
        $uploadfile = $uploaddir . basename($_FILES['imgarticolo']['name']);
        move_uploaded_file($_FILES['imgarticolo']['tmp_name'], $uploadfile);
    }

    $imgarticolo = substr($nomefile, 0, strlen($nomefile) - 4);

    $password = md5($_POST["password"]);
    $stmt->execute();


    ob_end_clean();
    header("location:../../Index.php");

    $stmt->close();
    $conn->close();
} else {
    ob_end_clean();
    header("location:SingUp.php");
}
