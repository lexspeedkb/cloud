<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div id="index">
    <?php if ($_GET['list']=='grid'): ?>
        <?php foreach ($files as $file): ?>
            <div class="demo-card-image mdl-card mdl-shadow--2dp item" data-type="image" src="/files/o/<?=$file['path']['text'].$file['path']['name'];?>" style="background: url('/files/s/<?=$file['path']['text'].$file['path']['name'];?>') center / cover">
                <div class="mdl-card__title mdl-card--expand"></div>
                <div class="mdl-card__actions">
                    <span class="demo-card-image__filename"><?=$file['name']?></span>

                    <a href="/files/o/<?=$file['path']['text'].$file['path']['name'];?>" class="download-icon" download>
                        <div id="tt3" class="icon material-icons">cloud_download</div>
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <table class="mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-shadow--2dp table-gallery">
            <thead>
                <tr>
                    <th class="mdl-data-table__cell--non-numeric">Material</th>
                    <th>Имя</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($files as $file): ?>
                    <tr>
                        <td>
                            <img class="item" data-type="image" src="/files/o/<?=$file['path']['text'].$file['path']['name'];?>" style="width: 50px;">
                        </td>
                        <td class="mdl-data-table__cell--non-numeric">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input file-name" type="text" value="<?=$file['name']?>" data-id="<?=$file['id']?>">
                                <label class="mdl-textfield__label" for="name">Название...</label>
                            </div>
                        </td>
                        <td class="actions">
                            <a href="/files/o/<?=$file['path']['text'].$file['path']['name'];?>" class="icon" download>
                                <div id="tt3" class="icon material-icons">cloud_download</div>
                            </a>
                            &nbsp;&nbsp;&nbsp;
                            <a href="/files/delete/<?=$file['id']?>" class="icon">
                                <div id="tt3" class="icon material-icons">delete</div>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <button  id="show-dialog" class="mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab mdl-button--colored">
        <i class="material-icons">add</i>
    </button>
</div>

<!-- Вывод фото -->
<div id="view">
    <!-- Меню для картинки -->
    <div class="img-menu">

    </div>
    
    <div class="img"></div>
</div>

<dialog class="mdl-dialog">
    <form action="/files/upload" method="POST" enctype="multipart/form-data">
        <h4 class="mdl-dialog__title">Загрузка файлов</h4>
        <div class="mdl-dialog__content">
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="text" id="name" name="name">
                <label class="mdl-textfield__label" for="name">Название...</label>
            </div>

            <input type="file" name="file">

        </div>
        <div class="mdl-dialog__actions">
            <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" type="submit" name="upload">
                Загрузить
            </button>
            <button type="button" class="mdl-button close">Закрыть</button>
        </div>
    </form>
</dialog>

<script>
    var dialog = document.querySelector('dialog');
    var showDialogButton = document.querySelector('#show-dialog');
    if (! dialog.showModal) {
        dialogPolyfill.registerDialog(dialog);
    }
    showDialogButton.addEventListener('click', function() {
        dialog.showModal();
    });
    dialog.querySelector('.close').addEventListener('click', function() {
        dialog.close();
    });
</script>

<script>
    $(document).ready(function () {
        var imgOpened = false;
        $('body').on('click', '.item', function () {
            if ($(this).attr('data-type')=='image') {
                $('#view .img').css('background-image', 'url('+$(this).attr('src')+')');
                $('#view').css('display', 'block');
                $('#view .img').css('display', 'block');
                imgOpened = true;
            }
        })

        $(document).on('click', '#view', function () {
            if (imgOpened) {
                $('#view').css('display', 'none');
                $('#view .img').css('display', 'none');
                imgOpened = false;
            }
        })
    })
</script>