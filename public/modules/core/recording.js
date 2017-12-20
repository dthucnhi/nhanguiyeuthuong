
var audio = document.querySelector('audio');

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
            type: "error"
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
            type: "error"
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

    // btnStartRecording.disabled = false;

    setTimeout(function() {
        if(!audio.paused) return;

        setTimeout(function() {
            if(!audio.paused) return;
            audio.play();
        }, 1000);

        audio.play();
    }, 300);

    audio.play();

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
    option= parseInt(option) + 1;
    if(trigger !== 'stop'){
        if (!microphone) {
            captureMicrophone(function(mic) {
                microphone = mic;

                if(isSafari) {
                    replaceAudio();

                    audio.muted = true;
                    setSrcObject(microphone, audio);
                    audio.play();
                    swal({
                        title: "Thông Báo!",
                        text: "Do bạn đang sử dụng trình duyệt Safari nên vui lòng nhấn vào nút ghi âm 1 lần nữa để tiến trình ghi âm bắt đầu !!",
                        confirmButtonColor: "#EF5350",
                        type: "error"
                    });
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
$("#chonnhac").click(function () {
    option= parseInt(option) + 1;
});
$("#themlink").click(function () {
    bootbox.dialog({
        title: 'Thêm link nhạc',
        closeButton: false,
        message: '<div class="row"><input type="text" name"link" id="link" placeholder="Vui lòng nhập link nhạc mp3.zing.vn vào đây"></div><div class="row"><div class="fileUpload btn btn-primary" onclick="return getLink();"> <span>Lấy file</span></div><div class="fileUpload btn btn-warning" onclick="bootbox.hideAll();"> <span>Hủy</span></div></div> ',
        size: 'small',
        onEscape: true,
        backdrop: true,
        buttons: false,
    })
});
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
// $("#guiyeuthuong").click(function () {
//     CheckShowTour="on";
// });
// $("#closebutton").click(function () {
//     CheckShowTour="on";
//     tour.end();
// });
// var tour = new Tour({
//     name: Math.random(),
//     delay: 1000,
//     steps: [
//         {
//             element: "#btn-start-recording",
//             content: "Bước 1: Nhấn vào đây để ghi âm lại tin nhắn của bạn"
//         },
//         {
//             element: "#chonnhac",
//             content: "Bước 2: Chọn đoạn nhạc bạn thích"
//         },
//         {
//             element: "#namereceiver",
//             content: "Bước 3: Nhập tên người sẽ nhận lời yêu thương của bạn vào đây"
//         },
//         {
//             element: "#phonereceiver",
//             content: "Bước 4: Nhập số điện thoại người đó vào đây"
//         },
//         {
//             element: "#namesender",
//             content: "Bước 5: Nhập tên của bạn vào đây"
//         },
//         {
//             element: "#phonesender",
//             content: "Bước 6: Nhập số điện thoại của bạn vào đây"
//         },
//         {
//             element: "#date",
//             content: "Bước 7: Chọn thời gian bạn muốn người đó nhận"
//         },
//         {
//             element: "#upload",
//             content: "Bước cuối cùng: Gửi thôi."
//         }
//     ],
//     template: "<div class='popover tour' style='color: black;'> <div class='arrow'></div> <h3 class='popover-title'></h3> <div class='popover-content'></div></div></div>",
// });
// var CheckShowTour="off";
//
// setInterval(function () {
//     if($("#morphevent").hasClass("active") === true && CheckShowTour === "on")
//     {
//         // Initialize the tour
//         tour.init();
//         // Start the tour
//         tour.start();
//         setTimeout(function () {
//             if(!tour.ended())
//             {
//                 tour.next();
//             }
//         },2000);
//         $("body").click(function () {
//             tour.end();
//         });
//     }
//     if(tour.ended()){
//         CheckShowTour="off";
//         tour.end();
//     }
// },2000);
