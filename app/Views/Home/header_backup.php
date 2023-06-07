<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $meta_title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php 
        $uri = service('uri');
    ?>
    <nav class="navbar sticky-top navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">Logotip</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/about">About me</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/photos">Photos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/videos">Videos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/contact">Contact me</a>
                    </li>
                    <li style="position: fixed; right: 0;" class="nav-item ml-auto">
                        <?php if (session()->has('isLoggedIn') && session()->get('isLoggedIn')) : ?>
                            <?php if (session()->get('userid') === '1') : ?>
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Admin
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="/library">Backlog</a>
                                        <a class="dropdown-item" href="/logout">Logout</a>
                                    </div>
                                </div>
                            <?php else : ?>
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Hi, <?= session()->get('firstname') ?>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="/library">My Library</a>
                                        <a class="dropdown-item" href="/logout">Logout</a>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php else : ?>
                            <form style="" class="" method="get" action="<?= base_url('login') ?>">
                                <button class="btn btn-secondary" name="seeFiles" type="submit" value="submit">Sign in</button>
                            </form>
                        <?php endif; ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


