
var audio = document.querySelector('audio');
var totaltimerecording=0;
var CheckRecording=0;
// setInterval(function () {
//     if(CheckRecording === 1)
//     {
//         totaltimerecording=parseInt(totaltimerecording)+parseInt(1);
//     }
// },1000);
function captureMicrophone(callback) {
    // btnReleaseMicrophone.disabled = false;

    if(microphone) {
        callback(microphone);
        return;
    }

    if(typeof navigator.mediaDevices === 'undefined' || !navigator.mediaDevices.getUserMedia) {
        swal({
            title: "Thông Báo!",
            text: "Trình duyệt này hiện tại chưa được hỗ trợ chức năng ghi âm. Vui lòng sử dụng trình duyệt khác để thử lại .(This browser does not supports WebRTC getUserMedia API.)",
            confirmButtonColor: "#EF5350",
        });
        if(!!navigator.getUserMedia) {
            alert('This browser seems supporting deprecated getUserMedia API.');
        }
    }

    navigator.mediaDevices.getUserMedia({
        audio: isEdge ? true : {
            echoCancellation: false
        }
    }).then(function(mic) {
        callback(mic);
    }).catch(function(error) {
        swal({
            title: "Thông Báo!",
            text: "Không thể ghi âm. Vui lòng kiểm tra lại thiết bị ghi âm!!",
            confirmButtonColor: "#EF5350",
        });
        console.error(error);
    });
}

function replaceAudio(src) {
    var newAudio = document.createElement('audio');
    newAudio.controls = true;

    if(src) {
        newAudio.src = src;
    }

    var parentNode = audio.parentNode;
    parentNode.innerHTML = '';
    parentNode.appendChild(newAudio);

    audio = newAudio;
}

function stopRecordingCallback() {
    replaceAudio(URL.createObjectURL(recorder.getBlob()));
    CheckRecording=0;
    // btnStartRecording.disabled = false;

    // setTimeout(function() {
    //     if(!audio.paused) return;
    //
    //     setTimeout(function() {
    //         if(!audio.paused) return;
    //         audio.play();
    //     }, 1000);
    //
    //     audio.play();
    // }, 300);
    //
    // audio.play();

    // btnDownloadRecording.disabled = false;

    if(isSafari) {
        // click(btnReleaseMicrophone);
    }
}

var isEdge = navigator.userAgent.indexOf('Edge') !== -1 && (!!navigator.msSaveOrOpenBlob || !!navigator.msSaveBlob);
var isSafari = /^((?!chrome|android).)*safari/i.test(navigator.userAgent);

var recorder; // globally accessible
var microphone;

var btnStartRecording = document.getElementById('btn-start-recording');

var trigger='start';
var option=0;
btnStartRecording.onclick = function() {
    CheckRecording=1;
    option= parseInt(option) + 1;
    if(trigger !== 'stop'){
        totaltimerecording=0;
        if (!microphone) {
            captureMicrophone(function(mic) {
                microphone = mic;

                if(isSafari) {
                    replaceAudio();

                    audio.muted = true;
                    setSrcObject(microphone, audio);
                    audio.play();
                    swal({
                        // title: "Thông Báo!",
                        html: '<div class="row">Vui lòng nhấn vào nút ghi âm 1 lần nữa để tiến trình ghi âm bắt đầu!!</div><div class="row"><div class="fileUpload btn btn-success" onclick="swal.closeModal();"><span>OK</span></div></div> ',
                        showConfirmButton: false,
                    });
                    tour.init();
                    tour.start();
                    return false;
                }
                click(btnStartRecording);
            });
            return false;
        }else {
            replaceAudio();
            audio.muted = true;
            setSrcObject(microphone, audio);
            audio.play();

            var options = {
                type: 'audio',
                numberOfAudioChannels: isEdge ? 1 : 2,
                checkForInactiveTracks: true,
                bufferSize: 16384
            };

            if(navigator.platform && navigator.platform.toString().toLowerCase().indexOf('win') === -1) {
                options.sampleRate = 48000; // or 44100 or remove this line for default
            }

            if(recorder) {
                recorder.destroy();
                recorder = null;
            }

            recorder = RecordRTC(microphone, options);
            recorder.startRecording();
            $('.button-container').addClass("Rec");
            $( "button" ).toggleClass( "square", 300, "easeInBack" );
            $( "#timeroutput" ).toggleClass( "show", 300, "linear" );
            $('#timeroutput').html("Đang ghi âm...");
            trigger='stop';
        }

    }
    else{
        trigger='start';
        $('#timeroutput').html("Nhấn để ghi âm lại");
        $('.button-container').removeClass("Rec");
        $( "button" ).removeClass("square");
        recorder.stopRecording(stopRecordingCallback);
        if(microphone) {
            microphone.stop();
            microphone = null;
        }
        if(recorder) {
            // click(btnStopRecording);
            recorder.stopRecording(stopRecordingCallback);
        }
    }
};


function click(el) {
    el.disabled = false; // make sure that element is not disabled
    var evt = document.createEvent('Event');
    evt.initEvent('click', true, true);
    el.dispatchEvent(evt);
}

function getRandomString() {
    if (window.crypto && window.crypto.getRandomValues && navigator.userAgent.indexOf('Safari') === -1) {
        var a = window.crypto.getRandomValues(new Uint32Array(3)),
            token = '';
        for (var i = 0, l = a.length; i < l; i++) {
            token += a[i].toString(36);
        }
        return token;
    } else {
        return (Math.random() * new Date().getTime()).toString(36).replace(/\./g, '');
    }
}

function getFileName(fileExtension) {
    var d = new Date();
    var year = d.getFullYear();
    var month = d.getMonth();
    var date = d.getDate();
    return 'RecordRTC-' + year + month + date + '-' + getRandomString() + '.' + fileExtension;
}

function SaveToDisk(fileURL, fileName) {
    // for non-IE
    if (!window.ActiveXObject) {
        var save = document.createElement('a');
        save.href = fileURL;
        save.download = fileName || 'unknown';
        save.style = 'display:none;opacity:0;color:transparent;';
        (document.body || document.documentElement).appendChild(save);

        if (typeof save.click === 'function') {
            save.click();
        } else {
            save.target = '_blank';
            var event = document.createEvent('Event');
            event.initEvent('click', true, true);
            save.dispatchEvent(event);
        }

        (window.URL || window.webkitURL).revokeObjectURL(save.href);
    }

    // for IE
    else if (!!window.ActiveXObject && document.execCommand) {
        var _window = window.open(fileURL, '_blank');
        _window.document.close();
        _window.document.execCommand('SaveAs', true, fileName || fileURL)
        _window.close();
    }
}
$("#upload").click(function () {
    var musicplayer='<div class="audio green-audio-player hidden"> <div class="loading" style="display: none"> <div class="spinner"></div> </div> <div class="play-pause-btn" style="display: block"> <svg xmlns="http://www.w3.org/2000/svg" width="18" height="24" viewBox="0 0 18 24"> <path fill="#566574" fill-rule="evenodd" d="M18 12L0 24V0" class="play-pause-icon" id="playPause"/> </svg> </div> <div class="controls"> <span class="current-time">0:00</span> /<div class="slider hidden" data-direction="horizontal"> <div class="progress"> <div class="pin" id="progress-pin" data-method="rewind"></div> </div> </div> <span class="total-time">0:00</span> </div> <div class="volume hidden"> <div class="volume-btn"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"> <path fill="#566574" fill-rule="evenodd" d="M14.667 0v2.747c3.853 1.146 6.666 4.72 6.666 8.946 0 4.227-2.813 7.787-6.666 8.934v2.76C20 22.173 24 17.4 24 11.693 24 5.987 20 1.213 14.667 0zM18 11.693c0-2.36-1.333-4.386-3.333-5.373v10.707c2-.947 3.333-2.987 3.333-5.334zm-18-4v8h5.333L12 22.36V1.027L5.333 7.693H0z" id="speaker"/> </svg> </div> <div class="volume-controls hidden"> <div class="slider" data-direction="vertical"> <div class="progress"> <div class="pin" id="volume-pin" data-method="changeVolume"></div> </div> </div> </div> </div> ' +
        '<audio src="https://gnly.cloudfone.vn/uploads/CF/CF01.mp3" type="audio/mpeg"> </audio> </div>';
    swal({
        html: '<p style="margin-right: 50px;margin-left: 50px;margin-bottom: 25px;">Nội dung lời yêu thương của bạn sẽ được CloudFone bảo mật và kiểm duyệt trong thời gian sớm nhất trước khi gửi.</p>' +
        '<div class="row">'+musicplayer+'</div>' +
        '<div class="row"><div class="fileUpload btn btn-success" id="OKButton"><span>OK</span></div><div class="fileUpload btn btn-primary" id="HuyCancel"><span>Hủy</span></div></div>',
        showConfirmButton: false,
    });
    var audioPlayer = document.querySelector(".green-audio-player");
    var playPause = audioPlayer.querySelector("#playPause");
    var playpauseBtn = audioPlayer.querySelector(".play-pause-btn");
    var loading = audioPlayer.querySelector(".loading");
    var progress = audioPlayer.querySelector(".progress");
    var sliders = audioPlayer.querySelectorAll(".slider");
    var volumeBtn = audioPlayer.querySelector(".volume-btn");
    var volumeControls = audioPlayer.querySelector(".volume-controls");
    var volumeProgress = volumeControls.querySelector(".slider .progress");
    var player = audioPlayer.querySelector("audio");
    var currentTime = audioPlayer.querySelector(".current-time");
    var totalTime = audioPlayer.querySelector(".total-time");
    var speaker = audioPlayer.querySelector("#speaker");
    var draggableClasses = ["pin"];
    var currentlyDragged = null;
    var recording=audio;
    var sound2=document.querySelector("#sound2");

    var totaltimesound2=0;
    var finalTotalTime=0;

    window.addEventListener("mousedown", function (event) {
        if (!isDraggable(event.target)) return false;

        currentlyDragged = event.target;
        var handleMethod = currentlyDragged.dataset.method;

        this.addEventListener("mousemove", window[handleMethod], false);

        window.addEventListener("mouseup", function () {
            currentlyDragged = false;
            window.removeEventListener("mousemove", window[handleMethod], false);
        }, false);
    });

    playpauseBtn.addEventListener("click", togglePlay);
    player.addEventListener("timeupdate", function () {
        updateProgress(player.currentTime);
    });
    player.addEventListener("volumechange", updateVolume);
    player.addEventListener("loadedmetadata", function () {

        if(sound2.readyState > 3)
        {
            totaltimesound2=sound2.duration;
        }
        finalTotalTime= parseInt(player.duration) + parseInt(totaltimerecording) + parseInt(totaltimesound2);
        totalTime.textContent = formatTime(finalTotalTime);
    });
    player.addEventListener("canplay", makePlay);
    player.addEventListener("ended", function () {
        if(recording.readyState > 3){
            recording.play();
        }
        else{
            if(sound2.readyState > 3 && recording.currentTime === 0){
                sound2.play();
            }
        }
    });
    //recording control
    recording.addEventListener("ended", function () {
        sound2.play();
    });
    recording.addEventListener("timeupdate", function () {
        updateProgress(player.duration + recording.currentTime);
    });
    //sound2 control
    sound2.addEventListener("ended", function () {
        playPause.attributes.d.value = "M18 12L0 24V0";
        player.currentTime = 0;
    });
    sound2.addEventListener("timeupdate", function () {
        updateProgress(totaltimerecording + player.duration + sound2.currentTime);
    });

    /*end*/
    volumeBtn.addEventListener("click", function () {
        volumeBtn.classList.toggle("open");
        volumeControls.classList.toggle("hidden");
    });

    window.addEventListener("resize", directionAware);

    sliders.forEach(function (slider) {
        var pin = slider.querySelector(".pin");
        slider.addEventListener("click", window[pin.dataset.method]);
    });

    directionAware();

    function isDraggable(el) {
        var canDrag = false;
        var classes = Array.from(el.classList);
        draggableClasses.forEach(function (draggable) {
            if (classes.indexOf(draggable) !== -1) canDrag = true;
        });
        return canDrag;
    }

    function inRange(event) {
        var rangeBox = getRangeBox(event);
        var rect = rangeBox.getBoundingClientRect();
        var direction = rangeBox.dataset.direction;
        if (direction == "horizontal") {
            var min = rangeBox.offsetLeft;
            var max = min + rangeBox.offsetWidth;
            if (event.clientX < min || event.clientX > max) return false;
        } else {
            var min = rect.top;
            var max = min + rangeBox.offsetHeight;
            if (event.clientY < min || event.clientY > max) return false;
        }
        return true;
    }

    function updateProgress(current) {
        var percent = current / finalTotalTime * 100;
        progress.style.width = percent + "%";
        currentTime.textContent = formatTime(current);
    }

    function updateVolume() {
        volumeProgress.style.height = player.volume * 100 + "%";
        if (player.volume >= 0.5) {
            speaker.attributes.d.value = "M14.667 0v2.747c3.853 1.146 6.666 4.72 6.666 8.946 0 4.227-2.813 7.787-6.666 8.934v2.76C20 22.173 24 17.4 24 11.693 24 5.987 20 1.213 14.667 0zM18 11.693c0-2.36-1.333-4.386-3.333-5.373v10.707c2-.947 3.333-2.987 3.333-5.334zm-18-4v8h5.333L12 22.36V1.027L5.333 7.693H0z";
        } else if (player.volume < 0.5 && player.volume > 0.05) {
            speaker.attributes.d.value = "M0 7.667v8h5.333L12 22.333V1L5.333 7.667M17.333 11.373C17.333 9.013 16 6.987 14 6v10.707c2-.947 3.333-2.987 3.333-5.334z";
        } else if (player.volume <= 0.05) {
            speaker.attributes.d.value = "M0 7.667v8h5.333L12 22.333V1L5.333 7.667";
        }
    }

    function getRangeBox(event) {
        var rangeBox = event.target;
        var el = currentlyDragged;
        if (event.type == "click" && isDraggable(event.target)) {
            rangeBox = event.target.parentElement.parentElement;
        }
        if (event.type == "mousemove") {
            rangeBox = el.parentElement.parentElement;
        }
        return rangeBox;
    }

    function getCoefficient(event) {
        var slider = getRangeBox(event);
        var rect = slider.getBoundingClientRect();
        var K = 0;
        if (slider.dataset.direction == "horizontal") {
            var offsetX = event.clientX - slider.offsetLeft;
            var width = slider.clientWidth;
            K = offsetX / width;
        } else if (slider.dataset.direction == "vertical") {
            var height = slider.clientHeight;
            var offsetY = event.clientY - rect.top;
            K = 1 - offsetY / height;
        }
        return K;
    }

    function rewind(event) {
        if (inRange(event)) {
            player.currentTime = player.duration * getCoefficient(event);
        }
    }

    function changeVolume(event) {
        if (inRange(event)) {
            player.volume = getCoefficient(event);
        }
    }

    function formatTime(time) {
        var min = Math.floor(time / 60);
        var sec = Math.floor(time % 60);
        return min + ':' + (sec < 10 ? '0' + sec : sec);
    }

    function togglePlay() {
        if (player.currentTime === 0) {

            playPause.attributes.d.value = "M0 0h6v24H0zM12 0h6v24h-6z";
            player.play();

        } else {
            playPause.attributes.d.value = "M18 12L0 24V0";
            currentTime.textContent=formatTime(0);
            var audios = document.getElementsByTagName('audio');
            for(var i = 0, len = audios.length; i < len;i++){
                audios[i].pause();
                audios[i].currentTime=0;
            }
        }
    }

    function makePlay() {
        // playpauseBtn.style.display = 'block';
        $(".play-pause-btn").css("display","block");
        $(".loading").css("display","none");
        // loading.style.display = 'none';
    }

    function directionAware() {
        if (window.innerHeight < 250) {
            volumeControls.style.bottom = '-54px';
            volumeControls.style.left = '54px';
        } else if (audioPlayer.offsetTop < 154) {
            volumeControls.style.bottom = '-164px';
            volumeControls.style.left = '-3px';
        } else {
            volumeControls.style.bottom = '52px';
            volumeControls.style.left = '-3px';
        }
    }
    $("#OKButton").click(function () {
        swal.closeModal();
        var audios = document.getElementsByTagName('audio');
        for(var i = 0, len = audios.length; i < len;i++){
            audios[i].pause();
            audios[i].currentTime=0;
        }
        // if(!checkPhoneNumber($("#phonereceiver").val())){
        //     swal({
        //         title: "Thông Báo!",
        //         text: "Số điện thoại không đúng format. Vui lòng kiểm tra lại !!",
        //         confirmButtonColor: "#EF5350",
        //         type: "error"
        //     });
        //     return false;
        // }
        if(!checkPhoneNumber($("#phonesender").val())){
            swal({
                title: "Thông Báo!",
                text: "Số điện thoại không đúng format. Vui lòng kiểm tra lại !!",
                confirmButtonColor: "#EF5350",
                type: "error"
            });
            return false;
        }
        if(option === 0){
            swal({
                title: "Thông Báo!",
                text: "Vui lòng chọn ghi âm hoặc upload file hoặc thêm link nhạc từ mp3.zing.vn!!",
                confirmButtonColor: "#EF5350",
                type: "error"
            });
            return false;
        }
        var formData = new FormData($("#uploader")[0]);
        if(recorder)
        {
            var blob = recorder.getBlob();
            var fileType = blob.type.split('/')[0] || 'audio';
            var fileName = (Math.random() * 1000).toString().replace('.', '');

            if (fileType === 'audio') {
                fileName += '.' + (!!navigator.mozGetUserMedia ? 'ogg' : 'wav');
            } else {
                fileName += '.webm';
            }

            // create FormData
            formData.append(fileType + '-filename', fileName);
            formData.append(fileType + '-blob', blob);
        }
        formData.append('option', option);
        $("#loading").css('visibility','');
        $.ajax({
            method: "POST",
            url: "core/uploadrecording",
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
            cache: false,
            success: function (result) {
                if (result.Status == '200') {
                    $("#loading").css('visibility','hidden');
                    swal({
                        title: "Thông Báo!",
                        text: result.Message,
                        confirmButtonColor: "#66BB6A",
                        type: "success"
                    }).then(function () {
                        location.reload();
                    });
                } else {
                    $("#loading").css('visibility','hidden');
                    swal({
                        title: "Thông Báo!",
                        text: result.Message,
                        confirmButtonColor: "#EF5350",
                        type: "error"
                    });
                }
            },
            error: function (xhr, status, error) {
                $("#loading").css('visibility','hidden');
                console.log(xhr.responseText);
                swal({
                    title: "Thông Báo!",
                    text: "Lỗi. Không thể gửi yêu cầu!!",
                    confirmButtonColor: "#EF5350",
                    type: "error"
                });
            }
        });
        return false;
    });
    $("#HuyCancel").click(function () {
        swal.closeModal();
        var audios = document.getElementsByTagName('audio');
        for(var i = 0, len = audios.length; i < len;i++){
            audios[i].pause();
            audios[i].currentTime=0;
        }
    });
});
$("#chonnhac").click(function () {
    option= parseInt(option) + 1;
});
$("#themlink").click(function () {
    swal({
        html: '<div class="row" style="float: left;margin-bottom: 10px">Truy cập <a href="http://mp3.zing.vn" style="text-decoration: underline;color:blue;" target="_blank">mp3.zing.vn</a> hoặc dán link vào dưới đây</div> <div class="row"><input type="text" name"link" id="link" placeholder="Vui lòng nhập link nhạc mp3.zing.vn vào đây"></div><div class="row"><div class="fileUpload btn btn-primary" onclick="return getLink();"> <span>OK</span></div><div class="fileUpload btn btn-warning" onclick="swal.closeModal();"> <span>Hủy</span></div></div> ',
        showConfirmButton: false,
    })
    reset($('#audio2'));
});
window.reset = function (e) {
    e.wrap('<form>').closest('form').get(0).reset();
    e.unwrap();
}
function getLink() {
    $.ajax({
        method: "POST",
        url: "core/getlink",
        data: {
            link: $("#link").val(),
        },
        dataType: 'json',
        cache: false,
        success: function (result) {
            if (result.Status == '200') {
                $("#loading").css('visibility','hidden');
                option= parseInt(option) + 1;
                bootbox.hideAll();
                swal({
                    title: "Thông Báo!",
                    text: "Lấy file từ mp3.zing.vn thành công",
                    confirmButtonColor: "#66BB6A",
                    type: "success"
                });
                var checkfile=document.getElementById("sound2").src;
                if(checkfile !== ''){
                    $.ajax({
                        method: "POST",
                        url: "core/deletefile",
                        data: {
                            filedelete: checkfile,
                        },
                        dataType: 'json',
                        cache: false,
                    });
                }
                audio_core=$('#sound2').attr('src', result.Message)[0];
                audio_core.play();
                $("#linkfile").val(result.Message);
            } else {
                bootbox.hideAll();
                $("#loading").css('visibility','hidden');
                swal({
                    title: "Thông Báo!",
                    text: result.Message,
                    confirmButtonColor: "#EF5350",
                    type: "error"
                });
            }
        },
        error: function (xhr, status, error) {
            bootbox.hideAll();
            $("#loading").css('visibility','hidden');
            console.log(xhr.responseText);
            swal({
                title: "Thông Báo!",
                text: "Lỗi. Không thể gửi yêu cầu!!",
                confirmButtonColor: "#EF5350",
                type: "error"
            });
        }
    });
    return false;
};
var tour = new Tour({
    name: Math.random(),
    delay: 1000,
    placement: 'top',
    steps: [
        {
            element: "#guiyeuthuong",
            content: "Nhấn vào đây để gửi yêu thương nhé."
        }
    ],
    template: "<div class='popover tour' style='color: black;'> <div class='arrow'></div> <h3 class='popover-title'></h3> <div class='popover-content'></div></div></div>",
});
$( document ).ready(function() {
    tour.init();
    tour.start();
});
$("body").click(function () {
            tour.end();
        });