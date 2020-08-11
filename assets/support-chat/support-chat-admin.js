var socketServer = "https://socket.yourconference.live:443";
let socket = io(socketServer);
socket.on('serverStatus', function(data) {
    //console.log(data);
});

socket.on('new-support-chat-request', function(data) {
    $('.support-chat-boxes').prepend('' +
        '<div class="chat-popup" id="chat_box_'+data.attendee.id+'">\n' +
        '        <form action="#" class="form-container">\n' +
        '            <h3>Support Chat</h3>\n' +
        '\n' +
        '            <label for="msg"><b class="person-name">'+data.attendee.name+'</b></label>\n' +
        '            <div class="support-chat-body">\n' +
        '                <ul class="support-chat-list support-chat-list_'+data.attendee.id+'">\n' +
        '\n' +
        '                </ul>\n' +
        '            </div>\n' +
        '\n' +
        '            <input type="text" class="form-control support-chat-message_'+data.attendee.id+'" placeholder="Enter your message here...">\n' +
        '            <button attendee_id="'+data.attendee.id+'" attendee_name="'+data.attendee.name+'" type="button" class="btn chat_send_btn">Send</button>\n' +
        '            <button attendee_id="'+data.attendee.id+'" attendee_name="'+data.attendee.name+'" socket="'+data.socket+'" type="button" class="btn cancel chat_close_btn" >Close</button>\n' +
        '        </form>\n' +
        '    </div>');

    $.get( "/tiadaannualconference/user/SupportChat/getAllChats/"+data.attendee.id, function(chats) {

        chats = JSON.parse(chats);

        $('.support-chat-list_'+data.attendee.id).html('');

        $.each( chats, function( number, chat ) {

            if (chat.message_from == 'admin')
            {
                $('.support-chat-list_'+data.attendee.id).append('' +
                    '<li class="support-chat-item admin clearfix">\n' +
                    '  '+chat.message+' <span class="support-chat-name">Admin</span>\n' +
                    '</li>');
            }else{
                $('.support-chat-list_'+data.attendee.id).append('' +
                    '<li class="support-chat-item left clearfix">\n' +
                    '  <span class="support-chat-name">'+chat.attendee_name+'</span> '+chat.message+'\n' +
                    '</li>');
            }
        });

        $('.support-chat-body').scrollTop($('.support-chat-body')[0].scrollHeight);

        $('#chat_box_'+data.attendee.id).css('display', 'inline-block');
    });
});

socket.on('newSupportText', function(data) {
    if (data.message_from == 'admin')
    {
        $('.support-chat-list_'+data.attendee_id).append('' +
            '<li class="support-chat-item admin clearfix">\n' +
            '  '+data.message+' <span class="support-chat-name">Admin</span>\n' +
            '</li>');
    }else{
        $('.support-chat-list_'+data.attendee_id).append('' +
            '<li class="support-chat-item left clearfix">\n' +
            '  <span class="support-chat-name">'+data.attendee_name+'</span> '+data.message+'\n' +
            '</li>');
    }
    $('.support-chat-body').scrollTop($('.support-chat-body')[0].scrollHeight);
});

socket.on('support-chat-closed', function(attendee) {
    $('#chat_box_'+attendee).css('display', 'none');
});

$('body').on('click', 'button.chat_close_btn', function () {
    var attendee_id = $(this).attr('attendee_id');
    var socketId = $(this).attr('socket');

    socket.emit('admin-closed-support-chat', {'attendee_id': attendee_id, 'socket':socketId});
});

$('body').on('click', 'button.chat_send_btn', function () {
    var attendee_id = $(this).attr('attendee_id');
    var attendee_name = $(this).attr('attendee_name');

    var message = $('.support-chat-message_'+attendee_id).val();

    if (message == ''){
        return;
    }

    $.post("/tiadaannualconference/user/SupportChat/sendMessage",
        {
            'message': message,
            'attendee_id': attendee_id,
            'message_from': 'admin'
        },
        function(data, status){
            if(status == 'success')
            {
                var dataFromDb = JSON.parse(data);

                $('.support-chat-message_'+attendee_id).val('');

                socket.emit('newSupportText',
                    {
                        'message': dataFromDb.message,
                        'attendee_id': dataFromDb.attendee_id,
                        'attendee_name': attendee_name,
                        'message_from': dataFromDb.message_from,
                        "datetime":dataFromDb.datetime
                    });

            }else{
                toastr["error"]("Network problem!");
            }
        });
});
