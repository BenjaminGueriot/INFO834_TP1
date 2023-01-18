<?php

    try {
        $conn = mysqli_connect("localhost", "root", "");
        mysqli_select_db($conn, "info834_tp1");
        mysqli_query($conn, "SET NAMES UTF8");
        $msg = "connecté au serveur " . mysqli_get_host_info($conn);
    } catch(mysqli_sql_exception $e) {
        printf("erreur ". mysqli_connect_error(), $e->getMessage());
        exit();
    }

?>