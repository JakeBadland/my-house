<?php
$sliderImages = $this->SliderModel->getSliderImages();
?>

<div class="slider-panel m-l2">
    <div class="logo-clip">
        <img id="video_clip" src="">
    </div>

    <div class="slider hidden">
        <?php foreach ($sliderImages as $image) : ?>
            <div>
                <img src="<?=$image->preview?>">
            </div>
        <?php endforeach ?>
    </div>
</div>
<div class="mb20"></div>

<style>
    #video_clip{
        width: 100%;
    }
</style>

<script>
    $(document).ready(function(){

        $('#video_clip').attr('src', '/images/final-logo-optimized.gif');

        setTimeout(function(){
            $('.logo-clip').hide();
            $('.slider').removeClass('hidden');
        }, 10000);
        resizeSlider();
    });

    $(window).on('resize', function(){
        resizeSlider();
    });

    function resizeSlider(){
        var $slider = $('.slider-panel');
        $slider.height($slider.width() * 0.2636);
    }
</script>
