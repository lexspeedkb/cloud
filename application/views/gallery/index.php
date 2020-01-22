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