<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- доп. опции -->
<dialog class="mdl-dialogp-options options-modal" id="options">
    <div class="bg"></div>
    <div class="wrapper">
        <a class="open" href=""><span class="">Открыть</span></a>
        <hr>
<!--        <span class="">Предоставить доступ</span>-->
<!--        <br><br>-->
        <a class="save" href="" download><span class="">Сохранить</span></a>
<!--        <br><br>-->
<!--        <span class="">Поделиться</span>-->
        <hr><br>
        <a class="delete" href=""><span>УДАЛИТЬ</span></a>
    </div>

    <button type="button" class="mdl-button close">Закрыть</button>
</dialog>

<dialog class="mdl-dialogp-options options-modal" id="options-folder">
    <div class="bg"></div>
    <div class="wrapper">
        <a class="open" href="">
            <span class="">Открыть папку</span>
        </a>
        <hr>
        <br>
        <a class="free" href="">
            <span class="">Предоставить доступ к папке</span>
        </a>
        <br>
        <br>

        <a class="get-link" href="#">
            <span class="">Скопировать ссылку</span>
        </a>
        <input id="link" type="text" style="position: fixed; bottom: -100px;">

        <br>
        <br>

        <!--        <a class="save" href="" download><span class="">Сохранить папку</span></a>-->
<!--        <br><br>-->
        <hr><br>
        <a class="delete" href="">
            <span>УДАЛИТЬ ПАПКУ</span>
        </a>
    </div>

    <button type="button" class="mdl-button close">Закрыть</button>
</dialog>