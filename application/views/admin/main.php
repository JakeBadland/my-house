<? include('core/views/blocks/admin_head.php'); ?>

<div id="container">
    <div id="header">
        <? include('core/views/admin/blocks/menu.php'); ?>
    </div>

    <div id="body">
        <div class="m-l1">
            <button type="button" class="btn btn-default" id="add_index_object">Добавить</button>
            <div class="mb20"></div>
            <ul class="list-group">
                <? foreach ($this->objects_list as $object) : ?>
                    <a href="/dna/edit_index_object/<?=$object->item_id?>">
                        <li class="list-group-item index-object" data-object-id="<?=$object->item_id?>">
                            <label><?=$object->title ?></label>
                        <span class="fr glyphicon glyphicon-trash delete-index-object" aria-hidden="true"></span>
                        <!--
                        <? if ($object->preview) : ?>
                            <span class="fr glyphicon glyphicon-ok" aria-hidden="true"></span>
                        <? endif; ?>
                        -->
                        </li>
                    </a>
                <? endforeach ?>
            </ul>
        </div>
    </div>

    <div id="footer">

    </div>
</div>

<!--
<div class="modal fade" id="modal_edit_index_object" data-object-id="" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Редактирование объекта</h4>
            </div>
            <div class="modal-body">
                <input class="db input100" type="text" id="object_title"><br/>
                <input class="db input100" type="text" id="object_desc"><br/>
                <img src="/images/index/01.jpg" id="object_img">
                <img src="/images/index/01.jpg" id="preview_img">
                <br/>
                <br/>
                Заменить изображение:<br/>
                <input type="file" id="change_image">
                <br/>
                <button type="button" class="btn btn-default" id="crop_img">Обрезать</button>
                <br/>
                <br/>
                <span>Включено</span>
                <input type="checkbox" id="object_enabled">
                <div class="h40">
                    <button type="button" class="btn btn-default fr" id="save_object">Сохранить</button>
                </div>
            </div>
        </div>
    </div>
</div>
-->

<script>

    $(document).ready(function () {

        $('body').on('click', '.delete-index-object', function(ev){
            ev.preventDefault();
            var $this = $(this),
                data = {};
            data.object_id = $this.parents('li[data-object-id]').data('object-id');
            $.post('/dna/ajax_del_index_object', {data: data}, function(){
                $('.index-object[data-object-id="'+data.object_id+'"]').remove();
            })
        });

        $('body').on('click', '#add_index_object', function(){
            $.post('/dna/ajax_add_index_object', {}, function(data){
                data = $.parseJSON(data);
                if (data.status){
                    window.location.href = '/dna/edit_index_object/' + data.object_id;
                }
            })
        });


    /*
    var preview = {};

    $('body').on('click', '#save_object', function () {
        var $modal = $(this).parents('#modal_edit_index_object'),
            data = {};

        data.object_id = $modal.data('object-id');

        data.title = $modal.find('#object_title').val();
        data.description = $modal.find('#object_desc').val();
        data.image = $modal.find('#object_img').attr('src');
        data.enabled = $modal.find('#object_enabled').prop('checked');
        data.selection = preview.selection;

        $.post('/dna/ajax_set_index_object_info', {data: data}, function (data) {
            location.reload();
        });
    });

    $('body').on('change', '#change_image', function () {
        var $this = $(this),
            form_data = new FormData(),
            $image = $("#object_img"),
            object_id = $this.parents('div[data-object-id]').data('object-id');

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

    $('body').on('click', '.index-object>label', function () {
        var $this = $(this),
            object_id = $this.parents('li[data-object-id]').data('object-id');

        edit_object(object_id);
    });

    function edit_object(object_id){
        var data = {},
            $modal = $('#modal_edit_index_object');

        data.object_id = object_id;
        $modal.data('object-id', object_id);

        $.post('/dna/ajax_get_index_object_info', {data: data}, function (data) {
            data = $.parseJSON(data);
            if (data.status) {
                data = data.data;

                $modal.find('#object_title').val(data.title);
                $modal.find('#object_desc').val(data.description);
                $modal.find('#object_img').attr('src', data.image);
                $modal.find('#preview_img').attr('src', data.preview);
                $modal.find('#object_enabled').attr('checked', data.enabled);
                $modal.modal();
            }
        });

    }

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
    })

    */

})

</script>