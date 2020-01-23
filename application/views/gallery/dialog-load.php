<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<dialog class="mdl-dialog" id="dialog-load">
    <div id="load-tabs" class="tabs">
        <div class="tab active" name="file">Файл</div>
        <div class="tab" name="dir">Директория</div>
    </div>

    <div id="load-tabs-content">
        <div class="tab" name="file">

                <h4 class="mdl-dialog__title">Загрузка файлов</h4>
                <div class="mdl-dialog__content">
                    <form>
                        <div id="queue"></div>
                        <input id="file_upload" name="file_upload" type="file" multiple="true">
                    </form>

                </div>
                <div class="mdl-dialog__actions">
                    <a href="javascript:$('#file_upload').uploadifive('upload')" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" type="submit" name="upload">
                        Загрузить
                    </a>
                    <button type="button" class="mdl-button close">Закрыть</button>
                </div>

            <style type="text/css">
                #queue {
                    border: 1px solid #E5E5E5;
                    height: 177px;
                    overflow: auto;
                    margin-bottom: 10px;
                    padding: 0 3px 3px;
                    width: 100%;
                }
            </style>

            <script type="text/javascript">
                <?php $timestamp = time();?>
                $(function() {
                    $('#file_upload').uploadifive({
                        'auto'             : false,
                        'checkScript'      : '/files/upload',
                        'fileType'         : '*',
                        'formData'         : {
                                                'timestamp' : '<?php echo $timestamp;?>',
                                                'token'     : '<?php echo md5('unique_salt' . $timestamp);?>',
                                                'folder_id' : '<?=$current_folder?>'
                        },
                        'queueID'          : 'queue',
                        'uploadScript'     : '/files/upload',
                        'onUploadComplete' : function(file, data) { console.log(data); }
                    });
                });
            </script>
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