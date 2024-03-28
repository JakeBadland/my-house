<? include ('core/views/blocks/admin_head.php'); ?>

<div id="container">
    <div id="header">
        <? include ('core/views/admin/blocks/menu.php'); ?>
    </div>

    <div id="body">
        <div>
            <button type="button" class="btn btn-default" id="add_images">Добавить изображения</button>
            <input class="hidden" multiple="multiple" name="upload_files[]" type="file" id="add_slider_images">
        </div>
        <br />
        <div class="slider-items">
            <? if (!empty($this->slider_list)) : ?>
                <? foreach ($this->slider_list as $key => $image) : ?>
                    <div data-object-id="<?=$image->image_id?>" class="image-item fl m-l1">
                        <img src="<?=$image->path?>">
                        <input class="toggle-image" type="checkbox" id="select_image<?=$key?>" <? echo ($image->is_enabled)? 'checked': '' ?>>
                        <label for="select_image<?=$key?>">Отображать на сайте</label>
                        <button type="button" class="btn btn-default show-slider-image">Показать</button>
                        <button type="button" class="btn btn-default delete-slider-image">Удалить</button>
                    </div>
                <? endforeach; ?>
            <? endif ?>

        </div>
    </div>

    <div id="footer">

    </div>

    <div class="modal fade" id="modal_edit_image" data-folder-id="" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Редактирование изображения</h4>
                </div>
                <div class="modal-body">
                    <div class="h40">
                        <button type="button" class="btn btn-default" id="crop_image">Обрезать</button>
                        <button type="button" class="btn btn-default" id="save_image">Сохранить</button>
                    </div>
                    <img id="slider_image" src="">
                    <br />
                    <br />
                    <img id="cropped_slider_image" src="">
                    <br />
                </div>
            </div>
        </div>
    </div>

</div>

<style>
    #slider_image{
        width: 100%;
    }
    #cropped_slider_image{
        width: 100%;
    }
</style>

<? include ('core/views/admin/blocks/modal_confirm.php'); ?>
<script>
    var preview = {};

    $(document).ready(function(){

        $('.slider-items').sortable({
            stop: function (event, ui) {
                var data = {},
                    $images = $('.slider-items').find('.image-item');

                data.images = [];
                for (var i = 0; i<$images.length; i++){
                    var info = {};
                    info.order = i;
                    info.image_id = $($images[i]).data('object-id');
                    data.images.push(info);
                }

                $.post('/dna/update_slider_order', {data: data});
            }
        });

        $('body').on('click', '.show-slider-image', function(){
            var data = {},
                $modal = $('#modal_edit_image'),
                $container = $(this).parents('div[data-object-id]');

            data.image_id = $container.data('object-id');
            $modal.data('image-id', data.image_id);
            $.post('/dna/get_slider_image_info', {data: data}, function(data){
                data = $.parseJSON(data);
                if (data.status){
                    data = data.data;
                    $modal.find('#slider_image').attr('src', data.path);
                    $modal.find('#cropped_slider_image').attr('src', data.preview);
                    $modal.modal();
                }
            });

        });

        $('body').on('click', '#crop_image', function(){
            $('#slider_image').imgAreaSelect(
                {
                    aspectRatio: '1024:270',
                    x1: 0, y1: 0, x2: 512, y2: 135,
                    onSelectChange: function(img, selection){
                        var image = document.getElementById('slider_image');
                        preview.selection = selection;
                        preview.selection.img_w = image.clientWidth;
                        preview.selection.img_h = image.clientHeight;
                    }
                }
            );
        });

        $('body').on('click', '#save_image', function(){
            var data = {},
                $modal = $('#modal_edit_image');

            data.image_id = $modal.data('image-id');
            data.selection = preview.selection;

            $.post('/dna/crop_slider_image', {data: data}, function(){
                $modal.modal('hide');
            })
        });

        $('body').on('click', '.delete-slider-image', function(){
            var $container = $(this).parents('div[data-object-id]');
            modals.confirm('confirm_image', function () {
                var data = {};
                data.image_id = $container.attr('data-object-id');
                $.post('/dna/ajax_delete_slider_image', {data: data}, function(data){
                    data = $.parseJSON(data);
                    if (data.status){
                        $container.remove();
                    }
                })
            });
        });

        $('body').on('change', '.toggle-image', function(){
            var $this = $(this),
                data = {};

            data.image_id = $this.parents('div[data-object-id]').data('object-id');
            if ($this.is(':checked')){
                data.selected = 1;
            }else{
                data.selected = 0;
            }
            $.post('/dna/select_slider_image', {data: data});
        });

        /*
        $('body').on('click', '.select-slider-img', function(){
            var $this = $(this),
                data = {};

            data.image_id = $this.parents('div[data-object-id]').data('object-id');

            if ( $this.hasClass('glyphicon-ok') ){
                data.selected = 0;
                $this.removeClass('glyphicon-ok')
                    .addClass('glyphicon-remove');
            }else{
                data.selected = 1;
                $this.removeClass('glyphicon-remove')
                    .addClass('glyphicon-ok');
            }

            $.post('/dna/select_slider_image', {data: data})
        });
        */

        $('body').on('click', '#add_images', function(){
            $('#add_slider_images').click();
        });

        $('body').on('change', '#add_slider_images', function(){
            var form_data = new FormData(),
                $input = $(this);

            for (var i = 0; i<$input.prop('files').length; i++){
                form_data.append('file'+i, $input.prop('files')[i]);
            }

            $.ajax({
                url: '/dna/ajax_add_slider_images',
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                success: function(data){
                    data = $.parseJSON(data);
                    if (data.status){
                        location.reload();
                    }
                }
            });

        });

        /*

        $('body').on('click', '#add_images', function(){
            $('#modal_add_images').modal();
        });

        $('body').on('click', '.image-adding', function(){
            var $this = $(this),
                data = {};
            data.image_id = $this.attr('data-object-id');
            $.post('/dna/add_slider_image', {data: data}, function(data){
                data = $.parseJSON(data);
                if (data.status){
                    $this.remove();
                }
            });
        });

        $('body').on('click', '#confirm_add_images', function(){
            location.reload();
        });
        */
    });
</script>