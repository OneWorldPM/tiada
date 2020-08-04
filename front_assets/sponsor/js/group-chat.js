$(function() {

    $.get( "/tiadaannualconference/sponsor-admin/GroupChat/getAllChats/"+sponsor_id, function(chatJson) {
        var chats = JSON.parse(chatJson);

        if (chats == 0)
            $('.group-chat').append('<p>No messages!</p>');

        $.each( chats, function( number, chat ) {
            if (chat.chat_from == 'sponsor')
            {
                $('.group-chat').append(
                    '<li class="grp-chat right clearfix">\n' +
                    '   <span class="chat-img pull-right">\n' +
                    '     <img src="'+base_url+'uploads/sponsors/'+sponsor_logo+'" alt="Sponsor Logo" class="img-circle" />\n' +
                    '   </span>\n' +
                    '   <div class="chat-body clearfix">\n' +
                    '     <div class="header">\n' +
                    '       <small class=" text-muted"><span class="glyphicon glyphicon-time"></span>'+chat.datetime+'</small>\n' +
                    '       <strong class="pull-right primary-font">'+company_name_orig+'</strong>\n' +
                    '     </div>\n' +
                    '     <p>\n' +
                    '      '+chat.chat_text+'\n' +
                    '     </p>\n' +
                    '   </div>\n' +
                    '</li>'
                );
            }else{
                var nameAcronym = chat.from_name.match(/\b(\w)/g).join('');
                var color = md5(nameAcronym+chat.from).slice(0, 6);

                $('.group-chat').append(
                    '<li class="grp-chat left clearfix">\n' +
                    '   <span class="chat-img pull-left">\n' +
                    '     <img src="https://placehold.it/50/'+color+'/fff&text='+nameAcronym+'" alt="User Avatar" class="img-circle" />\n' +
                    '   </span>\n' +
                    '   <div class="chat-body clearfix">\n' +
                    '      <div class="header">\n' +
                    '         <strong class="primary-font">'+chat.from_name+'</strong> <small class="pull-right text-muted">\n' +
                    '         <span class="glyphicon glyphicon-time"></span>'+chat.datetime+'</small>\n' +
                    '      </div>\n' +
                    '      <p>\n' +
                    '       '+chat.chat_text+'\n' +
                    '      </p>\n' +
                    '    </div>\n' +
                    '</li>'
                );
            }
        });

        $('#grp-chat-body').scrollTop($('#grp-chat-body')[0].scrollHeight);
    });


    $('#groupChatText').keypress(function(e){
        if(e.which == 13){//Enter key pressed
            $('.send-grp-chat-btn').click();//Trigger search button click event
        }
    });
    $(".send-grp-chat-btn").on( "click", function() {
        var text = $('#groupChatText').val();

        if (text == '')
            return;

        $.post("/tiadaannualconference/sponsor-admin/GroupChat/newText",
            {
                'chat_text': text,
                'sponsor_id': sponsor_id
            },
            function(data, status){
                if(status == 'success')
                {
                    $('#groupChatText').val('');
                    toastr["success"]("sent")

                }else{
                    toastr["error"]("Problem")
                }
            });
    });

    $(".clear-group-chat-btn").on( "click", function() {

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, clear chat!'
        }).then((result) => {
            if (result.value) {

                $.post("/tiadaannualconference/sponsor-admin/GroupChat/clearChat",
                    {

                    },
                    function(data, status){
                        if(status == 'success')
                        {
                            Swal.fire(
                                'Cleared!',
                                'Group chat has been cleared.',
                                'success'
                            )

                        }else{
                            toastr["error"]("Problem clearing chat!")
                        }
                    });
            }
        })
    });

    $(".save-group-chat-btn").on( "click", function() {
        toastr["warning"]("Under development!")
    });

});
