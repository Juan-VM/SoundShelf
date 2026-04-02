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
    // =========================
    // 🟢 SI VIENE DEL FORM (POST)
    // =========================
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $idLista = $_GET['idLista'];

        if (isset($_POST['canciones'])) {

            $canciones = $_POST['canciones'];

            foreach ($canciones as $idCancion) {

                $sql = "BEGIN sp_agregar_cancion_a_lista(:idLista, :idCancion); END;";

                $stmt = oci_parse($conn, $sql);

                oci_bind_by_name($stmt, ":idLista", $idLista);
                oci_bind_by_name($stmt, ":idCancion", $idCancion);

                oci_execute($stmt);
            }

            oci_commit($conn);
        }

        // Redirigir después del POST (muy importante)
        header("Location: playlist.php?idLista=" . $idLista);
        exit();
    }


    // =========================
    // 🔵 SI ES GET (CARGAR PÁGINA)
    // =========================

    $idLista = $_GET["idLista"];

    // Llamar función
    $sql = "BEGIN :cursor := fn_obtener_canciones_usuario(:idUsuario); END;";

    $stmt = oci_parse($conn, $sql);

    $cursor = oci_new_cursor($conn);

    oci_bind_by_name($stmt, ":cursor", $cursor, -1, OCI_B_CURSOR);
    oci_bind_by_name($stmt, ":idUsuario", $idUsuario);

    oci_execute($stmt);
    oci_execute($cursor);

    
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
                <h2 class="text-5xl font-extrabold font-headline tracking-tighter text-on-surface mb-4">Agregar Cancion a
                    <span class="text-transparent bg-clip-text primary-gradient">Lista</span>
                </h2>
                <div class="h-1 w-24 primary-gradient rounded-full"></div>
            </section>


            <!-- Songs Section -->
            <section class="space-y-6">
                <div class="flex items-center justify-between mb-2">
                    <h3 class="text-xl font-bold font-headline uppercase tracking-tight">Canciones Disponibles</h3>
                </div>

                <form action="addSongToList.php?idLista=<?php echo $idLista; ?>" method="POST">
                    <input type="hidden" name="idLista" value="<?php echo $_GET['idLista']; ?>">

                    <div class="bg-surface-container-low rounded-xl overflow-hidden shadow-2xl border border-outline-variant/10">
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="bg-surface-container-high/50 border-b border-outline-variant/10">
                                        <th class="px-8 py-5">Selecciona</th>
                                        <th class="px-8 py-5 text-xs uppercase tracking-widest font-bold text-on-surface-variant">Titulo</th>
                                        <th class="px-8 py-5 text-xs uppercase tracking-widest font-bold text-on-surface-variant">Artista</th>
                                        <th class="px-8 py-5 text-xs uppercase tracking-widest font-bold text-on-surface-variant">Album</th>
                                        <th class="px-8 py-5 text-xs uppercase tracking-widest font-bold text-on-surface-variant">Genero</th>
                                        <th class="px-8 py-5 text-xs uppercase tracking-widest font-bold text-on-surface-variant">Rating</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-outline-variant/5">

                                    <?php while ($row = oci_fetch_assoc($cursor)): ?>

                                        <tr class="group hover:bg-surface-bright transition-colors">

                                            <!-- Checkbox -->
                                            <td class="px-8 py-6">
                                                <input 
                                                    type="checkbox" 
                                                    name="canciones[]" 
                                                    value="<?php echo $row['IDCANCION']; ?>"
                                                    class="w-5 h-5"
                                                />
                                            </td>

                                            <!-- Título -->
                                            <td class="px-8 py-6">
                                                <div class="flex items-center gap-4">
                                                    <span class="font-semibold text-on-surface text-base">
                                                        <?php echo $row['TITULO']; ?>
                                                    </span>
                                                </div>
                                            </td>

                                            <!-- Artista -->
                                            <td class="px-8 py-6 text-on-surface-variant font-medium">
                                                <?php echo $row['ARTISTA']; ?>
                                            </td>

                                            <!-- Album -->
                                            <td class="px-8 py-6 text-on-surface-variant/80 italic">
                                                <?php echo $row['ALBUM']; ?>
                                            </td>

                                            <!-- Género -->
                                            <td class="px-8 py-6">
                                                <span class="bg-surface-variant text-on-surface-variant text-[10px] px-2 py-1 rounded-full uppercase font-bold">
                                                    <?php echo $row['GENERO']; ?>
                                                </span>
                                            </td>

                                            <!-- Rating -->
                                            <td class="px-8 py-6">
                                                <span class="text-primary font-black text-lg">
                                                    <?php echo $row['CALIFICACION']; ?>
                                                </span>
                                            </td>

                                        </tr>

                                    <?php endwhile; ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="bg-surface-container-low border border-outline-variant/10 p-6 rounded-xl flex justify-between items-center">

                        <!-- Cantidad seleccionada -->
                        <div class="text-sm">
                            <span class="text-on-surface-variant">Seleccionado:</span>
                            <span class="text-primary font-bold ml-1">0 Canciones</span>
                        </div>

                        <!-- Botones -->
                        <div class="flex gap-4">
                            <a href="playlist.php?idLista=<?php echo $idLista ?>" class="px-6 py-3 text-on-surface-variant font-bold hover:text-on-surface transition-colors">
                                Cancelar
                            </a>
                            <button type="submit"
                                class="bg-[#8B5CF6] hover:brightness-110 text-white font-bold px-8 py-3 rounded-lg shadow-xl transition-all active:scale-95">
                                Agregar a Playlist
                            </button>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </main>

</body>
</html>
