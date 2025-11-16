<?php

/** 
 * @var \App\Kernel\View\View $view
 */
?>

<?php $view->component('start') ?>

<h1>Вход</h1>

<form action="/login" method="post">
    <?php if ($session->has('error')) { ?>
    <p>
        <?php echo $session ->getFlash('error')  ?>
    </p>
    <?php } ?>
    <p>Email</p>
    <input type="email" name=email>
    <p>Пароль</p>
    <input type="password" name=password>

    <button>Войти</button>

</form>

<?php $view->component('end') ?>