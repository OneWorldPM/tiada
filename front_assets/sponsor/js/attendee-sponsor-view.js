$(function() {

    var socketServer = "https://meet.yourconference.live:443";
    let socket = io(socketServer);
    socket.on('welcome-phpapp', function(message){
        console.log(message);
        socket.emit('greeting-from-phpapp-attendee', {
            message: "Hello from php app attendee"
        });
    });

    socket.on('server-got-phpapp-attendee', function(message){
        console.log(message);
    });

    socket.on('video-call', function(message){
        console.log(message);
    });


// ......................................................
// ..................RTCMultiConnection Code.............
// ......................................................

    var connection = new RTCMultiConnection();

// Using SSE (Server Sent Events) for signaling
    connection.socketURL = 'https://yourconference.live/SSEConnection/';
    connection.setCustomSocketHandler(SSEConnection);

    connection.session = {
        audio: true,
        video: true
    };

    connection.sdpConstraints.mandatory = {
        OfferToReceiveAudio: true,
        OfferToReceiveVideo: true
    };

// https://www.rtcmulticonnection.org/docs/iceServers/
// use your own TURN-server here!
    connection.iceServers = [{
        'urls': [
            'stun:stun.l.google.com:19302',
            'stun:stun1.l.google.com:19302',
            'stun:stun2.l.google.com:19302',
            'stun:stun.l.google.com:19302?transport=udp',
        ]
    }];

    connection.videosContainer = document.getElementById('videos-container');
    connection.onstream = function(event) {
        console.log(event);
        socket.emit('video-call-request', {
            message: event
        });
        event.mediaElement.id = event.streamid;
        connection.videosContainer.appendChild(event.mediaElement);

        if (event.type === 'remote') {
            connection.socket.close(); // release SSE connection
        }
    };

    connection.onstreamended = function(event) {
        var mediaElement = document.getElementById(event.streamid);
        if (mediaElement && mediaElement.parentNode) {
            mediaElement.parentNode.removeChild(mediaElement);
        }
    };




    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-bottom-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }

    $(".edit-cover-btn").on( "click", function() {
        toastr["warning"]("Logo and cover editing option is under development!")
    });

    $(".edit-about-btn, .save-twitter, .test-edit-btn").on( "click", function() {
        toastr["warning"]("Under development!")
    });

    $(".video-call-btn").on( "click", function() {
        $('#videoCallModal').modal('show');
        connection.open('attendee-to-sponsor', function() {
            showRoomURL(connection.sessionid);
        });
        toastr["warning"]("Problem connecting to sponsor!")
    });

    $(".video-call-hangup").on( "click", function() {
        location.reload();
    });


    function toggleResetPswd(e){
        e.preventDefault();
        $('#logreg-forms .form-signin').toggle() // display:block or none
        $('#logreg-forms .form-reset').toggle() // display:block or none
    }

    function toggleSignUp(e){
        e.preventDefault();
        $('#logreg-forms .form-signin').toggle(); // display:block or none
        $('#logreg-forms .form-signup').toggle(); // display:block or none
    }

    $(()=>{
        // Login Register Form
        $('#logreg-forms #forgot_pswd').click(toggleResetPswd);
        $('#logreg-forms #cancel_reset').click(toggleResetPswd);
        $('#logreg-forms #btn-signup').click(toggleSignUp);
        $('#logreg-forms #cancel_signup').click(toggleSignUp);
    })

});
