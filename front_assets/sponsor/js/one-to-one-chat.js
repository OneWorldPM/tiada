$(function() {

    var socketServer = "https://socket.yourconference.live:443";
    let socket = io(socketServer);
    socket.on('serverStatus', function(data) {
        //console.log(data);
    });

    $.get( "/tiadaannualconference/sponsor-admin/UserDetails/getAllUsers", function(allUsers) {
        var users = JSON.parse(allUsers);
        console.log(users);

        $.each( users, function( number, user ) {

            var OTO_CHAT_ROOM = 'TIADA_'+company_name+sponsor_id+'_'+user.cust_id+'_Oto_Chat';
            socket.emit('joinSponsorOtoChat', {"room":OTO_CHAT_ROOM, "name":user_name, "userId":user_id});

            var fullname = user.first_name+' '+user.last_name;
            if(fullname == ' ')
            {
                fullname = 'No Name';
            }
            var nameAcronym = fullname.match(/\b(\w)/g).join('');
            var color = md5(nameAcronym+user.cust_id).slice(0, 6);

            $('.attendees-chat-list').append(
                '<li class="attendees-chat-list-item list-group-item" userName="'+fullname+'" userId="'+user.cust_id+'">\n' +
                '<img src="https://placehold.it/50/'+color+'/fff&amp;text='+nameAcronym+'" alt="User Avatar" class="img-circle"> \n' +
                '<span class="oto-chat-user-list-name" style="font-weight: bold;"> '+user.first_name+' '+user.last_name+' </span> \n' +
                '<i class="fa fa-circle" style="color: #ff9a41;" aria-hidden="true"></i> \n' +
                '</li>\n'
            );
        });

        $('.attendees-chat-list-item').on("click", function () {

            $(".attendees-chat-list>li.selected").removeClass("selected");
            $(this).addClass('selected');

            var fullname = $(this).attr('userName');
            var userId = $(this).attr('userId');
            var nameAcronym = fullname.match(/\b(\w)/g).join('');
            var color = md5(nameAcronym+userId).slice(0, 6);

            $('.send-oto-chat-btn').attr('send-to', userId);

            $('.selected-user-name-area').html(
                '<img src="https://placehold.it/50/'+color+'/fff&amp;text='+nameAcronym+'" alt="User Avatar" class="img-circle"> '+
                fullname +
                ' <i class="fa fa-circle" style="color: #ff9a41;" aria-hidden="true"></i>'
            );

            var OTO_CHAT_ROOM = 'TIADA_'+company_name+sponsor_id+'_'+userId+'_Oto_Chat';

            $('.selected-user-name-area').attr('userId', userId);
            $('.selected-user-name-area').attr('room', OTO_CHAT_ROOM);

            $('.oto-messages').html('');

            $.post("/tiadaannualconference/sponsor-admin/OtoChat/getChatsUserToSponsor/"+userId,
                {
                    'sponsor_id': sponsor_id
                },
                function(data, status){
                    if(status == 'success')
                    {
                        var dataFromDb = JSON.parse(data);

                        $.each( dataFromDb, function( number, text ) {
                            if (text.from_id == 'sponsor')
                            {
                                $('.oto-messages').append(
                                    '<li class="grp-chat right clearfix">\n' +
                                    '   <span class="chat-img pull-right">\n' +
                                    '     <img src="'+base_url+'uploads/sponsors/'+sponsor_logo+'" alt="Sponsor Logo" class="img-circle" />\n' +
                                    '   </span>\n' +
                                    '   <div class="chat-body clearfix">\n' +
                                    '     <div class="header">\n' +
                                    '       <small class=" text-muted"><span class="glyphicon glyphicon-time"></span>'+text.datetime+'</small>\n' +
                                    '       <strong class="pull-right primary-font">'+company_name_orig+'</strong>\n' +
                                    '     </div>\n' +
                                    '     <p class="pull-right">\n' +
                                    '      '+text.text+' \n' +
                                    '     </p>\n' +
                                    '   </div>\n' +
                                    '</li>'
                                );
                                $('.oto-chat-body').scrollTop($('.oto-chat-body')[0].scrollHeight);
                            }else{
                                var nameAcronym = text.from_name.match(/\b(\w)/g).join('');
                                var color = md5(nameAcronym+text.from_id).slice(0, 6);

                                $('.oto-messages').append(
                                    '<li class="grp-chat left clearfix">\n' +
                                    '   <span class="chat-img pull-left">\n' +
                                    '     <img src="https://placehold.it/50/'+color+'/fff&text='+nameAcronym+'" alt="User Avatar" class="img-circle" />\n' +
                                    '   </span>\n' +
                                    '   <div class="chat-body clearfix">\n' +
                                    '      <div class="header">\n' +
                                    '         <strong class="primary-font">'+text.from_name+'</strong> <small class="pull-right text-muted">\n' +
                                    '         <span class="glyphicon glyphicon-time"></span>'+text.datetime+'</small>\n' +
                                    '      </div>\n' +
                                    '      <p>\n' +
                                    '       '+text.text+' \n' +
                                    '      </p>\n' +
                                    '    </div>\n' +
                                    '</li>'
                                );
                                $('.oto-chat-body').scrollTop($('.oto-chat-body')[0].scrollHeight);
                            }
                        });

                    }else{
                        toastr["error"]("Network problem!");
                    }
                });
        });

        $(".attendees-chat-list li:first-child").click();
    });


    $('#one-to-one-ChatText').keypress(function(e){
        if(e.which == 13){//Enter key pressed
            $('.send-oto-chat-btn').click();//Trigger search button click event
        }else{
            var room = $('.selected-user-name-area').attr('room')
            var selectedUser = $('.selected-user-name-area').attr('userId');
            socket.emit('otoTyping', {"room":room, "someone":user_name, "typingTo":selectedUser});
        }
    });

    $(".send-oto-chat-btn").on( "click", function() {
        var text = $('#one-to-one-ChatText').val();
        var chat_to = $('.send-oto-chat-btn').attr('send-to');

        if (text == '')
            return;

        $.post("/tiadaannualconference/sponsor-admin/OtoChat/newText",
            {
                'chat_text': text,
                'sponsor_id': sponsor_id,
                'chat_to': chat_to
            },
            function(data, status){
                if(status == 'success')
                {
                    var dataFromDb = JSON.parse(data);

                    $('#one-to-one-ChatText').val('');

                    var OTO_CHAT_ROOM = 'TIADA_'+company_name+sponsor_id+'_'+chat_to+'_Oto_Chat';

                    socket.emit('newSponsorOtoText',
                        {
                            "room":OTO_CHAT_ROOM,
                            "name":user_name,
                            "from_id": "sponsor",
                            "userType":user_type,
                            "chat_text":text,
                            "user_id":chat_to,
                            "datetime":dataFromDb.datetime
                        });

                }else{
                    toastr["error"]("Network problem!");
                }
            });
    });

    socket.on('newSponsorOtoText', function(data) {
        var selectedUser = $('.selected-user-name-area').attr('userId');

        if (selectedUser == data.user_id)
        {
            if (data.from_id == 'sponsor')
            {
                $('.oto-messages').append(
                    '<li class="grp-chat right clearfix">\n' +
                    '   <span class="chat-img pull-right">\n' +
                    '     <img src="'+base_url+'uploads/sponsors/'+sponsor_logo+'" alt="Sponsor Logo" class="img-circle" />\n' +
                    '   </span>\n' +
                    '   <div class="chat-body clearfix">\n' +
                    '     <div class="header">\n' +
                    '       <small class=" text-muted"><span class="glyphicon glyphicon-time"></span>'+data.datetime+'</small>\n' +
                    '       <strong class="pull-right primary-font">'+data.name+'</strong>\n' +
                    '     </div>\n' +
                    '     <p class="pull-right">\n' +
                    '      '+data.chat_text+' \n' +
                    '     </p>\n' +
                    '   </div>\n' +
                    '</li>'
                );
                $('.oto-chat-body').scrollTop($('.oto-chat-body')[0].scrollHeight);
            }else{
                var nameAcronym = data.name.match(/\b(\w)/g).join('');
                var color = md5(nameAcronym+data.from_id).slice(0, 6);

                $('.oto-messages').append(
                    '<li class="grp-chat left clearfix">\n' +
                    '   <span class="chat-img pull-left">\n' +
                    '     <img src="https://placehold.it/50/'+color+'/fff&text='+nameAcronym+'" alt="User Avatar" class="img-circle" />\n' +
                    '   </span>\n' +
                    '   <div class="chat-body clearfix">\n' +
                    '      <div class="header">\n' +
                    '         <strong class="primary-font">'+data.name+'</strong> <small class="pull-right text-muted">\n' +
                    '         <span class="glyphicon glyphicon-time"></span>'+data.datetime+'</small>\n' +
                    '      </div>\n' +
                    '      <p>\n' +
                    '       '+data.chat_text+' \n' +
                    '      </p>\n' +
                    '    </div>\n' +
                    '</li>'
                );
                $('.oto-chat-body').scrollTop($('.oto-chat-body')[0].scrollHeight);
            }
        }
    });

    socket.on('otoTyping', function(data) {
        var selectedUser = $('.selected-user-name-area').attr('userId');
        console.log(data);
        console.log(selectedUser);
        if (selectedUser == data.from)
        {
            $('.oto-typing').html(data.someone+' is typing...');
            setTimeout(
                function() {
                    $('.oto-typing').html('');
                }, 1000);
        }
    });
});
