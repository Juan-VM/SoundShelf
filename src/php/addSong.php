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


    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $titulo = $_POST["track_title"];
        $artista = $_POST["lead_artist"];
        $album = $_POST["album_title"];
        $genero = $_POST["genre"];
        $calificacion = $_POST["rating"];
        $comentario = $_POST["notes"];

        $sqlInsertCancion = "BEGIN SP_INSERT_CANCION(:idUsuario, :titulo, :genero, :calificacion, :comentario, :artista, :album); END;";
        $stmtInsertCancion = oci_parse($conn, $sqlInsertCancion);

        oci_bind_by_name($stmtInsertCancion, ":idUsuario", $idUsuario);
        oci_bind_by_name($stmtInsertCancion, ":titulo", $titulo);
        oci_bind_by_name($stmtInsertCancion, ":genero", $genero);
        oci_bind_by_name($stmtInsertCancion, ":calificacion", $calificacion);
        oci_bind_by_name($stmtInsertCancion, ":comentario", $comentario);
        oci_bind_by_name($stmtInsertCancion, ":artista", $artista);
        oci_bind_by_name($stmtInsertCancion, ":album", $album);

        if (oci_execute($stmtInsertCancion)) {
            $_SESSION["mensaje"] = "Canción agregada correctamente";
        } else {
            $_SESSION["mensaje"] = "Error al agregar la canción";
        }

        // Evita reenvío del formulario
        header("Location: addSong.php");
        exit();
    }
?>
<!DOCTYPE html>
<html class="dark" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Nueva Cancion | SoundShelf</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="../css/addSong.css"/>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "on-surface": "#dee5ff",
                        "secondary-fixed-dim": "#dab4ff",
                        "tertiary-dim": "#f0779d",
                        "on-tertiary": "#6a0934",
                        "primary-dim": "#8455ef",
                        "outline": "#6d758c",
                        "secondary-fixed": "#e4c6ff",
                        "surface-container-high": "#141f38",
                        "on-tertiary-fixed": "#380018",
                        "on-error": "#490013",
                        "inverse-surface": "#faf8ff",
                        "on-background": "#dee5ff",
                        "on-secondary": "#390068",
                        "surface-tint": "#ba9eff",
                        "primary-fixed": "#ae8dff",
                        "inverse-on-surface": "#4d556b",
                        "tertiary-fixed-dim": "#f67ca3",
                        "on-tertiary-container": "#59002a",
                        "on-primary-fixed": "#000000",
                        "surface-container": "#0f1930",
                        "on-primary": "#39008c",
                        "surface-container-low": "#091328",
                        "surface-container-highest": "#192540",
                        "outline-variant": "#40485d",
                        "on-secondary-container": "#e3c4ff",
                        "tertiary": "#ff97b5",
                        "inverse-primary": "#6e3bd7",
                        "secondary": "#c08cf7",
                        "surface": "#060e20",
                        "primary-fixed-dim": "#a27cff",
                        "on-tertiary-fixed-variant": "#701039",
                        "surface-variant": "#192540",
                        "error": "#ff6e84",
                        "tertiary-container": "#fd81a8",
                        "primary-container": "#ae8dff",
                        "background": "#060e20",
                        "primary": "#ba9eff",
                        "error-container": "#a70138",
                        "on-primary-fixed-variant": "#370086",
                        "secondary-dim": "#bb87f1",
                        "on-secondary-fixed-variant": "#69379c",
                        "on-error-container": "#ffb2b9",
                        "tertiary-fixed": "#ff8eb0",
                        "on-primary-container": "#2b006e",
                        "surface-container-lowest": "#000000",
                        "secondary-container": "#5e2c91",
                        "on-surface-variant": "#a3aac4",
                        "error-dim": "#d73357",
                        "surface-dim": "#060e20",
                        "on-secondary-fixed": "#4b147d",
                        "surface-bright": "#1f2b49"
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
<body class="bg-background text-on-surface font-body selection:bg-primary-dim selection:text-white">

    
    <!-- SideNavBar -->
    <aside class="bg-[#091328] dark:bg-slate-950 h-screen w-64 fixed left-0 top-0 flex flex-col h-full py-8 px-6 z-50">
        <div class="mb-12">
            <h1 class="text-2xl font-extrabold tracking-tighter text-[#ba9eff] dark:text-violet-400 font-headline">SoundShelf</h1>
            <p class="text-[10px] uppercase tracking-widest text-on-surface-variant mt-1 font-label">Lo mejor de tu musica</p>
        </div>
        <nav class="flex-1 space-y-2">
            <a class="flex items-center gap-3 py-3 px-4 rounded-lg text-[#ba9eff] dark:text-violet-400 font-bold border-r-4 border-[#ba9eff] dark:border-violet-500 bg-[#1f2b49]/30 dark:bg-slate-900/50 transition-colors duration-200 group"
             href="dashboard.php">
                <span class="material-symbols-outlined">dashboard</span>
                <span class="font-label uppercase text-xs tracking-wider" style="font-size: 15px;">Dashboard</span>
            </a>
            <a class="flex items-center gap-3 py-3 px-4 rounded-lg text-[#a3aac4] dark:text-slate-400 hover:text-[#dee5ff] dark:hover:text-slate-200 hover:bg-[#1f2b49] dark:hover:bg-slate-900 transition-colors duration-200 group"
             href="library.php">
                <span class="material-symbols-outlined">library_music</span>
                <span class="font-label uppercase text-xs tracking-wider" style="font-size: 15px;">Libreria</span>
            </a>
            <a class="flex items-center gap-3 py-3 px-4 rounded-lg text-[#a3aac4] dark:text-slate-400 hover:text-[#dee5ff] dark:hover:text-slate-200 hover:bg-[#1f2b49] dark:hover:bg-slate-900 transition-colors duration-200 group"
             href="search.php">
                <span class="material-symbols-outlined">search</span>
                <span class="font-label uppercase text-xs tracking-wider" style="font-size: 15px;">Busqueda</span>
            </a>
            <a class="flex items-center gap-3 py-3 px-4 rounded-lg text-[#a3aac4] dark:text-slate-400 hover:text-[#dee5ff] dark:hover:text-slate-200 hover:bg-[#1f2b49] dark:hover:bg-slate-900 transition-colors duration-200 group"
             href="profile.php">
                <span class="material-symbols-outlined">person</span>
                <span class="font-label uppercase text-xs tracking-wider" style="font-size: 15px;">Perfil</span>
            </a>
        </nav>
    </aside>


    <!-- Main Content Stage -->
    <main class="ml-64 min-h-screen relative overflow-hidden bg-background">

        <!-- Background Ambient Elements -->
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-primary-dim opacity-[0.03] blur-[120px] rounded-full"></div>
        <div class="absolute top-1/2 -left-24 w-[500px] h-[500px] bg-tertiary-dim opacity-[0.02] blur-[160px] rounded-full"></div>

        <div class="max-w-4xl mx-auto px-12 py-16 relative z-10">

            <!-- Header Section -->
            <header class="mb-12 text-center lg:text-left">
                <h2 class="font-headline text-display-lg font-extrabold text-on-surface tracking-tight leading-none mb-4"
                 style="font-size: 3.5rem;">SoundShelf
                </h2>
                <p class="text-on-surface-variant max-w-xl text-lg font-light leading-relaxed mx-auto lg:mx-0">
                    Agrega tu nueva cancion favorita, puntuala y disfruta de ella.
                </p>
            </header>

            <!-- Registration Form Layout -->
            <div class="max-w-3xl mx-auto lg:mx-0">
                <form method="POST" action="" class="space-y-8">
                    <!-- Action mensage -->
                    <?php if (isset($_SESSION["mensaje"])): ?>
                        <div class="mb-6 p-4 rounded-xl bg-green-500/20 text-green-300 font-semibold text-center">
                            <?php 
                                echo $_SESSION["mensaje"]; 
                                unset($_SESSION["mensaje"]);
                            ?>
                        </div>
                    <?php endif; ?>
                    <!-- Track Details Section -->
                    <div class="space-y-6">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-xs font-semibold text-on-surface-variant px-1" style="font-size: 15px;">Titulo Cancion</label>
                                <input class="w-full bg-surface-container-highest border-0 border-b border-transparent rounded-xl px-5 py-4 text-on-surface placeholder:text-outline-variant transition-all focus:ring-0"
                                 name="track_title" placeholder="Nombre de cancion" type="text" required/>
                            </div>
                            <div class="space-y-2">
                                <label class="text-xs font-semibold text-on-surface-variant px-1" style="font-size: 15px;">Artista</label>
                                <input class="w-full bg-surface-container-highest border-0 border-b border-transparent rounded-xl px-5 py-4 text-on-surface placeholder:text-outline-variant transition-all focus:ring-0"
                                 name="lead_artist" placeholder="Artista" type="text" required/>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-xs font-semibold text-on-surface-variant px-1" style="font-size: 15px;">Album</label>
                                <input class="w-full bg-surface-container-highest border-0 border-b border-transparent rounded-xl px-5 py-4 text-on-surface placeholder:text-outline-variant transition-all focus:ring-0"
                                 name="album_title" placeholder="Album" type="text" required/>
                            </div>
                            <div class="space-y-2 relative">
                                <label class="text-xs font-semibold text-on-surface-variant px-1" style="font-size: 15px;">Genero</label>
                                <select class="w-full appearance-none bg-surface-container-highest border-0 border-b border-transparent rounded-xl px-5 py-4 text-on-surface transition-all focus:ring-0"
                                 name="genre" required>
                                    <option value="" disabled selected>Seleccionar</option>
                                    <option value="Electronica">Electronica</option>
                                    <option value="Jazz Fusion">Jazz Fusion</option>
                                    <option value="Clasica">Clasica</option>
                                    <option value="Ambiente">Ambiente</option>
                                    <option value="Experimental">Experimental</option>
                                    <option value="Rock">Rock</option>
                                    <option value="Regueton">Regueton</option>
                                    <option value="Trap">Trap</option>
                                    <option value="Instrumental">Instrumental</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Archival Rating Section -->
                    <div class="space-y-6 pt-4">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="w-1 h-4 bg-tertiary rounded-full"></span>
                            <h3 class="text-xs font-bold uppercase tracking-widest text-on-surface-variant">Calificacion</h3>
                        </div>
                        <div class="bg-surface-container-low p-6 rounded-2xl">
                            <label class="block text-xs font-semibold text-on-surface-variant mb-4" style="color: white; font-size: 15px;">
                                Selecciona la calificacion
                            </label>
                            <div class="grid grid-cols-5 sm:grid-cols-10 gap-2">
                                <?php for ($i = 1; $i <= 10; $i++): ?>
                                <button class="py-3 rounded-lg <?= $i === 1 ? 'bg-primary text-on-primary-fixed' : 'bg-surface-container-highest text-on-surface hover:bg-primary hover:text-on-primary-fixed' ?> font-bold transition-all"
                                 type="button" onclick="selectRating(<?= $i ?>)"><?= $i ?></button>
                                <?php endfor; ?>
                            </div>
                            <input type="hidden" name="rating" id="rating-value" value="1"/>
                            <div class="flex justify-between mt-2 px-1">
                                <span class="text-[10px] uppercase tracking-tighter text-outline-variant" style="color: white;">Standar</span>
                                <span class="text-[10px] uppercase tracking-tighter text-outline-variant" style="color: white;">Obra de arte</span>
                            </div>
                        </div>
                    </div>

                    <!-- Notes Section -->
                    <div class="space-y-4">
                        <label class="text-xs font-semibold text-on-surface-variant px-1" style="font-size: 15px;">Comentario</label>
                        <textarea class="w-full bg-surface-container-highest border-0 border-b border-transparent rounded-xl px-5 py-4 text-on-surface placeholder:text-outline-variant transition-all focus:ring-0 resize-none" 
                        name="notes" placeholder="Ingresa el comentario para tu cancion..." rows="4" required></textarea>
                    </div>

                    <!-- Submit -->
                    <div class="pt-6">
                        <button class="w-full py-5 rounded-xl bg-gradient-to-r from-primary-dim to-primary text-on-primary-fixed font-extrabold text-lg tracking-tight sonic-shadow hover:scale-[1.01] active:scale-[0.98] transition-all flex items-center justify-center gap-3" type="submit">
                            <span class="material-symbols-outlined">app_registration</span>
                            Registrar Cancion
                        </button>
                        <a href="dashboard.php" class="w-full py-4 text-on-surface-variant font-bold text-sm hover:text-on-surface transition-colors uppercase tracking-widest text-center block">
                            Cancelar
                        </a>
                    </div>

                </form>
            </div>
        </div>

    </main>

    <script>
        function selectRating(val) {
            document.getElementById('rating-value').value = val;
            const buttons = document.querySelectorAll('[onclick^="selectRating"]');
            buttons.forEach((btn, i) => {
                if (i + 1 === val) {
                    btn.classList.add('bg-primary', 'text-on-primary-fixed');
                    btn.classList.remove('bg-surface-container-highest', 'text-on-surface');
                } else {
                    btn.classList.remove('bg-primary', 'text-on-primary-fixed');
                    btn.classList.add('bg-surface-container-highest', 'text-on-surface');
                }
            });
        }
    </script>

</body>
</html>
