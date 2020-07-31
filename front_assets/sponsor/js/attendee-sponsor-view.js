$(function() {


// ......................................................
// ..................RTCMultiConnection Code.............
// ......................................................

    function displaySignalMessage(message) {
        console.log(message);
    }
    function displayMessage(message) {
        // chatArea.innerHTML = chatArea.innerHTML + "<br/>" + message;
        console.log(message);
    }

    var myVideoArea = document.querySelector("#myVideoTag");
    var theirVideoArea = document.querySelector("#theirVideoTag");
    var ROOM = "chat";
    var SIGNAL_ROOM = company_name+'_'+sponsor_id;
    var configuration = {
        'iceServers': [
            { 'urls': 'stun:stun.l.google.com:19302' },
            { 'urls': 'stun:stun1.l.google.com:19302' },
            {
                url: 'turn:numb.viagenie.ca',
                credential: 'muazkh',
                username: 'webrtc@live.com'
            },
            {
                url: 'turn:192.158.29.39:3478?transport=udp',
                credential: 'JZEOEt2V3Qb0y27GRntt2u2PAYA=',
                username: '28224511:1379330808'
            }
        ]
    };
    var rtcPeerConn;

    var socketServer = "https://meet.yourconference.live:443";
    let socket = io(socketServer);

    socket.emit('ready', {"chat_room": ROOM, "signal_room": SIGNAL_ROOM});

    function callSponsor()
    {
        // get a local stream, show it in our video tag and add it to be sent
        navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia;
        navigator.getUserMedia({
            'audio': false,
            'video': true
        }, function (stream) {
            myVideoArea.srcObject = stream;
        }, logError);


        socket.emit('ready', {"chat_room": ROOM, "signal_room": SIGNAL_ROOM});

        //Send a first signaling message to anyone listening
        //This normally would be on a button click
        socket.emit('signal',{"type":"user_here", "message":"Are you ready for a call?", "room":SIGNAL_ROOM});

        socket.on('signaling_message', function(data) {
            displaySignalMessage("Signal received: " + data.type);

            //Setup the RTC Peer Connection object
            if (!rtcPeerConn)
                startSignaling();

            if (data.type != "user_here") {
                var message = JSON.parse(data.message);
                if (message.sdp) {
                    rtcPeerConn.setRemoteDescription(new RTCSessionDescription(message.sdp), function () {
                        // if we received an offer, we need to answer
                        if (rtcPeerConn.remoteDescription.type == 'offer') {
                            rtcPeerConn.createAnswer(sendLocalDesc, logError);
                        }
                    }, logError);
                }
                else {
                    rtcPeerConn.addIceCandidate(new RTCIceCandidate(message.candidate));
                }
            }

        });
    }

    function startSignaling() {
        displaySignalMessage("starting signaling...");

        rtcPeerConn = new RTCPeerConnection(configuration);

        // send any ice candidates to the other peer
        rtcPeerConn.onicecandidate = function (evt) {
            if (evt.candidate)
                socket.emit('signal',{"type":"ice candidate", "message": JSON.stringify({ 'candidate': evt.candidate }), "room":SIGNAL_ROOM});
            displaySignalMessage("completed that ice candidate...");
        };

        // let the 'negotiationneeded' event trigger offer generation
        rtcPeerConn.onnegotiationneeded = function () {
            displaySignalMessage("on negotiation called");
            rtcPeerConn.createOffer(sendLocalDesc, logError);
        }

        // get a local stream, show it in our video tag and add it to be sent
        navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia;
        navigator.getUserMedia({
            'audio': false,
            'video': true
        }, function (stream) {
            displaySignalMessage("going to display my stream...");
            rtcPeerConn.addStream(stream);
        }, logError);

        // once remote stream arrives, show it in the remote video element
        rtcPeerConn.ontrack = function (evt) {
            displaySignalMessage("going to add their stream...");
            theirVideoArea.srcObject = evt.streams[0];
        };

    }

    function sendLocalDesc(desc) {
        rtcPeerConn.setLocalDescription(desc, function () {
            displaySignalMessage("sending local description");
            socket.emit('signal',{"type":"SDP", "message": JSON.stringify({ 'sdp': rtcPeerConn.localDescription }), "room":SIGNAL_ROOM});
        }, logError);
    }

    function logError(error) {
        displaySignalMessage(error.name + ': ' + error.message);
    }

    socket.on('announce', function(data) {
        console.log(data);
        displayMessage(data.message.chat_room);
        displayMessage(data.message.signal_room);
    });

    socket.on('message', function(data) {
        displayMessage(data.author + ": " + data.message);
    });
// ......................................................
// ................End of RTCMultiConnection Code........
// ......................................................



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

        callSponsor();

        $('#videoCallModal').modal('show');

        toastr["warning"]("Feature is still under development!")
    });

    $(".video-call-hangup").on( "click", function() {
        socket.emit('leave', {"chat_room": ROOM, "signal_room": SIGNAL_ROOM});
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
