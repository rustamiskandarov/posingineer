<?php $this->layout('layout/header', ['title' => 'Пользователь']) ?>

<div>
    <div class="card">
        <h5 class="card-header">Пользователь: <?= $user['username']?> (<?= $user['login']?>)</h5>
        <img src="https://picsum.photos/300/200" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title">Имя: <?= $user['username']?></h5>
            <h5 class="card-title">Логин: <?= $user['login']?></h5>
            <h5 class="card-title">Эл.почта: <?= $user['email']?></h5>
            <h5 class="card-title">Роль: <?= $user['role']?></h5>
            <h5 class="card-title">Статус: <?= $user['banned']?></h5>

            <a href="#" class="btn btn-primary">Редактировать</a>
        </div>
    </div>

</div>