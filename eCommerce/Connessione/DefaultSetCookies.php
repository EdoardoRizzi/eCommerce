<?php
include("connection.php");

//controllo se esiste il cookie
if (!isset($_COOKIE["Anonymous"])) {
    $cookie_name = "Anonymous";

    $sql = "INSERT INTO carello () VALUES ()";

    if (mysqli_query($conn, $sql)) {
        $cookie_value = mysqli_insert_id($conn);
    }

    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
} else {
    if(!isset($_SESSION["id"])){
       
        $idcarello = $_COOKIE['Anonymous'];
        $stmt = $conn->prepare("SELECT IdUtente FROM carello WHERE ID = $idcarello");
    
        $stmt->execute();
        $result = $stmt->get_result();
        //controllo se il carello ha già un utente
        if ($result->num_rows > 0) {
            if ($row = $result->fetch_assoc()) {
                if ($row['IdUtente'] != null) {
                    $sql = "INSERT INTO carello () VALUES ()";
                    $cookie_name = "Anonymous";
                    if (mysqli_query($conn, $sql)) {
                        $cookie_value = mysqli_insert_id($conn);
                    }
    
                    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
                } 
            }
        }
    }
}