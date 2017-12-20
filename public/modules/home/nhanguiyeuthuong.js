/**
 * Created by Son Minh on 12/6/2017.
 */

jQuery(document).ready(function($){
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
    var particleImage = new Image();
    particleImage.src = 'ticker/img/snow.png';
    function snowEffectBind() {
        container = $('.snowEffect');
        camera = new THREE.PerspectiveCamera(75, SCREEN_WIDTH / SCREEN_HEIGHT, 1, 10000);
        camera.position.z = 1000;
        scene = new THREE.Scene();
        scene.add(camera);
        renderer = new THREE.CanvasRenderer();
        renderer.setSize(SCREEN_WIDTH, SCREEN_HEIGHT);
        var material = new THREE.ParticleBasicMaterial({ map: new THREE.Texture(particleImage) });
        for (var i = 0; i < 500; i++) {
            particle = new Particle3D(material);
            particle.position.x = Math.random() * 2000 - 1000;
            particle.position.y = Math.random() * 2000 - 1000;
            particle.position.z = Math.random() * 2000 - 1000;
            particle.scale.x = particle.scale.y = 1;
            scene.add(particle);
            particles.push(particle);
        }
        container.html(renderer.domElement);
        // document.addEventListener('mousemove', onDocumentMouseMove, false);
        //document.addEventListener('touchstart', onDocumentTouchStart, false);
        // document.addEventListener('touchmove', onDocumentTouchMove, false);
        setInterval(loop, 2000 / 60);
    }
    function onDocumentMouseMove(event) {
        mouseX = event.clientX - windowHalfX;
        mouseY = event.clientY - windowHalfY;
    }
    function onDocumentTouchStart(event) {
        if (event.touches.length == 1) {
            event.preventDefault();
            mouseX = event.touches[0].pageX - windowHalfX;
            mouseY = event.touches[0].pageY - windowHalfY;
        }
    }
    function onDocumentTouchMove(event) {
        if (event.touches.length == 1) {
            event.preventDefault();
            mouseX = event.touches[0].pageX - windowHalfX;
            mouseY = event.touches[0].pageY - windowHalfY;
        }
    }
    function loop() {
        for (var i = 0; i < particles.length; i++) {
            var particle = particles[i];
            particle.updatePhysics();
            with (particle.position) {
                if (y < -1000) y += 2000;
                if (x > 1000) x -= 2000;
                else if (x < -1000) x += 2000;
                if (z > 1000) z -= 2000;
                else if (z < -1000) z += 2000;
            }
        }
        camera.position.x += (mouseX - camera.position.x) * 0.05;
        camera.position.y += (-mouseY - camera.position.y) * 0.05;
        camera.lookAt(scene.position);
        renderer.render(scene, camera);
    }
    snowEffectBind();
    var now = new Date();
    var dayWrapper = moment(60000 + now.valueOf());
    var dayString = dayWrapper.format("DD/MM/YYYY H:mm");

    $('#date').daterangepicker({
        "singleDatePicker": true,
        "showDropdowns": true,
        "timePicker": true,
        "timePicker24Hour": true,
        "autoApply": true,
        "showCustomRangeLabel": false,
        "startDate": dayString,
        "minDate": dayString,
        // "maxDate": "12/10/2017",
        "opens": "center",
        "drops": "up",
        locale: { format: 'DD-MM-YYYY HH:mm:ss',"separator": "/"},
    }, function(start, end, label) {
        console.log("New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')");
    });
});

function OnShowPoppupInfo() {

    $.ajax({
        url: "/home/getinfo",
        method: "GET",
        dataType: "html",
        cache: false,
        success: function (data) {
            bootbox
                .dialog({
                    title: "Gửi yêu thương của bạn đến",
                    message: data,
                    buttons: {
                        success: {
                            label: "GỬI",
                            className: "btn-success",
                            callback: function () {

                            }
                        }
                    }
                })
                .on('shown.bs.modal', function (e) {

                });
        },
        error: function (xhr, status, error) {
            alert(xhr.responseText);
        }
    });
    return false;
}
function checkPhoneNumber(str) {
    var regexp = /^0([0-9])+$/;
    if (!(regexp.test(str))) {
        return false;
    } else {
        return true;
    }
}
function onSave() {
    if(!checkPhoneNumber($("#phonereceiver").val())){
        swal({
            title: "Thông Báo!",
            text: "Số điện thoại không đúng format. Vui lòng kiểm tra lại !!",
            confirmButtonColor: "#EF5350",
            type: "error"
        });
        return false;
    }
    if(!checkPhoneNumber($("#phonesender").val())){
        swal({
            title: "Thông Báo!",
            text: "Số điện thoại không đúng format. Vui lòng kiểm tra lại !!",
            confirmButtonColor: "#EF5350",
            type: "error"
        });
        return false;
    }
    var formData = new FormData($("#uploader")[0]);
    $.ajax({
        method: "POST",
        url: "/home/saveinfo",
        data: formData,
        dataType: 'json',
        processData: false,
        contentType: false,
        cache: false,
        success: function (result) {
            if (result.Status == '200') {
                swal({
                        title: "Thông Báo!",
                        text: result.Message,
                        confirmButtonColor: "#66BB6A",
                        type: "success"
                    });
                setTimeout(function () {
                    location.reload();
                },3000);
            } else {
                swal({
                    title: "Thông Báo!",
                    text: result.Message,
                    confirmButtonColor: "#EF5350",
                    type: "error"
                });
            }
        },
        error: function (xhr, status, error) {
            alert(xhr.responseText);
        }
    });
    return false;
}
function onChangeFile(id,input) {
    var sound = document.getElementById(id);
    sound.src = URL.createObjectURL(input.files[0]);
    sound.onend = function(e) {
        URL.revokeObjectURL(this.src);
    }
}