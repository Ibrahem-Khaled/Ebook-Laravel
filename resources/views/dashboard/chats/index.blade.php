<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>المحادثة {{ $user->name }}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            padding: 5%;
            background-color: #F5F5F5;
        }

        .container {
            padding: 0;
            background-color: #FFF;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.19), 0 6px 6px rgba(0, 0, 0, 0.23);
            height: 700px;
        }

        .menu {
            float: left;
            height: 700px;
            width: 70px;
            background: linear-gradient(#4768b5, #35488e);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.19);
        }

        .menu .items {
            list-style: none;
            margin: auto;
            padding: 0;
        }

        .menu .items .item {
            height: 70px;
            border-bottom: 1px solid #6780cc;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #9fb5ef;
            font-size: 17pt;
        }

        .menu .items .item-active {
            background-color: #5172c3;
            color: #FFF;
        }

        .menu .items .item:hover {
            cursor: pointer;
            background-color: #4f6ebd;
            color: #cfe5ff;
        }

        .discussions {
            width: 35%;
            height: 700px;
            box-shadow: 0px 8px 10px rgba(0, 0, 0, 0.20);
            overflow: hidden;
            background-color: #87a3ec;
            display: inline-block;
        }

        .discussions .discussion {
            width: 100%;
            height: 90px;
            background-color: #FAFAFA;
            border-bottom: solid 1px #E0E0E0;
            display: flex;
            align-items: center;
            cursor: pointer;
        }
        .discussions .message-active {
            width: 98.5%;
            height: 90px;
            background-color: #FFF;
            border-bottom: solid 1px #E0E0E0;
        }

        .discussions .discussion .photo {
            margin-left: 20px;
            display: block;
            width: 45px;
            height: 45px;
            background: #E6E7ED;
            border-radius: 50px;
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
        }

        .online {
            position: relative;
            top: 30px;
            left: 35px;
            width: 13px;
            height: 13px;
            background-color: #8BC34A;
            border-radius: 13px;
            border: 3px solid #FAFAFA;
        }

        .desc-contact {
            height: 43px;
            width: 50%;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .discussions .discussion .name {
            margin: 0 0 0 20px;
            font-family: 'Montserrat', sans-serif;
            font-size: 11pt;
            color: #515151;
        }

        .discussions .discussion .message {
            margin: 6px 0 0 20px;
            font-family: 'Montserrat', sans-serif;
            font-size: 9pt;
            color: #515151;
        }

        .timer {
            margin-left: 15%;
            font-family: 'Open Sans', sans-serif;
            font-size: 11px;
            padding: 3px 8px;
            color: #BBB;
            background-color: #FFF;
            border: 1px solid #E5E5E5;
            border-radius: 15px;
        }

        .chat {
            width: calc(65% - 85px);
        }

        .header-chat {
            background-color: #FFF;
            height: 90px;
            box-shadow: 0px 3px 2px rgba(0, 0, 0, 0.100);
            display: flex;
            align-items: center;
        }

        .chat .header-chat .icon {
            margin-left: 30px;
            color: #515151;
            font-size: 14pt;
        }

        .chat .header-chat .name {
            margin: 0 0 0 20px;
            text-transform: uppercase;
            font-family: 'Montserrat', sans-serif;
            font-size: 13pt;
            color: #515151;
        }

        .chat .header-chat .right {
            position: absolute;
            right: 40px;
        }

        .chat .messages-chat {
            padding: 25px 35px;
        }

        .chat .messages-chat .message {
            display: flex;
            align-items: center;
            margin-bottom: 8px;
        }

        .chat .messages-chat .message .photo {
            display: block;
            width: 45px;
            height: 45px;
            background: #E6E7ED;
            border-radius: 50px;
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
        }

        .chat .messages-chat .text {
            margin: 0 35px;
            background-color: #f6f6f6;
            padding: 15px;
            border-radius: 12px;
        }

        .text-only {
            margin-left: 45px;
        }

        .time {
            font-size: 10px;
            color: lightgrey;
            margin-bottom: 10px;
            margin-left: 85px;
        }

        .response-time {
            float: right;
            margin-right: 40px !important;
        }

        .response {
            float: right;
            margin-right: 0px !important;
            margin-left: auto;
        }

        .response .text {
            background-color: #e3effd !important;
        }

        .footer-chat {
            width: calc(65% - 66px);
            height: 80px;
            display: flex;
            align-items: center;
            position: absolute;
            bottom: 0;
            background-color: transparent;
            border-top: 2px solid #EEE;

        }

        .chat .footer-chat .icon {
            margin-left: 30px;
            color: #C0C0C0;
            font-size: 14pt;
        }

        .chat .footer-chat .send {
            color: #fff;
            background-color: #4f6ebd;
            position: absolute;
            right: 50px;
            padding: 12px 12px 12px 12px;
            border-radius: 50px;
            font-size: 14pt;
        }

        .chat .footer-chat .name {
            margin: 0 0 0 20px;
            text-transform: uppercase;
            font-family: 'Montserrat', sans-serif;
            font-size: 13pt;
            color: #515151;
        }

        .chat .footer-chat .right {
            position: absolute;
            right: 40px;
        }

        .write-message {
            border: none !important;
            width: 60%;
            height: 50px;
            margin-left: 20px;
            padding: 10px;
        }

        .footer-chat *::-webkit-input-placeholder {
            color: #C0C0C0;
            font-size: 13pt;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <section class="discussions">
                @foreach ($users as $item)
                    <a href="{{ route('chats.index', $item->id) }}"
                        class="discussion  {{ $item->id == $user->id ? 'message-active' : '' }}">
                        <div class="photo"
                            style="background-image: url(https://cdn-icons-png.flaticon.com/128/4140/4140037.png);">
                            <div class="online"></div>
                        </div>
                        <div class="desc-contact">
                            <p class="name">{{ $item->name }}</p>
                        </div>
                        <div class="timer">{{ $item?->created_at?->diffForHumans() }}</div>
                    </a>
                @endforeach
            </section>
            <section class="chat">
                <div class="header-chat">
                    <i class="icon fa fa-user-o" aria-hidden="true"></i>
                    <p class="name">{{ $user->name }}</p>
                    <i class="icon clickable fa fa-ellipsis-h right" aria-hidden="true"></i>
                </div>
                <div class="messages-chat">
                    @foreach ($chats as $chat)
                        <div class="message {{ $chat->user_id == Auth::id() ? 'response' : '' }}">
                            <div class="photo"
                                style="background-image: url(https://cdn-icons-png.flaticon.com/128/4140/4140037.png);">
                                <div class="online"></div>
                            </div>
                            <p class="text">{{ $chat->message }}</p>
                        </div>
                        <p class="time">{{ $chat->created_at->format('H:i') }}</p>
                    @endforeach
                </div>
                <div class="footer-chat">
                    <form action="{{ route('chats.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="receiver_id" value="{{ $user->id }}">
                        <i class="icon fa fa-smile-o clickable" style="font-size:25pt;" aria-hidden="true"></i>
                        <input type="text" name="message" class="write-message" placeholder="اكتب رسالتك هنا..."
                            required>
                        <button type="submit" class="icon send fa fa-paper-plane-o clickable"></button>
                    </form>
                </div>
            </section>
        </div>
    </div>
</body>

</html>
