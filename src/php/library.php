<?php 
    session_start();

    if (!isset($_SESSION["idUsuario"])) {
        header("Location: ../index.php");
        exit();
    }
    
    require_once("../db/OracleDB.php");

    $db = new OracleDB();
    $conn = $db->getConn();

    $idUsuario = $_SESSION["idUsuario"];

    // Obtener todas las listas del usuario
    $sqlListas = "BEGIN :cursor := fn_obtener_listas_usuario(:idUsuario); END;";
    $stmtListas = oci_parse($conn, $sqlListas);

    $cursor = oci_new_cursor($conn);

    oci_bind_by_name($stmtListas, ":cursor", $cursor, -1, OCI_B_CURSOR);
    oci_bind_by_name($stmtListas, ":idUsuario", $idUsuario);

    oci_execute($stmtListas);
    oci_execute($cursor);

    $db->close();
?>
<!DOCTYPE html>
<html class="dark" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Libreria | SoundShelf</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="../css/library.css"/>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "on-primary-fixed-variant": "#370086",
                        "surface-dim": "#060e20",
                        "on-surface": "#dee5ff",
                        "error": "#ff6e84",
                        "on-error-container": "#ffb2b9",
                        "on-secondary": "#390068",
                        "surface-tint": "#ba9eff",
                        "surface-variant": "#192540",
                        "secondary": "#c08cf7",
                        "tertiary-dim": "#f0779d",
                        "surface": "#060e20",
                        "inverse-surface": "#faf8ff",
                        "surface-bright": "#1f2b49",
                        "primary-container": "#ae8dff",
                        "background": "#060e20",
                        "error-dim": "#d73357",
                        "primary-dim": "#8455ef",
                        "surface-container-low": "#091328",
                        "tertiary-fixed": "#ff8eb0",
                        "on-secondary-fixed": "#4b147d",
                        "on-surface-variant": "#a3aac4",
                        "secondary-container": "#5e2c91",
                        "on-tertiary": "#6a0934",
                        "primary-fixed-dim": "#a27cff",
                        "surface-container-high": "#141f38",
                        "surface-container-lowest": "#000000",
                        "on-secondary-container": "#e3c4ff",
                        "tertiary-container": "#fd81a8",
                        "outline": "#6d758c",
                        "on-primary-fixed": "#000000",
                        "inverse-on-surface": "#4d556b",
                        "on-background": "#dee5ff",
                        "secondary-dim": "#bb87f1",
                        "inverse-primary": "#6e3bd7",
                        "outline-variant": "#40485d",
                        "surface-container-highest": "#192540",
                        "error-container": "#a70138",
                        "on-primary": "#39008c",
                        "tertiary": "#ff97b5",
                        "on-tertiary-fixed-variant": "#701039",
                        "on-tertiary-fixed": "#380018",
                        "surface-container": "#0f1930",
                        "tertiary-fixed-dim": "#f67ca3",
                        "on-error": "#490013",
                        "on-tertiary-container": "#59002a",
                        "primary": "#ba9eff",
                        "on-primary-container": "#2b006e",
                        "secondary-fixed": "#e4c6ff",
                        "secondary-fixed-dim": "#dab4ff",
                        "primary-fixed": "#ae8dff",
                        "on-secondary-fixed-variant": "#69379c"
                    },
                    fontFamily: {
                        "headline": ["Manrope"],
                        "body": ["Inter"],
                        "label": ["Inter"]
                    },
                    borderRadius: { "DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px" },
                },
            },
        }
    </script>
</head>
<body class="bg-background text-on-surface font-body selection:bg-primary/30">

    <!-- SideNavBar -->
    <?php
        $active_page = 'library';
        include '../includes/sideBar.php';
    ?>

    <!-- TopNavBar -->
    <?php include '../includes/topBar.php'; ?>

    <!-- Main Content Canvas -->
    <main class="ml-64 pt-28 px-12 pb-24 min-h-screen">

        <!-- Mensaje confirmacion -->
        <?php if (isset($_SESSION["mensaje"])): ?>
            <div class="mb-6 p-4 rounded-xl bg-green-500/20 text-green-300 font-semibold text-center">
                <?php 
                    echo $_SESSION["mensaje"]; 
                    unset($_SESSION["mensaje"]);
                ?>
            </div>
        <?php endif; ?>

        <!-- Header & Tabs -->
        <div class="mb-12 flex flex-col md:flex-row md:items-end justify-between gap-8">
            <div>
                <h2 class="text-5xl font-extrabold font-headline tracking-tight mb-4">Libreria</h2>
                <div class="flex gap-10">
                    <button class="group relative pb-2">
                        <span class="font-headline text-lg font-bold text-primary">Listas</span>
                        <div class="absolute bottom-0 left-0 w-full h-1 bg-primary rounded-full"></div>
                    </button>
                </div>
            </div>
            <a href="addPlaylist.php" class="flex items-center gap-2 bg-primary text-on-primary px-6 py-3 rounded-xl shadow-[0_0_30px_rgba(186,158,255,0.2)] hover:scale-105 transition-all font-bold">
                <span class="material-symbols-outlined">add_circle</span>
                Crear Lista
            </a>
        </div>

        <!-- Grid of Playlists -->
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-8">
            <?php while ($row = oci_fetch_assoc($cursor)): ?>
                <a href="playlist.php?idLista=<?php echo $row['IDLISTA']; ?>" class="group cursor-pointer">
                    <div class="relative aspect-square rounded-2xl overflow-hidden mb-4 shadow-xl">
                        <img class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" 
                            src="../images/playlist.jpg" 
                            alt="<?php echo $row['TITULO']; ?>"/>
                        <div class="absolute inset-0 bg-black/20 group-hover:bg-black/0 transition-colors"></div>
                    </div>
                    <h4 class="font-headline font-bold text-lg mb-1 group-hover:text-primary transition-colors">
                        <?php echo $row['TITULO']; ?>
                    </h4>
                    <p class="text-on-surface-variant text-xs font-label uppercase tracking-wider">
                        <?php echo $row['TOTALCANCIONES']; ?> Canciones
                    </p>
                </a>
            <?php endwhile; ?>
        </div>

    </main>

</body>
</html>