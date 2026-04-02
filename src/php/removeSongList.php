<?php
    session_start();

    if (!isset($_SESSION["idUsuario"])) {
        header("Location: ../index.php");
        exit();
    }

    if (!isset($_GET["idCancion"]) || !isset($_GET["idLista"])) {
        header("Location: library.php");
        exit();
    }

    require_once("../db/OracleDB.php");

    $db = new OracleDB();
    $conn = $db->getConn();

    $idCancion = $_GET["idCancion"];
    $idLista = $_GET["idLista"];
    $resultado = 0;

    $sqlRemove = "BEGIN SP_REMOVE_CANCION_LISTA(:idLista, :idCancion, :resultado); END;";
    $stmtRemove = oci_parse($conn, $sqlRemove);

    oci_bind_by_name($stmtRemove, ":idLista", $idLista);
    oci_bind_by_name($stmtRemove, ":idCancion", $idCancion);
    oci_bind_by_name($stmtRemove, ":resultado", $resultado, 32);

    oci_execute($stmtRemove);

    $db->close();

    if ($resultado == 0) {
        $_SESSION["mensaje"] = "Canción eliminada de la lista correctamente";
    } else {
        $_SESSION["mensaje"] = "Error al eliminar la canción de la lista";
    }

    header("Location: playlist.php?idLista=" . $idLista);
    exit();
?>