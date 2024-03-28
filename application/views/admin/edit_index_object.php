<? include('core/views/blocks/admin_head.php'); ?>

<div id="container">
    <div id="header">
        <? include('core/views/admin/blocks/menu.php'); ?>
    </div>

    <div id="body">

        <div class="panel panel-default">
            <div class="panel-body">

                <div data-object-id="<?=$this->object_info->item_id?>"></div>

                <div class="edit-index-object">
                    <label for="object_title">Заголовок:</label>
                    <input class="" id="object_title" type="text" value="<?=$this->object_info->title?>">
                </div>

                <div class="edit-index-object">
                    <label for="object_description">Описание:</label>
                    <div>
                        <textarea id="object_description" ><?=$this->object_info->description?></textarea>
                    </div>
                </div>

                <div class="edit-index-object">
                    <label for="full_object_description">Полный текст:</label>
                    <div>
                        <textarea id="full_object_description" ><?=$this->object_info->full_description?></textarea>
                    </div>
                </div>

                <div class="edit-index-object">
                    <button type="button" class="btn btn-default" id="crop_img">Обрезать</button>
                </div>

                <div class="edit-index-object">
                    <img class="edit-index-image" id="object_img" src="<?=$this->object_info->image?>">
                    <img class="edit-index-preview" id="preview_img" src="<?=$this->object_info->preview?>">
                </div>

                <div class="edit-index-object">
                    <label for="change_image">Заменить изображение:</label>
                    <input type="file" id="change_image">
                </div>

                <div class="edit-index-object">
                    <label for="object_enabled">Включено?</label>
                    <input type="checkbox" id="object_enabled" <?php echo ($this->object_info->enabled == '1')? 'checked="checked"': '' ?>
                </div>

                <div class="mb40"></div>
                <button type="button" class="btn btn-default" id="select_index_images">Выбрать изображения</button>
                <br />
                <br />
                <div class="edit-index-object index-images-container">
                    <?php if ($this->images) : ?>
                        <?php foreach ($this->images as $image) : ?>
                            <img class="edit-index-image" src="<?=$image->path?>">
                        <? endforeach; ?>
                    <? endif; ?>
                </div>

                <button type="button" class="btn btn-default fr" id="save_object">Сохранить</button>
                <div class="mb40"></div>
            </div>



        </div>

    </div>


    <div id="footer">

    </div>
</div>

<div class="modal fade" id="modal_select_index_images" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Выбрать изображения</h4>
            </div>
            <div class="modal-body">
                <div id="images_container">

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        var preview = {};

        CKEDITOR.replace('full_object_description');

        $('#modal_select_index_images').on('hidden.bs.modal', function () {
            location.reload();
        });

        $('body').on('click', '.image-item', function(){
           var $this = $(this),
               $modal = $('#modal_select_index_images'),
               data = {};

            data.image_id = $this.parents('div[data-image-id]').data('image-id');
            data.object_id = $modal.data('object-id');

            if ($this.hasClass('image-selected')){
                $this.removeClass('image-selected');
            }else{
                $this.addClass('image-selected');
            }

            $.post('/dna/ajax_update_index_image', {data: data});
        });

        $('body').on('click', '#select_index_images', function(){
            var data = {},
                $modal = $('#modal_select_index_images');

            data.object_id = $('div[data-object-id]').data('object-id');
            $modal.data('object-id', data.object_id);

            $.post('/dna/ajax_get_index_object_images', {data : data}, function(data){
                data = $.parseJSON(data);
                if (data.status){
                    $('#images_container').html(data.render);
                }
            });
            $modal.modal();
        });

        $('body').on('click', '#crop_img', function(){
            $('#object_img').imgAreaSelect(
                {
                    aspectRatio: '1:1',
                    x1: 0, y1: 0, x2: 200, y2: 200,
                    onSelectChange: function(img, selection){
                        var image = document.getElementById('object_img');
                        preview.selection = selection;
                        preview.selection.img_w = image.clientWidth;
                        preview.selection.img_h = image.clientHeight;
                    }
                }
            );
        });

        $('body').on('click', '#save_object', function () {
            var $modal = $(this).parents('#modal_edit_index_object'),
                data = {};

            data.object_id = $('div[data-object-id]').data('object-id');

            data.title = $('#object_title').val();
            data.description = $('#object_description').val();
            data.full_description = CKEDITOR.instances.full_object_description.getData();
            data.image = $('#object_img').attr('src');
            data.enabled = $('#object_enabled').prop('checked');
            data.selection = preview.selection;

            $.post('/dna/ajax_set_index_object_info', {data: data}, function (data) {
                window.location.href = '/dna/main';
            });
        });

        $('body').on('change', '#change_image', function () {
            var $this = $(this),
                form_data = new FormData(),
                $image = $("#object_img"),
                object_id = $('div[data-object-id]').data('object-id');

            form_data.append('file', $this.prop('files')[0]);
            form_data.append('object_id', object_id);

            $.ajax({
                url: '/dna/ajax_change_index_image',
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                success: function(data){
                    d = new Date();
                    $image.attr('src', '/images/index/' + object_id + '.jpg?'+d.getTime());
                }
            });
        });

    });
</script>