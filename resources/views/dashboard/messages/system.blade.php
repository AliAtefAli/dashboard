@extends('dashboard.layouts.app')
@section('title', trans('dashboard.messages.show'))
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard/app-assets/css-rtl/pages/chat-application.css') }}">
    <style>
        .rebtn{background:url( {{ asset('assets/web/reload.gif') }} ) no-repeat center center !important;}
        /*.chat-application .chats .chat-left .chat-body { margin-right: 0; }*/
        /*.chat-application .chats .chat-left .chat-content {margin: 0 20px 0 0;}*/
        .chat-application .chats .chat-body .chat-content { max-width: 300px; max-height: 300px; }
        .chat-application .chats .chat-body .chat-content img { width: 100% }
        .content-right{position:relative}
        .seclection{z-index: 0; position: absolute; top: 0;right: 0;bottom: 0;margin: auto;left: 0;width: 150px;height: 50px;font-size: 18px;display: flex;flex-direction: column;align-items: center;color: #333;font-weight: 600;}
    </style>
    <link href="{{ asset('assets/web/styles/jquery.fancybox.min.css') }}" rel="stylesheet">
@stop
@livewireStyles
@section('content')
    <!--content wrapper -->
    @livewire('search-user', ['receiver_id' => $receiver_id])
    <div class="content-right">
        @if($conversation == 0 )
            <span class="seclection ">
                اختر محادثه
                <i class="ft-mail"></i>
            </span>
        @endif
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <section class="chat-app-window">
                    <div class="chats">
                        @foreach($messages as $message)
                            @if($message->user_id == 0)
                                <div class="chat chat-left">
                                    <div class="chat-avatar">
                                        <a class="avatar" data-toggle="tooltip" href="#" data-placement="right" title=""
                                           data-original-title="">
                                            <img alt="avatar" src="{{ asset('assets/web/images/mini-logo.png') }}"/>
                                        </a>
                                    </div>
                                    <div class="chat-body">
                                        <div class="chat-content">
                                            @if($message->type=='image')
                                                <a data-fancybox="gallery" href="{{asset('chatuploads/'.$message->content)}}">
                                                    <img style="width: 200px;height: 200px" src="{{asset('chatuploads/'.$message->content)}}" >
                                                </a>
                                            @else
                                                <p>
                                                    {{$message->content}}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="chat">
                                    <div class="chat-avatar">
                                        <a class="avatar" data-toggle="tooltip" href="#" data-placement="right" title=""
                                           data-original-title="">
                                            <img alt="avatar" src="{{ asset($avatar) }}"
                                            />
                                        </a>
                                    </div>
                                    <div class="chat-body">
                                        <div class="chat-content">
                                            @if($message->type=='image')
                                                <a data-fancybox="gallery" href="{{asset('chatuploads/'.$message->content)}}">
                                                    <img style="width: 200px;height: 200px" src="{{asset('chatuploads/'.$message->content)}}" >
                                                </a>
                                            @else
                                                <p>
                                                    {{$message->content}}
                                                </p>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach

                    </div>
                </section>

                <section class="chat-app-form @if($conversation == 0 ) hidden @endif ">
                    <form class="chat-app-input d-flex">
                        <fieldset class="form-group position-relative col-10 m-0 ">
                            <input id="messageInput" type="text" class="form-control" autofocus placeholder="{{ __('dashboard.messages.Write your message here') }}">
                            <label for="add-imgs-to-conv">
                                <div class="form-control-position control-position-right">
                                    <div id="image-preview">

                                    </div>
                                    <input type="file" name="image" id="add-imgs-to-conv" class="d-none btn-icon"  >
                                    <i class="ft-image"></i>
                                </div>
                            </label>
                        </fieldset>
                        <fieldset class="form-group position-relative has-icon-left col-2 m-0">
                            <a onclick="sendMessageBtn()" class="btn btn-info">
                                <i class="la la-paper-plane-o d-lg-none"></i>
                                <span class="d-none d-lg-block" >{{ __('dashboard.messages.send') }}</span>
                            </a>
                        </fieldset>
                    </form>
                </section>

            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        });
        <!-- Request Errors -->
    </script>
    @livewireScripts
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.1.1/socket.io.js"></script>
    <script>

        // Connect to socket
        var socket = io.connect('https://managementsystem.4hoste.com:4553'),
            client = 0,
            userId = 1,
            conversation = {{$conversation}},
            content = "",
            adminAvatar = "{{asset('/')}}assets/web/images/mini-logo.png",
            receiver_id = {{$receiver_id}},
            avatar = "{{ asset($avatar) }}";

        console.log(client, conversation, receiver_id);
        (function() {
            socket.emit('adduser', {'client':client,'conversation':conversation });
            // Retrieve Message
            socket.on('message', function(message) {
                // Tune
                $('<audio id="chatAudio"><source src="{{asset('assets/notify.mp3')}}" type="audio/mpeg"></audio>').appendTo('body');
                $("#chatAudio")[0].play();

                var messageCount = $('message-count[id="'+message.sender_id+'"]').html();
                console.log( messageCount) ;

                // Check Message type
                if(message.type == 'image') {
                    content =
                        '<a data-fancybox="gallery" href="{{asset('chatuploads/')}}'+ '/' + message.content + '">\n' +
                        '  <img src="{{asset('chatuploads/')}}'+'/'+message.content+'" width="100" alt="">\n' +
                        '</a>';
                } else {
                    content = '<p>'+ message.content +'</p>';
                }

                $('.chats').append('<div class="chat">\n' +
                    '                            <div class="chat-avatar">\n' +
                    '                                <a class="avatar" data-toggle="tooltip" href="#" data-placement="right" title=""\n' +
                    '                                   data-original-title="">\n' +
                    '                                    <img alt="avatar" src="'+ avatar +'"\n' +
                    '                                    />\n' +
                    '                                </a>\n' +
                    '                            </div>\n' +
                    '                            <div class="chat-body">\n' +
                    '                                <div class="chat-content">\n' + content +
                    '                                </div>\n' +
                    '                            </div>\n' +
                    '                        </div>');
                $(".image_div").remove();

                scrollToEnd();
            });

            socket.on('offline_message', function(message) {
                Livewire.emit('refreshSearch');
                console.log(message);
                var messageCount = parseInt( $('.message-count[id='+message.sender_id+']').html()) + 1;
                $('.message-count[id='+message.sender_id+']').removeClass('hidden');
                $('.message-count[id='+message.sender_id+']').html(messageCount);
                // console.log( messageCount) ;
                // Check Message type
                if(message.type == 'image') {

                } else {
                    // content = '<p>'+ message.content +'</p>';
                }

            });

            socket.on('disconnect', () => {
                console.log('disconnect');
            });
        })();

        function sendMessageBtn() {
            var image = '';
            var video = '';
            if (typeof $('#add-imgs-to-conv')[0] !== 'undefined'){
                image = $('#add-imgs-to-conv')[0].files[0];
            }
            if(image) {
                uploadImage(image);
            }
            var message = $('#messageInput').val();
            $('#messageInput').val('');//reset
            if($.trim(message) != ''){
                sendMessage(message,'text');
            }
            scrollToEnd();
        }

        // Send message
        function sendMessage(message,type){
            if(type == 'text'){
                // console.log('Before emit');
                socket.emit('sendmessage', {'sender_id':client, 'receiver_id':receiver_id, 'conversation_id':conversation, 'content':message, 'type':'text'});
                // console.log('After emit');
                // console.log('sender_id : ' + {{ auth()->id() }}, 'Client : ' + client, 'receiver : ' + receiver_id, 'conversation_id : ' + conversation, 'message : ' + message);
                $('.chats').append('<div class="chat chat-left">\n' +
                    '<div class="chat-avatar">\n' +
                    '                                        <a class="avatar" data-toggle="tooltip" href="#" data-placement="right" title=""\n' +
                    '                                           data-original-title="">\n' +
                    '                                            <img alt="avatar" src="'+ adminAvatar +'">' +
                    '                                        </a>\n' +
                    '                                    </div>'+
                    '                            <div class="chat-body">\n' +
                    '                                <div class="chat-content">\n'
                    +
                    '<p>' +message + '</p>'
                    +
                    '                                </div>\n' +
                    '                            </div>\n' +
                    '                        </div>');
                $(".image_div").remove();

            }else if(type == 'image'){
                socket.emit('sendmessage', {'sender_id':client, 'receiver_id':receiver_id, 'conversation_id':conversation, 'content':message, 'type':'image'});
            }

            scrollToEnd();
        }

        $(document).ready(function (e) {
            scrollToEnd();
            $("body").addClass('chat-application');

            $(document).keypress(function(e) {
                if(e.which == 13) {
                    e.preventDefault();
                    var image = '';
                    if (typeof $('#add-imgs-to-conv')[0] !== 'undefined'){
                        image = $('#add-imgs-to-conv')[0].files[0];
                    }

                    if(image){
                        uploadImage(image);
                    }

                    var message = $('#messageInput').val();
                    $('#messageInput').val('');//reset
                    if($.trim(message) != ''){
                        sendMessage(message,'text');
                    }
                }
            });
            scrollToEnd();
        })

        function uploadImage(image) {
            $('#messageInput').addClass("reload-btn");
            // $('#msg').attr("disabled",true);
            $('#add-imgs-to-conv').val('');//reset
            var formData = new FormData();
            formData.append('image',image);

            $.ajax({
                url:'<?=route("uploadFile");?>',
                type:"POST",
                data:formData,
                contentType: false,
                processData: false,
                cache: false,
                success: function(data){
                    // console.log(data);
                    if(data.value == '0'){
                        swal("Error!", "data.data.msg");
                        // alert(data.data.msg);
                    }else{
                        $('.chats').append('<div class="chat chat-left">\n' +
                            '                            <div class="chat-body">\n' +
                            '                                <div class="chat-content">\n' +
                            '<a data-fancybox="gallery" href="{{ asset('chatuploads/')}}'+ '/' + data.data.name + '">\n' +
                            '   <img style="width: 200px;height: 200px" src="{{asset('chatuploads/')}}'+'/'+data.data.name+'" width="100" alt="">\n' +
                            '</a>'
                            +
                            '                                </div>\n' +
                            '                            </div>\n' +
                            '                        </div>');
                        $(".image_div").remove();

                    }
                    $(".chat-application .chat-app-window").animate({scrollTop: $('.chat-application .chat-app-window').prop("scrollHeight")}, 500);
                    $('#messageInput').removeClass("reload-btn");
                    // $('#msg').attr("disabled",false);
                    $('#messageInput').attr('placeholder', "{{ trans('dashboard.messages.Write your message here') }}");

                    sendMessage(data.data.name,'image');
                    scrollToEnd();
                }
            })
            scrollToEnd();
        }

        function scrollToEnd(){
            var chatContent = $('.chat-application .chat-app-window');
            chatContent.scrollTop(chatContent.prop("scrollHeight"));
        }
        // Image Preview
        $('#add-imgs-to-conv').change(function (event) {
            var messageImg = $('#image-preview');
            messageImg.html('' +
                '<div class="image_div">' +
                '<img style="width: 35px; height: 35px;margin-left: 65px;position: absolute;right: -50px;top: 0;" src="' + URL.createObjectURL(event.target.files[0]) + '">' +
                '</div>' +
                '');
            messageImg.appendTo('#image-preview');

        });

        // Load single conversation
        $(".user-section").click(function() {
            // $(this).addClass('hidden');
            $('.chats').addClass("reload-btn");
            $('.chats').empty();
            userId = $(this).data('user-id');
            console.log('data-user-id : ' + $(this).data('user-id'));
            console.log('userId: ' + userId);
            $.ajax({
                url:'{{ route('dashboard.message.system') }}/' + userId,
                type:"GET",
                data: {user_id: userId},
                contentType: false,
                processData: false,
                cache: false,
                success: function(response) {
                    conversation = response.data['conversation'];
                    receiver_id = response.data['receiver_id'];
                    socket.emit('adduser', {'client':client,'conversation':conversation });
                    avatar = "{{asset('/')}}/" + response.data['avatar'];

                    Livewire.emit('changeReceiver', receiver_id);

                    $(".seclection").addClass('hidden');
                    $(".chat-app-form").removeClass('hidden');
                    $('.chats').removeClass("reload-btn");
                    // console.log(response);
                    let messages = response.data['messages'];
                    // console.log(avatar);
                    messages.forEach(message => {
                        let msg = message['content'];
                        if (message['type'] == 'image') {
                            msg = `
                            <a data-fancybox="gallery" href="{{asset('chatuploads/')}}/`+ message['content'] +`">
                                <img style="width: 200px;height: 200px" src="{{asset('chatuploads/')}}/`+ message['content'] +`" >
                            </a>`
                        } else {
                            msg = `
                            <p>
                                  `+ message['content'] +`
                            </p>`;
                        }
                        if (message['user_id'] == '0'){
                            // console.log(message);
                            $(".chats").append(`
                            <div class="chat chat-left">
                                    <div class="chat-avatar">
                                        <a class="avatar" data-toggle="tooltip" href="#" data-placement="right" title=""
                                           data-original-title="">
                                            <img alt="avatar" src="{{ asset('assets/web/images/mini-logo.png') }}"
                                            />
                                        </a>
                                    </div>
                                    <div class="chat-body">
                                        <div class="chat-content">

                                        `+ msg +`


                                        </div>
                                    </div>
                                </div>
                                `);
                        } else {
                            // console.log(message);
                            $(".chats").append(`
                            <div class="chat">
                                    <div class="chat-avatar">
                                        <a class="avatar" data-toggle="tooltip" href="#" data-placement="right" title=""
                                           data-original-title="">
                                            <img alt="avatar" src="`+ avatar +`"
                                            />
                                        </a>
                                    </div>
                                    <div class="chat-body">
                                        <div class="chat-content">
                                        `+ msg +`

                                        </div>
                                    </div>
                                </div>
                                `);

                        }
                        // console.log(message['user_id']);
                        // console.log(response.data['avatar']);
                    });
                    scrollToEnd();
                }
            })
        });
    </script>

    <script src="{{ asset('assets/web/scripts/jquery.fancybox.min.js') }}"></script>
@endsection
