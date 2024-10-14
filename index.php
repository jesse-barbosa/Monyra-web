<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Introdução</title>
</head>
<body>
<header>
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-4">
                <a class="header-logo link link-underline link-underline-opacity-0 link-light fs-3" href="">Monyra</a>
            </div>
            <div class="col-6 text-center">
                <ul class="header-links d-flex gap-4">
                    <li><a class="header-link link link-underline link-underline-opacity-0 link-opacity-75-hover link-light fs-4" href="index.php">Início</a></li>
                    <li><a class="header-link link link-underline link-underline-opacity-0 link-opacity-75-hover link-light fs-4" href="#planos">Planos</a></li>
                    <li><a class="header-link link link-underline link-underline-opacity-0 link-opacity-75-hover link-light fs-4" href="#suporte">Suporte</a></li>
                </ul>
            </div>
            <div class="col-2 text-end">
                <button id="downloadBtn" class="btn btn-light px-3 py-2">Baixar</button>
            </div>
        </div>
    </div>
</header>

<main>
<section>
    <div class="container">
        <div class="row">
            <div class="col">
                <img src="img/smartphone1.png" class="section-img" alt="Smartphone 1">
            </div>
            <div class="col">
                <h1>EDUCAÇÃO FINANCEIRA NA PRÁTICA.</h1>
                <p>Mantenha o auto-controle sobre seus gastos, saiba administrar seu dinheiro e conquiste sua independência financeira.</p>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>SUA VIDA FINANCEIRA ORGANIZADA</h1>
                <p>Faça transferências, configure contas, e receba avisos de futuros pagamentos, para não correr risco de ficar negativado.</p>
            </div>
            <div class="col text-end">
                <img src="img/smartphone2.png" class="section-img w-75" alt="Smartphone 2" >
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col">
                <img src="img/smartphone3.png" class="section-img w-75" alt="Smartphone 3">
            </div>
            <div class="col">
                <h1>COMPARTILHE METAS E OBJETIVOS</h1>
                <p>Compartilhe metas e objetivos com seus amigos e realize juntos sonhos incríveis.</p>
            </div>
        </div>
    </div>
</section>
<!-- Seção Planos -->
<section id="planos" class="py-5">
    <div class="container flex-column text-center">
        <h1 class="text-center py-2">Escolha o seu Plano</h1>
        <h5 class="text-center text-white pt-3 pb-4">Encontre o plano que melhor se adapta às suas necessidades financeiras.</h5>
        <div class="row">
            <div class="col-md-4">
                <div class="card mb-4 py-3">
                    <div class="card-body">
                        <h2 class="card-title">Plano Básico</h2>
                        <h3 class="card-price">R$ 29,90/mês</h3>
                        <p class="card-text">Ideal para quem está começando a organizar suas finanças.</p>
                        <button class="btn form-control text-white card-btn">Assinar</button>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4 py-3">
                    <div class="card-body">
                        <h2 class="card-title">Plano Padrão</h2>
                        <h3 class="card-price">R$ 49,90/mês</h3>
                        <p class="card-text">Para quem deseja ter mais controle e recursos financeiros.</p>
                        <button class="btn form-control text-white card-btn">Assinar</button>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4 py-3">
                    <div class="card-body">
                        <h2 class="card-title">Plano Premium</h2>
                        <h3 class="card-price">R$ 79,90/mês</h3>
                        <p class="card-text">Para aqueles que buscam a melhor experiência e benefícios exclusivos.</p>
                        <button class="btn form-control text-white card-btn">Assinar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</main>

<?php
    include_once("include/footer.php");
?>

</body>
</html>
