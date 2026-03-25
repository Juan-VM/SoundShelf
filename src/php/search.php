<?php ?>
<!DOCTYPE html>
<html class="dark" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>The Sonic Archive | Search Results</title>
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
                 placeholder="Search for songs, artists, or albums..." type="text" value=""/>
            </div>
        </div>
        <div class="flex items-center gap-6">
            <div class="h-8 w-[1px] bg-outline-variant/20 mx-2"></div>
            <button class="text-sm font-label uppercase tracking-widest text-on-surface-variant hover:text-error transition-all">Logout</button>
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
                    <h2 class="headline-font text-on-surface text-4xl font-extrabold tracking-tight">Search Results</h2>
                    <p class="text-on-surface-variant text-lg mt-1">Showing all songs matching "Ethereal Static"</p>
                </div>
            </div>

            <!-- Results Table -->
            <section class="bg-surface-container-low rounded-xl overflow-hidden shadow-2xl border border-outline-variant/10">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-surface-container-high/50 border-b border-outline-variant/10">
                                <th class="px-8 py-5 text-xs uppercase tracking-widest font-bold text-on-surface-variant">Title</th>
                                <th class="px-8 py-5 text-xs uppercase tracking-widest font-bold text-on-surface-variant">Artist</th>
                                <th class="px-8 py-5 text-xs uppercase tracking-widest font-bold text-on-surface-variant">Album</th>
                                <th class="px-8 py-5 text-xs uppercase tracking-widest font-bold text-on-surface-variant">Genre</th>
                                <th class="px-8 py-5 text-xs uppercase tracking-widest font-bold text-on-surface-variant">Rating</th>
                                <th class="px-8 py-5 text-xs uppercase tracking-widest font-bold text-on-surface-variant text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-outline-variant/5">
                            <!-- Row 1 -->
                            <tr class="group hover:bg-surface-bright transition-colors">
                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-4">
                                        <img class="w-12 h-12 rounded-lg object-cover shadow-lg group-hover:scale-105 transition-transform" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCMHVdu8BwpqKbY85-yrSAipUkKIM1hTUXchGU_VwdGT7ofcVR1zHH7WOSE_JAHNfh3WEbOQCre6vhIvmBAL24j59ETeQ6N2npqusDlJm3SQnO5ZDDKStFAthIQWTuGpnyhmIECAuMfH8qTonhi-wq0BZ6QjDiHkZnO0sqL_zzACl8Hql-3NME5iuJvwpe07bUy3ZhEQmIMGo25MXK-9IQM4PMD6GT-lhKfP-h4GhqCNkjIS_s_4092ynwRhyB6jLSCooPhSEshzlcS" alt="Midnight Resonance"/>
                                        <span class="font-semibold text-on-surface text-base">Midnight Resonance</span>
                                    </div>
                                </td>
                                <td class="px-8 py-6 text-on-surface-variant font-medium">Crystal Architect</td>
                                <td class="px-8 py-6 text-on-surface-variant/80 italic font-body">Ethereal Static</td>
                                <td class="px-8 py-6"><span class="bg-surface-variant text-on-surface-variant text-[10px] px-2 py-1 rounded-full uppercase tracking-tighter font-bold">Electronica</span></td>
                                <td class="px-8 py-6"><span class="text-primary font-black text-lg">9.2</span></td>
                                <td class="px-8 py-6 text-right"><div class="flex justify-end gap-3"><button class="p-2 text-on-surface-variant hover:text-primary transition-colors hover:bg-primary/10 rounded-lg"><span class="material-symbols-outlined">edit</span></button><button class="p-2 text-on-surface-variant hover:text-error transition-colors hover:bg-error/10 rounded-lg"><span class="material-symbols-outlined">delete</span></button></div></td>
                            </tr>
                            <!-- Row 2 -->
                            <tr class="group hover:bg-surface-bright transition-colors">
                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-4">
                                        <img class="w-12 h-12 rounded-lg object-cover shadow-lg group-hover:scale-105 transition-transform" src="https://lh3.googleusercontent.com/aida-public/AB6AXuClg6pgROL2_hzQ0mWrESRr-9V7iJQNit_47yceFx5aQDNSfMUk-t6oglQ-i-cJg7wa5PbGV-Fj9Aowol0oZ0g4Lx2V6T0T7NcMYzxzZRm2LcNqZE0WT7iayFqCJUp9EEPbmq3iTApE85Bx6AzUW2YY3vt8aCONSxLRTkcfjnfX2rB9_4mVelhRuJ2fw-Ffd-ZfhI32za1i3J1wzvM0I9Yq2nKeX0OY7BNZahV8XA2sgjepmpvyhM_pOhxFYW6sL8a1HxtKONvnbh3F" alt="Luminescent Waves"/>
                                        <span class="font-semibold text-on-surface text-base">Luminescent Waves</span>
                                    </div>
                                </td>
                                <td class="px-8 py-6 text-on-surface-variant font-medium">Crystal Architect</td>
                                <td class="px-8 py-6 text-on-surface-variant/80 italic font-body">Ethereal Static</td>
                                <td class="px-8 py-6"><span class="bg-surface-variant text-on-surface-variant text-[10px] px-2 py-1 rounded-full uppercase tracking-tighter font-bold">Ambient</span></td>
                                <td class="px-8 py-6"><span class="text-primary font-black text-lg">8.8</span></td>
                                <td class="px-8 py-6 text-right"><div class="flex justify-end gap-3"><button class="p-2 text-on-surface-variant hover:text-primary transition-colors hover:bg-primary/10 rounded-lg"><span class="material-symbols-outlined">edit</span></button><button class="p-2 text-on-surface-variant hover:text-error transition-colors hover:bg-error/10 rounded-lg"><span class="material-symbols-outlined">delete</span></button></div></td>
                            </tr>
                            <!-- Row 3 -->
                            <tr class="group hover:bg-surface-bright transition-colors">
                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-4">
                                        <img class="w-12 h-12 rounded-lg object-cover shadow-lg group-hover:scale-105 transition-transform" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDSBOddXC9T-6gDkywMUv6fM4IlbiJ22Qtv47gPXV-OpNdkl_3cnl1ZkZEx0pr1LklhjyeRPwQiPNrq9QjhQiXp7DyIae2N2UmAhsX1Kk1D0PKst4Efltpgjp4K1u3A6PGajW8VLQ6F1HVbD1IBvzpDh_DeElbdhe5M5WpTcl-Nb3RaAN_oFky5jPnbRBJl4As0GXBiXBKHl6GMXh5ApgXAFupxjdX70TerhXHvICCFcHvjvrq8mrpe8aBsrKDz3nOIMlqY5HL-dQ_x" alt="Neon Pulse"/>
                                        <span class="font-semibold text-on-surface text-base">Neon Pulse (Extended Mix)</span>
                                    </div>
                                </td>
                                <td class="px-8 py-6 text-on-surface-variant font-medium">Digital Warmth</td>
                                <td class="px-8 py-6 text-on-surface-variant/80 italic font-body">Ethereal Static</td>
                                <td class="px-8 py-6"><span class="bg-surface-variant text-on-surface-variant text-[10px] px-2 py-1 rounded-full uppercase tracking-tighter font-bold">Synthwave</span></td>
                                <td class="px-8 py-6"><span class="text-tertiary font-black text-lg">7.9</span></td>
                                <td class="px-8 py-6 text-right"><div class="flex justify-end gap-3"><button class="p-2 text-on-surface-variant hover:text-primary transition-colors hover:bg-primary/10 rounded-lg"><span class="material-symbols-outlined">edit</span></button><button class="p-2 text-on-surface-variant hover:text-error transition-colors hover:bg-error/10 rounded-lg"><span class="material-symbols-outlined">delete</span></button></div></td>
                            </tr>
                            <!-- Row 4 -->
                            <tr class="group hover:bg-surface-bright transition-colors">
                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-4">
                                        <img class="w-12 h-12 rounded-lg object-cover shadow-lg group-hover:scale-105 transition-transform" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDV5eupe5r4__FK6l7Jd8Exy9wWDPipnzCc04GstlzvpRL737v6JDKwWuC53mOy6woPPURWuJO5Z_ElPonULF8YvVMR7ALAlrj3HGtYOY0CDxJsUlht1qs0QrIy9X438YmeN-FrS13jsmJhJ3d74mWlHx3RiVz2ReO4BtEGUU5ixllwkXGzNGexmji0gE2rAuYh9HmGWZqaRV-55f3tUisQvpkoZ_Fqig2Qa1k8-YptO-JyHEeVGzG_wUbnI9-rjj8nAh20QeNotGN2" alt="Static Shadows"/>
                                        <span class="font-semibold text-on-surface text-base">Static Shadows</span>
                                    </div>
                                </td>
                                <td class="px-8 py-6 text-on-surface-variant font-medium">Ambient Archives</td>
                                <td class="px-8 py-6 text-on-surface-variant/80 italic font-body">Ethereal Static</td>
                                <td class="px-8 py-6"><span class="bg-surface-variant text-on-surface-variant text-[10px] px-2 py-1 rounded-full uppercase tracking-tighter font-bold">Lo-Fi</span></td>
                                <td class="px-8 py-6"><span class="text-primary font-black text-lg">9.5</span></td>
                                <td class="px-8 py-6 text-right"><div class="flex justify-end gap-3"><button class="p-2 text-on-surface-variant hover:text-primary transition-colors hover:bg-primary/10 rounded-lg"><span class="material-symbols-outlined">edit</span></button><button class="p-2 text-on-surface-variant hover:text-error transition-colors hover:bg-error/10 rounded-lg"><span class="material-symbols-outlined">delete</span></button></div></td>
                            </tr>
                            <!-- Row 5 -->
                            <tr class="group hover:bg-surface-bright transition-colors">
                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-4">
                                        <img class="w-12 h-12 rounded-lg object-cover shadow-lg group-hover:scale-105 transition-transform" src="https://lh3.googleusercontent.com/aida-public/AB6AXuB6yVsGuSzLot_GLepVa86UOcz_folYEjMNEjo2oyn8GojKLUoX9SmTddDPpSB-ZFl1di5TSnDjbyjWXvcqlgdB9-8eAF_-hfdhJGAfkNukSHoPyd91wAaUknLEWXpwhTlzh6Nq7v4_SyphA15hzYKGmCPoUqUi-2Zw3rKzwrGvo-8DVTcXS9AUj2-SUnkoxCPPRWSo_66EKCy1DVTsLQ2gTs2ulY4xnajpz4Rig49E6cAYas5El7O9RKqbb738QjNory9b3hD2zKUa" alt="Digital Dawn"/>
                                        <span class="font-semibold text-on-surface text-base">Digital Dawn</span>
                                    </div>
                                </td>
                                <td class="px-8 py-6 text-on-surface-variant font-medium">Digital Warmth</td>
                                <td class="px-8 py-6 text-on-surface-variant/80 italic font-body">Ethereal Static</td>
                                <td class="px-8 py-6"><span class="bg-surface-variant text-on-surface-variant text-[10px] px-2 py-1 rounded-full uppercase tracking-tighter font-bold">Electronica</span></td>
                                <td class="px-8 py-6"><span class="text-primary font-black text-lg">9.0</span></td>
                                <td class="px-8 py-6 text-right"><div class="flex justify-end gap-3"><button class="p-2 text-on-surface-variant hover:text-primary transition-colors hover:bg-primary/10 rounded-lg"><span class="material-symbols-outlined">edit</span></button><button class="p-2 text-on-surface-variant hover:text-error transition-colors hover:bg-error/10 rounded-lg"><span class="material-symbols-outlined">delete</span></button></div></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>

            <!-- End of results -->
            <div class="mt-12 text-center">
                <p class="text-on-surface-variant text-xs uppercase tracking-[0.2em] font-medium">End of Results</p>
            </div>

        </div>
    </main>

</body>
</html>
