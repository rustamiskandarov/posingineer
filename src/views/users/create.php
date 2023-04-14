<?php $this->layout('layout/header', ['title' => 'Редактирование']) ?>
<div class="col-md-6">
    <h2>Новый пользователь</h2>

    <form class="needs-validation" method="post" action="store" novalidate>
        <div class="row g-3">
            <div class="col-sm-6">
                <label for="username" class="form-label">Имя пользователя</label>
                <input name="username" type="text" class="form-control" id="username" placeholder="" value="" required>
                <div class="invalid-feedback">
                    Valid first name is required.
                </div>
            </div>


            <div class="col-12">
                <label for="login" class="form-label">Логин</label>
                <div class="input-group has-validation">
                    <span class="input-group-text">@</span>
                    <input name="login" type="text" class="form-control" id="login" placeholder="логин" required>
                    <div class="invalid-feedback">
                        Your username is required.
                    </div>
                </div>
            </div>

            <div class="col-12">
                <label for="email" class="form-label">Email </span></label>
                <input name="email" type="email" class="form-control" id="email" placeholder="you@example.com">
                <div class="invalid-feedback">
                    Please enter a valid email address for shipping updates.
                </div>
            </div>

        </div>


        <hr class="my-4">

        <h4 class="mb-3">Статус:</h4>

        <div class="my-3">
            <div class="form-check">
                <input id="credit" name="banned" type="radio" class="form-check-input" checked required value="0">
                <label class="form-check-label" for="credit">Активный</label>
            </div>
            <div class="form-check">
                <input id="debit" name="banned" type="radio" class="form-check-input" required value="1">
                <label class="form-check-label" for="debit">Заблокированный</label>
            </div>

        </div>
        <hr class="my-4">

        <h4 class="mb-3">Роль:</h4>

        <div class="col-md-4">
            <select name="role" class="form-select" id="role" required>
                <option value="user">Пользователь</option>
                <option value="admin">Администратор</option>
            </select>
            <div class="invalid-feedback">
                Please provide a valid state.
            </div>
        </div>
        <hr class="my-4">
        <div class="row gy-3">
            <div class="col-md-6">
                <label for="cc-name" class="form-label">Пароль</label>
                <input name="password" type="password" class="form-control" id="cc-name" placeholder="" required>
                <small class="text-muted">Не менее 8 символов</small>
                <div class="invalid-feedback">
                    Name on card is required
                </div>
            </div>

            <div class="col-md-6">
                <label for="cc-number" class="form-label">Повторите пароль</label>
                <input name = "password_confirm" type="password" class="form-control" id="cc-number" placeholder="" required>
                <div class="invalid-feedback">
                    Credit card number is required
                </div>
            </div>

        </div>

        <hr class="my-4">

        <button class="w-100 btn btn-primary btn-lg" type="submit">Сохранить</button>
    </form>
</div>