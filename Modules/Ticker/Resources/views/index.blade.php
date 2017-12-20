<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SHARED ON THEMELOCK.COM - Snowflakes Backround</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="ticker/favicon.ico" rel="shortcut icon" type="image/x-icon" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,600,700,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Exo+2:400,100,100italic,200,200italic,300,300italic,400italic,500,500italic,700,700italic,600,600italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Josefin+Sans:100,300,400,600' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="ticker/css/normalize.css">
    <link rel="stylesheet" type="text/css" href="ticker/css/component.css" />
    <link rel="stylesheet" type="text/css" href="ticker/css/bg-slider.css" />
    <link rel="stylesheet" type="text/css" href="ticker/clock/css/clock.css">
    <link rel="stylesheet" type="text/css" href="ticker/css/main.css">
    <link rel="stylesheet" type="text/css" href="ticker/css/responsive.css">
    <script src="ticker/js/vendor/modernizr-2.6.2.min.js"></script>
</head>
<body onload="init()" class="snowflakes">
<script src="ticker/js/vendor/ThreeCanvas.js" type="text/javascript" charset="utf-8"></script>
<script src="ticker/js/vendor/snow.js" type="text/javascript" charset="utf-8"></script>



<script>

    var SCREEN_WIDTH = window.innerWidth;
    var SCREEN_HEIGHT = window.innerHeight;

    var container;

    var particle;

    var camera;
    var scene;
    var renderer;

    var mouseX = 0;
    var mouseY = 0;

    var windowHalfX = window.innerWidth / 2;
    var windowHalfY = window.innerHeight / 2;

    var particles = [];
    var particleImage = new Image();//THREE.ImageUtils.loadTexture( "img/ParticleSmoke.png" );
    particleImage.src = 'ticker/img/snow.png';



    function init() {

        container = document.createElement('div');
        container.setAttribute('id', 'snowflakes');
        document.body.appendChild(container);

        camera = new THREE.PerspectiveCamera( 75, SCREEN_WIDTH / SCREEN_HEIGHT, 1, 10000 );
        camera.position.z = 1000;

        scene = new THREE.Scene();
        scene.add(camera);

        renderer = new THREE.CanvasRenderer();
        renderer.setSize(SCREEN_WIDTH, SCREEN_HEIGHT);
        var material = new THREE.ParticleBasicMaterial( { map: new THREE.Texture(particleImage) } );

        for (var i = 0; i < 500; i++) {

            particle = new Particle3D( material);
            particle.position.x = Math.random() * 2000 - 1000;
            particle.position.y = Math.random() * 2000 - 1000;
            particle.position.z = Math.random() * 2000 - 1000;
            particle.scale.x = particle.scale.y =  1;
            scene.add( particle );

            particles.push(particle);
        }

        container.appendChild( renderer.domElement );


        document.addEventListener( 'mousemove', onDocumentMouseMove, false );
        document.addEventListener( 'touchstart', onDocumentTouchStart, false );
        document.addEventListener( 'touchmove', onDocumentTouchMove, false );

        setInterval( loop, 1000 / 60 );

    }

    function onDocumentMouseMove( event ) {

        mouseX = event.clientX - windowHalfX;
        mouseY = event.clientY - windowHalfY;
    }

    function onDocumentTouchStart( event ) {

        if ( event.touches.length == 1 ) {

            event.preventDefault();

            mouseX = event.touches[ 0 ].pageX - windowHalfX;
            mouseY = event.touches[ 0 ].pageY - windowHalfY;
        }
    }

    function onDocumentTouchMove( event ) {

        if ( event.touches.length == 1 ) {

            event.preventDefault();

            mouseX = event.touches[ 0 ].pageX - windowHalfX;
            mouseY = event.touches[ 0 ].pageY - windowHalfY;
        }
    }

    //

    function loop() {

        for(var i = 0; i<particles.length; i++)
        {

            var particle = particles[i];
            particle.updatePhysics();

            with(particle.position)
            {
                if(y<-1000) y+=2000;
                if(x>1000) x-=2000;
                else if(x<-1000) x+=2000;
                if(z>1000) z-=2000;
                else if(z<-1000) z+=2000;
            }
        }

        camera.position.x += ( mouseX - camera.position.x ) * 0.05;
        camera.position.y += ( - mouseY - camera.position.y ) * 0.05;
        camera.lookAt(scene.position);

        renderer.render( scene, camera );


    }
</script>
<!--[if lt IE 7]>
<p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->


<section class="main-menu-container">
    <div class="show_toggle"><a href="#"></a></div>
    <ul class="main-menu">
        <li>
            <a href="#" class="home-link">Home</a>
        </li>
        <li>
            <a href="#" data-page="services">Services</a>
        </li>
        <li>
            <a href="#" data-page="about">About</a>
        </li>
        <li>
            <a href="#" data-page="contacts">Contacts</a>
        </li>
    </ul>
</section>
<section class="twitter-container">
    <div class="twitter">
        <ul class="tweet_list" id="tweet_list">
            <li class="tweet_first tweet_odd">
						<span class="tweet_text">WordPress 3.8 “Parker” is out and
							<br>
							ready for download <a href="#">buff.ly/18EGYRR</a></span><span class="tweet_time"><a href="#" title="view tweet on twitter">about 5 days ago</a></span>
            </li>
            <li class="tweet_even">
                <span class="tweet_text"><span class="at">@</span><a href="http://twitter.com/BeyondLocal_">BeyondLocal_</a> <span class="at">@</span><a href="http://twitter.com/bespokeav">bespokeav</a> Thanks :)</span><span class="tweet_time"><a href="http://twitter.com/pixelthrone/status/466325405507387392" title="view tweet on twitter">about 15 days ago</a></span>
            </li>
            <li class="tweet_odd">
                <span class="tweet_text"><span class="at">@</span><a href="http://twitter.com/geeks_in_motion">geeks_in_motion</a> ,hi for a better support please visit our online forum.I have a great team able to help you. → <a href="http://goo.gl/fghIzb">goo.gl/fghIzb</a></span><span class="tweet_time"><a href="http://twitter.com/pixelthrone/status/466280221889409024" title="view tweet on twitter">about 15 days ago</a></span>
            </li>
        </ul>
    </div>
</section>

<section class="mainarea">
    <div id="clock" class="active">
        <div class="clock-container">
            <div id="time-container-wrap">
                <div id="time-container">
                    <div class="numbers-container"></div>
                    <span id="ticker" class="clock-label">TICKER</span>
                    <span id="timelable" class="clock-label">TIME LEFT</span>
                    <span id="timeleft" class="clock-label">COUNTDOWN</span>
                    <figure id="canvas"></figure>
                </div>
            </div>
        </div>
        <h3>Our website is launching soon</h3>
        <form action="#" class="subscribe" id="subscribe">
            <input type="email" placeholder="Enter your email" class="email form_item requiredField" name="subscribe_email" />
            <input type="submit" class='form_submit' value="subscribe" />
            <div id="form_results"></div>
        </form>
    </div>
    <div class="mainarea-content">
        <div id="services" data-page="services" class="side-page side-left went-left">
            <div class="container">
                <h2 class="title">What we do</h2>
                <ul class="services">
                    <li>
                        <img src="ticker/img/icons/promotion-icon.png" alt="" />
                        <p>
                            Promotion
                        </p>
                    </li>
                    <li>
                        <img src="ticker/img/icons/web-desing-icon.png" alt="" />
                        <p>
                            Web Design
                        </p>
                    </li>
                    <li>
                        <img src="ticker/img/icons/photography-icon.png" alt="" />
                        <p>
                            Photography
                        </p>
                    </li>
                </ul>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                </p>
                <p>
                    Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. <a href="#">Excepteur sint occaecat</a> cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae.
                </p>
            </div>
        </div>
        <div id="about" data-page="about" class="side-page active">
            <div class="container">
                <h2 class="title">Who we are</h2>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla eget nibh at libero fringilla adipiscing nec ut leo. Etiam nec purus arcu. Morbi sollicitudin at risus id malesuada. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Etiam sed tincidunt arcu. Donec molestie ante sapien, sed molestie est euismod eget. Maecenas ac metus accumsan, scelerisque massa sed, porta est. Aliquam ut mollis mi. Cras id vulputate purus, ac sollicitudin ante.
                </p>
                <p>
                    Integer condimentum eu lectus quis semper. Sed id metus magna. Morbi ultrices magna id euismod hendrerit. Pellentesque nec mattis odio, vitae laoreet metus. Sed eget sollicitudin est, vitae accumsan nisi. Fusce consequat imperdiet venenatis. Integer mollis hendrerit facilisis. Praesent vel mattis enim. Integer fringilla et urna vitae rutrum.
                </p>
            </div>
        </div>
        <div id="contacts" data-page="contacts" class="side-page side-right went-right">
            <div class="container">
                <h2 class="title">Get in touch</h2>
                <p>
                    Lexington Avenue · New York, NY
                    <br>
                    P: (123) - 456 789 · email@domain.com
                </p>
                <form id='contacts_form' action="#" class="contact-list">
                    <div class="field-row">
                        <input class="form_item" type="text" id="name" name="name" placeholder="Name" />
                    </div>
                    <div class="field-row">
                        <input class="form_item" type="email" id="email" name="email" placeholder="E-mail" />
                    </div>
                    <div class="field-row">
                        <input class="form_item" type="text" id="message" name="message" placeholder="Message" />
                    </div>
                    <div class="field-row">
                        <input type="submit" class="form_submit" value="Send Message" />
                    </div>
                    <div id="contact_results"></div>
                </form>
            </div>
        </div>
    </div>
    <a class="close" href="#"><img alt="" src="ticker/img/close.png"></a>
</section>
<section class="social-container">
    <ul class="social">
        <li>
            <a href="#"><img src="ticker/img/icons/twitter-icon.png" alt="" /></a>
        </li>
        <li>
            <a href="#"><img src="ticker/img/icons/youtube-icon.png" alt="" /></a>
        </li>
        <li>
            <a href="#"><img src="ticker/img/icons/facebook-icon.png" alt="" /></a>
        </li>
    </ul>
</section>

<script src="ticker/js/vendor/jquery-1.11.1.min.js" type="text/javascript" charset="utf-8"></script>
<script src="ticker/js/vendor/classie.js" type="text/javascript" charset="utf-8"></script>
<script src="ticker/js/vendor/jquery.easing.1.3.js" type="text/javascript" charset="utf-8"></script>
<script src="ticker/js/vendor/jquery.tubular.1.0.js" type="text/javascript" charset="utf-8"></script>
<script src="ticker/js/vendor/jquery.cycle.min.js" type="text/javascript" charset="utf-8"></script>
<script src="ticker/js/plugins.js" type="text/javascript" charset="utf-8"></script>
<script src="ticker/js/main.js" type="text/javascript" charset="utf-8"></script>

<script src="ticker/clock/js/svg.min.js" type="text/javascript" charset="utf-8"></script>
<script src="ticker/clock/js/svg.easing.min.js" type="text/javascript" charset="utf-8"></script>
<script src="ticker/clock/js/svg.clock.min.js" type="text/javascript" charset="utf-8"></script>
<script src="ticker/clock/js/jquery.timers.min.js" type="text/javascript" charset="utf-8"></script>
<script src="ticker/clock/js/clock.js" type="text/javascript" charset="utf-8"></script>

</body>
</html>
