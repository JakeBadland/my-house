$(document).ready(function () {

    var $slider = $('.slider');
    if ($slider.length){
        $slider.slick({
            autoplay: true,
            autoplaySpeed: 2000,
            arrows: false
        });
    }

    lightbox.option({
        'resizeDuration': 500,
        'wrapAround': true,
        'positionFromTop': 10,
        showImageNumberLabel: false
        //'maxHeight' : '80'
    });

    /*
    var scroll = $(window).scrollTop();
    console.log(scroll);
    */
});

$(window).scroll(function() {
    var scrollTop = $(window).scrollTop(),
        $goup = $('#go_up');

    if (scrollTop > 0){
        if (parseFloat($goup.css('opacity')) === 0.0){
            $goup.fadeTo("fast", 0.50);
        }
    }else{
        if (parseFloat($goup.css('opacity')) === 0.5){
            $goup.fadeTo("fast", 0.00);
        }
    }
});

$.callAfter = function(callback, interval, params){
    params = params || null;
    if (this.timer){
        clearTimeout(this.timer);
        this.timer = setTimeout(function() {
            callback(params);
        }, interval);
    }else{
        this.timer = setTimeout(function() {
            callback(params);
        }, interval);
    }
};

var log = {
    clear: function(){
        $.noty.closeAll();
    },

    show : function(type, text, layout, timeout, buttons){
        if (!type) type='alert';
        if (!layout) layout='top';
        if (!timeout) timeout=5000;
        var n = noty({
            layout: layout, //topLeft, topCenter, topRight, centerLeft, center, centerRight, bottomLeft, bottomCenter, bottomRight
            theme: 'relax', // or 'relax'
            type: type, //alert, success, error, warning, information, confirm
            text: text,
            timeout: timeout,
            template: '<div class="noty_message"><span class="noty_text"></span><div class="noty_close"></div></div>',
            animation: {
                open: {height: 'toggle'}, // Animate.css class names
                close: {height: 'toggle'}, // Animate.css class names
                easing: 'swing', // unavailable - no need
                speed: 500 // unavailable - no need
            }
        });
    }
};


var modals = {
    confirm : function(btn_name, callback){
        var btn_class = btn_name+'_class',
            $modal = $("#modal_confirm");
        $modal.find('#confirm_delete_ok').addClass(btn_class);
        $modal.modal();
        $('.'+btn_class).off();
        $('.'+btn_class).on('click', function(){
            $modal.modal('hide');
            callback();
        });
    },
    input: function(btn_name, callback){
        var btn_class = btn_name+'_class',
            $modal = $("#modal_input");
        $modal.find('#confirm_ok').addClass(btn_class);
        $modal.modal();
        $('.'+btn_class).off();
        $('.'+btn_class).on('click', function(){
            $modal.modal('hide');
            callback($('#modal_input').find('input').val());
        });
    }
};






