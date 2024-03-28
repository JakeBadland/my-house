<?php

$mainPhone = $this->IndexModel->getMainPhone();

switch ('index'){
    case 'index': { $active = 'Главная';} break;
    case 'gallery': { $active = 'Галерея';} break;
    case 'contacts': { $active = 'Контакты';} break;
    case 'pages': { $active = 'Главная';} break;
    default: {$active = '';}
}
?>

<header>
    <div class="header-menu transparent m-l2">
        <a href="/" class="header-logo fl">
            <img src="/images/logo-2.png" class="shadowed">
        </a>

        <div class="main-phone-hint fr" style="display: none">
            <a class="c-white" href="tel:<?=$mainPhone?>"><?=$mainPhone?></a>
        </div>
        <div class="main-phone-icon fr">
            <span class="glyphicon glyphicon-earphone" aria-hidden="true"></span>
        </div>

        <div class="header-links fr">
            <a href="/" class="active">Главная</a>
            <a href="/gallery" class="">Галерея</a>
            <a href="/contacts" class="">Контакты</a>
        </div>

        <div class="media-menu fr">
            <span class="active-item"><?=$active?>
                <span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span>
            </span>

            <div class="menu-items">
				<div><a href="/">Главная</a></div>
				<div><a href="/gallery">Галерея</a></div>
				<div><a href="/contacts">Контакты</a></div>
            </div>
        </div>

    </div>
</header>

<script>
    $(document).ready(function(){

        $('body').on('click', '.media-menu>.active-item', function(){
            $('.menu-items').toggle();
        });

        $('body').on('click', function(ev){
            var $hint = $('.main-phone-hint');
            if ( $hint.is(':visible') ){
                $hint.slideUp('fast');
            }
        });

        $('body').on('click', '.main-phone-icon', function (ev) {
            $('.main-phone-hint').slideDown('fast');
            ev.stopPropagation();
        });

        $('body').on('click', '.main-phone-hint', function () {
            $(this).slideUp('fast');
        });

    });
</script>
