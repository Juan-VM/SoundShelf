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
    $nombre = "";
    $correo = "";
    $totalCanciones = 0;
    $totalListas = 0;


    // Obtener datos para mostrarlos
    $sqlGetUsuario = "BEGIN SP_GET_USUARIO(:id, :nombre, :correo, :canciones, :listas); END;";
    $stmtGetUsuario = oci_parse($conn, $sqlGetUsuario);

    oci_bind_by_name($stmtGetUsuario, ":id", $idUsuario);
    oci_bind_by_name($stmtGetUsuario, ":nombre", $nombre, 100);
    oci_bind_by_name($stmtGetUsuario, ":correo", $correo, 100);
    oci_bind_by_name($stmtGetUsuario, ":canciones", $totalCanciones);
    oci_bind_by_name($stmtGetUsuario, ":listas", $totalListas);

    oci_execute($stmtGetUsuario);

    // Actualiza los datos recibidos en el form
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $_SESSION["nombreUsuario"] = $_POST["display_name"];
        $nuevoNombre = $_POST["display_name"];
        $nuevoCorreo = $_POST["email"];

        $sqlUpdateUsuario = "BEGIN SP_UPDATE_USUARIO(:id, :nombre, :correo); END;";
        $stmtUpdateUsuario = oci_parse($conn, $sqlUpdateUsuario);

        oci_bind_by_name($stmtUpdateUsuario, ":id", $idUsuario);
        oci_bind_by_name($stmtUpdateUsuario, ":nombre", $nuevoNombre);
        oci_bind_by_name($stmtUpdateUsuario, ":correo", $nuevoCorreo);

        oci_execute($stmtUpdateUsuario);

        header("Location: profile.php");
        exit();
    }
?>
<!DOCTYPE html>
<html class="dark" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Perfil | SoundShelf</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Manrope:wght@700;800&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="../css/profile.css"/>
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
<body class="bg-background text-on-surface font-body min-h-screen">

    <!-- SideNavBar -->
    <?php
        $active_page = 'profile';
        include '../includes/sideBar.php';
    ?>

    <!-- TopNavBar -->
    <?php include '../includes/topBar.php'; ?>

    <!-- Main Content -->
    <main class="ml-64 pt-20 p-12 bg-background min-h-screen">
        <div class="max-w-5xl mx-auto">

            <!-- Page Header -->
            <div class="mb-12 flex items-end justify-between">
                <div>
                    <h2 class="text-5xl font-extrabold font-headline text-on-surface tracking-tighter">Configuracion Perfil</h2>
                    <p class="text-on-surface-variant mt-2 font-body max-w-md">Maneja tu identidad de forma segura, actualiza tus datos o visualizalos.</p>
                </div>
                <div class="flex gap-4 pb-2">
                    <a href="dashboard.php" class="px-6 py-2.5 rounded-lg border border-outline-variant/40 text-primary font-semibold hover:bg-surface-bright transition-colors text-sm font-label uppercase tracking-widest">
                        Cancelar
                    </a>
                    <button type="submit" form="profileForm" class="px-6 py-2.5 rounded-lg primary-gradient text-on-primary-fixed font-bold sonic-shadow hover:scale-[1.02] transition-transform text-sm font-label uppercase tracking-widest">
                        Guardar Cambios
                    </button>
                </div>
            </div>

            <!-- Bento Layout -->
            <div class="grid grid-cols-12 gap-8">

                <!-- Profile Identity Card -->
                <div class="col-span-12 lg:col-span-4 space-y-8">
                    <div class="bg-surface-container-low rounded-xl p-8 sonic-shadow border-t border-white/5 relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-primary/10 blur-[60px] -mr-16 -mt-16"></div>
                        <div class="relative flex flex-col items-center">
                            <div class="relative group">
                                <div class="w-40 h-40 rounded-full p-1 bg-gradient-to-tr from-primary to-tertiary">
                                    <div class="w-full h-full rounded-full overflow-hidden border-4 border-[#091328]">
                                        <img alt="Profile" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuC1IsivxJdH1KSNqQ2XCAizowkVtdKNc8I2YO_hGCrkTXeBKdVGTvgkZTvq2hzY23ZIETxGrDgt0d4zp_hVCG7VnLXdTowjyjJ8Fvmmi0jJIzZPHBfqqklKH7nigtJuJ6pvpqRA4xdiyLbIY8pW5s4VvqP6L69ppP7ublEsGv_ANVXV_tPxBEOvU7MlI9tk0PWKJUI06Pz4WeJtMGazl_u8mJ3Wl9se_OlxM4ZWqN2cNF2jamDhVWig20iKMPKBbG_w_of7nXXoGMBV"/>
                                    </div>
                                </div>
                            </div>
                            <h3 class="mt-6 text-2xl font-bold font-headline"><?php echo $nombre; ?></h3>
                            <p class="text-on-surface-variant font-label uppercase text-xs tracking-[0.2em]"><?php echo $correo; ?></p>
                        </div>
                        <div class="mt-10 grid grid-cols-2 gap-2 text-center">
                            <div>
                                <p class="text-xl font-bold font-headline"><?php echo $totalCanciones; ?></p>
                                <p class="text-[10px] text-on-surface-variant font-label uppercase tracking-widest">Canciones</p>
                            </div>
                            <div class="border-l border-outline-variant/10">
                                <p class="text-xl font-bold font-headline"><?php echo $totalListas; ?></p>
                                <p class="text-[10px] text-on-surface-variant font-label uppercase tracking-widest">Listas</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Profile Form -->
                <div class="col-span-12 lg:col-span-8">
                    <div class="bg-surface-container-low rounded-xl p-10 sonic-shadow border-t border-white/5 h-full">
                        <div class="flex justify-between items-center mb-10">
                            <h3 class="text-xl font-bold font-headline">Informacion Personal</h3>
                        </div>
                        <form id="profileForm" method="POST" action="" class="space-y-8">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div class="space-y-2">
                                    <label class="text-[10px] font-label uppercase tracking-[0.2em] text-on-surface-variant ml-1">Nombre Usuario</label>
                                    <input class="w-full bg-surface-container-highest border-none rounded-xl py-3 px-5 focus:ring-1 focus:ring-primary/40 text-on-surface font-medium transition-all outline-none"
                                     type="text" name="display_name" value="<?php echo $nombre; ?>"/>
                                </div>
                                
                            </div>
                            <div class="space-y-2">
                                <label class="text-[10px] font-label uppercase tracking-[0.2em] text-on-surface-variant ml-1">Correo</label>
                                <input class="w-full bg-surface-container-highest border-none rounded-xl py-3 px-5 focus:ring-1 focus:ring-primary/40 text-on-surface font-medium transition-all outline-none"
                                 type="email" name="email" value="<?php echo $correo; ?>"/>
                            </div>
    
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </main>

</body>
</html>
