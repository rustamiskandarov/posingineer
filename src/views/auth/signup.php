<?php

use function Tamtamchik\SimpleFlash\flash;

?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Rustisk">

    <title><?= $this->e($title) ?></title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/dashboard/">


    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="/docs/5.0/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="/docs/5.0/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="/docs/5.0/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="manifest" href="/docs/5.0/assets/img/favicons/manifest.json">
    <link rel="mask-icon" href="/docs/5.0/assets/img/favicons/safari-pinned-tab.svg" color="#7952b3">
    <link rel="icon" href="/docs/5.0/assets/img/favicons/favicon.ico">
    <meta name="theme-color" content="#7952b3">


    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>


    <!-- Custom styles for this template -->
    <link href="assets/css/dashbord.css" rel="stylesheet">
</head>
<body>

<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="/">POS Ingineer</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
            aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="navbar-nav">
        <div class="nav-item text-nowrap d-flex justify-content-between">

            <?php
            if ($_SESSION['auth_logged_in']):
                echo '<a class="nav-link px-3" href="">User: ' . $_SESSION['auth_username'] . '</a>';
                echo '<a class="nav-link px-3" href="/logout">Выход</a>';
            else :
                echo '<a class="nav-link px-3" href="/signin">Вход</a>';
                echo '<a class="nav-link px-3" href="/signup">Регистрация</a>';
            endif;
            ?>

        </div>
    </div>
</header>

<div class="container-fluid">
    <div class="row">

        <main class="col-md-4 col-lg-12 px-md-4 mt-5">

            <div class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                <div class="col-md-4">
                    <?= flash()->display() ?>
                </div>
            </div>

            <div class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">


                <div class="col-md-4">
                    <h2>Регистрация</h2>

                    <form class="needs-validation" method="post" action="register" novalidate>
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <label for="username" class="form-label">Имя пользователя</label>
                                <input name="username" type="text" class="form-control" id="username" placeholder=""
                                       value="" required>
                                <div class="invalid-feedback">
                                    Valid first name is required.
                                </div>
                            </div>


                            <div class="col-12">
                                <label for="login" class="form-label">Логин</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text">@</span>
                                    <input name="login" type="text" class="form-control" id="login" placeholder="логин"
                                           required>
                                    <div class="invalid-feedback">
                                        Your username is required.
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="email" class="form-label">Email </span></label>
                                <input name="email" type="email" class="form-control" id="email"
                                       placeholder="you@example.com">
                                <div class="invalid-feedback">
                                    Please enter a valid email address for shipping updates.
                                </div>
                            </div>

                        </div>


                        <hr class="my-4">

                        <div class="row gy-3">
                            <div class="col-md-6">
                                <label for="cc-name" class="form-label">Пароль</label>
                                <input name="password" type="password" class="form-control" id="cc-name" placeholder=""
                                       required>
                                <small class="text-muted">Не менее 8 символов</small>
                                <div class="invalid-feedback">
                                    Name on card is required
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="cc-number" class="form-label">Повторите пароль</label>
                                <input name="password_confirm" type="password" class="form-control" id="cc-number"
                                       placeholder="" required>
                                <div class="invalid-feedback">
                                    Credit card number is required
                                </div>
                            </div>

                        </div>

                        <hr class="my-4">

                        <button class="w-100 btn btn-primary btn-lg" type="submit">Сохранить</button>
                    </form>
                </div>

            </div>

        </main>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"
        integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"
        integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha"
        crossorigin="anonymous"></script>
<script src="dashboard.js"></script>
<script src="assets/js/dashboard.js"></script>
</body>
</html>
