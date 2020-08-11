$(function() {
    var socketServer = "https://socket.yourconference.live:443";
    let socket = io(socketServer);
    socket.on('serverStatus', function(data) {
        //console.log(data);
    });



    $('.support-chat').on('click', function () {

        socket.emit('support-chat-request', {'id': user_id, 'name': user_name});

        socket.on('contacting-support', function() {
            $.get( "/tiadaannualconference/user/SupportChat/getAllChats/"+user_id, function(chats) {

                chats = JSON.parse(chats);

                $('.support-chat-list').html('');

                $.each( chats, function( number, chat ) {

                    if (chat.message_from == 'admin')
                    {
                        $('.support-chat-list').append('' +
                            '<li class="support-chat-item admin clearfix">\n' +
                            '  '+chat.message+' <span class="support-chat-name">Admin</span>\n' +
                            '</li>');
                    }else{
                        $('.support-chat-list').append('' +
                            '<li class="support-chat-item left clearfix">\n' +
                            '  <span class="support-chat-name">'+chat.attendee_name+'</span> '+chat.message+'\n' +
                            '</li>');
                    }
                });

                openForm();
            });
        });

        socket.on('support-chat-busy', function() {
            Swal.fire({
                icon: 'warning',
                title: 'Sorry!',
                text: 'All support chat rooms are busy at the moment, please try again shortly!'
            });
        });
    });

    socket.on('newSupportText', function(data) {
        if (data.message_from == 'admin')
        {

        }else{
            $('.support-chat-list').append('' +
                '<li class="support-chat-item left clearfix">\n' +
                '  <span class="support-chat-name">'+data.attendee_name+'</span> '+data.message+'\n' +
                '</li>');
        }
    });

    $('#close-support-request').on('click', function () {
        socket.emit('close-support-request');
        closeForm();
    });

    $('#send-support-message-btn').on('click', function () {
        var message = $('.support-chat-message').val();

        if (message == ''){
            return;
        }

        $.post("/tiadaannualconference/user/SupportChat/sendMessage",
            {
                'message': message,
                'attendee_id': user_id,
                'message_from': user_id
            },
            function(data, status){
                if(status == 'success')
                {
                    var dataFromDb = JSON.parse(data);

                    $('.support-chat-message').val('');

                    socket.emit('newSupportText',
                        {
                            'message': dataFromDb.message,
                            'attendee_id': dataFromDb.attendee_id,
                            'attendee_name': user_name,
                            'message_from': dataFromDb.message_from,
                            "datetime":dataFromDb.datetime
                        });

                }else{
                    toastr["error"]("Network problem!");
                }
            });
    });



});

function openForm() {

    document.getElementById("supportChat").style.display = "block";
}

function closeForm() {
    document.getElementById("supportChat").style.display = "none";
}
