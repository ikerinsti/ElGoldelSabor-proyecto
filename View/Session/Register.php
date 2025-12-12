<section class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card login-box p-4 shadow-lg">
        <h3 class="text-center mb-4 fw-semibold text-uppercase text-black">
            Registrarse
        </h3>

        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger text-center">
                El nombre de usuario ya existe.
            </div>
        <?php endif; ?>

        <form method="POST" action="?controller=Login&action=register">

            <!-- Nombre -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Nombre</label>
                <input type="text" name="Nombre" class="form-control" required>
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Email</label>
                <input type="mail" name="Email" class="form-control" required>
            </div>

            <!-- Contraseña -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Contraseña</label>
                <input type="password" name="Password" class="form-control" required>
            </div>

            <!-- Confirmación -->
            <div class="mb-4">
                <label class="form-label fw-semibold">Repite la contraseña</label>
                <input type="password" name="Password2" class="form-control" required>
            </div>

            <!-- Direccion -->
            <div class="mb-4">
                <label class="form-label fw-semibold">Direccion predeterminada</label>
                <input type="text" name="Direccion" class="form-control" required>
            </div>

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary px-4">Crear cuenta</button>
                <a href="index.php?controller=Login&action=index" class="btn btn-secundary px-4">Volver</a>
            </div>

        </form>
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