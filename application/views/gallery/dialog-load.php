<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<dialog class="mdl-dialog" id="dialog-load">
    <div id="load-tabs" class="tabs">
        <div class="tab active" name="file">Файл</div>
        <div class="tab" name="dir">Директория</div>
    </div>

    <div id="load-tabs-content">
        <div class="tab" name="file">
            <form action="/files/upload" method="POST" enctype="multipart/form-data">
                <h4 class="mdl-dialog__title">Загрузка файлов</h4>
                <div class="mdl-dialog__content">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="text" id="name" name="name">
                        <label class="mdl-textfield__label" for="name">Название...</label>
                    </div>

                    <input type="file" name="file[]" multiple>
                    <input type="hidden" name="folder_id" value="<?=$current_folder?>">

                </div>
                <div class="mdl-dialog__actions">
                    <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" type="submit" name="upload">
                        Загрузить
                    </button>
                    <button type="button" class="mdl-button close">Закрыть</button>
                </div>
            </form>
        </div>
        <div class="tab" name="dir" style="display: none">
            <form action="/files/addFolder" method="POST">
                <h4 class="mdl-dialog__title">Создать директорию</h4>
                <div class="mdl-dialog__content">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="text" id="name" name="name">
                        <label class="mdl-textfield__label" for="name">Название...</label>
                    </div>

                    <input type="hidden" name="folder_id" value="<?=$current_folder?>">

                </div>
                <div class="mdl-dialog__actions">
                    <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" type="submit" name="upload">
                        Создать
                    </button>
                    <button type="button" class="mdl-button close">Закрыть</button>
                </div>
            </form>
        </div>
    </div>
</dialog>