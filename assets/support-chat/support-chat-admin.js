var socketServer = "https://socket.yourconference.live:443";
let socket = io(socketServer);
socket.on('serverStatus', function(data) {
    //console.log(data);
});

socket.on('new-support-chat-request', function(attendee) {
    $('.support-chat-boxes').prepend('' +
        '<div class="chat-popup" id="chat_box_'+attendee.id+'">\n' +
        '        <form action="#" class="form-container">\n' +
        '            <h3>Support Chat</h3>\n' +
        '\n' +
        '            <label for="msg"><b class="person-name">'+attendee.name+'</b></label>\n' +
        '            <div class="support-chat-body">\n' +
        '                <ul class="support-chat-list support-chat-list_'+attendee.id+'">\n' +
        '\n' +
        '                </ul>\n' +
        '            </div>\n' +
        '\n' +
        '            <input type="text" class="form-control support-chat-message" placeholder="Enter your message here...">\n' +
        '            <button type="submit" class="btn">Send</button>\n' +
        '            <button type="button" class="btn cancel" >Close</button>\n' +
        '        </form>\n' +
        '    </div>');

    $.get( "/tiadaannualconference/user/SupportChat/getAllChats/"+attendee.id, function(chats) {

        chats = JSON.parse(chats);

        $('.support-chat-list_'+attendee.id).html('');

        $.each( chats, function( number, chat ) {

            if (chat.message_from == 'admin')
            {
                $('.support-chat-list_'+attendee.id).append('' +
                    '<li class="support-chat-item admin clearfix">\n' +
                    '  '+chat.message+' <span class="support-chat-name">Admin</span>\n' +
                    '</li>');
            }else{
                $('.support-chat-list_'+attendee.id).append('' +
                    '<li class="support-chat-item left clearfix">\n' +
                    '  <span class="support-chat-name">'+chat.attendee_name+'</span> '+chat.message+'\n' +
                    '</li>');
            }
        });

        $('#chat_box_'+attendee.id).css('display', 'inline-block');
    });
});

socket.on('newSupportText', function() {

});

socket.on('support-chat-closed', function(attendee) {
    console.log(attendee);
    closeForm();
});

function openForm() {
    document.getElementById("myForm").style.display = "inline-block";
    document.getElementById("myForm2").style.display = "inline-block";
}

function closeForm() {
    document.getElementById("myForm").style.display = "none";
}
