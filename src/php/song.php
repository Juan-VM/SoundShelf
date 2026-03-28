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

    $idUsuario = $_SESSION["idUsuario"];
    $idCancion = $_GET["idCancion"];

    
    $titulo = $artista = $album = $genero = $comentario = "";
    $calificacion = 0;

    $sqlGetSong = "BEGIN SP_GET_CANCION(:id, :titulo, :artista, :album, :genero, :calificacion, :comentario); END;";
    $stmtGetSong = oci_parse($conn, $sqlGetSong);

    oci_bind_by_name($stmtGetSong, ":id", $idCancion);
    oci_bind_by_name($stmtGetSong, ":titulo", $titulo, 100);
    oci_bind_by_name($stmtGetSong, ":artista", $artista, 100);
    oci_bind_by_name($stmtGetSong, ":album", $album, 100);
    oci_bind_by_name($stmtGetSong, ":genero", $genero, 50);
    oci_bind_by_name($stmtGetSong, ":calificacion", $calificacion, -1, SQLT_INT);
    oci_bind_by_name($stmtGetSong, ":comentario", $comentario, 300);

    oci_execute($stmtGetSong);




    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $titulo = $_POST["song_title"];
        $artista = $_POST["artist"];
        $album = $_POST["album"];
        $genero = $_POST["genre"];
        $calificacion = $_POST["archive_rating"];
        $comentario = $_POST["notes"];

        $sqlUpdateCancion = "BEGIN SP_UPDATE_CANCION(:id, :titulo, :artista, :album, :genero, :calificacion, :comentario); END;";
        $stmtUpdateCancion = oci_parse($conn, $sqlUpdateCancion);

        oci_bind_by_name($stmtUpdateCancion, ":id", $idCancion);
        oci_bind_by_name($stmtUpdateCancion, ":titulo", $titulo);
        oci_bind_by_name($stmtUpdateCancion, ":artista", $artista);
        oci_bind_by_name($stmtUpdateCancion, ":album", $album);
        oci_bind_by_name($stmtUpdateCancion, ":genero", $genero);
        oci_bind_by_name($stmtUpdateCancion, ":calificacion", $calificacion);
        oci_bind_by_name($stmtUpdateCancion, ":comentario", $comentario);

        if (oci_execute($stmtUpdateCancion)) {
            $_SESSION["mensaje"] = "Canción actualizada correctamente";
        } else {
            $_SESSION["mensaje"] = "Error al actualizar";
        }

        header("Location: song.php?idCancion=" . $idCancion);
        exit();
    }
?>
<!DOCTYPE html>
<html class="dark" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Cancion | SoundShelf</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Manrope:wght@700;800&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="../css/song.css"/>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "on-primary-fixed": "#000000",
                        "secondary-fixed": "#e4c6ff",
                        "primary": "#ba9eff",
                        "outline-variant": "#40485d",
                        "on-secondary-fixed": "#4b147d",
                        "surface-container-low": "#091328",
                        "secondary": "#c08cf7",
                        "on-tertiary-fixed": "#380018",
                        "error-dim": "#d73357",
                        "secondary-container": "#5e2c91",
                        "background": "#060e20",
                        "on-secondary-fixed-variant": "#69379c",
                        "on-error": "#490013",
                        "surface-bright": "#1f2b49",
                        "surface": "#060e20",
                        "outline": "#6d758c",
                        "on-secondary-container": "#e3c4ff",
                        "inverse-surface": "#faf8ff",
                        "tertiary-fixed-dim": "#f67ca3",
                        "primary-dim": "#8455ef",
                        "on-surface-variant": "#a3aac4",
                        "surface-container-highest": "#192540",
                        "on-surface": "#dee5ff",
                        "tertiary-dim": "#f0779d",
                        "surface-container-high": "#141f38",
                        "on-primary-fixed-variant": "#370086",
                        "on-tertiary-container": "#59002a",
                        "surface-dim": "#060e20",
                        "on-tertiary": "#6a0934",
                        "on-background": "#dee5ff",
                        "tertiary": "#ff97b5",
                        "on-tertiary-fixed-variant": "#701039",
                        "primary-container": "#ae8dff",
                        "inverse-primary": "#6e3bd7",
                        "surface-container-lowest": "#000000",
                        "on-primary-container": "#2b006e",
                        "surface-tint": "#ba9eff",
                        "inverse-on-surface": "#4d556b",
                        "surface-container": "#0f1930",
                        "on-error-container": "#ffb2b9",
                        "secondary-fixed-dim": "#dab4ff",
                        "error-container": "#a70138",
                        "tertiary-container": "#fd81a8",
                        "tertiary-fixed": "#ff8eb0",
                        "primary-fixed": "#ae8dff",
                        "on-primary": "#39008c",
                        "error": "#ff6e84",
                        "surface-variant": "#192540",
                        "secondary-dim": "#bb87f1",
                        "on-secondary": "#390068",
                        "primary-fixed-dim": "#a27cff"
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
<body class="bg-background text-on-surface font-body min-h-screen overflow-x-hidden">

    <!-- SideNavBar -->
    <?php
        $active_page = 'dashboard';
        include '../includes/sideBar.php';
    ?>

    <!-- Main Content -->
    <main class="ml-64 min-h-screen flex flex-col">
        <!-- Main Content Canvas -->
        <section class="flex-1 p-8 lg:p-12 max-w-5xl mx-auto w-full">
            <div class="mb-10 text-center">
                <h1 class="font-headline font-extrabold text-4xl lg:text-5xl text-on-surface tracking-tight mb-2">Cancion</h1>
                <p class="text-on-surface-variant text-lg">Tu musica a tu alcance</p>
            </div>

            <div class="glass-panel p-8 lg:p-12 rounded-[2rem] sonic-shadow border border-outline-variant/10">
                
                <!-- Top Visual Section -->
                <div class="flex flex-col md:flex-row gap-8 items-center md:items-start mb-12">
                    <div class="flex-1 space-y-4 text-center md:text-left pt-4">
                        <div>
                            <h3 class="font-headline text-2xl font-bold text-on-surface">Datos de la Cancion</h3>
                            <p class="text-primary font-medium">Actualiza o visualiza tu cancion</p>
                        </div>
                    </div>
                </div>

                <form method="POST" action="" class="space-y-8">
                    <!-- Confirmation menssage -->
                    <?php if (isset($_SESSION["mensaje"])): ?>
                        <div class="mb-6 p-4 rounded-xl bg-green-500/20 text-green-300 text-center font-bold">
                            <?php 
                                echo $_SESSION["mensaje"]; 
                                unset($_SESSION["mensaje"]);
                            ?>
                        </div>
                    <?php endif; ?>
                    <!-- Form Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">

                        <!-- Song Title -->
                        <div class="space-y-2">
                            <label class="text-sm font-bold text-on-surface-variant uppercase tracking-widest ml-1">Titulo Cancion</label>
                            <input class="w-full bg-surface-container-highest border-none rounded-xl px-4 py-4 text-on-surface focus:ring-1 focus:ring-primary/40 transition-all"
                             name="song_title" type="text" value="<?php echo $titulo; ?>" required/>
                        </div>

                        <!-- Artist -->
                        <div class="space-y-2">
                            <label class="text-sm font-bold text-on-surface-variant uppercase tracking-widest ml-1">Artista</label>
                            <input class="w-full bg-surface-container-highest border-none rounded-xl px-4 py-4 text-on-surface focus:ring-1 focus:ring-primary/40 transition-all"
                             name="artist" type="text" value="<?php echo $artista; ?>" required/>
                        </div>

                        <!-- Album -->
                        <div class="space-y-2">
                            <label class="text-sm font-bold text-on-surface-variant uppercase tracking-widest ml-1">Album</label>
                            <input class="w-full bg-surface-container-highest border-none rounded-xl px-4 py-4 text-on-surface focus:ring-1 focus:ring-primary/40 transition-all"
                             name="album" type="text" value="<?php echo $album; ?>"  required/>
                        </div>

                        <!-- Genre -->
                        <div class="space-y-2">
                            <label class="text-sm font-bold text-on-surface-variant uppercase tracking-widest ml-1">Genero</label>
                            <select class="w-full bg-surface-container-highest border-none rounded-xl px-4 py-4 text-on-surface focus:ring-1 focus:ring-primary/40 transition-all appearance-none"
                             name="genre" required>
                                <option value="Electronica" <?= $genero == "Electronica" ? "selected" : "" ?>>Electronica</option>
                                <option value="Jazz Fusion" <?= $genero == "Jazz Fusion" ? "selected" : "" ?>>Jazz Fusion</option>
                                <option value="Clasica" <?= $genero == "Clasica" ? "selected" : "" ?>>Clasica</option>
                                <option value="Ambiente" <?= $genero == "Ambiente" ? "selected" : "" ?>>Ambiente</option>
                                <option value="Experimental" <?= $genero == "Experimental" ? "selected" : "" ?>>Experimental</option>
                                <option value="Rock" <?= $genero == "Rock" ? "selected" : "" ?>>Rock</option>
                                <option value="Regueton" <?= $genero == "Regueton" ? "selected" : "" ?>>Regueton</option>
                                <option value="Trap" <?= $genero == "Trap" ? "selected" : "" ?>>Trap</option>
                                <option value="Instrumental" <?= $genero == "Instrumental" ? "selected" : "" ?>>Instrumental</option>

                            </select>
                        </div>

                        <!-- Rating -->
                        <div class="md:col-span-2 space-y-4 pt-4 pb-2">
                            <label class="text-sm font-bold text-on-surface-variant uppercase tracking-widest ml-1">Calificacion</label>
                            <div class="flex flex-wrap gap-2">
                                <?php
                                $current_rating = $calificacion;

                                for ($i = 1; $i <= 10; $i++):
                                    $active = $i == $current_rating;
                                ?>
                                <button class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm 
                                    <?= $active ? 'bg-primary text-on-primary-fixed shadow-lg shadow-primary/20' 
                                                : 'bg-surface-container-highest text-on-surface-variant hover:bg-primary/20 transition-all border border-outline-variant/10' ?>"
                                    type="button" onclick="selectRating(<?= $i ?>)">
                                    <?= $i ?>
                                </button>
                                <?php endfor; ?>
                            </div>
                            <input name="archive_rating" type="hidden" id="rating-value" value="<?= $current_rating ?>"/>
                        </div>

                        <!-- Notes -->
                        <div class="md:col-span-2 space-y-2">
                            <label class="text-sm font-bold text-on-surface-variant uppercase tracking-widest ml-1">Comentario</label>
                            <textarea class="w-full bg-surface-container-highest border-none rounded-xl px-4 py-4 text-on-surface focus:ring-1 focus:ring-primary/40 transition-all resize-none"
                             name="notes" placeholder="Agregar comentario..." rows="5"><?php echo $comentario; ?></textarea>
                        </div>

                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row items-center justify-between pt-8 gap-4 border-t border-outline-variant/10 mt-12">
                        <a href="deleteSong.php?idCancion=<?php echo $idCancion; ?>"
                            onclick="return confirm('¿Seguro que deseas eliminar esta canción?')"
                            class="order-2 sm:order-1 flex items-center gap-2 text-error hover:bg-error/10 px-6 py-3 rounded-xl transition-colors font-bold tracking-tight" type="button">
                            <span class="material-symbols-outlined text-xl">delete_forever</span>
                            Eliminar Cancion
                        </a>
                        <div class="order-1 sm:order-2 flex items-center gap-4 w-full sm:w-auto">
                            <a href="dashboard.php" class="flex-1 sm:flex-initial px-8 py-3 rounded-xl border border-outline-variant/30 text-on-surface-variant hover:text-on-surface hover:bg-surface-bright transition-all font-bold"
                             type="button">
                                Cancelar
                            </a>
                            <button class="flex-1 sm:flex-initial bg-gradient-to-br from-primary-dim to-primary text-on-primary-fixed px-10 py-3 rounded-xl font-bold sonic-shadow hover:opacity-90 active:scale-[0.98] transition-all"
                             type="submit">
                                Guardar Cambios
                            </button>
                        </div>
                    </div>               
                </form>
            </div>
        </section>

    </main>

    <script>
        function selectRating(val) {
            document.getElementById('rating-value').value = val;
            const buttons = document.querySelectorAll('[onclick^="selectRating"]');
            buttons.forEach((btn, i) => {
                if (i + 1 === val) {
                    btn.className = 'w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm bg-primary text-on-primary-fixed shadow-lg shadow-primary/20';
                } else {
                    btn.className = 'w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm bg-surface-container-highest text-on-surface-variant hover:bg-primary/20 transition-all border border-outline-variant/10';
                }
            });
        }
    </script>

</body>
</html>
