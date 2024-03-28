<div class="gallery-object">
    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
    <label class="object-title" data-object-id="<?=$object->object_id?>"><?=$object->address?></label>
    <div class="folders-list">
        <? if ($object->folders) : ?>
            <? foreach ($object->folders as $folder) : ?>
                <? include 'core/views/admin/blocks/gallery-folder.php' ?>
            <? endforeach; ?>
        <? endif ?>
    </div>
</div>