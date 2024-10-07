<?php include_once("include/head.php"); ?>
<body>
    <main>
        <div class="container">
            <div class="row justify-content-center">
            <h1 class="fw-bold text-center my-5">Crie uma conta</h1>
                <div class="col-md-6 col-10 mt-5">
                <br>
                <form method="paginas/index.php" class="text-center mt-5">
                    <div class="mb-3 input-group p-2">
                        <i class="bi bi-person opacity-50 mx-2 fs-4"></i>
                        <input type="text" class="input form-control" placeholder="Usuário">
                    </div>
                    <div class="mb-3 input-group p-2">
                        <i class="bi bi-envelope opacity-50 mx-2 fs-4"></i>
                        <input type="email" class="input form-control" placeholder="Email">
                    </div>
                    <div class="mb-3 input-group p-2">
                        <i class="bi bi-lock opacity-50 mx-2 fs-4"></i>
                        <input type="password" class="input form-control" placeholder="Senha">
                    </div>
                    <button type="submit" class="btn btn-purple form-control fw-semibold py-3 mt-4">Entrar</button>
                    <p class="opacity-50 mt-2">Já tem uma conta? <a href="index.php" class="link link-underline link-underline-opacity-0 opacity-100 text-primary">Faça login</a></p>
                </form>
                </div>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>