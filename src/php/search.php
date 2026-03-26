<?php 
    session_start();

    if (!isset($_SESSION["idUsuario"])) {
        header("Location: ../index.php");
        exit();
    }
?>
<!DOCTYPE html>
<html class="dark" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Busqueda | SoundShelf</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="../css/search.css"/>
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
<body class="bg-background text-on-surface">

    <!-- SideNavBar -->
    <?php
        $active_page = 'search';
        include '../includes/sideBar.php';
    ?>

    <!-- TopNavBar -->
    <header class="fixed top-0 right-0 left-64 h-20 z-40 bg-[#060e20]/80 dark:bg-slate-950/80 backdrop-blur-xl shadow-[0_20px_40px_rgba(0,0,0,0.12)] flex justify-between items-center px-10">
        <div class="flex items-center gap-6 flex-1 max-w-2xl">
            <div class="relative w-full group">
                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant group-focus-within:text-[#ba9eff] transition-colors">search</span>
                <input class="w-full bg-surface-container-highest border-none rounded-xl py-3 pl-12 pr-4 text-on-surface placeholder:text-on-surface-variant/50 focus:ring-1 focus:ring-[#ba9eff]/40 focus:outline-none transition-all font-body text-sm"
                 placeholder="Buscar por titulo..." type="text" value=""/>
            </div>
        </div>
        <div class="flex items-center gap-6">

            <span class="text-sm text-on-surface font-label uppercase tracking-widest text-on-surface-variant">
                <?php  echo $_SESSION["nombreUsuario"]; ?>
            </span>
        
            <div class="h-8 w-[1px] bg-outline-variant/20 mx-2"></div>
            <button class="text-sm font-label uppercase tracking-widest text-on-surface-variant hover:text-error transition-all">Salir</button>
            <div class="w-10 h-10 rounded-full overflow-hidden border-2 border-primary/20">
                <img alt="User Avatar" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCf4zUw9EhAaOULoSE8epDcZTMzmDXohwVYJeXdx3QxQ1rEBqPOd4VUsp9EG-uuUH1cEBWRKbL3P12bvJ_BVfEOR7UogpHL3YzzL7jqif8zNlRkkPwSyfdhIdeRT1gdqWT3UgoveG_qZS1j5uDsemYhNg3gDuF0iW-ZsOA21kXDVa-2b9us_gjDTYaUyK0qvsjWK4twCkIyhjHi6FJ7TQbNiuf9VeTpgVJMlnB575BPHV8czyW1MkqoAcY87Zq_9vlLZPYEgee670N2"/>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="ml-64 pt-28 px-10 pb-20">
        <div class="max-w-7xl mx-auto">

            <!-- Search Results Header -->
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h2 class="headline-font text-on-surface text-4xl font-extrabold tracking-tight">Resultado Busqueda</h2>
                    <p class="text-on-surface-variant text-lg mt-1">Mostrando todas las canciones relacionadas a tu busqueda</p>
                </div>
            </div>

            <!-- Results Table -->
            <section class="bg-surface-container-low rounded-xl overflow-hidden shadow-2xl border border-outline-variant/10">
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
                            <tr class="group hover:bg-surface-bright transition-colors">
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-4">
                                    <img alt="Track Art" class="w-12 h-12 rounded-lg object-cover shadow-lg group-hover:scale-105 transition-transform"
                                     src="../images/musicaIcono.png"/>
                                    <span class="font-semibold text-on-surface text-base">Titulo</span>
                                </div>
                            </td>
                            <td class="px-8 py-6 text-on-surface-variant font-medium">Artista</td>
                            <td class="px-8 py-6 text-on-surface-variant/80 italic font-body">Album</td>
                            <td class="px-8 py-6"><span class="bg-surface-variant text-on-surface-variant text-[10px] px-2 py-1 rounded-full uppercase tracking-tighter font-bold">Genero</span></td>
                            <td class="px-8 py-6"><div class="flex items-center gap-2"><span class="text-primary font-black text-lg">9.2</span></div></td>
                            <td class="px-8 py-6 text-right"><div class="flex justify-end gap-3">
                                <a href="editSong.php" class="p-2 text-on-surface-variant hover:text-primary transition-colors hover:bg-primary/10 rounded-lg"><span class="material-symbols-outlined">edit</span></a> 
                            </td>
                        </tr>
                            
                        </tbody>
                    </table>
                </div>
            </section>

            <!-- End of results -->
            <div class="mt-12 text-center">
                <p class="text-on-surface-variant text-xs uppercase tracking-[0.2em] font-medium">Final Resultados</p>
            </div>

        </div>
    </main>

</body>
</html>
