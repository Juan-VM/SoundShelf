<?php ?>
<!DOCTYPE html>
<html class="dark" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Playlist Management | The Sonic Archive</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Manrope:wght@700;800&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="../css/playlist.css"/>
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
<body class="bg-background text-on-surface font-body selection:bg-primary/30">

    <!-- SideNavBar -->
    <?php
        $active_page = 'library';
        include '../includes/sideBar.php';
    ?>

    <!-- TopNavBar -->
    <?php include '../includes/topBar.php'; ?>

    <!-- Main Canvas -->
    <main class="ml-64 pt-20 p-12 min-h-screen">

        <!-- Playlist Header Section -->
        <section class="flex flex-col md:flex-row gap-12 items-end mb-16 relative">
            <div class="relative group">
                <div class="w-72 h-72 rounded-xl overflow-hidden sonic-shadow ring-1 ring-primary/20">
                    <img alt="Playlist Cover" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAuDjCBHHvXPa1hMgay5f5JfVzPedR8CpEsVdMoYB5YmOL4H4AMnyTiOjxPp9klxu8-ILetBWPySqenjzCb0zbnvu5BMXDkIW_40HNWchTVVUqG-_XcNjwidEo4OVQKBuv2ZJdUDRfXMVD8Y45sL0qifsX2u3P1JnVU3hDXdI6v7raw5zlnLjQAsTbQrIJVe5iTRuaxeqQQbaKI713Y8bCiQwzgs_DOLXoYyCjTVgDd8jCwtqyq1MO6vCUthRHrRnzeI01Jk1QfYuM6"/>
                </div>
            </div>
            <div class="flex-1 flex flex-col gap-4">
                <h2 class="text-6xl font-extrabold font-headline tracking-tighter text-on-surface leading-tight">Midnight Sessions vol. 4</h2>
                <p class="text-on-surface-variant max-w-xl text-lg leading-relaxed">
                    A curated deep-dive into late-night electronic textures, ambient soundscapes, and high-bitrate archival pulses.
                    <span class="text-primary/80">Continuous flow for creative focus.</span>
                </p>
                <div class="flex items-center gap-6 mt-4">
                    <div class="flex flex-col">
                        <span class="text-[10px] uppercase font-label text-on-surface-variant tracking-widest">Total Tracks</span>
                        <span class="text-xl font-bold font-headline text-on-surface">42 Tracks</span>
                    </div>
                    <div class="w-[1px] h-8 bg-outline-variant/30"></div>
                    <div class="flex gap-4">
                        <button class="flex items-center gap-2 text-on-surface-variant hover:text-primary transition-colors text-sm font-label uppercase tracking-widest font-semibold px-4 py-2 bg-surface-container rounded-lg border border-outline-variant/10">
                            <span class="material-symbols-outlined text-lg">edit</span>
                            Edit Playlist Name
                        </button>
                        <button class="flex items-center gap-2 text-on-surface-variant hover:text-error transition-colors text-sm font-label uppercase tracking-widest font-semibold px-4 py-2 bg-surface-container rounded-lg border border-outline-variant/10">
                            <span class="material-symbols-outlined text-lg">delete</span>
                            Delete Playlist
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Track List Section -->
        <section class="bg-surface-container-low rounded-xl overflow-hidden shadow-2xl border border-outline-variant/10 mb-12">
            <div class="flex justify-between items-center p-8 bg-surface-container-low/50">
                <h3 class="text-2xl font-bold font-headline tracking-tight">Archive Tracks</h3>
                <button class="flex items-center gap-2 primary-gradient px-6 py-2.5 rounded-xl text-on-primary-fixed font-bold font-headline text-sm hover:shadow-[0_0_20px_rgba(186,158,255,0.4)] transition-all">
                    <span class="material-symbols-outlined text-lg">add</span>
                    Add Song to Playlist
                </button>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-surface-container-high/50 border-b border-outline-variant/10">
                            <th class="px-8 py-5 text-xs uppercase tracking-widest font-bold text-on-surface-variant">Title</th>
                            <th class="px-8 py-5 text-xs uppercase tracking-widest font-bold text-on-surface-variant">Artist</th>
                            <th class="px-8 py-5 text-xs uppercase tracking-widest font-bold text-on-surface-variant">Album</th>
                            <th class="px-8 py-5 text-xs uppercase tracking-widest font-bold text-on-surface-variant">Genre</th>
                            <th class="px-8 py-5 text-xs uppercase tracking-widest font-bold text-on-surface-variant">Rating</th>
                            <th class="px-8 py-5 text-xs uppercase tracking-widest font-bold text-on-surface-variant text-right">Manage</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline-variant/5">
                        <!-- Row 1 -->
                        <tr class="group hover:bg-surface-bright transition-colors">
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-4">
                                    <img alt="Track Art" class="w-12 h-12 rounded-lg object-cover shadow-lg group-hover:scale-105 transition-transform" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDtecnEOBbBYf8CAS2YgVu_5ErRf8_702wqaU-zjHfL3llj1S1mTb4M-Zls3BVy4nrRo446AmCJ3KwJL4CZSwGHd9RDKX5DcK2jDzYjpnw8lu8a4gpAHUwttwsQTGBXCG8VoLOuwMu8It_p6uxrhuW_NP8v2PL3F3FNCN3yBefed5Rnrl0fAibU9wsJ4s1fikq9bZwSW5d5OXCeDbKbYXTxyO0VschkKOM5Wp50NHN6uJum4O6SYNhqtU1VBz2PmHSbpWYzqg6wllkB"/>
                                    <span class="font-semibold text-on-surface text-base">Hyper-Space Resonance</span>
                                </div>
                            </td>
                            <td class="px-8 py-6 text-on-surface-variant font-medium">Lumina Pulse</td>
                            <td class="px-8 py-6 text-on-surface-variant/80 italic font-body">Neon Drift</td>
                            <td class="px-8 py-6"><span class="bg-surface-variant text-on-surface-variant text-[10px] px-2 py-1 rounded-full uppercase tracking-tighter font-bold">Synthwave</span></td>
                            <td class="px-8 py-6"><div class="flex items-center gap-2"><span class="text-primary font-black text-lg">9.2</span></div></td>
                            <td class="px-8 py-6 text-right"><div class="flex justify-end gap-3"><button class="p-2 text-on-surface-variant hover:text-primary transition-colors hover:bg-primary/10 rounded-lg"><span class="material-symbols-outlined">edit</span></button><button class="p-2 text-on-surface-variant hover:text-error transition-colors hover:bg-error/10 rounded-lg"><span class="material-symbols-outlined">delete</span></button></div></td>
                        </tr>
                        <!-- Row 2 -->
                        <tr class="group hover:bg-surface-bright transition-colors">
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-4">
                                    <img alt="Track Art" class="w-12 h-12 rounded-lg object-cover shadow-lg group-hover:scale-105 transition-transform" src="https://lh3.googleusercontent.com/aida-public/AB6AXuA7YBtkS1fC6bWDI-dqB_JkbiQmi_Hr394zMIxCgT40Pk1nA8dyjFb1K55rrjWGLMLcl7u5fyejddqxy2Nn2JURnJIFRGmrWZ2VjPC9hG_j8IEVI0f2sg28PsPnEp40g_FG0jsdav2qqmlnl_Aj5BdcC2p17uOgU34VNoxLz-60gJ86rkf0ZnzxSIUeUuBd3dSeZAL0uDMLg_3U_CCrduzt9MnDL_LabnExa6MC2Tt5cwbzjBqkJTBtxD5fR7YHz7JspBM2EwXFkuls"/>
                                    <span class="font-semibold text-on-surface text-base">Midnight Echoes</span>
                                </div>
                            </td>
                            <td class="px-8 py-6 text-on-surface-variant font-medium">The Archive</td>
                            <td class="px-8 py-6 text-on-surface-variant/80 italic font-body">Dark Matter</td>
                            <td class="px-8 py-6"><span class="bg-surface-variant text-on-surface-variant text-[10px] px-2 py-1 rounded-full uppercase tracking-tighter font-bold">Ambient</span></td>
                            <td class="px-8 py-6"><div class="flex items-center gap-2"><span class="text-primary font-black text-lg">8.5</span></div></td>
                            <td class="px-8 py-6 text-right"><div class="flex justify-end gap-3"><button class="p-2 text-on-surface-variant hover:text-primary transition-colors hover:bg-primary/10 rounded-lg"><span class="material-symbols-outlined">edit</span></button><button class="p-2 text-on-surface-variant hover:text-error transition-colors hover:bg-error/10 rounded-lg"><span class="material-symbols-outlined">delete</span></button></div></td>
                        </tr>
                        <!-- Row 3 -->
                        <tr class="group hover:bg-surface-bright transition-colors">
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-4">
                                    <img alt="Track Art" class="w-12 h-12 rounded-lg object-cover shadow-lg group-hover:scale-105 transition-transform" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDl-VNlxjGie8yms3V8ZDlxVUcNmhdtwxHFyhIJq0QfYqWw6WiAzJKrwE5DqkUoqoL5_-RehJ7Fw73CzZAIVpsNKfCG7rJ4fOb4mTBf-7JWPsQBCnlnRTRGExFtYvRJXpZbjBbghIPGTKC2jL4-_52IOmCAUhH5N5MrwPxbJI4ST0Die3uZq-0dUq_5-3xNxjnfF0KgmmR1TOGpGsSvJNLQX7XJr2nlb87_cxK7SdogO-E1Nif70NcYn_LJp-PGLj6blmygv3U-8xU3"/>
                                    <span class="font-semibold text-on-surface text-base">Glitch Protocol X</span>
                                </div>
                            </td>
                            <td class="px-8 py-6 text-on-surface-variant font-medium">Cyber Link</td>
                            <td class="px-8 py-6 text-on-surface-variant/80 italic font-body">Node Origins</td>
                            <td class="px-8 py-6"><span class="bg-surface-variant text-on-surface-variant text-[10px] px-2 py-1 rounded-full uppercase tracking-tighter font-bold">IDM</span></td>
                            <td class="px-8 py-6"><div class="flex items-center gap-2"><span class="text-tertiary font-black text-lg">7.1</span></div></td>
                            <td class="px-8 py-6 text-right"><div class="flex justify-end gap-3"><button class="p-2 text-on-surface-variant hover:text-primary transition-colors hover:bg-primary/10 rounded-lg"><span class="material-symbols-outlined">edit</span></button><button class="p-2 text-on-surface-variant hover:text-error transition-colors hover:bg-error/10 rounded-lg"><span class="material-symbols-outlined">delete</span></button></div></td>
                        </tr>
                        <!-- Row 4 -->
                        <tr class="group hover:bg-surface-bright transition-colors">
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-4">
                                    <img alt="Track Art" class="w-12 h-12 rounded-lg object-cover shadow-lg group-hover:scale-105 transition-transform" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAfC7kM3PMycuWVzAOTdHBuenig1u9ixgnTgAebQ2QVSZCcroidIdEbRQPEb7hFfq91UYen1JWocD-4xVnUZa16iXnVCf9uvKg0d5LZZvclBvbLnW1bjv17HPF-tJkzm9r4SiREe9N_DGhwAhFXu_FUaUlB8LFGP6Nv-dOIN3Nl9fyHHkn94flagVBVUX_HBw4bAPWX9Kt_5ybWclz1b0bg-ZVefSXVy8hW6ols_CZWZ0AObjk3gJXaWKZIRU_86ci-4vhT_fCXsxL9"/>
                                    <span class="font-semibold text-on-surface text-base">Sub-Atomic Bass</span>
                                </div>
                            </td>
                            <td class="px-8 py-6 text-on-surface-variant font-medium">Freq Modulator</td>
                            <td class="px-8 py-6 text-on-surface-variant/80 italic font-body">Single Pulse</td>
                            <td class="px-8 py-6"><span class="bg-surface-variant text-on-surface-variant text-[10px] px-2 py-1 rounded-full uppercase tracking-tighter font-bold">Deep Dub</span></td>
                            <td class="px-8 py-6"><div class="flex items-center gap-2"><span class="text-primary font-black text-lg">9.8</span></div></td>
                            <td class="px-8 py-6 text-right"><div class="flex justify-end gap-3"><button class="p-2 text-on-surface-variant hover:text-primary transition-colors hover:bg-primary/10 rounded-lg"><span class="material-symbols-outlined">edit</span></button><button class="p-2 text-on-surface-variant hover:text-error transition-colors hover:bg-error/10 rounded-lg"><span class="material-symbols-outlined">delete</span></button></div></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>

    </main>

</body>
</html>
