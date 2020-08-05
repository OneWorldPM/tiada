$(function() {

    var socketServer = "https://socket.yourconference.live:443";
    let socket = io(socketServer);
    socket.on('serverStatus', function(data) {
        //console.log(data);
    });

    var OTO_CHAT_ROOM = 'TIADA_'+company_name+sponsor_id+'_'+user_id+'_Oto_Chat';

    socket.emit('joinSponsorOtoChat', {"room":OTO_CHAT_ROOM, "name":user_name, "userId":user_id});

    socket.on('sponsorOtoNewJoin', function(data) {
        console.log(data);
    });


    $.post("/tiadaannualconference/sponsor-admin/OtoChat/getChatsUserToSponsor/"+user_id,
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
                        $('.chat').append(
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
                        $('#chat-body').scrollTop($('#chat-body')[0].scrollHeight);
                    }else{
                        var nameAcronym = text.from_name.match(/\b(\w)/g).join('');
                        var color = md5(nameAcronym+text.from_id).slice(0, 6);

                        $('.chat').append(
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
                        $('#chat-body').scrollTop($('#chat-body')[0].scrollHeight);
                    }
                });

            }else{
                toastr["error"]("Network problem!");
            }
        });


    $('#one-to-one-ChatText').keypress(function(e){
        if(e.which == 13){//Enter key pressed
            $('.send-oto-chat-btn').click();//Trigger search button click event
        }else{
            //socket.emit('isTyping', {"room":GROUP_CHAT_ROOM, "someone":user_name});
        }
    });

    $(".send-oto-chat-btn").on( "click", function() {
        var text = $('#one-to-one-ChatText').val();
        var chat_to = 'sponsor';

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

                    socket.emit('newSponsorOtoText',
                        {
                            "room":OTO_CHAT_ROOM,
                            "name":user_name,
                            "from_id": user_id,
                            "userType":user_type,
                            "chat_text":text,
                            "user_id":user_id,
                            "datetime":dataFromDb.datetime
                        });

                }else{
                    toastr["error"]("Network problem!");
                }
            });
    });

    socket.on('newSponsorOtoText', function(data) {
        if (data.from_id == 'sponsor')
        {
            $('.chat').append(
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
            $('#chat-body').scrollTop($('#chat-body')[0].scrollHeight);
        }else{
            var nameAcronym = data.name.match(/\b(\w)/g).join('');
            var color = md5(nameAcronym+data.from_id).slice(0, 6);

            $('.chat').append(
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
            $('#chat-body').scrollTop($('#chat-body')[0].scrollHeight);
        }
    });

    socket.on('otoTyping', function(data) {
        $('.oto-typing').html(data.someone+' is typing...');
        setTimeout(
            function() {
                $('.oto-typing').html('');
            }, 1000);
    });
});
