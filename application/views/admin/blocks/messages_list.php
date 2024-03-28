<tr class="cell <?= (!$message->is_answered)? 'bg-red' :'';?>" data-message-id="<?=$message->message_id?>">
    <td><?=$message->user_name?></td>
    <td><?=$message->user_email?></td>
    <td class="mh"><?=$message->date?></td>
    <td class="mh">
        <? if ($message->is_answered) : ?>
            <span class="glyphicon glyphicon-ok is_answered" aria-hidden="true"></span>
        <? else : ?>
            <span class="glyphicon glyphicon-remove is_answered" aria-hidden="true"></span>
        <? endif; ?>
    </td>
    <td>
        <button type="button" class="btn btn-danger delete-dialog">Удалить</button>
    </td>
</tr>