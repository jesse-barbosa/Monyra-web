<?php
include_once("../classes/User.php");
$usuario = new User();
$usuario->getUserData($user['session'])

?>
<div class="container-fluid">
    <div class="row">
        <div class="col-5 ms-5 mt-5">
            <h1 class="fw-bold">Monyra</h1>
            <h4 class="nameUser fw-semibold">Jessé Barbosa</h4>
        </div>
        <div class="col-6 text-end mt-5">
            <img src="img/user.png" height="80px" alt="">
        </div>
    </div>
</div>
<div class="container-fluid ms-5">
    <div class="row">
        <div class="col-9 balance mt-4 text-start">
            <h5 class="text-white opacity-75 font-monospace">Saldo Total </h5>
            <h4 class="text-white">R$ 31.6</h4>
        </div>
    </div>
</div>
<h2 class="fw-bold ms-5 mt-3">Goals</h2>
<div class="container-fluid ms-5">
    <div class="row">
        <div class="col-4 card border-0 p-4 rounded-5 mx-2 mt-4 text-start">
            <h4 class="text-black">Name of Goal</h4>
            <h5 class="text-black opacity-50 fw-light mb-3">- Me</h5>
            <div id="container"></div>
        </div>
        <div class="col-4 card border-0 p-4 rounded-5 mx-2 mt-4 text-start">
            <h4 class="text-black">Name of Goal</h4>
            <h5 class="text-black opacity-50 fw-light mb-3">- Me</h5>
        </div>
    </div>
</div>
<img src="img/btn-add.png" class="btn-add" height="60px" alt="">

<script src="https://cdn.jsdelivr.net/npm/progressbar.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var container = document.getElementById('container');
        var bar = new ProgressBar.Line(container, {
            strokeWidth: 4,
            easing: 'easeInOut',
            duration: 1400,
            color: '#5019D4',
            trailColor: '#eee',
            trailWidth: 1,
            svgStyle: {width: '100%', height: '60%'}
        });

        bar.animate(1.0);
    });
</script>
