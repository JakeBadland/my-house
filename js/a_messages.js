var message_id = null,
    //parent_id = null,
    myAudio = new Audio,
    timerInterval = null,
    soundInterval = null;

myAudio.src = "../sounds/warning.wav";

function playSound(){
    myAudio.play();
}

function checkNewMessages(){
    $.post('/dna/check_new_messages', function(data){
        data = $.parseJSON(data);

        if (!data.status){
            clearInterval(soundInterval);
        }

        if (data.status){
            var $mes_noty = $('.message-notification');
            var $modal = $('#modal_messages_info');

            if (message_id !== data.message_id){
                message_id = data.message_id;
                //parent_id = data.parent_id;

                if (data.play_sound){
                    playSound();
                    if (!soundInterval){
                        soundInterval = setInterval(playSound , 5000);
                    }
                }

                //soundInterval = setInterval(playSound , 5000);

                $mes_noty.find('div').html(data.message_text);
                $mes_noty.show();
                if ( $modal.is(':visible') && $modal.data('parent-id') == data.parent_id){
                    $modal.find('.dialog')
                        .append('<div class="message tal">'+data.message_text+'</div></br>')
                        .animate({
                            scrollTop: 100000
                        }, 'fast');

                }

                if ( typeof $modal.data('parent-id') == 'undefined'){
                    $modal.data('parent-id', data.parent_id);
                }

                $.post('/dna/ajax_redraw_messages', function(data){
                    data = $.parseJSON(data);
                    if (data.status){
                        $('#messages_container').html(data.render);
                    }
                })

            }
        }
    })
}

function showDialog(message_id){
    var data = {},
        $modal = $('#modal_messages_info');

    data.message_id = message_id;
    $modal.data('message-id', message_id);

    $.post('/dna/get_dialog', {data: data}, function(data){
        data = $.parseJSON(data);
        if (data.status){
            var $dialog = $('.dialog');

            $dialog
                .html(data.render)
                .animate({
                    scrollTop: 100000
                }, 'fast');
            $modal.find('.modal-title').text(data.user_name);
            $modal.modal();
        }
    })

}

$(document).ready(function(){
    timerInterval = setInterval(checkNewMessages , 5000);

    $('body').on('click', '.message-notification', function(ev){
        var message_id = $(this).find('div[data-message-id]').data('message-id');
        $(this).hide();
        showDialog(message_id);
    });

    $('body').on('keypress', '#login,#pass', function (ev) {
        if (ev.which === 13){
            $('#submit').click();
        }
    });

});