$(function() {

    var socketServer = "https://socket.yourconference.live:443";
    let socket = io(socketServer);
    socket.on('serverStatus', function(data) {
        //console.log(data);
    });

    $.get( "/tiadaannualconference/sponsor-admin/UserDetails/getAllUsers", function(allUsers) {
        var users = JSON.parse(allUsers);

        $.each( users, function( number, user ) {

            var OTO_CHAT_ROOM = 'TIADA_'+company_name+sponsor_id+'_'+user.cust_id+'_Oto_Chat';
            socket.emit('joinSponsorOtoChat', {"room":OTO_CHAT_ROOM, "name":user_name, "userId":user_id, "userType":user_type});

            var fullname = user.first_name+' '+user.last_name;
            if (fullname == ' ')
            {
                var fullname = 'Name Unavailable';
            }

            var nameAcronym = fullname.match(/\b(\w)/g).join('');
            var color = md5(nameAcronym+user.cust_id).slice(0, 6);

            var userAvatarSrc = (user.profile != '' && user.profile != null)?'/tiadaannualconference/uploads/customer_profile/'+user.profile:'https://placehold.it/50/'+color+'/fff&amp;text='+nameAcronym;
            var userAvatarAlt = 'https://placehold.it/50/'+color+'/fff&amp;text='+nameAcronym;

            $('.attendees-chat-list').append(
                '<li class="attendees-chat-list-item list-group-item" userName="'+fullname+'" userId="'+user.cust_id+'" status="offline" new-text="0">\n' +
                '<img src="'+userAvatarSrc+'" alt="User Avatar" onerror=this.src="'+userAvatarAlt+'" class="img-circle"> \n' +
                '<span class="oto-chat-user-list-name" style="font-weight: bold;"> '+fullname+' <span class="badge new-text" style="background-color: #ff0a0a; display: none;">new</span> </span> \n' +
                '<i class="active-icon fa fa-circle" style="color: #454543;" aria-hidden="true" userId="'+user.cust_id+'"></i> \n' +
                '<h5 class="attendee-profile-btn pull-right" userId="'+user.cust_id+'" onclick="userProfileModal('+user.cust_id+')">\n' +
                '   <span class="label label-info">\n' +
                '      <i class="fa fa-user" aria-hidden="true"></i>\n' +
                '   </span>\n' +
                '</h5>' +
                '</li>\n'
            );
        });

        $('.attendees-chat-list-item').on("click", function () {

            $(this).children('.oto-chat-user-list-name').children('.new-text').hide();
            $(this).attr('new-text', '0');

            $(".attendees-chat-list>li.selected").removeClass("selected");
            $(this).addClass('selected');

            var fullname = $(this).attr('userName');
            var userId = $(this).attr('userId');
            var nameAcronym = fullname.match(/\b(\w)/g).join('');
            var color = md5(nameAcronym+userId).slice(0, 6);
            var activeStatus = $(this).attr('status');
            var statusColour = (activeStatus == 'active')?'#26ff49':(activeStatus == 'inactive')?'#ff9a41':'#454543';

            var userAvatar = $(this).children('img').attr('src');
            var userAvatarAlt = 'https://placehold.it/50/'+color+'/fff&amp;text='+nameAcronym;

            $('.send-oto-chat-btn').attr('send-to', userId);
            $('.one-to-one-chat-heading > .attendee-profile-btn').attr('userId', userId);

            $('.selected-user-name-area').html(
                '<img src="'+userAvatar+'" alt="User Avatar" onerror=this.src="'+userAvatarAlt+'" class="img-circle"> '+
                fullname +
                ' <i class="active-icon fa fa-circle" style="color: '+statusColour+';" aria-hidden="true" userId="'+userId+'"></i>'
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
                                    '     <img src="'+userAvatar+'" alt="User Avatar" onerror=this.src="'+userAvatarAlt+'" class="img-circle">\n' +
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
                            "datetime":dataFromDb.datetime,
                            "profile":''
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

                var userAvatarSrc = (data.profile != '' && data.profile != null)?'/tiadaannualconference/uploads/customer_profile/'+data.profile:'https://placehold.it/50/'+color+'/fff&amp;text='+nameAcronym;
                var userAvatarAlt = 'https://placehold.it/50/'+color+'/fff&amp;text='+nameAcronym;

                $('.oto-messages').append(
                    '<li class="grp-chat left clearfix">\n' +
                    '   <span class="chat-img pull-left">\n' +
                    '     <img src="'+userAvatarSrc+'" alt="User Avatar" onerror=this.src="'+userAvatarAlt+'" class="img-circle" />\n' +
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
        }else{
            $('.attendees-chat-list > li[userid="'+data.user_id+'"] > .oto-chat-user-list-name > .new-text').show();
            $('.attendees-chat-list > li[userid="'+data.user_id+'"]').attr('new-text', '1');

            $(".attendees-chat-list li").sort(dec_sort).appendTo('.attendees-chat-list');
            function asc_sort(a, b){
                return ($(b).attr('new-text')) < ($(a).attr('new-text')) ? 1 : -1;
            }
            function dec_sort(a, b){
                return ($(b).attr('new-text')) > ($(a).attr('new-text')) ? 1 : -1;
            }
        }
    });

    socket.on('otoTyping', function(data) {
        var selectedUser = $('.selected-user-name-area').attr('userId');
        if (selectedUser == data.from)
        {
            $('.oto-typing').html(data.someone+' is typing...');
            setTimeout(
                function() {
                    $('.oto-typing').html('');
                }, 1000);
        }
    });

    socket.on('userActiveChange', function(data) {
        if (data.status == true)
        {
            var color = '#26ff49';
            var status = 'active';
        }else{
            var color = '#ffc500';
            var status = 'inactive';
        }

        $('.active-icon[userId="'+data.userId+'"]').css('color', color);
        $('.attendees-chat-list-item[userId="'+data.userId+'"]').attr('status', status);
    });

    $(".oto-attendee-search").keyup(function () {
        var filter = $(this).val();
        $(".attendees-chat-list li").each(function () {
            if ($(this).text().search(new RegExp(filter, "i")) < 0) {
                $(this).hide();
            } else {
                $(this).show()
            }
        });
    });

    setInterval(function() {
        socket.emit('getActiveUserList');
    }, 60 * 1000); // 60 * 1000 milsec
    socket.emit('getActiveUserList');
    socket.on('activeUserList', function(data) {
        $.each(data, function( socketId, userId ) {
            $('.active-icon[userId="'+userId+'"]').css('color', '#26ff49');
            $('.attendees-chat-list-item[userId="'+userId+'"]').attr('status', 'active');
        });
        $(".attendees-chat-list li").sort(asc_sort).appendTo('.attendees-chat-list');
        function asc_sort(a, b){
            return ($(b).attr('status')) < ($(a).attr('status')) ? 1 : -1;
        }
        function dec_sort(a, b){
            return ($(b).attr('status')) > ($(a).attr('status')) ? 1 : -1;
        }
    });

    $(".attendee-profile-btn").on( "click", function() {
        var userId = $(this).attr('userId');
        userProfileModal(userId);
    });
});
