var defaults = {
    autostart: true, // Boolean; If set as 'true' jGallery will be started automatically after loading the document(only for full-screen or standard mode).; [ true, false ]
    autostartAtImage: 1, // Number; Number of image which will be loaded by autostart(only when 'autostart' parameter set as 'true').; ; [ 1, 2, 3 ]
    autostartAtAlbum: 1, // Number; Number of album which will be loaded by autostart(only when 'autostart' parameter set as 'true').; ; [ 1, 2, 3 ]
    backgroundColor: '#fff', // String; Background color for jGallery container.; ; [ '#ffffff', 'silver' ]
    browserHistory: true, // Boolean; If set as 'true', changes of active image will be saved in browser history.; [ true, false ]
    canChangeMode: true, // Boolean; If set as 'true' you can change display mode(only for full-screen or standard mode).; [ true, false ]
    canClose: false, // Boolean; If set as 'true' you can close jGallery(only for full-screen or standard mode).; [ true, false ]
    canMinimalizeThumbnails: true, // Boolean; If set as 'true', you can minimalize thumbnails(only when 'thumbnails' parameter set as 'true').; [ true, false ]
    canZoom: true, // Boolean; If set as 'true' you can zoom photos.; [ true, false ]
    disabledOnIE8AndOlder: true, // Boolean; If set as 'true', jGallery will be blocked for Internet Explorer 8 and older.; [ true, false ]
    draggableZoom: true, // Boolean; If set as 'true' you can drag active image.; [ true, false ]
    draggableZoomHideNavigationOnMobile: true, // Boolean; If set as 'true' navigation of draggable zoom will be hidden when width of window <= 'maxMobileWidth' parameter (default value - 767px); [ true, false ]
    height: '600px', // String; Height of jGallery container(only for standard or slider mode).
    hideThumbnailsOnInit: false, // Boolean; If set as 'true', thumbnails will be minimized by default, when jGallery will be started(only when 'thumbnails' parameter set as 'true').; [ true, false ]
    items: null, // Array | null; You can pass images as array (you don't have to create HTML elements).
    maxMobileWidth: 767, // Number; Maximum width(px) for jGallery shows a view for mobile device.
    mode: 'standard', // String; Display mode.; [ 'full-screen', 'standard', 'slider' ]
    preloadAll: false, // Boolean; If set as 'true', all photos will be loaded before first shown photo.; [ true, false ]
    slideshow: true, // Boolean; If set as 'true', option slideshow is enabled.; [ true, false ]
    slideshowAutostart: false, // Boolean; If set as 'true', slideshow will be started immediately after initializing jGallery(only when 'slideshow' has been set as true).; [ true, false ]
    slideshowCanRandom: true, // Boolean; If set as 'true', you can enable random change photos for slideshow(only when 'slideshow' has been set as true).; [ true, false ]
    slideshowInterval: '8s', // String; Time between change of photos for slideshow(only when 'slideshow' has been set as true).; [ '3s', '6s', '10s' ] 
    slideshowRandom: false, // Boolean; If set as 'true', photos in slideshow will be changing random(only when 'slideshow' has been set as true and 'slideshowCanRandom' has been set as true).; [ true, false ]
    swipeEvents: true, // Boolean; If set as 'true', you can switch to next/prev photo and thumbnails using swipe events.; [ true, false ]
    textColor: '#000', // String; Color of text and icons.; ; [ '#000000', 'rgb(0,153,221)' ]
    thumbnails: true, // Boolean; If set as 'true', thumbnails will be displayed.; [ true, false ]
    thumbHeight: 75, // Number; Height(pixels) of thumbnails.; ; [ 50, 75, 125 ]
    thumbHeightOnFullScreen: 100, // Number; Height(pixels) of thumbnails for thumbnails displayed in full-screen.; ; [ 125, 160, 200 ]
    thumbnailsFullScreen: true, // Boolean; If set as 'true', thumbnails will be displayed in full-screen.; [ true, false ]
    thumbnailsHideOnMobile: true, // Boolean; If set as 'true', thumbnails will be hidden when width of window <= 'maxMobileWidth' parameter (default value - 767px).; [ true, false ]
    thumbnailsPosition: 'bottom', // String; Thumbnails position(only when 'thumbnails' parameter set as 'true').; [ 'top',  'bottom', 'left', 'right' ]
    thumbType: 'image', // String; Thumbnails type(only when 'thumbnails' parameter set as 'true').; [ 'image', 'square', 'number' ]
    thumbWidth: 75, // Number; Width(pixels) of thumbnails.; ; [ 50, 75, 125 ]
    thumbWidthOnFullScreen: 100, // Number; Width(pixels) of thumbnails for thumbnails displayed in full-screen.; ; [ 125, 160, 200 ]
    title: true, // Boolean; If set as 'true', near photo will be shown title from alt attribute of img.; [ true, false ]
    titleExpanded: false, // Boolean; If set as 'true', in bottom area of zoomed photo will be shown title from alt attribute of img(only when 'title' has been set as true).; [ true, false ]
    tooltipClose: 'Закрыть', // String; Text of tooltip which will be displayed next to icon for close jgallery(if you set canClose parameter as true).; ; [ 'Close', 'Zamknij' ]
    tooltipFullScreen: 'На полный экран', // String; Text of tooltip which will be displayed next to icon for change display mode.; ; [ 'Full screen', 'Tryb pełnoekranowy' ]
    tooltipRandom: 'Случайно', // String; Text of tooltip which will be displayed next to icon for random slideshow toggling.; ; [ 'Random', 'Kolejność losowa' ]
    tooltips: true, // Boolean; If set as 'true', tooltips will be displayed next to icons.; [ true, false ]
    tooltipSeeAllPhotos: 'Показать все изображения', // String; Text of tooltip which will be displayed next to icon for change thumbnails view.; ; [ 'See all photos', 'Zobacz wszystkie zdjęcia' ]
    tooltipSeeOtherAlbums: 'Показать другие альбомы', // String; Text of tooltip which will be displayed next to icon for change album(if your jGallery has more than one album).; ; [ 'See other albums', 'Zobacz pozostałe albumy' ]
    tooltipSlideshow: 'Слайдшоу', // String; Text of tooltip which will be displayed next to icon for play/pause slideshow.; ; [ 'Slideshow', 'Pokaz slajdów' ]
    tooltipToggleThumbnails: 'Toggle thumbnails', // String; Text of tooltip which will be displayed next to icon for toggle thumbnails.; ; [ 'Toggle thumbnails', 'Pokaż/ukryj miniatury' ]
    tooltipZoom: 'Зум', // String; Text of tooltip which will be displayed next to icon for zoom photo.; ; [ 'Zoom', 'Powiększenie' ]
    transition: 'moveToLeft_moveFromRight', // String; Transition effect for change active image.; [ 'moveToLeft_moveFromRight', 'moveToRight_moveFromLeft', 'moveToTop_moveFromBottom', 'moveToBottom_moveFromTop', 'fade_moveFromRight', 'fade_moveFromLeft', 'fade_moveFromBottom', 'fade_moveFromTop', 'moveToLeftFade_moveFromRightFade', 'moveToRightFade_moveFromLeftFade', 'moveToTopFade_moveFromBottomFade', 'moveToBottomFade_moveFromTopFade', 'moveToLeftEasing_moveFromRight', 'moveToRightEasing_moveFromLeft', 'moveToTopEasing_moveFromBottom', 'moveToBottomEasing_moveFromTop', 'scaleDown_moveFromRight', 'scaleDown_moveFromLeft', 'scaleDown_moveFromBottom', 'scaleDown_moveFromTop', 'scaleDown_scaleUpDown', 'scaleDownUp_scaleUp', 'moveToLeft_scaleUp', 'moveToRight_scaleUp', 'moveToTop_scaleUp', 'moveToBottom_scaleUp', 'scaleDownCenter_scaleUpCenter', 'rotateRightSideFirst_moveFromRight', 'rotateLeftSideFirst_moveFromLeft', 'rotateTopSideFirst_moveFromTop', 'rotateBottomSideFirst_moveFromBottom', 'flipOutRight_flipInLeft', 'flipOutLeft_flipInRight', 'flipOutTop_flipInBottom', 'flipOutBottom_flipInTop', 'rotateFall_scaleUp', 'rotateOutNewspaper_rotateInNewspaper', 'rotatePushLeft_moveFromRight', 'rotatePushRight_moveFromLeft', 'rotatePushTop_moveFromBottom', 'rotatePushBottom_moveFromTop', 'rotatePushLeft_rotatePullRight', 'rotatePushRight_rotatePullLeft', 'rotatePushTop_rotatePullBottom', 'rotatePushBottom_page', 'rotateFoldLeft_moveFromRightFade', 'rotateFoldRight_moveFromLeftFade', 'rotateFoldTop_moveFromBottomFade', 'rotateFoldBottom_moveFromTopFade', 'moveToRightFade_rotateUnfoldLeft', 'moveToLeftFade_rotateUnfoldRight', 'moveToBottomFade_rotateUnfoldTop', 'moveToTopFade_rotateUnfoldBottom', 'rotateRoomLeftOut_rotateRoomLeftIn', 'rotateRoomRightOut_rotateRoomRightIn', 'rotateRoomTopOut_rotateRoomTopIn', 'rotateRoomBottomOut_rotateRoomBottomIn', 'rotateCubeLeftOut_rotateCubeLeftIn', 'rotateCubeRightOut_rotateCubeRightIn', 'rotateCubeTopOut_rotateCubeTopIn', 'rotateCubeBottomOut_rotateCubeBottomIn', 'rotateCarouselLeftOut_rotateCarouselLeftIn', 'rotateCarouselRightOut_rotateCarouselRightIn', 'rotateCarouselTopOut_rotateCarouselTopIn', 'rotateCarouselBottomOut_rotateCarouselBottomIn', 'rotateSidesOut_rotateSidesInDelay', 'rotateSlideOut_rotateSlideIn', 'random' ]
    transitionBackward: 'auto', // String; Transition effect for change active image(when user selected one of previous images).; [ 'auto', 'moveToLeft_moveFromRight', 'moveToRight_moveFromLeft', 'moveToTop_moveFromBottom', 'moveToBottom_moveFromTop', 'fade_moveFromRight', 'fade_moveFromLeft', 'fade_moveFromBottom', 'fade_moveFromTop', 'moveToLeftFade_moveFromRightFade', 'moveToRightFade_moveFromLeftFade', 'moveToTopFade_moveFromBottomFade', 'moveToBottomFade_moveFromTopFade', 'moveToLeftEasing_moveFromRight', 'moveToRightEasing_moveFromLeft', 'moveToTopEasing_moveFromBottom', 'moveToBottomEasing_moveFromTop', 'scaleDown_moveFromRight', 'scaleDown_moveFromLeft', 'scaleDown_moveFromBottom', 'scaleDown_moveFromTop', 'scaleDown_scaleUpDown', 'scaleDownUp_scaleUp', 'moveToLeft_scaleUp', 'moveToRight_scaleUp', 'moveToTop_scaleUp', 'moveToBottom_scaleUp', 'scaleDownCenter_scaleUpCenter', 'rotateRightSideFirst_moveFromRight', 'rotateLeftSideFirst_moveFromLeft', 'rotateTopSideFirst_moveFromTop', 'rotateBottomSideFirst_moveFromBottom', 'flipOutRight_flipInLeft', 'flipOutLeft_flipInRight', 'flipOutTop_flipInBottom', 'flipOutBottom_flipInTop', 'rotateFall_scaleUp', 'rotateOutNewspaper_rotateInNewspaper', 'rotatePushLeft_moveFromRight', 'rotatePushRight_moveFromLeft', 'rotatePushTop_moveFromBottom', 'rotatePushBottom_moveFromTop', 'rotatePushLeft_rotatePullRight', 'rotatePushRight_rotatePullLeft', 'rotatePushTop_rotatePullBottom', 'rotatePushBottom_page', 'rotateFoldLeft_moveFromRightFade', 'rotateFoldRight_moveFromLeftFade', 'rotateFoldTop_moveFromBottomFade', 'rotateFoldBottom_moveFromTopFade', 'moveToRightFade_rotateUnfoldLeft', 'moveToLeftFade_rotateUnfoldRight', 'moveToBottomFade_rotateUnfoldTop', 'moveToTopFade_rotateUnfoldBottom', 'rotateRoomLeftOut_rotateRoomLeftIn', 'rotateRoomRightOut_rotateRoomRightIn', 'rotateRoomTopOut_rotateRoomTopIn', 'rotateRoomBottomOut_rotateRoomBottomIn', 'rotateCubeLeftOut_rotateCubeLeftIn', 'rotateCubeRightOut_rotateCubeRightIn', 'rotateCubeTopOut_rotateCubeTopIn', 'rotateCubeBottomOut_rotateCubeBottomIn', 'rotateCarouselLeftOut_rotateCarouselLeftIn', 'rotateCarouselRightOut_rotateCarouselRightIn', 'rotateCarouselTopOut_rotateCarouselTopIn', 'rotateCarouselBottomOut_rotateCarouselBottomIn', 'rotateSidesOut_rotateSidesInDelay', 'rotateSlideOut_rotateSlideIn', 'random' ]
    transitionCols: 1, // Number; Number of columns in the image divided into columns.; ; [ 1, 2, 3, 4, 5, 6 ]
    transitionDuration: '0.7s', // String; Duration of transition between photos.; [ '0.2s', '0.5s', '1s' ] 
    transitionRows: 1, // Number; Number of columns in the image divided into rows.; ; [ 1, 2, 3, 4, 5, 6 ]
    transitionTimingFunction: 'cubic-bezier(0,1,1,1)', // String; Timig function for showing photo.; [ 'linear', 'ease', 'ease-in', 'ease-out', 'ease-in-out', 'cubic-bezier(0.5,-0.5,0.5,1.5)', 'cubic-bezier(0,1,1,1)' ]
    transitionWaveDirection: 'forward', // String; Direction of animation(only when 'transitionCols' > 1 or 'transitionRows' > 1).; [ 'forward', 'backward' ]
    width: '100%', // String; Width of jGallery container(only for standard or slider mode).
    zoomSize: 'fit', // String; Size of zoomed photo(only for full-screen or standard mode).; [ 'fit', 'original', 'fill' ]
    afterLoadPhoto: function() {}, // Function; Custom function that will be called after loading photo.; ; [ function(link,thumbnail) { console.log( link,thumbnail ) } ]
    beforeLoadPhoto: function() {}, // Function; Custom function that will be called before loading photo.; ; [ function(link,thumbnail) { console.log( link,thumbnail ) } ]
    closeGallery: function() {}, // Function; Custom function that will be called after hiding jGallery.; ; [ function() { alert( 'closeGallery' ) } ]
    initGallery: function() {}, // Function; Custom function that will be called before initialization of jGallery.; ; [ function() { alert( 'initGallery' ) } ]
    showGallery: function() {}, // Function; Custom function that will be called after showing jGallery.; ; [ function() { alert( 'showGallery' ) } ]
    showPhoto: function() {} // Function; Custom function that will be called before showing photo.; ; [ function(link,thumbnail) { console.log( link,thumbnail ) } ]
};
