<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $meta_title ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
        crossorigin="anonymous">
        <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
    <style>
        a{
            font-family: 'Poppins', sans-serif;
        }

        body {
            margin-bottom: 160px;
            background-color: black;
        }


    </style>
</head>
<body>
    
<div class="wrapper">
    <header>
        
        <nav class=" navbar navbar-expand-sm navbar-dark bg-dark sticky-top"> <!-- Add 'sticky-top' class to make the navbar stick to the top -->
            <a href="/" class="logo">
                <img style="margin: 10px" id="logo" src="/images/logo/logo-color.png" alt="Logo" width="150">
            </a>
            <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarMenu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarMenu">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a  href="/" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="/about" class="nav-link">About me</a>
                    </li>
                    <li class="nav-item">
                        <a href="/photos" class="nav-link">Photos</a>
                    </li>
                    <li class="nav-item">
                        <a href="/videos" class="nav-link">Videos</a>
                    </li>
                    <li class="nav-item">
                        <a href="/videos" class="nav-link">Contact me</a>
                    </li>
                </ul>

                <ul class="navbar-nav">
                    <li  class="nav-item">
                        <?php if (session()->has('isLoggedIn') && session()->get('isLoggedIn')) : ?>
                            <?php if (session()->get('userid') === '1') : ?>
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Admin
                                    </button>
                                        <div  class="dropdown-menu" aria-labelledby="dropdownMenuButton">
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
        </nav>
     </header>


