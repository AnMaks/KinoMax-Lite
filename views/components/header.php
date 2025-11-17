<?php
/**
 *  @var \App\Kernel\Auth\AuthInterface $auth
 */

$user = $auth ->user();

?>

<header>
    <div class="account">
        <?php if($auth ->check()) { ?>
        <h3>User: <?php echo $user->email(); ?></h3>
        <button class="btn">Выход</button>
        <?php } ?>
    </div>
</header>