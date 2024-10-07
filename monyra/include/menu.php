<?php
$current_page = isset($_GET['pagina']) ? $_GET['pagina'] : 'home';

function getIcon($page, $current_page) {
    if ($page === $current_page) {
        return "/monyra-website/monyra/img/icons/menu-icons/{$page}-filled.png";
    } else {
        return "/monyra-website/monyra/img/icons/menu-icons/{$page}.png";
    }
}
?>

<header class="d-flex">
    <div class="container-fluid">
        <div class="row vh-100">
            <div class="col menu ps-5 pe-5">
            <ul class="px-0" style="list-style: none;">
                <a href="?pagina=home"><li class="my-4"><img src="<?php echo getIcon('home', $current_page); ?>" height="30px" alt="Home"></li></a>
                <a href="?pagina=analytics"><li class="my-4"><img src="<?php echo getIcon('analytics', $current_page); ?>" height="30px" alt="Analytics"></li></a>
                <a href="?pagina=notifications"><li class="my-4"><img src="<?php echo getIcon('notifications', $current_page); ?>" height="30px" alt="Notifications"></li></a>
                <a href="?pagina=settings"><li class="my-4"><img src="<?php echo getIcon('settings', $current_page); ?>" height="30px" alt="Settings"></li></a>
            </ul>
            </div>
        </div>
    </div>
</header>
    