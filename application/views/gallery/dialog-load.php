<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<dialog class="mdl-dialog" id="dialog-load">
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
</dialog>