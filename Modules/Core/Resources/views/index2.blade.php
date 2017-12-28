<!DOCTYPE html>
<html lang="en">
<head>

    <!-- ==============================================
  TITLE AND BASIC META TAGS
  =============================================== -->
    <meta charset="utf-8">
    <title>CloudFone - Gửi Ngàn Lời Yêu</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta property="og:image" content="https://cloudfone.vn/wp-content/uploads/2017/12/1080bg.png" />

    <!-- ==============================================
    MOBILE METAS
    =============================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- ==============================================
	CSS
	=============================================== -->
    <link rel="stylesheet" href="theme/bootstrap/css/bootstrap.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="theme/bootstrap/css/bootstrap-theme.min.css" type="text/css" media="screen"  />
    <link rel="stylesheet" href="theme/css/supersized.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="theme/css/supersized.shutter.css" type="text/css" />
    <link rel="stylesheet" href="theme/css/elegant.css" type="text/css" />
    <link rel="stylesheet" href="theme/css/component.css" type="text/css"  media="screen" />
    <link rel="stylesheet" href="theme/css/style.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="theme/css/responsive.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="css/bootstrap-tour.min.css" type="text/css" media="screen">
    <link rel="stylesheet" href="theme/css/fontawesome-all.min.css" type="text/css" />
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- ==============================================
	FONTS
	=============================================== -->
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

    <!-- ==============================================
	JS
	=============================================== -->
    <script type="text/javascript" src="theme/js/modernizr.js"></script>
    <script type="text/javascript" src="theme/js/device.min.js"></script>

    <!-- ==============================================
	FAVICONS
	=============================================== -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="theme/img/favicon/apple-touch-icon-144-precomposed.html">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="theme/img/favicon/apple-touch-icon-114-precomposed.html">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="theme/img/favicon/apple-touch-icon-72-precomposed.html">
    <link rel="apple-touch-icon-precomposed" href="theme/img/favicon/apple-touch-icon-57-precomposed.html">
    <link rel="shortcut icon" href="theme/img/favicon/favicon.png">
    {{--<script src="https://webrtc.github.io/adapter/adapter-latest.js"></script>--}}
    {{--<script src="theme/js/common.js"></script>--}}
    {{--<script src="theme/js/main.js"></script>--}}
    {{--<script src="theme/js/ga.js"></script>--}}

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
    {{--<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap/3/css/bootstrap.css" />--}}
    <script src="js/RecordRTC.js"></script>
    <script src="js/gif-recorder.js"></script>
    <script src="js/getScreenId.js"></script>

    <!-- for Edige/FF/Chrome/Opera/etc. getUserMedia support -->
    <script src="js/gumadapter.js"></script>
    <script src="js/adapter-latest.js"></script>

</head>
<body>
<style>
    .daterangepicker{
        color: black;
    }
    .Rec{
        animation-name: pulse;
        animation-duration: 1.5s;
        animation-iteration-count: infinite;
        animation-timing-function: linear;
    }

    @keyframes pulse{
        0%{
            box-shadow: 0px 0px 5px 0px rgba(173,0,0,.3);
        }
        65%{
            box-shadow: 0px 0px 5px 13px rgba(173,0,0,.3);
        }
        90%{
            box-shadow: 0px 0px 5px 13px rgba(173,0,0,0);
        }
    }
    .button-container {
        border: 4px solid #ff0707;
        border-radius: 50%;
        width: 68px;
        height: 68px;
        position: relative;
        margin: 0px auto 6px auto;
        cursor: pointer;
    }
    button {
        background-color: red;
        text-align: center;
        display: block;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        margin: 5px auto 0 auto;
    }
    button, button:focus {
        border:none;
        outline:none;
    }
    .square {
        width: 38px;
        height: 38px;
        margin: 11px auto 0 auto;
        border-radius: 5px;
    }
    #timeroutput {
        margin-top: 10px;
        opacity: 1;
        text-align: center;
        color: #000000;
        font-size: 20px;
    }
    .show {
        margin-top: 0 !important;
        opacity: 1 !important;
    }
    .fileUpload {
        position: relative;
        overflow: hidden;
        margin: 10px;
    }
    .fileUpload input.upload {
        position: absolute;
        top: 0;
        right: 0;
        margin: 0;
        padding: 0;
        font-size: 20px;
        cursor: pointer;
        opacity: 0;
        filter: alpha(opacity=0);
    }
    #loading {
        width: 100%;
        height: 100%;
        background: #193c54 url(theme/Loading/Loading-bg.jpg) no-repeat center;
        position: fixed;
        top: 0;
        left: 0;
        z-index: 9999;
    }
    .load{
        position: relative;
        /*width: 194px;*/
        height: 112px;
        top: 60%;
        margin: -56px auto;
    }
    #loading .spinner {
        position: relative;
        width: 94px;
        height: 112px;
        top: 50%;
        margin: -56px auto;
        background: url(theme/Loading/loading.png) no-repeat center;
        -webkit-animation: mask 1s infinite alternate;
        -moz-animation: mask 1s infinite alternate;
        -ms-animation: mask 1s infinite alternate;
        -o-animation: mask 1s infinite alternate;
        animation: mask 1s infinite alternate;
    }
    @-webkit-keyframes mask {
        0% {
            -webkit-transform: rotate(90deg);
        }

        100% {
            -webkit-transform: rotate(-90deg);
        }
    }

    @-moz-keyframes mask {
        0% {
            -moz-transform: rotate(90deg);
        }

        100% {
            -moz-transform: rotate(-90deg);
        }
    }

    @-ms-keyframes mask {
    0% {
        -ms-transform: rotate(90deg);
    }

    100% {
        -ms-transform: rotate(-90deg);
    }
    }

    @-o-keyframes mask {
        0% {
            -o-transform: rotate(90deg);
        }

        100% {
            -o-transform: rotate(-90deg);
        }
    }

    @keyframes mask {
        0% {
            transform: rotate(90deg);
        }

        100% {
            transform: rotate(-90deg);
        }
    }
    .modal-open .modal {
        display: flex !important;
        align-items: center;
        justify-content: center;
        z-index: 99999;
        color: black;
    }
    .swal2-container {
        z-index: 999999;
    }
    .audio.green-audio-player {
        margin-left: 25%;
        margin-right: 25%;
        /*min-width: 300px;*/
        height: 56px;
        box-shadow: 0 4px 16px 0 rgba(0, 0, 0, 0.07);
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-left: 24px;
        padding-right: 24px;
        border-radius: 4px;
        user-select: none;
        -webkit-user-select: none;
        background-color: #fff;
    }
    .audio.green-audio-player .play-pause-btn {
        display: none;
        cursor: pointer;
    }
    .audio.green-audio-player .spinner {
        width: 18px;
        height: 18px;
        background-image: url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/355309/loading.png);
        background-size: cover;
        background-repeat: no-repeat;
        animation: spin 0.4s linear infinite;
    }
    .audio.green-audio-player .slider {
        flex-grow: 1;
        background-color: #D8D8D8;
        cursor: pointer;
        position: relative;
    }
    .audio.green-audio-player .slider .progress {
        background-color: #44BFA3;
        border-radius: inherit;
        position: absolute;
        pointer-events: none;
    }
    .audio.green-audio-player .slider .progress .pin {
        height: 16px;
        width: 16px;
        border-radius: 8px;
        background-color: #44BFA3;
        position: absolute;
        pointer-events: all;
        box-shadow: 0px 1px 1px 0px rgba(0, 0, 0, 0.32);
    }
    .audio.green-audio-player .controls {
        font-family: 'Roboto', sans-serif;
        font-size: 16px;
        line-height: 18px;
        color: #55606E;
        display: flex;
        flex-grow: 1;
        justify-content: space-between;
        align-items: center;
        margin-left: 24px;
        margin-right: 24px;
    }
    .audio.green-audio-player .controls .slider {
        margin-left: 16px;
        margin-right: 16px;
        border-radius: 2px;
        height: 4px;
    }
    .audio.green-audio-player .controls .slider .progress {
        width: 0;
        height: 100%;
    }
    .audio.green-audio-player .controls .slider .progress .pin {
        right: -8px;
        top: -6px;
    }
    .audio.green-audio-player .controls span {
        cursor: default;
    }
    .audio.green-audio-player .volume {
        position: relative;
    }
    .audio.green-audio-player .volume .volume-btn {
        cursor: pointer;
    }
    .audio.green-audio-player .volume .volume-btn.open path {
        fill: #44BFA3;
    }
    .audio.green-audio-player .volume .volume-controls {
        width: 30px;
        height: 135px;
        background-color: rgba(0, 0, 0, 0.62);
        border-radius: 7px;
        position: absolute;
        left: -3px;
        bottom: 52px;
        flex-direction: column;
        align-items: center;
        display: flex;
    }
    .audio.green-audio-player .volume .volume-controls.hidden {
        display: none;
    }
    .audio.green-audio-player .volume .volume-controls .slider {
        margin-top: 12px;
        margin-bottom: 12px;
        width: 6px;
        border-radius: 3px;
    }
    .audio.green-audio-player .volume .volume-controls .slider .progress {
        bottom: 0;
        height: 100%;
        width: 6px;
    }
    .audio.green-audio-player .volume .volume-controls .slider .progress .pin {
        left: -5px;
        top: -8px;
    }

    svg, img {
        display: block;
    }

    @keyframes spin {
        from {
            transform: rotateZ(0);
        }
        to {
            transform: rotateZ(1turn);
        }
    }
    /*Trái tim*/
    .avatar {
        /*height: 80px;*/
        position: relative;
        /*width: 80px;*/

    }

    .avatar img {
        border-radius: 9999px;
        height: 100%;
        position: relative;
        width: 100%;
        z-index: 2;
    }

    @keyframes cycle-colors {
        0% { border-color: hsl(0, 100%, 50%); }
        25% { border-color: hsl(90, 100%, 50%); }
        50% { border-color: hsl(180, 100%, 50%); }
        75% { border-color: hsl(270, 100%, 50%); }
        100% { border-color: hsl(360, 100%, 50%); }
    }

    @keyframes pulse {
        to {
            opacity: 0;
            transform: scale(1);
        }
    }

    .avatar::before,
    .avatar::after {
        animation: pulse 2s linear infinite;
        border: #fff solid 8px;
        border-radius: 9999px;
        box-sizing: border-box;
        content: ' ';
        height: 140%;
        left: -20%;
        opacity: .6;
        position: absolute;
        top: -20%;
        transform: scale(0.714);
        width: 140%;
        z-index: 1;
    }

    .avatar::after {
        animation-delay: 1s;
    }
    .avatar:hover::before,
    .avatar:hover::after {
        animation: pulse 1s linear infinite, cycle-colors 6s linear infinite;
    }

    .avatar:hover::after {
        animation-delay: .5s;
    }
    /*music button*/
    .sound {
        width: 100px;
        height: 100px;
        position: absolute;
        cursor: pointer;
        display: inline-block;
        right: 20px;
        /*visibility: hidden;*/
    }
    .sound--icon {
        /*color: #333;*/
        width: 75%;
        height: 100%;
        line-height: 100%;
        font-size: 100px;
        display: block;
        margin: auto;
    }
    .sound--wave {
        position: absolute;
        border: 10px solid transparent;
        border-right: 4px solid ;
        border-radius: 50%;
        -webkit-transition: all 200ms;
        transition: all 200ms;
        margin: auto;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
    }
    .sound--wave_one {
        width: 50%;
        height: 50%;
    }
    .sound--wave_two {
        width: 75%;
        height: 75%;
    }
    .sound-mute .sound--wave {
        border-radius: 0;
        margin-right: 29px;
        width: 25%;
        height: 25%;
        border-width: 0 4px 0 0;
    }
    .sound-mute .sound--wave_one {
        -webkit-transform: rotate(45deg) translate3d(0, -50%, 0);
        transform: rotate(45deg) translate3d(0, -50%, 0);
    }
    .sound-mute .sound--wave_two {
        -webkit-transform: rotate(-45deg) translate3d(0, 50%, 0);
        transform: rotate(-45deg) translate3d(0, 50%, 0);
    }
    .fa{
        font-size: 42px;
        margin-top: 30px;
    }
    .ttw-music-player{
        visibility: hidden;
    }
</style>
<!-- ==============================================
PRELOADER
=============================================== -->
<div id="preloader">
    <div id="loading-animation"></div>
</div> <!-- End Preloader -->

<div id="loading" style="visibility: hidden">
    <div class="spinner">
    </div>
    <div class="load">
        Hệ thống đang xử lý yêu cầu. Vui lòng đợi...
    </div>
</div>
<!-- ==============================================
BACKGROUND COLOR
=============================================== -->
<div class="back-color"></div>
<div class="mainWrap">
    <div class="snowEffect" style="position: fixed;z-index: 1;left: 0;right: 0;bottom: 0;pointer-events: none;"><canvas width="1091" height="974"></canvas></div>
</div>
<!-- ==============================================
HOME
=============================================== -->
<div class="sound" id="player">
    <div class="sound--icon fa fa-volume-off"></div>
    <div class="sound--wave sound--wave_one"></div>
    <div class="sound--wave sound--wave_two"></div>
</div>
<section id="home">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <h1 id="logo" class="animate"><a href="#" title="Rosa - Responsive Coming Soon Template">GỬI NGÀN LỜI YÊU</a></h1>
                <p class="intro animate">Những ngày cuối năm, không khí nhộn nhịp, tưng bừng diễn ra trên khắp mọi nẻo đường, từ siêu thị, chợ hoa đến những cửa hàng thời trang, tất cả đều sôi động, tất bật, báo hiệu ngày Tết đang đến rất gần...
                    <br>Hãy để CloudFone giúp bạn gửi những lời chúc mừng, lời yêu thương tốt đẹp nhất đến gia đình, bạn bè và những người thân yêu nhé.</p>
                <div class="timerContent animate">
                    <div class="timer">
                        <ul>
                            <li><span class="days"></span><p class="daysText">days</p></li>
                            <li><span class="hours"></span><p class="hoursText">hours</p></li>
                            <li><span class="minutes"></span><p class="minutesText">minutes</p></li>
                            <li><span class="seconds"></span><p class="secondsText">seconds</p></li>
                        </ul>
                    </div>
                </div>

                <section class="menu animate">
                    <div id="morphevent" class="morph-button morph-button-modal morph-button-modal-3 morph-button-fixed">
                        <a style="cursor: pointer" class="button" id="guiyeuthuong">
                            <div class="avatar">
                                <img src="theme/img/icon.png">
                            </div>
                        </a>
                        <div class="morph-content">
                            <div>
                                <div class="content-style-form content-style-form-2">
                                    <div class="button-close">
                                        <span class="button-close-icon" id="closebutton" aria-hidden="true" data-icon="&#x51;"></span>
                                    </div>
                                    {{--<h2>Gửi đến</h2>--}}
                                    <form id="uploader" enctype="multipart/form-data">
                                        <div class="button-container stopped">
                                            <button class="button" type="button" id="btn-start-recording"></button>
                                        </div>
                                        <span id="timeroutput">Nhấn để ghi âm</span>
                                        <div class="row" style="margin-top: 10px">
                                            <audio controls="" autoplay=""></audio>
                                        </div>
                                        <div class="fileUpload btn btn-success" id="chonnhac">
                                            <span>Upload File</span>
                                            <input type="file" class="upload" id="audio2" name="audio2" onchange="onChangeFile('sound2',this)"/>
                                        </div>
                                        Hoặc
                                        <div class="fileUpload btn btn-primary" id="themlink">
                                            <span>Thêm Link</span>
                                            <input type="text" class="upload" id="audio3" name="audio3"/>
                                        </div>
                                        <audio id="sound2" controls style="margin-bottom: 10px"></audio>
                                        <input type="hidden" name="linkfile" id="linkfile">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                {{--<h3>Người thương <code>*</code></h3>--}}
                                                <input type="text" name="namereceiver" id="namereceiver" placeholder="Tên người nhận" title="Nhập tên người nhận vào đây" data-toggle="tooltip" required/>
                                            </div>
                                            <div class="col-sm-6">
                                                {{--<h3>SĐT <code>*</code></h3>--}}
                                                <p><input type="text" name="phonereceiver" id="phonereceiver" placeholder="SĐT người nhận" title="Bạn có thể nhập một hoặc nhiều số điện thoại người nhận cách nhau bằng dấu phẩy... Ví Dụ: 092653121,098563121,096315478" data-toggle="tooltip" required/></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                {{--<h3>Người gửi <code>*</code></h3>--}}
                                                <p><input type="text" name="namesender" id="namesender" placeholder="Tên của bạn" title="Nhập tên của bạn vào đây" data-toggle="tooltip" required/></p>
                                            </div>
                                            <div class="col-sm-6">
                                                {{--<h3>SĐT <code>*</code></h3>--}}
                                                <p><input type="text" name="phonesender" id="phonesender" placeholder="SĐT của bạn" title="Nhập số điện thoại của bạn vào đây" data-toggle="tooltip" required/></p>
                                            </div>
                                        </div>
                                        <h3>Lịch hẹn<code>*</code></h3>
                                        <input type="text" id="date" name="date" />
                                        <p><div class="btn-submit" style="cursor: pointer" id="upload"><span style="font-size: 24px">GỬI</span></div></p>
                                    </form>
                                    <div class="success-message-2"></div>
                                    <div class="error-message-2"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <div class="footer-social animate" style="margin-top: 80px">
                    Copyright © 2017 | Powered By <a href="http://CloudFone.vn" style="text-decoration: underline;" target="_blank">CloudFone.vn.</a><br> All Rights Reserved.
                </div>

                {{--<ul class="footer-social animate">--}}
                {{--<li><a href="#" class="facebook" title="Facebook" data-gal="tooltip" data-placement="bottom" data-original-title="Facebook" aria-hidden="true" data-icon="&#xe093;"></a></li>--}}
                {{--<li><a href="#" class="twitter" title="Twitter" data-gal="tooltip" data-placement="bottom" data-original-title="Twitter" aria-hidden="true" data-icon="&#xe094;"></a></li>--}}
                {{--<li><a href="#" class="skype" title="Skype" data-gal="tooltip" data-placement="bottom" data-original-title="Skype" aria-hidden="true" data-icon="&#xe0a2;"></a></li>--}}
                {{--<li><a href="#" class="linkedin" title="Linkedin" data-gal="tooltip" data-placement="bottom" data-original-title="Linkedin" aria-hidden="true" data-icon="&#xe09d;"></a></li>--}}
                {{--<li><a href="#" class="pinterest" title="Pinterest" data-gal="tooltip" data-placement="bottom" data-original-title="Pinterest" aria-hidden="true" data-icon="&#xe095;"></a></li>--}}
                {{--<li><a href="#" class="instagram" title="Instagram" data-gal="tooltip" data-placement="bottom" data-original-title="Instagram" aria-hidden="true" data-icon="&#xe09a;"></a></li>--}}
                {{--<li><a href="#" class="googleplus" title="Google Plus" data-gal="tooltip" data-placement="bottom" data-original-title="Google Plus" aria-hidden="true" data-icon="&#xe096;"></a></li>--}}
                {{--<li><a href="#" class="dribbble" title="Dribbble" data-gal="tooltip" data-placement="bottom" data-original-title="Dribbble" aria-hidden="true" data-icon="&#xe09b;"></a></li>--}}
                {{--<li><a href="#" class="vimeo" title="Vimeo" data-gal="tooltip" data-placement="bottom" data-original-title="Vimeo" aria-hidden="true" data-icon="&#xe09c;"></a></li>--}}
                {{--</ul>--}}

            </div>
        </div>

    </div>
</section>

<!-- BOOTSTRAP CORE JAVASCRIPT
================================================== -->
<!-- PLACED AT THE END OF THE DOCUMENT SO THE PAGES LOAD FASTER -->



<script type="text/javascript" src="theme/js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="theme/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/bootstrap-tour.min.js"></script>
<script type="text/javascript" src="js/bootbox.min.js"></script>
<script type="text/javascript" src="theme/js/supersized.3.2.7.min.js"></script>
<script type="text/javascript" src="theme/js/supersized.shutter.min.js"></script>
<script type="text/javascript" src="theme/js/jquery.countdown.js"></script>
<script type="text/javascript" src="theme/js/classie.js"></script>
<script type="text/javascript" src="theme/js/uiMorphingButton_fixed.js"></script>
{{--<script type="text/javascript" src="theme/js/twitterfeed.js"></script>--}}
<script type="text/javascript" src="theme/js/scripts.js"></script>
<script type="text/javascript" src="theme/js/images.js"></script>
<script src="https://unpkg.com/sweetalert2/dist/sweetalert2.all.js"></script>
<script src="ticker/js/vendor/ThreeCanvas.js" type="text/javascript" charset="utf-8"></script>
<script src="ticker/js/vendor/snow.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="theme/js/moment.min.js"></script>
<script type="text/javascript" src="theme/js/daterangepicker.js"></script>
<script type="text/javascript" src="{{ Module::asset('home:jquery.jplayer.js') }}?<?php echo time(); ?>"></script>
<script type="text/javascript" src="{{ Module::asset('home:ttw-music-player.js') }}?<?php echo time(); ?>"></script>
<script type="text/javascript" src="{{ Module::asset('home:myplaylist.js') }}?<?php echo time(); ?>"></script>
<script type="text/javascript" src="{{ Module::asset('home:nhanguiyeuthuong.js') }}?<?php echo time(); ?>"></script>
<script type="text/javascript" src="{{ Module::asset('core:recordingv3.js') }}?<?php echo time(); ?>"></script>
</body>
</html>
