<?php ?>
<!DOCTYPE html>
<html class="dark" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Nueva Lista | SoundShelf</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Manrope:wght@700;800&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="../css/addPlaylist.css"/>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "secondary": "#c08cf7",
                        "on-tertiary-fixed-variant": "#701039",
                        "surface-variant": "#192540",
                        "surface-container": "#0f1930",
                        "tertiary-fixed-dim": "#f67ca3",
                        "surface-container-low": "#091328",
                        "on-tertiary": "#6a0934",
                        "error-dim": "#d73357",
                        "surface-container-highest": "#192540",
                        "outline-variant": "#40485d",
                        "on-secondary-container": "#e3c4ff",
                        "on-primary-fixed-variant": "#370086",
                        "secondary-container": "#5e2c91",
                        "secondary-dim": "#bb87f1",
                        "on-primary-container": "#2b006e",
                        "on-error-container": "#ffb2b9",
                        "primary-fixed-dim": "#a27cff",
                        "on-error": "#490013",
                        "surface-bright": "#1f2b49",
                        "on-secondary": "#390068",
                        "tertiary-fixed": "#ff8eb0",
                        "primary-container": "#ae8dff",
                        "background": "#060e20",
                        "secondary-fixed": "#e4c6ff",
                        "surface-container-high": "#141f38",
                        "inverse-on-surface": "#4d556b",
                        "tertiary": "#ff97b5",
                        "inverse-primary": "#6e3bd7",
                        "on-tertiary-container": "#59002a",
                        "primary-fixed": "#ae8dff",
                        "on-secondary-fixed-variant": "#69379c",
                        "error-container": "#a70138",
                        "tertiary-container": "#fd81a8",
                        "surface-tint": "#ba9eff",
                        "error": "#ff6e84",
                        "primary": "#ba9eff",
                        "on-tertiary-fixed": "#380018",
                        "on-secondary-fixed": "#4b147d",
                        "surface-dim": "#060e20",
                        "surface-container-lowest": "#000000",
                        "secondary-fixed-dim": "#dab4ff",
                        "primary-dim": "#8455ef",
                        "on-primary-fixed": "#000000",
                        "inverse-surface": "#faf8ff",
                        "on-surface-variant": "#a3aac4",
                        "on-surface": "#dee5ff",
                        "surface": "#060e20",
                        "on-primary": "#39008c",
                        "outline": "#6d758c",
                        "tertiary-dim": "#f0779d",
                        "on-background": "#dee5ff"
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
<body class="bg-background text-on-surface">

    <!-- TopNavBar -->
        <?php include '../includes/topBar.php'; ?>

    <!-- SideNavBar -->
    <?php
        $active_page = 'library';
        include '../includes/sideBar.php';
    ?>

    <!-- Main Content Canvas -->
    <main class="md:pl-64 pt-20 min-h-screen flex items-center justify-center p-6">
        <div class="w-full max-w-xl">

            <!-- Header -->
            <div class="mb-12 text-left">
                <h2 class="text-5xl md:text-6xl font-extrabold font-headline leading-tight tracking-tighter text-on-surface">
                    Crear Nueva <br/> <span class="text-primary italic">Lista</span>
                </h2>
            </div>

            <!-- Form Container -->
            <div class="bg-surface-container-low rounded-2xl p-10 shadow-[0_40px_80px_rgba(0,0,0,0.3)] relative overflow-hidden">
                <div class="absolute -top-24 -right-24 w-64 h-64 bg-primary/10 blur-[80px] rounded-full"></div>
                <form method="POST" action="" class="relative z-10 space-y-10">
                    <div class="space-y-3">
                        <label class="block text-sm font-bold text-on-surface-variant uppercase tracking-widest px-1" for="playlist-title">
                            Titulo de la lista
                        </label>
                        <input class="w-full bg-surface-container-highest border-none rounded-xl px-6 py-5 text-xl font-headline text-on-surface placeholder:text-outline focus:ring-2 focus:ring-primary/40 transition-all outline-none"
                         id="playlist-title" name="playlist_title" placeholder="Titulo" type="text"/>
                    </div>
                    <div class="flex flex-col gap-4">
                        <button class="w-full py-5 rounded-xl bg-gradient-to-br from-primary-dim to-primary text-black font-extrabold text-lg font-headline shadow-[0_10px_30px_rgba(186,158,255,0.2)] hover:shadow-[0_15px_40px_rgba(186,158,255,0.3)] transition-all active:scale-[0.98]"
                         type="submit">
                            Crear Lista
                        </button>
                        <a href="library.php" class="w-full py-4 text-on-surface-variant font-bold text-sm hover:text-on-surface transition-colors uppercase tracking-widest text-center block">
                            Cancelar
                        </a>
                </form>
            </div>
        </div>
    </main>

</body>
</html>
