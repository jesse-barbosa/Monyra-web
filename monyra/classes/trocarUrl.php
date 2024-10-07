<?php
class TrocarUrl {
    public function trocarUrl($url)
    {
        if(empty($url)) {
            $url = "home.php";
        }
        else {
            $url = "$url.php";
        }
        include_once ($url);
    }
}
?>
