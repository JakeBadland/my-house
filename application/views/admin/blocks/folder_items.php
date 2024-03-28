<div id="folders_list">
    <? foreach ($this->folders_list as $folder) : ?>
        <div data-folder-id="<?=$folder->folder_id?>">
            <input class="folder-order" type="text" value="<?=$folder->folder_order?>">
            <input type="checkbox" class="object-folder-item" id="folder-item-<?=$folder->folder_id?>"
            <? echo ($folder->is_selected)? 'checked': '' ?>
            >
            <label for="folder-item-<?=$folder->folder_id?>"><?=$folder->text?></label>
        </div>
    <? endforeach; ?>
</div>