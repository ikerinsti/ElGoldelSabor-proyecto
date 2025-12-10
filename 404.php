<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>404 - Página no encontrada</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f8f9fa;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 20px;
        }

        .card-404 {
            background: #ffffff;
            border-radius: 18px;
            padding: 40px 32px;
            max-width: 600px;
            width: 100%;
            box-shadow: 0 5px 25px rgba(0,0,0,0.08);
        }

        .code {
            font-size: 70px;
            font-weight: 800;
            color: #dc3545;
            line-height: 1;
        }

        .subtitle {
            font-size: 22px;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .text-muted-custom {
            color: #6c757d;
            margin-bottom: 25px;
        }

        .btn-home {
            padding: 12px 24px;
            font-size: 16px;
            border-radius: 12px;
            font-weight: 600;
        }
    </style>
</head>

<body>

    <div class="card-404">
        <div class="code">404</div>
        <div class="subtitle">Página no encontrada</div>
        <p class="text-muted-custom">
            La página que buscas no existe o fue movida.  
        </p>

        <a href="http://localhost/ElGoldelSabor/" class="btn btn-primary btn-home">
            ← Volver al inicio
        </a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
