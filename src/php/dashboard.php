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



    // SQL PARA MOSTAR LAS ESTADÍSTICAS

    $sqlStats = "BEGIN sp_dashboard_stats(:idUsuario, :totalCanciones, :totalArtistas, :totalListas); END;";
    $stmtStats = oci_parse($conn, $sqlStats);

    oci_bind_by_name($stmtStats, ":idUsuario", $idUsuario);
    oci_bind_by_name($stmtStats, ":totalCanciones", $totalCanciones, 32);
    oci_bind_by_name($stmtStats, ":totalArtistas", $totalArtistas, 32);
    oci_bind_by_name($stmtStats, ":totalListas", $totalListas, 32);

    oci_execute($stmtStats);


    // SQL PARA MOSTAR LAS CANCIONES

    $sqlSongs = "BEGIN :cursor := fn_obtener_canciones_usuario(:idUsuario); END;";
    $stmtSongs = oci_parse($conn, $sqlSongs);

    $cursor = oci_new_cursor($conn);

    oci_bind_by_name($stmtSongs, ":idUsuario", $idUsuario);
 // oci_bind_by_name($statement, $placeholder, &$variable, $length, $type);
    oci_bind_by_name($stmtSongs, ":cursor", $cursor, -1, OCI_B_CURSOR);

    oci_execute($stmtSongs);
    oci_execute($cursor);

    $db->close();
?>

<!DOCTYPE html>
<html class="dark" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>SoundShelf</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Manrope:wght@700;800&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="../css/dashboard.css"/>
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
<body class="bg-background text-on-surface font-body antialiased">

    <!-- SideNavBar -->
    <?php
        $active_page = 'dashboard';
        include '../includes/sideBar.php';
    ?>

    <!-- Main Content Canvas -->
    <main class="ml-64 min-h-screen">
        
        <!-- TopNavBar -->
        <?php include '../includes/topBar.php'; ?>

        <!-- Dashboard Canvas -->
        <div class="pt-32 pb-12 px-10">

            <!-- Welcome Section -->
            <section class="mb-12">
                <p class="text-primary font-bold text-sm tracking-widest uppercase mb-2">Estado de tu musica: lista para escuchar</p>
                <h2 class="text-5xl font-extrabold font-headline tracking-tighter text-on-surface mb-4">Bienvenido, 
                    <span class="text-transparent bg-clip-text primary-gradient"><?php echo $_SESSION["nombreUsuario"]; ?></span>
                </h2>
                <div class="h-1 w-24 primary-gradient rounded-full"></div>
            </section>

            <!-- Statistics Summary Bento Grid -->
            <section class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                <div class="bg-surface-container-low p-8 rounded-xl flex flex-col justify-between group hover:bg-surface-bright transition-all duration-300">
                    <span class="material-symbols-outlined text-primary text-3xl mb-4">library_music</span>
                    <div>
                        <p class="text-4xl font-extrabold font-headline mb-1"><?php echo $totalCanciones; ?></p>
                        <p class="text-xs uppercase tracking-widest text-on-surface-variant font-semibold">Total Canciones</p>
                    </div>
                </div>
                <div class="bg-surface-container-low p-8 rounded-xl flex flex-col justify-between group hover:bg-surface-bright transition-all duration-300">
                    <span class="material-symbols-outlined text-tertiary text-3xl mb-4">record_voice_over</span>
                    <div>
                        <p class="text-4xl font-extrabold font-headline mb-1"><?php echo $totalArtistas; ?></p>
                        <p class="text-xs uppercase tracking-widest text-on-surface-variant font-semibold">Artistas distintos</p>
                    </div>
                </div>
                <div class="bg-surface-container-low p-8 rounded-xl flex flex-col justify-between group hover:bg-surface-bright transition-all duration-300">
                    <span class="material-symbols-outlined text-secondary text-3xl mb-4">playlist_play</span>
                    <div>
                        <p class="text-4xl font-extrabold font-headline mb-1"><?php echo $totalListas; ?></p>
                        <p class="text-xs uppercase tracking-widest text-on-surface-variant font-semibold">Total listas</p>
                    </div>
                </div>
            </section>

            <!-- Songs Section -->
            <section class="space-y-6">
                <div class="flex items-center justify-between mb-2">
                    <h3 class="text-xl font-bold font-headline uppercase tracking-tight">Tus Canciones</h3>
                </div>
                <div class="bg-surface-container-low rounded-xl overflow-hidden shadow-2xl border border-outline-variant/10">
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
                                <!-- Row 1 -->
                                <?php while ($row = oci_fetch_assoc($cursor)): ?>
                                    <tr class="group hover:bg-surface-bright transition-colors">

                                        <td class="px-8 py-6">
                                            <div class="flex items-center gap-4">
                                                <img alt="artwork" 
                                                    class="w-12 h-12 rounded-lg object-cover shadow-lg group-hover:scale-105 transition-transform" 
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
                                                <button class="p-2 text-on-surface-variant hover:text-primary transition-colors hover:bg-primary/10 rounded-lg">
                                                    <span class="material-symbols-outlined">edit</span>
                                                </button>
                                                <button class="p-2 text-on-surface-variant hover:text-error transition-colors hover:bg-error/10 rounded-lg">
                                                    <span class="material-symbols-outlined">delete</span>
                                                </button>
                                            </div>
                                        </td>

                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="mt-8 text-center">
                    <p class="text-on-surface-variant text-[10px] uppercase tracking-[0.2em] font-bold">Fin lista de canciones</p>
                </div>
            </section>

        </div>
    </main>

</body>
</html>
