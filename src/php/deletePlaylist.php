<?php
    session_start();

    // Verificar sesión
    if (!isset($_SESSION["idUsuario"])) {
        header("Location: ../index.php");
        exit();
    }

    // Verificar que venga el id de la lista
    if (!isset($_GET["idLista"])) {
        header("Location: library.php");
        exit();
    }

    require_once("../db/OracleDB.php");

    $db = new OracleDB();
    $conn = $db->getConn();

    $idLista = $_GET["idLista"];
    $resultado = 0;

    // Llamar al procedimiento
    $sql = "BEGIN SP_DELETE_LISTA(:idLista, :resultado); END;";

    $stmt = oci_parse($conn, $sql);

    oci_bind_by_name($stmt, ":idLista", $idLista);
    oci_bind_by_name($stmt, ":resultado", $resultado, 32);

    oci_execute($stmt);

    // Validar resultado
    if ($resultado == 0) {
        $_SESSION["mensaje"] = "Playlist eliminada correctamente.";
    } else {
        $_SESSION["mensaje"] = "Error al eliminar la playlist.";
    }

    $db->close();

    // Redireccionar
    header("Location: library.php");
    exit();
?>