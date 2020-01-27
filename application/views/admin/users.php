<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div id="index">
    <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp table-gallery">
        <thead>
            <tr>
                <th class="mdl-data-table__cell--non-numeric"><input type="checkbox" id="check-all"></th>
                <th class="mdl-data-table__cell--non-numeric">ID</th>
                <th class="mdl-data-table__cell--non-numeric">Логин</th>
                <th class="mdl-data-table__cell--non-numeric">Имя</th>
                <th class="mdl-data-table__cell--non-numeric">Дата регистрации</th>
                <th class="mdl-data-table__cell--non-numeric">Занимаемое пространство</th>
                <th class="mdl-data-table__cell--non-numeric">Максимальное пространство</th>
                <th class="mdl-data-table__cell--non-numeric"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td class="mdl-data-table__cell--non-numeric">
                        <input type="checkbox" name="checked[<?=$folder['id']?>]" class="checkbox-action">
                        <input type="hidden" name="type[<?=$folder['id']?>]" value="folder">
                    </td>
                    <td class="mdl-data-table__cell--non-numeric">
                        <?=$user['id']?>
                    </td>
                    <td class="mdl-data-table__cell--non-numeric">
                        <?=$user['login']?>
                    </td>
                    <td>
                        <?=$user['name']?>
                    </td>
                    <td>
                        <?=$user['date_reg']?>
                    </td>
                    <td>
                        <?=$user['used_storage']?>
                    </td>
                    <td>
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                            <input class="mdl-textfield__input" type="text" value="<?=$user['max_upload']?>" data-id="<?=$user['id']?>">
                            <label class="mdl-textfield__label" for="name">Название...</label>
                        </div>
                    </td>
                    <td>
                        <div class="actions" type="dir" data-id="<?=$folder['id']?>" free="<?=$folder['free']?>">
                            <div id="tt3" class="icon material-icons">more_vert</div>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>