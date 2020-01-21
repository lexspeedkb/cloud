<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="demo-card-square mdl-card mdl-shadow--2dp delete-wrapper" >
    <div class="mdl-card__title mdl-card--expand"  style="background: url('/files/render/o/<?=$file['path']['name'];?>') center / cover no-repeat #46B6AC;">
        <h2 class="mdl-card__title-text"></h2>
    </div>
    <div class="mdl-card__actions mdl-card--border">
        <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" style="color: rgb(255,64,129)" href="/files/deleteAction/<?=$file['id']?>">
            Удалить
        </a>
    </div>
</div>