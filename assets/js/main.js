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





    setOptionsToDefaultPlace();

    function setOptionsToDefaultPlace () {
        var optionsHeight = $('#options .wrapper').height();

        optionsHeight +=25;

        $('#options .wrapper').css('bottom', '-'+optionsHeight+'px');
    }

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
    });

    preloaderClose();

    function preloaderClose () {
        $('#preloader').css('opacity', 0);
        setTimeout(function () {
            $('#preloader').css('display', 'none');
        }, 200)
    }
});