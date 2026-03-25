<?php
$nav_items = [
    ['href' => 'dashboard.php', 'icon' => 'dashboard',     'label' => 'Dashboard', 'key' => 'dashboard'],
    ['href' => 'library.php',   'icon' => 'library_music', 'label' => 'Libreria',  'key' => 'library'],
    ['href' => 'search.php',    'icon' => 'search',        'label' => 'Busqueda',  'key' => 'search'],
    ['href' => 'profile.php',   'icon' => 'person',        'label' => 'Perfil',    'key' => 'profile'],
];

$active   = "flex items-center gap-3 py-3 px-4 rounded-lg text-[#ba9eff] dark:text-violet-400 font-bold border-r-4 border-[#ba9eff] dark:border-violet-500 bg-[#1f2b49]/30 dark:bg-slate-900/50 transition-colors duration-200 group";
$inactive = "flex items-center gap-3 py-3 px-4 rounded-lg text-[#a3aac4] dark:text-slate-400 hover:text-[#dee5ff] dark:hover:text-slate-200 hover:bg-[#1f2b49] dark:hover:bg-slate-900 transition-colors duration-200 group";
?>

<aside class="bg-[#091328] dark:bg-slate-950 h-screen w-64 fixed left-0 top-0 flex flex-col h-full py-8 px-6 z-50">
    <div class="mb-12">
        <h1 class="text-2xl font-extrabold tracking-tighter text-[#ba9eff] dark:text-violet-400 font-headline">SoundShelf</h1>
        <p class="text-[10px] uppercase tracking-widest text-on-surface-variant mt-1 font-label">Lo mejor de tu musica</p>
    </div>
    <nav class="flex-1 space-y-2">
        <?php foreach ($nav_items as $item): ?>
            <a href="<?= $item['href'] ?>" class="<?= ($active_page ?? '') === $item['key'] ? $active : $inactive ?>">
                <span class="material-symbols-outlined"><?= $item['icon'] ?></span>
                <span class="font-label uppercase text-xs tracking-wider"><?= $item['label'] ?></span>
            </a>
        <?php endforeach; ?>
    </nav>
    <a href="addSong.php" class="mt-8 w-full bg-gradient-to-br from-primary-dim to-primary text-on-primary-fixed font-bold py-3 rounded-xl flex items-center justify-center gap-2 hover:shadow-[0_0_20px_rgba(186,158,255,0.2)] transition-all active:scale-95">
        <span class="material-symbols-outlined">add</span>
        <span class="text-sm">Agregar Cancion</span>
    </a>
</aside>