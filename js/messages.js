var user_token = '',
    user_email = '',
    checkMessagesInterval = null;

var notify = {
    last_message_id: null,
    sound: new Audio
};

notify.sound.src = "../sounds/warning.wav";

$(document).ready(function () {
    user_token = $.cookie('user_token');

    if (typeof user_token !== 'undefined') {
        checkMessagesInterval = setInterval(checkNewMessages, 5000);
    }

    $('body').on('click', function(ev){
        var $hint_mes = $('.help-hint-messages');
        var $hint_com = $('.help-hint-comments');
        if ($hint_mes.is(':visible')){
            $hint_mes.hide();
            ev.stopPropagation();
        }
        if ($hint_com.is(':visible')){
            $hint_com.hide();
            ev.stopPropagation();
        }
    });

    $('body').on('click', '.help-icon-messages', function (ev) {
        $(this).parents('.modal-body').find('.help-hint-messages').show();
        ev.stopPropagation();
    });

    $('body').on('click', '.help-icon-comments', function (ev) {
        $(this).parents('.comment-reply-form').find('.help-hint-comments').show();
        ev.stopPropagation();
    });

    $('body').on('click', '.help-hint-messages', function () {
        $(this).hide();
    });

    $('body').on('click', '#admin_message', function () {
        showDialog();
    });

    $('body').on('click', '#send_message_reply', function () {
        var data = {},
            $modal = $('#modal_messages_dialog');

        data.text = $modal.find('#message_reply').val();
        data.post_key = $('body').data('post-key');

        $.post('/contacts/ajax_reply_message', {data: data}, function (data) {
            data = $.parseJSON(data);
            log.clear();
            if (data.status) {
                $('.dialog')
                    .append(data.render)
                    .animate({
                        scrollTop: 100000
                    }, 'slow');
                $('body').data('post-key', data.post_key);
                $modal.find('textarea').val('').focus();
            } else {
                log.show('error', data.message);
            }
        });
    });

    $('body').on('click', '#confirm_admin_message', function () {
        var data = {},
            $modal = $('#modal_admin_message');

        user_email = $modal.find('#admin_message_email').val();

        data.user_name = $modal.find('#admin_message_user_name').val();
        data.user_email = user_email;
        data.text = $modal.find('#admin_message_text').val();
        data.post_key = $('body').data('post-key');

        $.post('/contacts/ajax_send_admin_message', {data: data}, function (data) {
            data = $.parseJSON(data);
            if (data.status) {

                if (data.is_new) {
                    log.clear();
                    log.show('success', data.message);
                }

                user_token = data.user_token;

                checkMessagesInterval = setInterval(checkNewMessages, 5000);
                $modal.find('#admin_message_text').val('');
                //$('body').data('post-key', data.post_key);
                $modal.modal('hide');
                $('#admin_message').click();
            } else {
                log.clear();
                log.show('error', data.message);
            }
        });

    });

    $('body').on('click', '.comment-reply>a', function (ev) {
        ev.preventDefault();

        $('.comment-reply').slideUp('fast');
        $('.comment-reply-form').slideDown('fast');
    });

    $('body').on('click', '#send_comment', function () {
        var data = {};
        data.user_name = $('#user_name').val();
        data.user_email = $('#user_email').val();
        data.text = $('.comment-reply-form').find('textarea').val();
        data.post_key = $('body[data-post-key]').data('post-key')

        $.post('/contacts/add_comment', {data: data}, function (data) {
            data = $.parseJSON(data);
            if (data.status) {
                $(data.render).insertAfter(".comment-reply-form");
                $('body').data('post-key', data.post_key);
                $('.comment-reply-form').hide();
            } else {
                log.clear();
                log.show('error', data.message);
            }
        })
    });

    $('body').on('click', '.load-comment-info', function (ev) {
        ev.preventDefault();

        var $this = $(this),
            data = {},
            $container = $this.parents('div[data-comment-id]');

        data.comment_id = $container.data('comment-id');
        $.post('/contacts/get_comment_text', {data: data}, function (data) {
            data = $.parseJSON(data);
            if (data.status) {
                $container.find('.comment-body').html(data.text);
            }
        })

    });

    $('body').on('click', '#load_more_comments', function (ev) {
        ev.preventDefault();

        var $this = $(this),
            data = {},
            $container = $this.parents('div[data-page]');

        data.page = $container.data('page');
        $.post('/contacts/ajax_load_more_comments', {data: data}, function (data) {
            data = $.parseJSON(data);
            if (data.status) {
                $(data.render).insertBefore($this.parents('div.comment-container'));
                var page = $container.data('page');
                page++;
                $container.data('page', page);
            } else {
                $('#load_more_comments').parents('div.comment-container').remove();
            }
        })
    });

    $('body').on('click', '.comment-edit', function () {
        var $this = $(this),
            $modal = $('#modal_edit_comment'),
            data = {};

        $modal.data('comment-id', $this.parents('div[data-comment-id]').data('comment-id'));
        data.comment_id = $modal.data('comment-id');
        $.post('/contacts/ajax_get_comment_info', {data: data}, function (data) {
            data = $.parseJSON(data);
            if (data.status) {
                data = data.info;
                $('#modal_user_name').val(data.user_name);
                $('#modal_text').val(data.text);
                $modal.modal();
            }
        });
    });

    $('body').on('click', '#confirm_edit_comment', function () {
        var data = {},
            $modal = $('#modal_edit_comment');

        data.text = $modal.find('#modal_text').val();
        data.user_name = $modal.find('#modal_user_name').val();
        data.comment_id = $modal.data('comment-id');
        $.post('/contacts/ajax_edit_comment', {data: data}, function (data) {
            data = $.parseJSON(data);
            if (data.status) {
                location.reload();
            }
        })
    });

    $('body').on('click', '.comment-delete', function () {
        var $this = $(this),
            $modal = $('#modal_confirm');

        $modal.data('comment-id', $this.parents('div[data-comment-id]').data('comment-id'));
        $modal.modal();
    });

    $('body').on('click', '#confirm_delete_ok', function () {
        var data = {},
            $modal = $('#modal_confirm');

        data.comment_id = $modal.data('comment-id');
        $.post('/contacts/ajax_delete_comment', {data: data}, function () {
            $('div[data-comment-id="' + $modal.data('comment-id') + '"]').remove();
            $modal.modal('hide');
        })
    });

    $('body').on('click', '.comment-reply-btn', function () {
        var $modal = $('#modal_reply_comment');
        $modal.data('comment-id', $(this).parents('div[data-comment-id]').data('comment-id'));
        $modal.modal();
    });

    $('body').on('click', '#cancel_comment', function () {
        $('.comment-reply-form').slideUp('fast');
        $('.comment-reply').slideDown('fast');
    });

    $('body').on('click', '#go_up', function () {
        $("html, body").animate({scrollTop: 0}, "slow");
    });

    $('body').on('click', '#confirm_reply_comment', function () {
        var data = {},
            $modal = $('#modal_reply_comment');

        data.parent_comment_id = $modal.data('comment-id');
        data.user_name = $('#reply_user_name').val();
        data.user_email = $('#reply_email').val();
        data.text = $('#reply_text').val();
        data.post_key = $('body').data('post-key');

        $.post('/contacts/ajax_reply_comment', {data: data}, function (data) {
            data = $.parseJSON(data);
            if (data.status) {
                $(data.render).insertAfter(".comment-reply-form");
                $('body').data('post-key', data.post_key);
                $modal.modal('hide');
            } else {
                log.clear();
                log.show('error', data.message);
            }
        });
    });
});

function checkNewMessages() {
    var $dialog = $('#modal_messages_dialog');

    $.post('/contacts/check_new_messages', {}, function (data) {
        data = $.parseJSON(data);
        if (data.status) {
            //clearInterval(checkMessagesInterval);
            $('.new-messages').removeClass('hidden');

            if (data.message_id !== notify.last_message_id) {
                notify.last_message_id = data.message_id;
                if (!$dialog.is(':visible')){
                    notify.sound.play();
                }
                showDialog();
            }
        }
    })
}

function showDialog() {
    var $dialog = $('#modal_messages_dialog');
    $.post('/contacts/get_dialog', {user_email : user_email}, function (data) {
        data = $.parseJSON(data);
        if (data.status) {
            $dialog.find('.consultant-name').text(data.consultant_name);
            $('.new-messages').addClass('hidden');
            var $messages = $dialog.find('.dialog');
            $messages.html(data.render)
                .animate({
                    scrollTop: 100000
                }, 'slow');
            $dialog.modal();
        } else {
            $('#modal_admin_message').modal();
        }
    });
}

$("#admin_message").hover(
    function () {
        $(this).animate({left: '-10px'}, 'fast')
    },
    function () {
        $(this).animate({left: '-20px'}, 'fast')
    });