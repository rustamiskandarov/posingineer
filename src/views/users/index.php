<?php $this->layout('layout/header', ['title' => 'Users']) ?>

<div>


    <div class="d-flex justify-content-between">
        <h2>Пользователи</h2>
        <a href="user/create" class="btn btn-success">+</a>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">Имя польз</th>
                <th scope="col">Статус</th>
                <th scope="col">Email</th>
                <th scope="col">Потвержд</th>
                <th scope="col">Роль</th>
                <th scope="col">Действия</th>
            </tr>
            </thead>
            <tbody>
            <? foreach ($users as $user):?>
                <tr>
                    <td><?= $user->getId()?></td>
                    <td><a href=<?= 'user/'.$user->getId()?>><?= $user->getUsername()?></a></td>
                    <td><?= $user->isStatus()?></td>
                    <td><?= $user->getEmail()?></td>
                    <td><?= $user->isVerified()?></td>
                    <td><?= $user->getRolesMask()?></td>
                    <td class="d-flex justify-content-center">
                        <a href="<?= 'user/'.$user->getId().'/edit'?>" class="btn btn-success btn-sm">Edit</a>
                        <form action="user/delete" method="post">
                            <input type="hidden" name="id" value="<?= $user->getId()?>"/>
                            <button type="submit" class="btn btn-danger btn-sm">Del</button>
                        </form>

                    </td>
                </tr>
            <? endforeach;?>
            </tbody>
        </table>
    </div>
</div>
