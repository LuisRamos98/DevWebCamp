<main class="auth">
    <h2 class="auth__heading"><?php echo $titulo; ?></h2>
    <p class="auth__texto">Registrate en DevWebCamp</p>

    <form action="" class="formulario">
        <div class="formulario__campo">
            <label for="nombre" class="formulario__label">Nombre</label>
            <input 
                type="nombre"
                class="formulario__input"
                placeholder="Tu Nombre"
                id="nombre"
                name="nombre"
            >
        </div>
        <div class="formulario__campo">
            <label for="apellido" class="formulario__label">Apellido</label>
            <input 
                type="apellido"
                class="formulario__input"
                placeholder="Tu Apellido"
                id="apellido"
                name="apellido"
            >
        </div>
        <div class="formulario__campo">
            <label for="email" class="formulario__label">Email</label>
            <input 
                type="email"
                class="formulario__input"
                placeholder="Tu email"
                id="email"
                name="email"
            >
        </div>
        <div class="formulario__campo">
            <label for="password" class="formulario__label">Password</label>
            <input 
                type="password"
                class="formulario__input"
                placeholder="Tu password"
                id="password"
                name="password"
            >
        </div>
        <div class="formulario__campo">
            <label for="password2" class="formulario__label">Repite el Password</label>
            <input 
                type="password"
                class="formulario__input"
                placeholder="Repite tu password"
                id="password2"
                name="password2"
            >
        </div>
        <input type="submit" class="formulario__submit" value="Crear Cuenta">
    </form>

    <div class="acciones">
        <a href="/login" class="acciones__enlace">¿Ya tienes cuenta? Inicia Sesión</a>
        <a href="/olvide" class="acciones__enlace">¿Olvidaste tu password?</a>
    </div>
</main>