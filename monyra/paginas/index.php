<?php include_once("../include/head.php"); ?>
<body>
<?php include_once("../include/menu.php"); ?>
    <main>
        <?php
            include_once("../classes/trocarUrl.php");
            $url = new TrocarUrl();
            $url->trocarUrl(@$_GET["pagina"]);
         ?>

    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>