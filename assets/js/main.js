$(document).ready(function () {
    var dialog = document.querySelector('#dialog-load');

    $('body').on('click', '#show-dialog', function () {
        $( '.wheel-load' ).addClass( 'blur' );
        dialog.showModal();
    });

    $('body').on('click', '.close', function () {
        $( '.wheel-load' ).removeClass( 'blur' );
        dialog.close();
    });



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
        var type = $(this).attr('type');
        var free = $(this).attr('free');

        if (type=='dir') {
            var dialogOptions = document.querySelector('#options-folder');
            dialogOptions.showModal();
            $('#options-folder .wrapper').addClass('open');
            $('#options-folder .bg').css('display', 'block');

            $('#options-folder .open').attr('href', '/gallery/index/'+data_id);
            $('#options-folder .free').attr('href', '/files/toggleFolderFree/'+data_id);
            $('#options-folder .delete').attr('href', '/files/deleteFolder/'+data_id);

            if (free==0) {
                $('#options-folder .free span').text('Предоставить доступ к папке');
            } else {
                $('#options-folder .free span').text('Закрыть доступ к папке');
                $('#options-folder #link').val('/gallery/index/'+data_id);
            }
        } else {
            var dialogOptions = document.querySelector('#options');
            dialogOptions.showModal();
            $('#options .wrapper').addClass('open');
            $('#options .bg').css('display', 'block');


            $('#options .open').attr('href', path);
            $('#options .save').attr('href', path);
            $('#options .delete').attr('href', '/files/delete/'+data_id);
        }

        $('.wheel-load').addClass( 'blur' );
    });

    $(document).on('click', '#options-folder .get-link', function () {
        var copyText = document.getElementById("link");
        copyText.select();
        copyText.setSelectionRange(0, 99999);
        document.execCommand("copy");

        var data = {message: 'Ссылка скопирована в буфер обмена' };
        snackbarContainer.MaterialSnackbar.showSnackbar(data);

        optionsFolder_close();
    });



    $(document).on('click', '#options .bg', function () {
        $('#options .wrapper').removeClass('open');
        $('.wheel-load').removeClass( 'blur' );

        setTimeout(function () {
            $('#options .bg').css('display', 'none');
            var dialogOptions = document.querySelector('#options');
            dialogOptions.close();
        }, 300)

    });

    $(document).on('click', '#options-folder .bg', function () {
        optionsFolder_close();
    });

    function optionsFolder_close () {
        $('#options-folder .wrapper').removeClass('open');
        $('.wheel-load').removeClass( 'blur' );

        setTimeout(function () {
            $('#options-folder .bg').css('display', 'none');
            var dialogOptions = document.querySelector('#options-folder');
            dialogOptions.close();
        }, 300)
    }


    $(document).on('click', '#load-tabs .tab', function () {
        var name = $(this).attr('name');
        $('#load-tabs .tab').removeClass('active');
        $(this).addClass('active');

        $('#load-tabs-content .tab').css('display', 'none');
        $('#load-tabs-content .tab[name="'+name+'"]').css('display', 'block');
    });

    $("#check-all").change(function() {
        if(this.checked) {
            $(".checkbox-action").prop('checked', true);
        } else {
            $(".checkbox-action").prop('checked', false);
        }
    });


    $(document).on('change', '.file-name', function () {
        var id      = $(this).attr('data-id');
        var type    = $(this).attr('data-type');
        var value   = $(this).val();

        if (type == 'folder') {
            var url_rename = '/files/changeDirName/';
        } else {
            var url_rename = '/files/changeName/'
        }

        $.ajax({
            url: url_rename,
            type: 'POST',
            data: {id: id, value: value},
        })
            .done(function() {
                var data = {message: 'Имя папки изменено!' };
                snackbarContainer.MaterialSnackbar.showSnackbar(data);
            })
            .fail(function() {
                var data = {message: 'Ошибка изменения имени папки' };
                snackbarContainer.MaterialSnackbar.showSnackbar(data);
            })
    });

    preloaderClose();

    function preloaderClose () {
        $('#preloader').css('opacity', 0);
        setTimeout(function () {
            $('#preloader').css('display', 'none');
        }, 1000)
    }
});