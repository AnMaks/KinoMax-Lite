<?php 
/** 
 * @var \App\Kernel\View\View $view
 */
?>

<?php $view -> component('start')?>

<h1>Add Movies page</h1>

<form action="/admin/movies/add" method="post">
    <label>Name</label>
    <div><input type="text" name="name"></div>
    <div><button>Отправить</button></div>

</form>

<?php $view -> component('end')?>