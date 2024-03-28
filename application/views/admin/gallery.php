<? include ('core/views/blocks/admin_head.php'); ?>

<div id="container">
    <div id="header">
        <? include ('core/views/admin/blocks/menu.php'); ?>
    </div>

    <div id="body">

        <div class="object-menu">
            <div id="object_edit"><span><b>Редактировать</b></span></div>
            <div id="object_create"><span>Создать объект</span></div>
            <div id="object_create_folder"><span>Создать папку</span></div>
            <div id="object_delete"><span>Удалить объект</span></div>
        </div>

        <div class="folder-menu">
            <div id="folder_edit"><span><b>Редактировать</b></span></div>
            <div id="folder_delete"><span>Удалить папку</span></div>
        </div>

        <div class="panel panel-default p20 gallery-objects-list noselect">
            <? foreach ($this->objects_info as $object) : ?>
                <? include 'core/views/admin/blocks/gallery-object.php' ?>
            <? endforeach; ?>
        </div>

    </div>

    <div id="footer">

    </div>
</div>


<div class="modal fade" id="modal_edit_object" data-object-id="" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Редактирование объекта</h4>
            </div>
            <div class="modal-body">
                <label for="object_address">Имя объекта</label>
                <input class="db input100" type="text" id="object_address"><br/>
                <label for="object_order">Порядок вывода</label>
                <input class="db input100" type="text" id="object_order"><br/>
                <div class="h40">
                    <button type="button" class="btn btn-default fr" id="save_object">Сохранить</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_edit_folder" data-folder-id="" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Редактирование директории</h4>
            </div>
            <div class="modal-body">
                <div class="h40">
                    <input type="text" id="folder_text">
                    <button type="button" class="btn btn-default" id="save_folder">Сохранить</button>
                    <button type="button" class="btn btn-default" id="delete_all_folder_images">Удалить все</button>
                    <button type="button" class="btn btn-default" id="delete_selected_images">Удалить выбранные</button>
                    <button type="button" class="btn btn-default" id="add_folder_images">Добавить изображения</button>
                    <label id="upload_progress"></label>
                    <input class="hidden" multiple="multiple" name="upload_files[]" type="file" id="add_images_input">
                </div>
                <br/>

                <div id="folders_images_list" class="">

                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_add_folder" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Добавить директорию</h4>
            </div>
            <div class="modal-body">
                <input>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="confirm_add_folder">Добавить</button>
                <button type="button" class="btn btn-default" id="confirm_cancel" data-dismiss="modal">Отмена</button>
            </div>
        </div>
    </div>
</div>

<? include ('core/views/admin/blocks/modal_confirm.php'); ?>
<? include ('core/views/admin/blocks/modal_input.php'); ?>

<script>
    var object_id = null,
        folder_id = null;

    $(document).ready(function(){

        $('.folders-list').sortable({
            stop: function (event, ui) {
                var data = {},
                    $this = $(this),
                    $folders = null;

                data.object_id = $this.prev('label').data('object-id');
                data.folders = [];

                $folders = $this.find('.folder-title');

                for (var i = 0; i<$folders.length; i++){
                    var info = {};
                    info.order = i;
                    info.folder_id = $($folders[i]).data('folder-id');
                    data.folders.push(info);
                }

                $.post('/dna/ajax_update_folders_order', {data: data}, function(){

                });
            }
        });

        //object menu events
        $('body').on('click', '#object_create', function(){
            modals.input('confirm_object', function (text) {
                var data = {};
                data.text = text;
                $.post('/dna/add_object', {data: data}, function (data) {
                    data = $.parseJSON(data);
                    if (data.status) {
                        $('.gallery-objects-list').prepend(data.render);
                    }
                });
            });
        });

        $('body').on('click', '#object_delete', function(){
            var object_id = $('.object-menu').data('object-id');
            modals.confirm('del_object', function () {
                var data = {};
                data.object_id = object_id;
                $.post('/dna/delete_object', {data: data}, function (data) {
                    data = $.parseJSON(data);
                    if (data.status) {
                        $('label[data-object-id="'+object_id+'"]').parents('div.gallery-object').remove();
                    }
                });
            });
        });

        $('body').on('click', '#object_edit', function(){
            edit_object_modal( $('.object-menu').data('object-id') );
        });

        $('body').on('dblclick', '.object-title', function(){
            edit_object_modal($(this).data('object-id'));
        });

        function edit_object_modal(objectId){
            var data = {},
                $modal = $('#modal_edit_object');

            data.object_id = objectId;
            $modal.data('object-id', objectId);

            $.post('/dna/ajax_get_object_info',{data: data}, function(data){
                data = $.parseJSON(data);
                if (data.status){
                    $modal.find('#object_address').val(data.address);
                    $modal.find('#object_order').val(data.order);
                    $modal.modal();
                }
            });
        }

        $('body').on('click', '#save_object', function(ev){
            var $this = $(this),
                $modal = $('#modal_edit_object'),
                data = {},
                inputs = null;

            data.object_id = $modal.data('object-id');
            data.address = $modal.find('#object_address').val();
            data.order = $modal.find('#object_order').val();

            $.post('/dna/ajax_set_object_info', {data: data}, function(result){
                result = $.parseJSON(result);
                if (result.status){
                    $('label[data-object-id="'+data.object_id+'"]').text(data.address);
                    $modal.modal('hide');
                }
            })
        });

        $('body').on('click', '#object_create_folder', function(){
            modals.input('confirm_folder', function (text) {
                var data = {},
                    object_id = $('.object-menu').data('object-id');

                data.folder_text = text;
                data.object_id = object_id;
                $.post('/dna/ajax_add_folder', {data: data}, function (data) {
                    data = $.parseJSON(data);
                    if (data.status) {
                        $('label[data-object-id="'+object_id+'"]')
                            .parents('div.gallery-object')
                            .find('.folders-list')
                            .append(data.render);
                    }
                });
            });
        });

        $('body').on('click', '#folder_delete', function (ev) {
            folder_id = $('.folder-menu').data('folder-id');
            modals.confirm('del_object', function () {
                var data = {};
                data.folder_id = folder_id;
                $.post('/dna/ajax_delete_folder', {data: data}, function (data) {
                    data = $.parseJSON(data);
                    if (data.status) {
                        $('label[data-folder-id="'+folder_id+'"]').remove();
                    }
                });
            });
        });

        $('body').on('click', '#folder_edit', function(){
            edit_folder_modal($('.folder-menu').data('folder-id'));
        });

        $('body').on('dblclick', '.folder-title', function(){
            edit_folder_modal($(this).data('folder-id'));
        });

        function edit_folder_modal(folderId){
            var $this = $(this),
                $modal = $('#modal_edit_folder'),
                data = {};

            data.folder_id = folderId;
            $modal.data('folder-id', folderId);

            $.post('/dna/ajax_get_folder_info',{data: data}, function(data){
                data = $.parseJSON(data);
                if (data.status){
                    $('#folders_images_list').html(data.render);
                    $modal.find('#folder_text').val(data.folder_text);
                    $modal.modal();
                }
            });
        };

        $('body').on('click', '#save_folder', function(){
            var data = {},
                $modal = $('#modal_edit_folder');
            data.folder_text = $modal.find('#folder_text').val();
            data.folder_id = $modal.data('folder-id');

            $.post('/dna/ajax_edit_folder', {data: data}, function(){
                $('label[data-folder-id="'+data.folder_id+'"]').text(data.folder_text);
                $modal.modal('hide');
            })
        });

        //interface
        $('body').on('click', '.glyphicon-plus, .glyphicon-minus', function(){
            var $this = $(this);
            if ($this.hasClass('glyphicon-plus')){
                $this.parents('div.gallery-object').find('.folders-list').slideDown('fast');
                $this.removeClass('glyphicon-plus').addClass('glyphicon-minus');
            }else{
                $this.parents('div.gallery-object').find('.folders-list').slideUp('fast');
                $this.removeClass('glyphicon-minus').addClass('glyphicon-plus');
            }
        });

        $('body').on('contextmenu', '.folder-title', function(ev){
            ev.preventDefault();
            hide_menus();

            var $menu = $('.folder-menu');
            $menu.data('folder-id', $(this).data('folder-id'));
            $menu.css({left:ev.pageX, top:ev.pageY});
            $menu.show();
        });

        $('body').on('contextmenu', '.object-title', function(ev){
            ev.preventDefault();
            hide_menus();

            var $menu = $('.object-menu');
            $menu.css({left:ev.pageX, top:ev.pageY});
            $menu.data('object-id', $(this).data('object-id'));
            $menu.show();
        });

        $('body').on('contextmenu', '.object-menu, .folder-menu', function(ev){
            ev.preventDefault();
        });

        $('html, body').on('click', function(){
            hide_menus();
        });

        function hide_menus(){
            $('.object-menu').hide();
            $('.folder-menu').hide();
        }

        $('body').on('click', '#add_folder_images', function(){
            $('#add_images_input').click();
        });

        $('body').on('click', '#delete_all_folder_images', function(){
            var data = {},
                $modal = $('#modal_edit_folder');

            data.folder_id =  $modal.data('folder-id');

            modals.confirm('delete_all_folder_images', function () {
                $.post('/dna/delete_all_folder_images', {data: data}, function (data) {
                    data = $.parseJSON(data);
                    if (data.status) {
                        $('#modal_edit_folder').find('#folders_images_list').html('');
                    }
                });
            });
        });

        $('body').on('click', '.image-item', function(){
            $(this).toggleClass('selected-img');
        });

        $('body').on('click', '#delete_selected_images', function(){
            var data = {},
                $images = null,
                $modal = $('#modal_edit_folder');

            data.images_ids = [];
            data.folder_id = $modal.data('folder-id');

            modals.confirm('delete_selected_images', function () {
                $images = $modal.find('.selected-img');

                for(var i = 0; i < $images.length; i++){
                    var img = $($images[i]).parents('div[data-image-id]');
                    data.images_ids.push(img.data('image-id'));
                    img.remove();
                }

                $.post('/dna/delete_selected_images', {data: data}, function (data) {

                });
            });

        });

        $('body').on('change', '#add_images_input', function(){
            var $input = $(this),
                folder_id = $('#modal_edit_folder').data('folder-id'),
                total_files = 0,
                uploaded_count = 0;

            total_files = $input.prop('files').length;
            for (var i = 0; i<total_files; i++){
                form_data = new FormData();

                form_data.append('folder_id', folder_id);
                form_data.append('file'+i, $input.prop('files')[i]);

                $.ajax({
                    /*
                    xhr: function() {
                        var xhr = new window.XMLHttpRequest();
                        xhr.upload.addEventListener("progress", setProgress, false);
                        xhr.addEventListener("progress", setProgress, false);
                        return xhr;
                    },
                    */
                    url: '/dna/ajax_add_folder_images',
                    dataType: 'text',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data,
                    type: 'post',
                    enctype: 'multipart/form-data',
                    success: function(data){
                        data = $.parseJSON(data);
                        if (data.status){
                            uploaded_count++;
                            if (uploaded_count >= total_files){
                                $('#upload_progress').text('');
                            }else{
                                $('#upload_progress').text('Загружено: '+uploaded_count+'/'+total_files);
                            }
                            $('#folders_images_list').html(data.render);
                        }
                    }
                });

            }

            /*
            function setProgress(e) {
                if (e.lengthComputable) {
                    var complete = e.loaded / e.total;
                    $('#upload_progress').text('Загружено: '+Math.floor(complete*100)+"%");
                    //$("#pBar").text(Math.floor(complete*100)+"%");
                }
            }
            */

        });

        /*
        $('body').on('click', '.delete-image', function(){
            var $this = $(this),
                image_id = $this.parents('div[data-image-id]').data('image-id');

            modals.confirm('del_folder_image', function () {
                var data = {};
                data.folder_image_id = image_id;
                $.post('/dna/ajax_delete_folder_image', {data: data}, function (data) {
                    data = $.parseJSON(data);
                    if (data.status) {
                        $('#modal_edit_folder').find('div[data-image-id="'+image_id+'"]').remove();
                    }
                });
            });
        });
        */

        /*
        $('body').on('input','#folders_images_seach', function(){
            $.callAfter(searchFolderImages, 500, $(this).val());
        });

        function searchFolderImages(text){
            var data = {};
            data.text = text;
            data.folder_id = $('#modal_edit_folder').data('folder-id');

            $.post('/dna/search_folder_images', {data: data}, function(data){
                data = $.parseJSON(data);
                if (data.status){
                    $('#folders_images_list').html(data.render);
                }else{
                    $('#folders_images_list').html('');
                }
            });
        }
        */

        /*
        $('body').on('click', '.image-container', function(){
            var $this = $(this),
                $modal = $('#modal_edit_folder'),
                $glyph = null,
                data = {};

            data.image_id = $this.data('image-id');
            data.folder_id = $modal.data('folder-id');

            $.post('/dna/ajax_select_folder_image', {data: data}, function(data){
                data = $.parseJSON(data);
                if (data.status){
                    if (data.deleted){
                        $this.find('.glyphicon').addClass('dn');
                    }else{
                        $this.find('.glyphicon').removeClass('dn');
                    }
                }
            })
        });
        */

        /*
        $('.nav-tabs a').click(function(){
            $(this).tab('show');
        });
        */

    });
</script>