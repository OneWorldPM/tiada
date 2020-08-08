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

    socket.on('signaling_message', function(data) {
        displaySignalMessage("Signal received: " + data.type);

        $.post("sponsor-admin/VideoChatApi/sponsorVideoEngageStatus",
            {
                roomId: SIGNAL_ROOM,
                sponsorId: sponsor_id
            },
            function(data, status){
                if(status == 'success' && data == 'false')
                {
                    //Setup the RTC Peer Connection object
                    if (!rtcPeerConn)
                        startSignaling();
                }else{
                    //alert('Sponsor is already on a call!');
                }
            });

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

    function startSignaling() {

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'An attendee is calling!',
            text: "Accept the call?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Accept',
            cancelButtonText: 'Reject',
            reverseButtons: true,
            allowOutsideClick: false
        }).then((result) => {
            if (result.value) {

                $.post("sponsor-admin/VideoChatApi/sponsorVideoEngageStatus",
                    {
                        roomId: SIGNAL_ROOM,
                        sponsorId: sponsor_id
                    },
                    function(data, status){
                        if(status == 'success' && data == 'false')
                        {
                            //Send a first signaling message to anyone listening
                            //This normally would be on a button click
                            socket.emit('signal',{"type":"user_here", "message":"Are you ready for a call?", "room":SIGNAL_ROOM});
                            displaySignalMessage("starting signaling...");
                            $('#videoCallModal').modal({
                                backdrop: 'static',
                                keyboard: false
                            });
                            $('#videoCallModal').modal('show');

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

                            // once remote stream arrives, show it in the remote video element
                            rtcPeerConn.ontrack = function (evt) {
                                displaySignalMessage("going to add their stream...");
                                theirVideoArea.srcObject = evt.streams[0];

                                $.post("sponsor-admin/VideoChatApi/engageSponsor",
                                    {
                                        roomId: SIGNAL_ROOM,
                                        sponsorId: sponsor_id
                                    });
                            };

                            rtcPeerConn.oniceconnectionstatechange = function() {
                                if(rtcPeerConn.iceConnectionState == 'disconnected') {
                                    //Releasing previous connections on reload!
                                    $.post("sponsor-admin/VideoChatApi/releaseSponsor",
                                        {
                                            roomId: SIGNAL_ROOM,
                                            sponsorId: sponsor_id
                                        });

                                    $('#videoCallModal').modal('hide');
                                    Swal.fire(
                                        'Attendee left the video chat!',
                                        'if this was a connection problem, please try again!',
                                        'warning'
                                    ).then(function () {
                                        location.reload();
                                    });

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

                            // get a local stream, show it in our video tag and add it to be sent
                            navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia;
                            navigator.getUserMedia({
                                'audio': true,
                                'video': true
                            }, function (stream) {
                                displaySignalMessage("going to display my stream...");
                                myVideoArea.srcObject = stream;
                                rtcPeerConn.addStream(stream);
                            }, logError);
                        }else{
                            Swal.fire({
                                icon: 'warning',
                                title: 'Call is already accepted on a different browser or computer!',
                                text: 'please try again after a while',
                                footer: '<span>Or schedule a meeting with attendee now! </span>'
                            });
                        }
                    });

            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Rejected',
                    "You have rejected attendee's call",
                    'error'
                ).then(function () {
                    //add reject action
                });
                return false;
            }
        })

    }

    $(".video-call-hangup").on( "click", function() {
        $('#videoCallModal').modal('hide');
    });

    $('#videoCallModal').on('hidden.bs.modal', function () {
        $.post("sponsor-admin/VideoChatApi/releaseSponsor",
            {
                roomId: SIGNAL_ROOM,
                sponsorId: sponsor_id
            },
            function(data, status){
                if(status == 'success')
                {
                    location.reload();
                }
            });
        socket.emit('leave', {"chat_room": ROOM, "signal_room": SIGNAL_ROOM});
    });

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

    $(".edit-about-btn").on( "click", function() {

        var about = $('.sponsor-about').val();
        $.post("sponsor-admin/profile/updateAbout",
            {
                about: about
            },
            function(data, status){
                if(status == 'success')
                {
                    toastr["success"]("About updated!")

                }else{
                    toastr["error"]("Problem updating about!")
                }
            });
    });

    $(".save-website").on( "click", function() {

        var website = $('#website').val();
        $.post("sponsor-admin/profile/updateWebsite",
            {
                website: website
            },
            function(data, status){
                if(status == 'success')
                {
                    toastr["success"]("Website updated!")

                }else{
                    toastr["error"]("Problem updating website!")
                }
            });
    });

    $(".save-twitter").on( "click", function() {

        var twitter = $('#twitterHandle').val();
        $.post("sponsor-admin/profile/updateTwitter",
            {
                twitter: twitter
            },
            function(data, status){
                if(status == 'success')
                {
                    toastr["success"]("Twitter handle updated!")

                }else{
                    toastr["error"]("Problem updating twitter handle!")
                }
            });
    });

    $(".save-facebook").on( "click", function() {

        var facebook = $('#facebookHandle').val();
        $.post("sponsor-admin/profile/updateFacebook",
            {
                facebook: facebook
            },
            function(data, status){
                if(status == 'success')
                {
                    toastr["success"]("Facebook handle updated!")

                }else{
                    toastr["error"]("Problem updating facebook handle!")
                }
            });
    });

    $(".save-linkedin").on( "click", function() {

        var linkedin = $('#linkedinHandle').val();
        $.post("sponsor-admin/profile/updateLinkedin",
            {
                linkedin: linkedin
            },
            function(data, status){
                if(status == 'success')
                {
                    toastr["success"]("LinkedIn handle updated!")

                }else{
                    toastr["error"]("Problem updating LinkedIn handle!")
                }
            });
    });

    $(".video-call-btn").on( "click", function() {
        $('#videoCallModal').modal('show');
        connection.open('attendee-to-sponsor', function() {
            showRoomURL(connection.sessionid);
        });
        toastr["warning"]("Problem connecting to sponsor!")
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



    $(".name-edit-btn").on( "click", function() {

        if ($(this).attr('saving') == 'true')
        {
            var name = $('.company-name').text();

            $.post("sponsor-admin/profile/updateName",
                {
                    name: name
                },
                function(data, status){
                    if(status == 'success')
                    {
                        $(".name-edit-btn").attr("saving", "false");

                        $(".company-name").removeClass("company-name-editable");
                        $(".company-name").attr('contentEditable', false);

                        $(".name-edit-btn").addClass("small-edit-btn");
                        $(".name-edit-btn").removeClass("name-save-btn");
                        $(".name-edit-btn").removeClass("small-save-btn");

                        $(".name-edit-btn").html('<i class="fa fa-pencil-square-o" aria-hidden="true"></i> edit name');
                        $(".name-edit-cancel-btn").remove();

                        toastr["success"]("Name updated!")

                    }else{
                        toastr["error"]("Problem updating the name!")
                    }
                });
        }else{
            $(".company-name").addClass("company-name-editable");
            $(".company-name").attr('contentEditable', true);

            $(".name-edit-btn").addClass("name-save-btn");
            $(".name-edit-btn").addClass("small-save-btn");
            $(".name-edit-btn").attr("saving", "true");


            $(".name-edit-btn").html('<i class="fa fa-floppy-o" aria-hidden="true"></i> save');
            $( ".name-edit-btn" ).after( '' +
                '<span class="name-edit-cancel-btn small-cancel-btn badge badge-primary">' +
                '<i class="fa fa-times" aria-hidden="true"></i> cancel' +
                '</span>' );

            $(".name-edit-btn").removeClass("small-edit-btn");

            $(".name-edit-cancel-btn").on( "click", function() {
                $(".name-edit-btn").attr("saving", "false");

                $(".company-name").removeClass("company-name-editable");
                $(".company-name").attr('contentEditable', false);

                $(".name-edit-btn").addClass("small-edit-btn");
                $(".name-edit-btn").removeClass("name-save-btn");
                $(".name-edit-btn").removeClass("small-save-btn");

                $(".name-edit-btn").html('<i class="fa fa-pencil-square-o" aria-hidden="true"></i> edit name');
                $(".name-edit-cancel-btn").remove();
            });
        }

    });

    $(".logo-upload-btn").on( "click", function() {
        $('#logoupload').trigger('click');
    });

    $("#logoupload").change(function (){
        var file_data = $("#logoupload").prop("files")[0];
        var form_data = new FormData();
        form_data.append("logo", file_data);

        $.ajax({
            url: "/tiadaannualconference/sponsor-admin/profile/updateLogo/"+user_id,
            dataType: 'text',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function(logo){
                var version = Math.floor(Math.random() * 10000) + 1;
                $('.sponsor-main-logo').attr('src', '/tiadaannualconference/uploads/sponsors/'+logo+'?v='+version);
                toastr["success"]("Logo updated!")
            },
            error: function(){
                toastr["error"]("Unable to update the logo!")
            }
        });
    });

    $(".cover-upload-btn").on( "click", function() {
        $('#coverupload').trigger('click');
    });

    $("#coverupload").change(function (){
        var file_data = $("#coverupload").prop("files")[0];
        var form_data = new FormData();
        form_data.append("cover", file_data);

        $.ajax({
            url: "/tiadaannualconference/sponsor-admin/profile/updateCover/"+user_id,
            dataType: 'text',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function(cover){
                var version = Math.floor(Math.random() * 10000) + 1;
                $('#sponsorCover').css('background-image', '');
                $('#sponsorCover').css('background-image', 'url(/tiadaannualconference/uploads/sponsors/'+cover+'?v='+version+')');
                toastr["success"]("Cover updated!")
            },
            error: function(){
                toastr["error"]("Unable to update the cover!")
            }
        });
    });

    $('input[name="availability-selector"]').daterangepicker({
        minDate: new Date(),
        timePicker: true,
        timePicker24Hour: true,
        startDate: moment().startOf('hour'),
        endDate: moment().startOf('hour').add(32, 'hour'),
        applyButtonClasses: "btn-info",
        locale: {
            format: 'DD/MM hh:mm A'
        }
    }, function(start, end, label) {
        if($('.selected-agent').val() == 0){
            alert('Contact support to add more people!');
            return false;
        }

        var sponsorId = user_id;
        var contactPerson = $('.selected-agent').val();
        var availableFrom = start.format('YYYY-MM-DD HH:mm');
        var availableTo = end.format('YYYY-MM-DD HH:mm');

        var availableFromD = new Date(Date.parse(availableFrom));
        var availableToD = new Date(Date.parse(availableTo));
        var difference = Math.abs(availableToD-availableFromD);
        var minMeetingDuration = 30;

        if (difference/60000 < minMeetingDuration)
        {
            console.log(availableToD);
            console.log(availableFromD);
            console.log(difference);
            console.log(difference/60000);
            toastr["warning"]('Availability duration must be at least '+minMeetingDuration+' minutes!');
            return;
        }

        $.post("/tiadaannualconference/sponsor-admin/Schedules/addAvailability",
            {
                'sponsor_id' : sponsorId,
                'contact_person' : contactPerson,
                'available_from' : availableFrom,
                'available_to' : availableTo
            },
            function(data, status){
                if(status == 'success')
                {
                    var response = JSON.parse(data);

                    if (response.status == 'failed')
                    {
                        toastr["error"](response.message);
                    }else if(response.status == 'error'){
                        toastr["warning"](response.message);
                    }else{
                        fillCurrentAvailabilityList(response.data);
                        toastr["success"](response.message);
                    }

                }else{
                    toastr["error"]("Problem adding availability!");
                }
            });
    });

    $('.agent-list-item').on('click', function () {
        var selectedAgent = $('.selected-agent').val($(this).attr('person'));

        if($(this).attr('person') == 0){
            toastr["error"]("Just "+company_name+" is available for now. Contact support to add more people!");
            return false;
        }
        var selectedAgent = $(this).attr('person');
        var selectedAgentName = $(this).children('a').text();
        $('.current-person-name').html(selectedAgentName);

        $.post("/tiadaannualconference/sponsor-admin/Schedules/getCurrentAvailabilityList",
            {
                'sponsor_id' : user_id,
                'contact_person' : selectedAgent
            },
            function(data, status){
                if(status == 'success')
                {
                    if (data != 'false'){
                        fillCurrentAvailabilityList(JSON.parse(data));
                    }

                    $('#availability-body').collapse('show');
                    var y = $(window).scrollTop();  //current y position on the page
                    $(window).scrollTop(y+200);

                }else{
                    toastr["error"]("Network problem!");
                    return;
                }
            });

    });

    function fillCurrentAvailabilityList(json) {
        $('.current-availability-list').html('');

        $.each( json, function( number, details ) {
            $('.current-availability-list').append('' +
                '<li class="current-availability-list-item list-group-item">' +
                '<h4>' +
                '<i class="fa fa-clock-o" aria-hidden="true" style="color: #1fbd1f;"></i> ' +
                '<span style="color: #2e7fff;">'+details.available_from+'</span> TO <span style="color: #5656ff;">'+details.available_to+'</span>' +
                '</h4>' +
                '</li>');
        });
    }

});
