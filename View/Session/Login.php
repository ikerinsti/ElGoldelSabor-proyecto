<section class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card login-box p-4 shadow-lg">
        <h3 class="text-center mb-4 fw-semibold text-uppercase text-black">
            Iniciar Sesión
        </h3>

<?php
    if (isset($_GET['error'])) {
        ?>
        <div class="alert alert-danger text-center">
            Usuario o contraseña incorrectos.
        </div>
        <?php }
        
        
        else { ?>
        <form method="POST" action="http://localhost/ElGoldelSabor/?controller=Login&action=login">
            <!-- Usuario -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Correo</label>
                <input type="text" name="email" class="form-control" required placeholder="Introduce tu Correo">
            </div>

            <!-- Contraseña -->
            <div class="mb-4">
                <label class="form-label fw-semibold">Contraseña</label>
                <input type="password" name="contraseña" class="form-control" required placeholder="Introduce tu contraseña">
            </div>

            <!-- Botones -->
            <div class="d-flex justify-content-between">
                <button class="btn btn-primary px-4">Entrar</button>
            </form>
                <a href="http://localhost/ElGoldelSabor/?controller=login&action=registro" class="btn btn-secundary px-4">Registrarse</a>
            </div>
    <?php } ?>
    </div>
</section>
<style>
    .login-box {
    max-width: 420px;
    width: 100%;
    border-radius: 18px;
     background-color: #DFDFDF;
}

.form-control {
    border-radius: 12px;
    padding: 10px 12px;
    font-size: 1rem;
}

.form-control:focus {
    border-color: #000;
    box-shadow: 0 0 4px rgba(0, 0, 0, 0.25);
}

.btn {
    border-radius: 10px;
    font-weight: 600;
}

h3 {
    letter-spacing: 1px;
}
</style>