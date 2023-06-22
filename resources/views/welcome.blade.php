<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('assets/css/chat.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
<style>
    a{
        text-decoration: none;
    }
</style>

</head>

<body class="antialiased">
    <div class="wrapper">
        <div class="users-list-card mdl-card mdl-shadow--2dp">
            <div class="mdl-card__title">
                <h2 class="mdl-card__title-text">Users</h2>
            </div>
            <div class="mdl-card__menu">
                <button class="mdl-button mdl-button--icon">
                    <i class="material-icons">more_vert</i>
                </button>
            </div>
            <div class="mdl-menu__item--full-bleed-divider"></div>
            <ul class="mdl-list">
                <li class="mdl-list__item">
                    <span class="mdl-list__item-primary-content">
                        <i class="material-icons mdl-list__item-icon">search</i>
                        <div class="mdl-textfield mdl-js-textfield">
                            <input class="mdl-textfield__input search" type="text" id="sample1" placeholder="Search a user...">
                        </div>
                    </span>
                </li>
            </ul>
            <div class="mdl-menu__item--full-bleed-divider"></div>
            <div class="mdl-card__supporting-text">
                <ul class="mdl-list">
                    @foreach($users as $user)
                    <li class="mdl-list__item">
                        <a href="{{ route('chat') }}">
                            <span class="mdl-list__item-primary-content">
                                <i class="material-icons mdl-list__item-icon">star</i>
                                <i class="mdl-list__item-avatar"></i>
                                {{$user->name}}
                            </span>
                        </a>
                    </li>
                    @endforeach
                    <li class="mdl-list__item">
                        <span class="mdl-list__item-primary-content">
                            <i class="material-icons mdl-list__item-icon"></i>
                            <i class="mdl-list__item-avatar"></i>
                            Marc Graves
                        </span>
                    </li>

                </ul>
            </div>
        </div>
    </div>
</body>

</html>