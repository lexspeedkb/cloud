<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div id="index">
    <?php if ($_GET['list']=='grid'): ?>
        <?php foreach ($files as $file): ?>
            <?php if ($file['type']['primary']=='image'): ?>
                <div class="demo-card-image mdl-card mdl-shadow--2dp item" data-type="image" data-src="/files/render/o/<?=$file['path']['name'];?>" style="background: url('/files/render/s/<?=$file['path']['name'];?>') center / cover">
                    <div class="mdl-card__title mdl-card--expand"></div>
                    <div class="mdl-card__actions">
                        <span class="demo-card-image__filename"><?=$file['name']?></span>

                        <a href="/files/o/<?=$file['path']['text'].$file['path']['name'];?>" class="download-icon" download>
                            <div id="tt3" class="icon material-icons">cloud_download</div>
                        </a>
                    </div>
                </div>
            <?php else: ?>
                <div class="demo-card-image mdl-card mdl-shadow--2dp" style="background: url('/assets/img/default_<?=$file['type']['primary']?>.png') center / cover">
                    <div class="mdl-card__title mdl-card--expand"></div>
                    <div class="mdl-card__actions">
                        <span class="demo-card-image__filename"><?=$file['name']?></span>

                        <a href="/files/render/o/<?=$file['path']['name'];?>" class="download-icon" download>
                            <div id="tt3" class="icon material-icons">cloud_download</div>
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php else: ?>
        <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp table-gallery">
            <thead>
                <tr>
                    <th class="mdl-data-table__cell--non-numeric">Material</th>
                    <th class="mdl-data-table__cell--non-numeric">Название</th>
                    <th class="mdl-data-table__cell--non-numeric">Тип</th>
                    <th class="mdl-data-table__cell--non-numeric"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($files as $file): ?>
                    <?php if ($file['type']['primary']=='image'): ?>
                        <tr>
                            <td>
                                <img class="item" data-type="image" data-src="/files/render/o/<?=$file['path']['name'];?>" src="/files/render/s/<?=$file['path']['name'];?>" style="width: 50px;">
                            </td>
                            <td class="mdl-data-table__cell--non-numeric">
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                    <input class="mdl-textfield__input file-name" type="text" value="<?=$file['name']?>" data-id="<?=$file['id']?>">
                                    <label class="mdl-textfield__label" for="name">Название...</label>
                                </div>
                            </td>
                            <td class="mdl-data-table__cell--non-numeric">
                                <?php
                                $ext = explode('.', $file['src']);
                                $extension = $ext[1];
                                echo $extension;
                                ?>
                            </td>
                            <td>
                                <div class="actions" path="/files/render/o/<?=$file['path']['name'];?>" data-id="<?=$file['id']?>">
                                    <div id="tt3" class="icon material-icons">more_vert</div>
                                </div>

                                <!-- <a href="/files/render/o/<?=$file['path']['name'];?>" class="icon">
                                    <div id="tt3" class="icon material-icons">open_in_new</div>
                                </a>
                                &nbsp;&nbsp;&nbsp;
                                <a href="/files/render/o/<?=$file['path']['name'];?>" class="icon" download>
                                    <div id="tt3" class="icon material-icons">cloud_download</div>
                                </a>
                                &nbsp;&nbsp;&nbsp;
                                <a href="/files/delete/<?=$file['id']?>" class="icon">
                                    <div id="tt3" class="icon material-icons">delete</div>
                                </a> -->
                            </td>
                        </tr>
                    <?php else: ?>
                        <tr>
                            <td>
                                <img src="/assets/img/default_<?=$file['type']['primary']?>.png" style="width: 50px;">
                            </td>
                            <td class="mdl-data-table__cell--non-numeric">
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                    <input class="mdl-textfield__input file-name" type="text" value="<?=$file['name']?>" data-id="<?=$file['id']?>">
                                    <label class="mdl-textfield__label" for="name">Название...</label>
                                </div>
                            </td>
                            <td class="mdl-data-table__cell--non-numeric">
                                <?php
                                $ext = explode('.', $file['src']);
                                $extension = $ext[1];
                                echo $extension;
                                ?>
                            </td>
                            <td class="actions">
                                <!-- <a href="/files/render/o/<?=$file['path']['name'];?>" class="icon">
                                    <div id="tt3" class="icon material-icons">open_in_new</div>
                                </a>
                                &nbsp;&nbsp;&nbsp;
                                <a href="/files/render/o/<?=$file['path']['name'];?>" class="icon" download>
                                    <div id="tt3" class="icon material-icons">cloud_download</div>
                                </a>
                                &nbsp;&nbsp;&nbsp;
                                <a href="/files/delete/<?=$file['id']?>" class="icon">
                                    <div id="tt3" class="icon material-icons">delete</div>
                                </a> -->
                            </td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <button  id="show-dialog" class="mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab mdl-button--colored">
        <i class="material-icons">add</i>
    </button>
</div>

<!-- доп. опции -->
<div id="options">
    <div class="bg"></div>
    <div class="wrapper">
        <a class="open" href=""><span class="">Открыть</span></a>
        <hr>
        <span class="">Предоставить доступ</span>
        <br><br>
        <a class="save" href="" download><span class="">Сохранить</span></a>
        <br><br>
        <span class="">Поделиться</span>
        <hr><br>
        <a class="delete" href=""><span>УДАЛИТЬ</span></a>
    </div>
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

            <input type="file" name="file[]" multiple>

        </div>
        <div class="mdl-dialog__actions">
            <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" type="submit" name="upload">
                Загрузить
            </button>
            <button type="button" class="mdl-button close">Закрыть</button>
        </div>
    </form>
</dialog>

<div id="demo-toast-example" class="mdl-js-snackbar mdl-snackbar">
    <div class="mdl-snackbar__text"></div>
    <button class="mdl-snackbar__action" type="button"></button>
</div>

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
        var snackbarContainer = document.querySelector('#demo-toast-example');

        var imgOpened = false;
        $('body').on('click', '.item', function () {
            if ($(this).attr('data-type')=='image') {
                $('#view .img').css('background-image', 'url('+$(this).attr('data-src')+')');
                $('#view').css('display', 'block');
                $('#view .img').css('display', 'block');
                imgOpened = true;
            }
        });

        $(document).on('click', '#view', function () {
            if (imgOpened) {
                $('#view').css('display', 'none');
                $('#view .img').css('display', 'none');
                imgOpened = false;
            }
        });

        $(document).on('click', '.actions', function () {
            var data_id = $(this).attr('data-id');
            var path = $(this).attr('path');

            $('#options .wrapper').addClass('open');
            $('#options .bg').css('display', 'block');
            $('#options .open').attr('href', path);
            $('#options .save').attr('href', path);
            $('#options .delete').attr('href', '/files/delete/'+data_id);
        });

        $(document).on('click', '#options .bg', function () {
            $('#options .wrapper').removeClass('open');
            setTimeout(function () {
                $('#options .bg').css('display', 'none');
            }, 300)

        });



        $(document).on('change', '.file-name', function () {
            var id = $(this).attr('data-id');
            var value = $(this).val();

            $.ajax({
                url: '/files/changeName/',
                type: 'POST',
                data: {id: id, value: value},
            })
                .done(function() {
                    var data = {message: 'Имя изменено!' };
                    snackbarContainer.MaterialSnackbar.showSnackbar(data);
                })
                .fail(function() {
                    var data = {message: 'Ошибка' };
                    snackbarContainer.MaterialSnackbar.showSnackbar(data);
                })
        })
    })
</script>