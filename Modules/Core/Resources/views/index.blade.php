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
        width: 194px;
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
        Đang gửi yêu cầu...
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
<section id="home">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <h1 id="logo" class="animate"><a href="#" title="Rosa - Responsive Coming Soon Template">GỬI NGÀN LỜI YÊU</a></h1>
                <p class="intro animate">Tết đến, xuân về, yêu thương đong đầy. Hãy để CloudFone giúp bạn gửi những lời chúc,những lời yêu thương tốt đẹp nhất cho gia đình, người thân và bạn bè của mình bạn nhé!</p>
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
                        <a style="cursor: pointer" class="button" id="guiyeuthuong"><h2>Gửi yêu thương</h2></a>
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
                                        <audio id="sound2" controls></audio>

                                        <input type="hidden" name="linkfile" id="linkfile">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <h3>Người thương <code>*</code></h3>
                                                <input type="text" name="namereceiver" id="namereceiver" placeholder="Tên người thương" required/>
                                            </div>
                                            <div class="col-sm-6">
                                                <h3>SĐT <code>*</code></h3>
                                                <p><input type="text" name="phonereceiver" id="phonereceiver" placeholder="SĐT người thương" required/></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <h3>Người gửi <code>*</code></h3>
                                                <p><input type="text" name="namesender" id="namesender" placeholder="Tên của bạn" required/></p>
                                            </div>
                                            <div class="col-sm-6">
                                                <h3>SĐT <code>*</code></h3>
                                                <p><input type="text" name="phonesender" id="phonesender" placeholder="SĐT của bạn" required/></p>
                                            </div>
                                        </div>

                                        <h3 style="margin-top: 10px">Lịch hẹn<code>*</code></h3>
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
                <div class="footer-social animate" style="margin-top: 120px">
                    Copyright © 2017 | Powered By CloudFone.vn.<br> All Rights Reserved.
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
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="ticker/js/vendor/ThreeCanvas.js" type="text/javascript" charset="utf-8"></script>
<script src="ticker/js/vendor/snow.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="theme/js/moment.min.js"></script>
<script type="text/javascript" src="theme/js/daterangepicker.js"></script>
<script type="text/javascript" src="{{ Module::asset('home:nhanguiyeuthuong.js') }}"></script>
<script type="text/javascript" src="{{ Module::asset('core:recording.js') }}"></script>
</body>
</html>
