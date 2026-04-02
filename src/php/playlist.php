<?php
    session_start();

    if (!isset($_SESSION["idUsuario"])) {
        header("Location: ../index.php");
        exit();
    }

    if (!isset($_GET["idLista"])) {
        header("Location: library.php");
        exit();
    }

    require_once("../db/OracleDB.php");

    $db = new OracleDB();
    $conn = $db->getConn();

    $idUsuario = $_SESSION["idUsuario"];
    $idLista = $_GET["idLista"];

    $tituloLista = "";
    $fechaCreacion = "";
    $totalCanciones = 0;

    // Obtener datos de la lista
    $sqlGetLista = "BEGIN SP_GET_LISTA(:idLista, :titulo, :fecha, :total); END;";
    $stmtGetLista = oci_parse($conn, $sqlGetLista);

    oci_bind_by_name($stmtGetLista, ":idLista", $idLista);
    oci_bind_by_name($stmtGetLista, ":titulo", $tituloLista, 100);
    oci_bind_by_name($stmtGetLista, ":fecha", $fechaCreacion, 50);
    oci_bind_by_name($stmtGetLista, ":total", $totalCanciones, 32);

    oci_execute($stmtGetLista);

    // Obtener canciones de la lista
    $sqlCanciones = "BEGIN :cursor := fn_obtener_canciones_lista(:idLista); END;";
    $stmtCanciones = oci_parse($conn, $sqlCanciones);

    $cursor = oci_new_cursor($conn);

    oci_bind_by_name($stmtCanciones, ":cursor", $cursor, -1, OCI_B_CURSOR);
    oci_bind_by_name($stmtCanciones, ":idLista", $idLista);

    oci_execute($stmtCanciones);
    oci_execute($cursor);

    $db->close();
?>
<!DOCTYPE html>
<html class="dark" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Playlist | SoundShelf</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Manrope:wght@700;800&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="../css/playlist.css"/>
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
                    borderRadius: {"DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px"},
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

    <!-- Main Canvas -->
    <main class="ml-64 pt-20 p-12 min-h-screen">

        <!-- Mensaje de confirmacion -->
        <?php if (isset($_SESSION["mensaje"])): ?>
            <div class="mb-6 p-4 rounded-xl bg-green-500/20 text-green-300 font-semibold text-center">
                <?php 
                    echo $_SESSION["mensaje"]; 
                    unset($_SESSION["mensaje"]);
                ?>
            </div>
        <?php endif; ?>

        <!-- Playlist Header Section -->
        <section class="flex flex-col md:flex-row gap-12 items-end mb-16 relative">
            <div class="relative group">
                <div class="w-72 h-72 rounded-xl overflow-hidden sonic-shadow ring-1 ring-primary/20">
                    <img alt="Playlist Cover" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                     src="../images/playlist.jpg"/>
                </div>
            </div>
            <div class="flex-1 flex flex-col gap-4">
                <h2 class="text-6xl font-extrabold font-headline tracking-tighter text-on-surface leading-tight">
                    <?php echo $tituloLista; ?>
                </h2>
                <div class="flex items-center gap-6 mt-4">
                    <div class="flex flex-col">
                        <span class="text-[10px] uppercase font-label text-on-surface-variant tracking-widest">Total Canciones</span>
                        <span class="text-xl font-bold font-headline text-on-surface"><?php echo $totalCanciones; ?></span>
                    </div>
                    <div class="w-[1px] h-8 bg-outline-variant/30"></div>
                    <div class="flex gap-4">
                        <a href="deletePlaylist.php?idLista=<?php echo $idLista; ?>"
                            onclick="return confirm('¿Seguro que deseas eliminar esta lista?')"
                            class="flex items-center gap-2 text-on-surface-variant hover:text-error transition-colors text-sm font-label uppercase tracking-widest font-semibold px-4 py-2 bg-surface-container rounded-lg border border-outline-variant/10">
                            <span class="material-symbols-outlined text-lg">delete</span>
                            Eliminar Lista
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Track List Section -->
        <section class="bg-surface-container-low rounded-xl overflow-hidden shadow-2xl border border-outline-variant/10 mb-12">
            <div class="flex justify-between items-center p-8 bg-surface-container-low/50">
                <h3 class="text-2xl font-bold font-headline tracking-tight">Canciones</h3>
                <a href="addSongToList.php?idLista=<?php echo $idLista; ?>" 
                    class="flex items-center gap-2 primary-gradient px-6 py-2.5 rounded-xl text-on-primary-fixed font-bold font-headline text-sm hover:shadow-[0_0_20px_rgba(186,158,255,0.4)] transition-all">
                    <span class="material-symbols-outlined text-lg">add</span>
                    Agregar Cancion
                </a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-surface-container-high/50 border-b border-outline-variant/10">
                            <th class="px-8 py-5 text-xs uppercase tracking-widest font-bold text-on-surface-variant">Titulo</th>
                            <th class="px-8 py-5 text-xs uppercase tracking-widest font-bold text-on-surface-variant">Artista</th>
                            <th class="px-8 py-5 text-xs uppercase tracking-widest font-bold text-on-surface-variant">Album</th>
                            <th class="px-8 py-5 text-xs uppercase tracking-widest font-bold text-on-surface-variant">Genero</th>
                            <th class="px-8 py-5 text-xs uppercase tracking-widest font-bold text-on-surface-variant">Rating</th>
                            <th class="px-8 py-5 text-xs uppercase tracking-widest font-bold text-on-surface-variant text-right">Gestion</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline-variant/5">
                        <?php while ($row = oci_fetch_assoc($cursor)): ?>
                            <tr class="group hover:bg-surface-bright transition-colors">
                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-4">
                                        <img alt="Track Art" class="w-12 h-12 rounded-lg object-cover shadow-lg group-hover:scale-105 transition-transform"
                                         src="../images/musicaIcono.png"/>
                                        <span class="font-semibold text-on-surface text-base">
                                            <?php echo $row['TITULO']; ?>
                                        </span>
                                    </div>
                                </td>
                                <td class="px-8 py-6 text-on-surface-variant font-medium">
                                    <?php echo $row['ARTISTA']; ?>
                                </td>
                                <td class="px-8 py-6 text-on-surface-variant/80 italic font-body">
                                    <?php echo $row['ALBUM']; ?>
                                </td>
                                <td class="px-8 py-6">
                                    <span class="bg-surface-variant text-on-surface-variant text-[10px] px-2 py-1 rounded-full uppercase tracking-tighter font-bold">
                                        <?php echo $row['GENERO']; ?>
                                    </span>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-2">
                                        <span class="text-primary font-black text-lg">
                                            <?php echo $row['CALIFICACION']; ?>
                                        </span>
                                    </div>
                                </td>
                                <td class="px-8 py-6 text-right">
                                    <div class="flex justify-end gap-3">
                                        <a href="song.php?idCancion=<?php echo $row['IDCANCION']; ?>" 
                                            class="p-2 text-on-surface-variant hover:text-primary transition-colors hover:bg-primary/10 rounded-lg">
                                            <span class="material-symbols-outlined">edit</span>
                                        </a>
                                        <a href="removeSongList.php?idCancion=<?php echo $row['IDCANCION']; ?>&idLista=<?php echo $idLista; ?>"
                                            onclick="return confirm('¿Quitar esta canción de la lista?')"
                                            class="p-2 text-on-surface-variant hover:text-error transition-colors hover:bg-error/10 rounded-lg">
                                            <span class="material-symbols-outlined">delete</span>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </section>

    </main>

</body>
</html>