<header class="fixed top-0 right-0 left-64 h-20 z-40 bg-[#060e20]/80 backdrop-blur-xl flex justify-end items-center px-10">
    <div class="flex items-center gap-6">
        
        <span class="text-sm text-on-surface font-label uppercase tracking-widest text-on-surface-variant">
            <?php  echo $_SESSION["nombreUsuario"]; ?>
        </span>
        
        <div class="h-8 w-[1px] bg-outline-variant/20 mx-2"></div>
        <a href="logout.php" 
            class="text-sm font-label uppercase tracking-widest text-on-surface-variant hover:text-error transition-all">
            Salir
        </a>
        <div class="w-10 h-10 rounded-full overflow-hidden border-2 border-primary/20">
            <img alt="User Avatar" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCf4zUw9EhAaOULoSE8epDcZTMzmDXohwVYJeXdx3QxQ1rEBqPOd4VUsp9EG-uuUH1cEBWRKbL3P12bvJ_BVfEOR7UogpHL3YzzL7jqif8zNlRkkPwSyfdhIdeRT1gdqWT3UgoveG_qZS1j5uDsemYhNg3gDuF0iW-ZsOA21kXDVa-2b9us_gjDTYaUyK0qvsjWK4twCkIyhjHi6FJ7TQbNiuf9VeTpgVJMlnB575BPHV8czyW1MkqoAcY87Zq_9vlLZPYEgee670N2"/>
        </div>
    </div>
</header>