<? include('core/views/blocks/admin_head.php'); ?>

<div id="container">
    <div id="header">
        <? include('core/views/admin/blocks/menu.php'); ?>
    </div>

    <div id="body">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-3"><label>Имя</label></div>
                <div class="col-md-3 mh"><label>Телефон</label></div>
                <div class="col-md-3 mh"><label>Дата</label></div>
                <div class="col-md-1 mh"><label>Отвечен</label></div>
                <div class="col-md-1 mh"><label>Удалить</label></div>
            </div>
        </div>
        <?php if ($this->calls_list): ?>
        <? foreach ($this->calls_list as $call) : ?>
            <div class="row cell" data-object-id="<?= $call->request_id ?>">
                <div class="col-md-3"><?= $call->user_name ?></div>
                <div class="col-md-3 mh"><?= $call->user_phone ?></div>
                <div class="col-md-3 mh"><?= $call->date ?></div>
                <div class="col-md-1">
                    <? if ($call->is_answered) : ?>
                        <span class="fr glyphicon glyphicon-ok is_answered" aria-hidden="true"></span>
                    <? else : ?>
                        <span class="fr glyphicon glyphicon-remove is_answered" aria-hidden="true"></span>
                    <? endif; ?>
                </div>
                <div class="col-md-1">
                    <span class="fr glyphicon glyphicon-trash delete-call" aria-hidden="true"></span>
                </div>
            </div>
        <? endforeach ?>
        <?php endif; ?>
    </div>
</div>

<div id="footer">

</div>

<div class="modal fade" id="modal_call_info" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Информация о заказе звонка</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6"><label>Имя</label></div>
                    <div class="col-md-6" id="user_name">Телефон</div>
                </div>
                <div class="row">
                    <div class="col-md-6"><label>Телефон</label></div>
                    <div class="col-md-6" id="user_phone">Телефон</div>
                </div>
                <div class="row">
                    <div class="col-md-6"><label>Дата</label></div>
                    <div class="col-md-6" id="call_date">Телефон</div>
                </div>
                <div class="row">
                    <div class="col-md-12"><label>Текст</label></div>
                </div>
                <div class="row">
                    <div class="col-md-12" id="call_text"></div>
                </div>
                <br />
                <br />
                <div class="row">
                    <div class="col-md-6"><label>Отвечен</label></div>
                    <div class="col-md-6" >
                        <input type="checkbox" id="is_answered">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" id="confirm_cancel" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>

<? include('core/views/admin/blocks/modal_confirm.php'); ?>

<script>
    $(document).ready(function () {

        $('body').on('click', '#is_answered', function(){
            var data = {},
                $input = null;
            data.call_id = $('#modal_call_info').data('call-id');
            $input = $('div[data-object-id="'+data.call_id+'"]').find('.is_answered');

            if ($input.hasClass('glyphicon-ok')){
                $input.removeClass('glyphicon-ok').addClass('glyphicon-remove');
            }else{
                $input.removeClass('glyphicon-remove').addClass('glyphicon-ok');
            }

            $.post('/dna/ajax_check_call', {data: data});
        });

        $('body').on('click', '.cell', function () {
            var $this = $(this),
                data = {},
                $modal = $('#modal_call_info');

            data.call_id = $this.data('object-id');
            $modal.data('call-id', data.call_id);

            $.post('/dna/ajax_get_call_info', {data: data},  function(data){
                data = $.parseJSON(data);
                if (data.status){
                    data = data.info;
                    $modal.find('#user_name').text(data.user_name);
                    $modal.find('#user_phone').text(data.user_phone);
                    $modal.find('#call_date').text(data.date);
                    $modal.find('#call_text').text(data.text);

                    if (parseInt(data.is_answered)){
                        $modal.find('#is_answered').prop('checked', true);
                    }else{
                        $modal.find('#is_answered').prop('checked', false);
                    }
                    $modal.modal();
                }
            });
        });

        $('body').on('click', '.delete-call', function (ev) {
            ev.stopPropagation();

            var $this = $(this),
                data = {};

            data.call_id = $this.parents('div[data-object-id]').data('object-id');

            modals.confirm('delete_call', function () {
                $.post('/dna/ajax_delete_call', {data: data}, function (data) {
                    data = $.parseJSON(data);
                    if (data.status) {
                        $this.parents('.row').remove();
                    }
                })
            });


        });

    })
</script>