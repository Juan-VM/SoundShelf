<?php
    session_start();

    if (!isset($_SESSION["idUsuario"])) {
        header("Location: ../index.php");
        exit();
    }

    if (!isset($_GET["idCancion"])) {
        die("Canción no especificada");
    }

    require_once("../db/OracleDB.php");

    $db = new OracleDB();
    $conn = $db->getConn();

    $idCancion = $_GET["idCancion"];


    $sqlDelete = "BEGIN SP_DELETE_CANCION(:id); END;";
    $stmtDelete = oci_parse($conn, $sqlDelete);

    oci_bind_by_name($stmtDelete, ":id", $idCancion);

    if (oci_execute($stmtDelete)) {
        header("Location: dashboard.php");
        exit();
    } else {
        $_SESSION["mensaje"] = "Error al eliminar la canción";
    }
?>