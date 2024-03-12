<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>chat</title>
</head>

<body>
    <h3>chat</h3>
    @foreach ($messages as $item)
        <div style="margin-bottom: 2rem">
            <span>{{ $item->user->name }}</span> : <span>{{ $item->message }}</span>
        </div>
    @endforeach

    <form action="{{ route('chat.create') }}" method="post">
        @csrf
        <input type="hidden" value="1" name="user_id">
        <textarea name="message" rows="10"></textarea>
        <button>send!</button>
    </form>

    <script src="https://js.pusher.com/8.0.1/pusher.min.js"></script>
    <script>
        if (Notification.permission !== "granted") {
            Notification.requestPermission()
        }
        var pusher = new Pusher("1e604af4996618b8b02b", {
            cluster: "eu",
        });
        var channel = pusher.subscribe("chat_channel");
        channel.bind("App\\Events\\ChatEvent", (data) => {
            new Notification(data.message)
        });
    </script>
</body>

</html>
