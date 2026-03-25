<?php ?>
<!DOCTYPE html>
<html class="dark" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Song Registration | Sonic Archive</title>
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
            <h1 class="text-2xl font-extrabold tracking-tighter text-[#ba9eff] dark:text-violet-400 font-headline">The Sonic Archive</h1>
            <p class="text-[10px] uppercase tracking-widest text-on-surface-variant mt-1 font-label">High-Fidelity Curator</p>
        </div>
        <nav class="flex-1 space-y-2">
            <a class="flex items-center gap-3 py-3 px-4 rounded-lg text-[#ba9eff] dark:text-violet-400 font-bold border-r-4 border-[#ba9eff] dark:border-violet-500 bg-[#1f2b49]/30 dark:bg-slate-900/50 transition-colors duration-200 group"
             href="dashboard.php">
                <span class="material-symbols-outlined">dashboard</span>
                <span class="font-label uppercase text-xs tracking-wider">Dashboard</span>
            </a>
            <a class="flex items-center gap-3 py-3 px-4 rounded-lg text-[#a3aac4] dark:text-slate-400 hover:text-[#dee5ff] dark:hover:text-slate-200 hover:bg-[#1f2b49] dark:hover:bg-slate-900 transition-colors duration-200 group"
             href="library.php">
                <span class="material-symbols-outlined">library_music</span>
                <span class="font-label uppercase text-xs tracking-wider">Library</span>
            </a>
            <a class="flex items-center gap-3 py-3 px-4 rounded-lg text-[#a3aac4] dark:text-slate-400 hover:text-[#dee5ff] dark:hover:text-slate-200 hover:bg-[#1f2b49] dark:hover:bg-slate-900 transition-colors duration-200 group"
             href="search.php">
                <span class="material-symbols-outlined">search</span>
                <span class="font-label uppercase text-xs tracking-wider">Search</span>
            </a>
            <a class="flex items-center gap-3 py-3 px-4 rounded-lg text-[#a3aac4] dark:text-slate-400 hover:text-[#dee5ff] dark:hover:text-slate-200 hover:bg-[#1f2b49] dark:hover:bg-slate-900 transition-colors duration-200 group"
             href="profile.php">
                <span class="material-symbols-outlined">person</span>
                <span class="font-label uppercase text-xs tracking-wider">Profile</span>
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
                <h2 class="font-headline text-display-lg font-extrabold text-on-surface tracking-tight leading-none mb-4" style="font-size: 3.5rem;">New Acquisition</h2>
                <p class="text-on-surface-variant max-w-xl text-lg font-light leading-relaxed mx-auto lg:mx-0">
                    Enter the metadata for the high-fidelity asset. The Sonic Archive maintains a strict 24-bit/192kHz standard for all registered entries.
                </p>
            </header>

            <!-- Registration Form Layout -->
            <div class="max-w-3xl mx-auto lg:mx-0">
                <form method="POST" action="" class="space-y-8">

                    <!-- Track Details Section -->
                    <div class="space-y-6">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-xs font-semibold text-on-surface-variant px-1">Track Title</label>
                                <input class="w-full bg-surface-container-highest border-0 border-b border-transparent rounded-xl px-5 py-4 text-on-surface placeholder:text-outline-variant transition-all focus:ring-0" name="track_title" placeholder="e.g. Midnight in Berlin" type="text"/>
                            </div>
                            <div class="space-y-2">
                                <label class="text-xs font-semibold text-on-surface-variant px-1">Lead Artist</label>
                                <input class="w-full bg-surface-container-highest border-0 border-b border-transparent rounded-xl px-5 py-4 text-on-surface placeholder:text-outline-variant transition-all focus:ring-0" name="lead_artist" placeholder="Individual or Group" type="text"/>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-xs font-semibold text-on-surface-variant px-1">Album Title</label>
                                <input class="w-full bg-surface-container-highest border-0 border-b border-transparent rounded-xl px-5 py-4 text-on-surface placeholder:text-outline-variant transition-all focus:ring-0" name="album_title" placeholder="Full Project Name" type="text"/>
                            </div>
                            <div class="space-y-2 relative">
                                <label class="text-xs font-semibold text-on-surface-variant px-1">Genre</label>
                                <select class="w-full appearance-none bg-surface-container-highest border-0 border-b border-transparent rounded-xl px-5 py-4 text-on-surface transition-all focus:ring-0" name="genre">
                                    <option>Select Genre</option>
                                    <option>Electronic</option>
                                    <option>Jazz Fusion</option>
                                    <option>Classical</option>
                                    <option>Ambient</option>
                                    <option>Experimental</option>
                                </select>
                                <span class="material-symbols-outlined absolute right-4 bottom-4 text-on-surface-variant pointer-events-none">keyboard_arrow_down</span>
                            </div>
                        </div>
                    </div>

                    <!-- Archival Rating Section -->
                    <div class="space-y-6 pt-4">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="w-1 h-4 bg-tertiary rounded-full"></span>
                            <h3 class="text-xs font-bold uppercase tracking-widest text-on-surface-variant">Archival Significance</h3>
                        </div>
                        <div class="bg-surface-container-low p-6 rounded-2xl">
                            <label class="block text-xs font-semibold text-on-surface-variant mb-4">Curator Rating (Sonic Fidelity)</label>
                            <div class="grid grid-cols-5 sm:grid-cols-10 gap-2">
                                <?php for ($i = 1; $i <= 10; $i++): ?>
                                <button class="py-3 rounded-lg <?= $i === 8 ? 'bg-primary text-on-primary-fixed' : 'bg-surface-container-highest text-on-surface hover:bg-primary hover:text-on-primary-fixed' ?> font-bold transition-all" type="button" onclick="selectRating(<?= $i ?>)"><?= $i ?></button>
                                <?php endfor; ?>
                            </div>
                            <input type="hidden" name="rating" id="rating-value" value="8"/>
                            <div class="flex justify-between mt-2 px-1">
                                <span class="text-[10px] uppercase tracking-tighter text-outline-variant">Standard</span>
                                <span class="text-[10px] uppercase tracking-tighter text-outline-variant">Master Grade</span>
                            </div>
                        </div>
                    </div>

                    <!-- Notes Section -->
                    <div class="space-y-4">
                        <label class="text-xs font-semibold text-on-surface-variant px-1">Curator's Notes</label>
                        <textarea class="w-full bg-surface-container-highest border-0 border-b border-transparent rounded-xl px-5 py-4 text-on-surface placeholder:text-outline-variant transition-all focus:ring-0 resize-none" name="notes" placeholder="Detailed observations on production quality, mastering chain, and dynamic range..." rows="4"></textarea>
                    </div>

                    <!-- Submit -->
                    <div class="pt-6">
                        <button class="w-full py-5 rounded-xl bg-gradient-to-r from-primary-dim to-primary text-on-primary-fixed font-extrabold text-lg tracking-tight sonic-shadow hover:scale-[1.01] active:scale-[0.98] transition-all flex items-center justify-center gap-3" type="submit">
                            <span class="material-symbols-outlined">app_registration</span>
                            Register Song
                        </button>
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
