</div>
<!-- END: WRAPPER -->
<!-- GO TOP BUTTON -->
<a class="gototop gototop-button" href="#"><i class="fa fa-chevron-up"></i></a>

<!-- Theme Base, Components and Settings -->
<script src="<?= base_url() ?>front_assets/js/theme-functions.js"></script>

<!-- Custom js file -->
<script src="<?= base_url() ?>front_assets/js/custom.js"></script>
<script src="<?= base_url() ?>assets/alertify/alertify.min.js" type="text/javascript"></script>


<script src="https://meet.yourconference.live/socket.io/socket.io.js"></script>
<script>

    var user_name = "<?= $this->session->userdata('fullname') ?>";
    var user_id = <?= $this->session->userdata("cid") ?>;

    function fillUnreadMessages() {
        $('.unread-msg-count').html('0');
        $('.unread-msgs-list').html('');
        $.get("<?= base_url() ?>user/UnreadMessages/getUnreadMessages", function (messages) {
            messages = JSON.parse(messages);
            var count = Object.keys(messages).length;
            if (count > 0){
                $('.badge-notify').css('background', '#f11');
            }else{
                $('.badge-notify').css('background', '#727272');
            }
            $('.unread-msg-count').html(count);

            $.each(messages, function( number, message ) {
                $('.unread-msgs-list').append('' +
                    '<a target="_blank" class="dropdown-item waves-effect waves-light" href="<?= base_url() ?>sponsor/view/'+message.sponsor_id+'"><strong>Message from '+message.company_name+'</strong></a>' +
                    '<a href="<?= base_url() ?>sponsor/view/'+message.sponsor_id+'" target="_blank">'+message.text+'</a>');


            });
        });
    }


    $(function () {
        fillUnreadMessages();

        var socketServer = "https://socket.yourconference.live:443";
        let socket = io(socketServer);

        socket.on('unreadMessage', function() {
            fillUnreadMessages();
        });

        // If theres no activity for 30 seconds set inactive
        var activityTimeout = setTimeout(inActive, 30 * 1000);
        function resetActive(){
            socket.emit('userActiveChange', {"name":user_name, "userId":user_id, "status":true});
            clearTimeout(activityTimeout);
            activityTimeout = setTimeout(inActive, 30 * 1000);
        }
        // No activity let everyone know
        function inActive(){
            socket.emit('userActiveChange', {"name":user_name, "userId":user_id, "status":false});
        }
        // Check for mousemove, could add other events here such as checking for key presses ect.
        $(document).bind('mousemove', function(){resetActive()});
    });
</script>


</body>
</html>
