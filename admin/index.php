<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Painel Administrativo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            background-color: #333;
            color: #fff;
            font-family: Arial, sans-serif;
        }
        .container-fluid {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .form-container {
            background: rgba(0, 0, 0, 0.7);
            border-radius: 10px;
            padding: 2rem;
            width: 100%;
            max-width: 500px;
        }
        .form-control {
            background-color: #333 !important;
            color: #fff !important;
            border: none;
        }
        .form-control::placeholder {
            color: #bbb;
        }
        .btn-light {
            background-color: #fff;
            color: #333;
            border: none;
            transition: background-color 0.3s ease;
        }
        .btn-light:hover {
            background-color: #e2e2e2;
        }
        .alert {
            transition: opacity 0.3s ease;
        }
        .footer-text {
            text-align: center;
            margin-top: 20px;
            color: #ccc;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="form-container">
            <h2 class="display-6 mb-4 text-center">Painel Administrativo</h2>
            <form action="index.php" method="post">
                <input type="hidden" name="idForm" value="formLogin">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" placeholder="Digite seu E-mail" class="form-control py-2" required>
                </div>
                <div class="mb-3">
                    <label for="senha" class="form-label">Senha</label>
                    <input type="password" name="senha" placeholder="Digite sua Senha" class="form-control py-2" required>
                </div>
                <div class="mt-4">
                    <button type="submit" name="enviar" class="btn btn-light w-100">Entrar</button>
                </div>
                <?php
                if (isset($_POST["enviar"])) {
                    if (empty($_POST["email"]) || empty($_POST["senha"])) {
                        echo "<div class='alert alert-warning mt-3' role='alert'>Por favor, preencha todos os campos.</div>";
                    } else {
                        include_once("classe/VerificarLogin.php");
                        $dados = new VerificarLogin();
                        $dados->verificarLogin($_POST['email'], $_POST['senha']);
                    }
                }
                ?>
            </form>
        </div>
    </div>
    <div class="footer-text">
        <p>© <?php echo date('Y'); ?> Painel Administrativo</p>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
