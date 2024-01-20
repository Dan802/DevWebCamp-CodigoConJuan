<aside class="dashboard__sidebar">
    <nav class="dashboard__menu">
        <a href="/admin/dashboard" 
            class="dashboard__enlace <?php echo pagina_actual('dashboard') ? 'dashboard__enlace--actual' : ''; ?>">
            <i class="dashboard__icono fa-solid fa-house-user"></i>
            <span class="dashboard__menu-texto">
                Inicio
            </span>
        </a>

        <a href="/admin/influencers" 
        class="dashboard__enlace <?php echo pagina_actual('influencers') ? 'dashboard__enlace--actual' : ''; ?>">
            <i class="dashboard__icono fa-solid fa-microphone"></i>
            <span class="dashboard__menu-texto">
                Influencers
            </span>
        </a>

        <a href="/admin/eventos" 
        class="dashboard__enlace <?php echo pagina_actual('eventos') ? 'dashboard__enlace--actual' : ''; ?>">
            <i class="dashboard__icono fa-solid fa-calendar-days"></i>
            <span class="dashboard__menu-texto">
                Eventos
            </span>
        </a>

        <a href="/admin/registrados" 
        class="dashboard__enlace <?php echo pagina_actual('registrados') ? 'dashboard__enlace--actual' : ''; ?>">
            <i class="dashboard__icono fa-solid fa-users"></i>
            <span class="dashboard__menu-texto">
                Registrados
            </span>
        </a>

        <a href="/admin/regalos" 
        class="dashboard__enlace <?php echo pagina_actual('regalos') ? 'dashboard__enlace--actual' : ''; ?>">
            <i class="dashboard__icono fa-solid fa-gift"></i>
            <span class="dashboard__menu-texto">
                Regalos
            </span>
        </a>
    </nav>
</aside>