<?php
    require_once("../db/OracleDB.php");
    $mensaje = "";
    $tipo = "";


    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $nombre = $_POST["fullname"];
        $correo = $_POST["email"];
        $password = $_POST["password"];

        $db = new OracleDB();
        $conn = $db->getConn();

        $sql = "BEGIN sp_registrar_usuario(:nombre, :correo, :password, :resultado); END;";

        $stmt = oci_parse($conn, $sql);

        oci_bind_by_name($stmt, ":nombre", $nombre);
        oci_bind_by_name($stmt, ":correo", $correo);
        oci_bind_by_name($stmt, ":password", $password);
        oci_bind_by_name($stmt, ":resultado", $resultado, 32);

        oci_execute($stmt);

        $db->close();

        // Manejo del resultado
        if ($resultado == 0) {
            $mensaje = "Usuario registrado correctamente";
            $tipo = "success";
        } elseif ($resultado == 1) {
            $mensaje = "El correo ya está registrado";
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
    <title>Sign Up | SoundShelf</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Manrope:wght@700;800&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="../css/singUp.css"/>
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
<body class="bg-background text-on-surface font-body antialiased selection:bg-primary/30 selection:text-primary min-h-screen flex items-center justify-center p-6 auth-grid-bg">
    <div class="w-full max-w-[560px] overflow-hidden rounded-xl shadow-[0_20px_40px_rgba(0,0,0,0.4)] bg-surface-container-low">
        <!-- Signup Form -->
        <div class="p-8 md:p-12 lg:p-16 flex flex-col justify-center bg-surface-dim">
            <div class="w-full max-w-md mx-auto">
                <header class="mb-10 text-center">
                    <h1 class="font-headline text-xl font-extrabold tracking-tighter text-primary">
                        SoundShelf
                    </h1>
                </header>
                <div class="mb-10 text-center">
                    <h3 class="font-headline text-3xl font-bold text-on-surface mb-2">Crear Cuenta</h3>
                    <p class="text-on-surface-variant">Registarte para disfrutar de tu musica.</p>
                </div>

                <form method="POST" action="" class="space-y-6">
                    <!-- Error Placeholder -->
                    <?php if ($mensaje != ""): ?>
                        <div class="flex items-center gap-3 p-4 border rounded-lg text-sm
                            <?php echo ($tipo == 'success') 
                                ? 'bg-green-600 text-white border-green-700' 
                                : 'bg-error-container/20 border-error/30 text-error-dim'; ?>">
                            
                            <span class="material-symbols-outlined text-lg">
                                <?php echo ($tipo == 'success') ? 'check_circle' : 'error'; ?>
                            </span>

                            <span><?php echo $mensaje; ?></span>
                        </div>
                    <?php endif; ?>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Full Name -->
                        <div class="space-y-2">
                            <label class="block font-label text-xs font-semibold uppercase tracking-wider text-on-surface-variant ml-1"
                             for="fullname">Nombre Usuario
                            </label>
                            <div class="relative group">
                                <input class="w-full h-14 px-5 bg-surface-container-highest border-none rounded-xl text-on-surface placeholder:text-outline/50 focus:ring-1 focus:ring-primary/40 transition-all outline-none"
                                 id="fullname" name="fullname" placeholder="Usuario" type="text" required/>
                            </div>
                        </div>
                     
                    </div>
                    <!-- Email -->
                    <div class="space-y-2">
                        <label class="block font-label text-xs font-semibold uppercase tracking-wider text-on-surface-variant ml-1"
                         for="email">Correo
                        </label>
                        <div class="relative group">
                            <input class="w-full h-14 px-5 bg-surface-container-highest border-none rounded-xl text-on-surface placeholder:text-outline/50 focus:ring-1 focus:ring-primary/40 transition-all outline-none" 
                             id="email" name="email" placeholder="correo@ejemplo.com" type="email" required/>
                        </div>
                    </div>
                    <!-- Password -->
                    <div class="space-y-2">
                        <label class="block font-label text-xs font-semibold uppercase tracking-wider text-on-surface-variant ml-1"
                         for="password">Password
                        </label>
                        <div class="relative group">
                            <input class="w-full h-14 px-5 bg-surface-container-highest border-none rounded-xl text-on-surface placeholder:text-outline/50 focus:ring-1 focus:ring-primary/40 transition-all outline-none"
                             id="password" name="password" placeholder="••••••••" type="password" required/>
                            <button class="absolute right-4 top-1/2 -translate-y-1/2 text-on-surface-variant hover:text-on-surface" type="button">
                                <span class="material-symbols-outlined text-xl">visibility</span>
                            </button>
                        </div>
                    </div>
                    <!-- Primary Action -->
                    <div class="pt-4">
                        <button class="sonic-gradient-btn w-full h-14 rounded-xl font-headline font-bold text-on-primary-fixed text-lg shadow-[0_8px_30px_rgba(186,158,255,0.25)] hover:shadow-[0_8px_30px_rgba(186,158,255,0.4)] hover:scale-[1.02] active:scale-[0.98] transition-all duration-200"
                         type="submit">
                            Crear Cuenta
                        </button>
                    </div>
                </form>
                <!-- Footer Link -->
                <div class="mt-10 text-center">
                    <p class="text-on-surface-variant text-sm">
                        Ya tienes uan cuenta registrada?
                        <a class="text-primary font-bold ml-1 hover:text-primary-container transition-colors"
                         href="logIn.php">Inicia sesion aqui</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
