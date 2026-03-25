<?php
    require_once("../db/OracleDB.php");

    $mensaje = "";
    $tipo = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $correo = $_POST["username"];
        $password = $_POST["password"];

        $db = new OracleDB();
        $conn = $db->getConn();

        $sql = "BEGIN sp_login_usuario(:correo, :password, :resultado, :idUsuario, :nombre); END;";

        $stmt = oci_parse($conn, $sql);

        oci_bind_by_name($stmt, ":correo", $correo);
        oci_bind_by_name($stmt, ":password", $password);
        oci_bind_by_name($stmt, ":resultado", $resultado, 32);
        oci_bind_by_name($stmt, ":idUsuario", $idUsuario, 32);
        oci_bind_by_name($stmt, ":nombre", $nombre, 100);

        oci_execute($stmt);

        $db->close();

        // Manejo del resultado
        if ($resultado == 0) {

            session_start();

            $_SESSION["idUsuario"] = $idUsuario;
            $_SESSION["nombreUsuario"] = $nombre;

            header("Location: dashboard.php");
            exit();

        } elseif ($resultado == 1) {
            $mensaje = "Correo o contraseña incorrectos";
            $tipo = "error";
        } else {
            $mensaje = "Error en el servidor";
            $tipo = "error";
        }
    }
?>



<!DOCTYPE html>
<html class="dark" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Login | SoundShelf</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Manrope:wght@700;800&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="../css/login.css"/>

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
<body class="bg-background font-body text-on-surface min-h-screen flex items-center justify-center relative overflow-hidden">

    <!-- Background Ambient Glows -->
    <div class="absolute top-[-10%] left-[-10%] w-[50%] h-[50%] rounded-full bg-primary/10 blur-[120px]"></div>
    <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] rounded-full bg-tertiary/5 blur-[100px]"></div>

    <main class="w-full max-w-md px-6 relative z-10">
        <!-- Logo Section -->
        <div class="text-center mb-10">
            <h1 class="font-headline text-3xl font-extrabold tracking-tighter text-primary mb-2">SoundShelf</h1>
            <p class="font-label text-on-surface-variant text-sm uppercase tracking-widest">Lo mejor de tu musica</p>
        </div>

        <!-- Login Card -->
        <div class="glass-effect rounded-xl p-8 sonic-shadow border border-outline-variant/20">
            <header class="mb-8">
                <h2 class="font-headline text-2xl font-bold text-on-surface">Iniciar Sesion</h2>
                <p class="text-on-surface-variant text-sm mt-1">Bienvenido, ingresa tus datos</p>
            </header>

            <form action="" method="POST" class="space-y-6">
                <!-- Error Placeholder -->
                <?php if ($mensaje != ""): ?>
                    <div class="flex items-center gap-3 p-4 border rounded-lg text-sm
                        <?php echo ($tipo == 'error') 
                            ? 'bg-error-container/20 border-error/30 text-error-dim' 
                            : 'bg-green-600 text-white'; ?>">
                        
                        <span class="material-symbols-outlined text-lg">
                            <?php echo ($tipo == 'error') ? 'error' : 'check_circle'; ?>
                        </span>

                        <span><?php echo $mensaje; ?></span>
                    </div>
                <?php endif; ?>

                <!-- Input Groups -->
                <div class="space-y-4">
                    <div class="space-y-2">
                        <label class="font-label text-xs uppercase font-semibold text-on-surface-variant tracking-wider ml-1" for="username">
                            Correo
                        </label>
                        <div class="relative group">
                            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant group-focus-within:text-primary transition-colors">person</span>
                            <input class="w-full bg-surface-container-highest border-none rounded-lg py-3.5 pl-12 pr-4 text-on-surface placeholder:text-outline/60 focus:ring-1 focus:ring-primary/40 transition-all outline-none"
                             id="username" name="username" placeholder="correo@gmail.com" type="text"/>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <div class="relative group">
                            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant group-focus-within:text-primary transition-colors">lock</span>
                            <input class="w-full bg-surface-container-highest border-none rounded-lg py-3.5 pl-12 pr-4 text-on-surface placeholder:text-outline/60 focus:ring-1 focus:ring-primary/40 transition-all outline-none"
                             id="password" name="password" placeholder="••••••••" type="password"/>
                            <button class="absolute right-4 top-1/2 -translate-y-1/2 text-on-surface-variant hover:text-on-surface" type="button">
                                <span class="material-symbols-outlined text-xl">visibility</span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="pt-2">
                    <button class="w-full primary-gradient text-on-primary-fixed font-headline font-bold py-3.5 rounded-lg shadow-[0_8px_20px_rgba(186,158,255,0.2)] hover:scale-[1.02] active:scale-[0.98] transition-all" type="submit">
                        <p class="btn-login">Ingresar</p>
                    </button>
                </div>
            </form>

            <footer class="text-center mt-10">
                <p class="text-sm text-on-surface-variant">
                    No tienes una cuenta?
                    <a class="text-primary font-semibold hover:underline decoration-primary/30 underline-offset-4 transition-all"
                     href="singUp.php">Registrate aqui</a>
                </p>
            </footer>
        </div>

    </main>

    <!-- Decorative Element: Rotating Album Mockup -->
    <div class="hidden lg:block absolute right-[-5%] top-1/2 -translate-y-1/2 opacity-20 pointer-events-none">
        <div class="w-[600px] h-[600px] rounded-full border border-primary/20 flex items-center justify-center">
            <div class="w-[400px] h-[400px] rounded-full border border-primary/10 flex items-center justify-center">
                <div class="w-64 h-64 rounded-xl bg-surface-container-high rotate-12 flex items-center justify-center shadow-2xl overflow-hidden">
                    <img alt="Vinyl Record" class="w-full h-full object-cover opacity-60 mix-blend-luminosity" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDa6LWNr9ykhizkIqaDL--z57rA2LW_OrkOwr_qGsV68bFXeDkew6EmBQDhj11AuIXuK3pXa50bgsSkgepzprurOxjN46rz9uncvXUshTvwuL-fJet74Q7aYCXNC2ZTDiJbgoXHaNgcpASsm4-Aw5C3q2MPfnHmqUfr1sdvwakvotUm2wN3Ho4nDvCNAJJPFAqJv28qD0BydfjBDpIhzdcoRG-IZhTU92GjBS-_9GhOZtQn63jT2GIYP35PLmv-n3SSJm5xdQh1WJcG"/>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
