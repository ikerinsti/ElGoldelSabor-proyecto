<section class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card login-box p-4 shadow-lg">
        <h3 class="text-center mb-4 fw-semibold text-uppercase text-black">
            Iniciar Sesión
        </h3>

        <form>
            <!-- Usuario -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Usuario</label>
                <input type="text" class="form-control" placeholder="Introduce tu usuario">
            </div>

            <!-- Contraseña -->
            <div class="mb-4">
                <label class="form-label fw-semibold">Contraseña</label>
                <input type="password" class="form-control" placeholder="Introduce tu contraseña">
            </div>

            <!-- Botones -->
            <div class="d-flex justify-content-between">
                <button class="btn btn-primary px-4">Entrar</button>
                <button class="btn btn-secundary px-4">Registrarse</button>
            </div>
        </form>
    </div>
</section>
<style>
    .login-box {
    max-width: 420px;
    width: 100%;
    border-radius: 18px;
    background: #ffffff;
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