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
    var SIGNAL_ROOM = 'tiada_'+company_name+'_'+sponsor_id;
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
            'audio': true,
            'video': true
        }, function (stream) {
            myVideoArea.srcObject = stream;
        }, logError);



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
            'audio': true,
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

        rtcPeerConn.oniceconnectionstatechange = function() {
            if(rtcPeerConn.iceConnectionState == 'disconnected') {
                //Releasing previous connections on reload!
                $.post("/tiadaannualconference/sponsor-admin/VideoChatApi/releaseSponsor",
                    {
                        roomId: SIGNAL_ROOM,
                        sponsorId: sponsor_id
                    });

                $('#videoCallModal').modal('hide');
                Swal.fire(
                    'TIADA left the video chat!',
                    'if this was a connection problem, please try again!',
                    'warning'
                ).then(function () {
                    location.reload();
                });
                location.reload();

                // myVideoArea.srcObject.getVideoTracks().forEach(track => {
                //     track.stop();
                //     myVideoArea.srcObject.removeTrack(track);
                // });
                //
                // theirVideoArea.srcObject.getVideoTracks().forEach(track => {
                //     track.stop();
                //     theirVideoArea.srcObject.removeTrack(track);
                // });
                //
                // rtcPeerConn.close();
            }
        }

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


    $(".video-call-btn").on( "click", function() {

        $.post("/tiadaannualconference/sponsor-admin/VideoChatApi/sponsorVideoEngageStatus",
            {
                roomId: SIGNAL_ROOM,
                sponsorId: sponsor_id
            },
            function(data, status){
                if(status == 'success' && data == 'false')
                {
                    callSponsor();
                    $('#videoCallModal').modal({
                        backdrop: 'static',
                        keyboard: false
                    });
                    $('#videoCallModal').modal('show');
                }else{
                    Swal.fire({
                        icon: 'warning',
                        title: company_name_orig+' is on another call!',
                        text: 'please try again after a while',
                        footer: '<span>Or schedule a meeting with '+company_name_orig+' now! </span>'
                    });
                }
            });

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

    $('.schedule-meet-btn').on('click', function () {

        $.get( "/tiadaannualconference/sponsor-admin/schedules/getAvailableDatesOf/"+sponsor_id+"/"+company_name, function(dates){
            var enableDays = JSON.parse(dates);
            $('#scheduleModal').modal('show');

            if (typeof(enableDays[0]) == 'undefined' || enableDays[0] == ''){
                $(".datetimepicker").val('No dates available!');
                $(".datetimepicker").prop('disabled', true);
                return false;
            }
            $(".datetimepicker").prop('disabled', false);

            $.get( "/tiadaannualconference/sponsor-admin/schedules/getTimeSlotByDateOf/"+sponsor_id+"/"+company_name+"/"+enableDays[0], function(times){

                var enableTimes = JSON.parse(times);

                $(".datetimepicker").val(enableDays[0]+' '+enableTimes[0]);

                function enableAllTheseDays(date) {
                    let d = new Date(Date.parse(date));
                    var sdate = (d.getFullYear() + '-' + ('0' + (d.getMonth()+1)).slice(-2) + '-' + ('0' + d.getDate()).slice(-2));
                    //var sdate = date.format( 'yy/mm/dd');
                    if($.inArray(sdate, enableDays) != -1) {
                        return [true];
                    }
                    return [false];
                }

                $(".datetimepicker").datetimepicker({
                    timepicker: true,
                    beforeShowDay: enableAllTheseDays,
                    allowTimes: enableTimes,
                    onSelectDate:function(date,$i){
                        let d = new Date(Date.parse(date));
                        var sdate = (d.getFullYear() + '-' + ('0' + (d.getMonth()+1)).slice(-2) + '-' + ('0' + d.getDate()).slice(-2));

                        $.get( "/tiadaannualconference/sponsor-admin/schedules/getTimeSlotByDateOf/"+sponsor_id+"/"+company_name+"/"+sdate, function(times){
                            var enableTimes = JSON.parse(times);
                            console.log(enableTimes);
                            $('.datetimepicker').datetimepicker('setOptions', {allowTimes:enableTimes});
                        });
                    }
                });
            });
        });
    });

    $('.book-meet-btn').on('click', function () {
        var meetingDateTime = $('#selectedMeetingDateTime').val();
        if (meetingDateTime == 'No dates available!')
            return;

        let from = new Date(Date.parse(meetingDateTime));
        var sfdate = (from.getFullYear() + '/' + ('0' + (from.getMonth()+1)).slice(-2) + '/' + ('0' + from.getDate()).slice(-2) +' '+ from.getHours()+':'+(from.getMinutes()<10?'0':'') + from.getMinutes());
        var to = from;
        to.setMinutes(from.getMinutes()+30);
        var stdate = (to.getFullYear() + '/' + ('0' + (to.getMonth()+1)).slice(-2) + '/' + ('0' + to.getDate()).slice(-2) +' '+ to.getHours()+':'+to.getMinutes());
        var sttime = to.getHours()+':'+ (to.getMinutes()<10?'0':'') + to.getMinutes();

        Swal.fire({
            title: 'Are you sure?',
            html: "<h5>You are about to book a meeting with " +
                   "<span style='color: #047d20'>"+company_name_orig+"</span><br>" +
                   "On <span style='color: #0f3e68'>"+sfdate+"</span> To <span style='color: #00a5b3'>"+sttime+"</span></h5>",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, book it!',
            cancelButtonText: 'No, go back!'
        }).then((result) => {
            if (result.value) {

                $.post("/tiadaannualconference/sponsor-admin/Schedules/makeBooking",
                    {
                        'sponsor_id': sponsor_id,
                        'contact_person': company_name,
                        'attendee_id': user_id,
                        'meet_from': sfdate,
                        'meet_to': stdate
                    },
                    function(data, status){
                        if(status == 'success')
                        {
                            data = JSON.parse(data);

                            if (data.status == 'success')
                            {
                                Swal.fire(
                                    'Booked!',
                                    data.message,
                                    'success'
                                );
                                $('#scheduleModal').modal('hide');
                            }else if(data.status == 'error'){
                                Swal.fire(
                                    'Sorry!',
                                    data.message,
                                    'warning'
                                )
                            }else{
                                Swal.fire(
                                    'Oh no!',
                                    data.message,
                                    'error'
                                )
                            }

                        }else{
                            toastr["error"]("Network problem!");
                        }
                    });

            }
        })
    });

});
