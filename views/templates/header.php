<header class="header">
    <div class="header__contenedor">
        <nav class="header__navegacion">
            <a href="/registro" class="header__enlace">Registro</a>
            <a href="/login" class="header__enlace">Iniciar Sesión</a>
        </nav>
        <div class="header__contenido">
            <a href="/">
                <h1 class="header__logo">
                    &#60;DevWebCamp/>
                </h1>
            </a>
            <p class="header__texto">Octubre 5-6-2023</p>
            <p class="header__texto header__texto--modalidad">En Línea - Presencial</p>
            <a href="/registro" class="header__boton">Comprar Pase</a>
        </div>
    </div>
</header>

<div class="barra">
    <div class="barra__contenido">
        <a href="/"><h2 class="barra__logo">&#60;DevWebCamp/></h2></a>
        <nav class="navegacion">
            <a href="/devwebcamp" class="navegacion__enlace <?php echo pagina_actual('/devwebcamp') ? 'navegacion__enlace--actual' : ''; ?>">Evento</a>
            <a href="/paquetes" class="navegacion__enlace <?php echo pagina_actual('/paquetes') ? 'navegacion__enlace--actual' : ''; ?>">Paquetes</a>
            <a href="/workshop-conferencias" class="navegacion__enlace <?php echo pagina_actual('/workshop-conferencias') ? 'navegacion__enlace--actual' : ''; ?> ">Workshop / Conferencias</a>
            <a href="/registro" class="navegacion__enlace <?php echo pagina_actual('/registro') ? 'navegacion__enlace--actual' : ''; ?> ">Comprar Boleto</a>
        </nav>
    </div>
</div>