<? include('core/views/blocks/admin_head.php'); ?>

<input type="hidden" id="user_token" value="<?=$this->user_token?>">

<div id="container">
    <div id="header">
        <? include('core/views/admin/blocks/menu.php'); ?>
    </div>

    <div id="body">
        <div class="panel-body">
            <table class="table">
                <thead>
                <tr>
                    <th>Имя</th>
                    <th>Email</th>
                    <th class="mh">Дата</th>
                    <th class="mh">Отвечен</th>
                    <th></th>
                </tr>
                </thead>
                <tbody id="messages_container">
                <? if ($this->messages_list) : ?>
                    <? foreach ($this->messages_list as $message) : ?>
                        <? include('core/views/admin/blocks/messages_list.php'); ?>
                    <? endforeach ?>
                <? endif ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="footer">

</div>

<div class="modal fade" id="modal_messages_info" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Диалог</h4>
            </div>
            <div class="modal-body">
                <div class="dialog">

                </div>
                <br/>
                <textarea id="message_reply"></textarea>
                <br/>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" id="send_message_reply">Отправить</button>
            </div>
        </div>
    </div>
</div>

<? include('core/views/admin/blocks/modal_confirm.php'); ?>

<script>
    $(document).ready(function () {
        $('body').on('click', '#message_test', function () {
            var $modal = $('#modal_messages_info');

            $.post('/dna/ajax_redraw_messages', function (data) {
                data = $.parseJSON(data);
                if (data.status){
                    $('#messages_container').html(data.render);
                }
            })
        });

        var data = {};
        data.user_token = $('#user_token').val();

        if (data.user_token !== '') {
            $.post('/dna/ajax_get_last_message_id', {data: data}, function (data) {
                data = $.parseJSON(data);

                if (data.status) {
                    showDialog(data.message_id);
                }
            })
        }

        $('body').on('click', '.delete-dialog', function (ev) {
            ev.stopPropagation();

            var $this = $(this),
                data = {};

            data.message_id = $this.parents('tr[data-message-id]').data('message-id');
            modals.confirm('delete_messages_dialog', function () {
                $.post('/dna/ajax_delete_dialog', {data: data}, function (data) {
                    data = $.parseJSON(data);
                    if (data.status) {
                        $this.parents('tr').remove();
                    }
                })
            });
        });

        $('body').on('click', '#send_message_reply', function () {
            var data = {},
                $modal = $('#modal_messages_info');

            clearInterval(soundInterval);

            data.message_id = $modal.data('message-id');
            data.text = $('#message_reply').val();

            $.post('/dna/ajax_reply_message', {data: data}, function (data) {
                data = $.parseJSON(data);
                if (data.status) {
                    $('#message_reply').val('');
                    $('.dialog')
                        .append(data.render)
                        .animate({
                                scrollTop: 100000
                            }, 'fast');

                    $.post('/dna/ajax_redraw_messages', function(data){
                        data = $.parseJSON(data);
                        if (data.status){
                            $('#messages_container').html(data.render);
                        }
                    })
                }
            });
        });

        $('body').on('click', '.cell', function () {
            var message_id = $(this).data('message-id');
            clearInterval(soundInterval);
            showDialog(message_id);
        });

    })
</script>