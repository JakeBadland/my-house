<? include ('core/views/blocks/admin_head.php'); ?>

<div id="container">
    <div id="header">
        <? include ('core/views/admin/blocks/menu.php'); ?>
    </div>

    <div id="body">
        <div class="input-group">
            <input id="search-input" type="text" class="form-control" placeholder="file name...">
            <span class="input-group-btn">
        <button class="btn btn-default" type="button" id="upload_btn">Upload more</button>
        <input multiple="multiple" name="upload_files[]" type="file" id="upload_images" style="display: none">
      </span>
        </div>
    </div>

    <br/>
    <div class="panel panel-default">
        <div class="panel-body images-container">
            <? foreach ($this->images_list as $image) : ?>
                <? include ('core/views/admin/blocks/image-item.php'); ?>
            <? endforeach; ?>
        </div>
    </div>

    <div id="footer">

    </div>
</div>

<script>
    $(document).ready(function(){
        $('body').on('click', '#upload_btn', function(){
            $('#upload_images').click();
        });

        $('body').on('click', '.delete-image', function(){
            var data = {},
                $this = $(this),
                $container = $this.parents('div[data-image-id]');

            data.image_id = $container.data('image-id');
            $.post('/dna/ajax_delete_image', {data: data}, function(data){
                data = $.parseJSON(data);
                if (data.status){
                    $container.remove();
                }
            })
        });

        $('body').on('input', '#search-input', function(){
            $.callAfter(searchImages, 500, $(this).val());
        });

        function searchImages(text){
            var data = {};
            data.text = text;
            $.post('/dna/search_images', {data: data}, function(data){
                data = $.parseJSON(data);
                if (data.status){
                    $('.images-container').html(data.render);
                }
            });
        }

        $('body').on('change', '#upload_images', function(){

            var form_data = new FormData(),
                $input = $(this);

            for (var i = 0; i<$input.prop('files').length; i++){
                form_data.append('file'+i, $input.prop('files')[i]);
            }

            $.ajax({
                url: '/dna/upload_file',
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                success: function(data){
                    $('#modal_image').modal();
                    location.reload();
                }
            });
        });
    });
</script>