<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- Always shows a header, even in smaller screens. -->
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
    <header class="mdl-layout__header">
        <div class="mdl-layout__header-row">
            <!-- Title -->
            <span class="mdl-layout-title">Title</span>
            <!-- Add spacer, to align navigation to the right -->
            <div class="mdl-layout-spacer"></div>
            <!-- Navigation. We hide it in small screens. -->
            <nav class="mdl-navigation mdl-layout--large-screen-only">
                <a class="mdl-navigation__link" href="/dashboard"><?=$user['login']?></a>
                <a class="mdl-navigation__link" href="/">List</a>
                <a class="mdl-navigation__link" href="/?list=grid">Grid</a>
                <a class="mdl-navigation__link" href="/auth/exit">Выход</a>
            </nav>
        </div>
    </header>
    <div class="mdl-layout__drawer">
        <span class="mdl-layout-title">Title</span>
        <nav class="mdl-navigation">
            <a class="mdl-navigation__link" href="/dashboard"><?=$user['login']?></a>
            <a class="mdl-navigation__link" href="/">List</a>
            <a class="mdl-navigation__link" href="/?list=grid">Grid</a>
            <a class="mdl-navigation__link" href="/auth/exit">Выход</a>
        </nav>
    </div>
    <main class="mdl-layout__content">
        <div class="page-content">