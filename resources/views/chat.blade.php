<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

</head>

<body class="antialiased">
    <section class="msger">
        <header class="msger-header">
            <div class="msger-header-title">
                <i class="fas fa-comment-alt"></i> SimpleChat
            </div>
            <div class="msger-header-options">
                <span><i class="fas fa-cog"></i></span>
            </div>
            <a href="{{ route('index') }}" class="friends btn"><button class="friends btn">Friends</button></a>
        </header>


        <div id="content-body">
            @include('chat_list',['messages' => $messages])
        </div>

        <form class="msger-inputarea">
            <input type="text" class="msger-input" id="msg" placeholder="Enter your message..." autocomplete="FALSE">
            <button type="submit" id="send" class="msger-send-btn" data-sid="{{ auth()->user()->id }}" data-rid="{{ $user->id }}" onclick="sendMessage($(this))">Send</button>
        </form>
    </section>


    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>

    <script>
        // function fetchMessages() {
        //     // let sendersId
        //     let button = $('#send');
        //     let sendersId = button.data('sid');
        //     let receiversId = button.data('rid');
        //     const addToCartUrl = "{{ route('fetchMessage', ['sid' => ':sid', 'rid' => ':rid']) }}";
        //     const formattedUrl = addToCartUrl.replace(':sid', sendersId).replace(':rid', receiversId);
        //     $.get(formattedUrl, function(h) {

        //             $('#content-body').html(h);
                    
        //         }, 'html')
        //         .fail(err => {
        //             console.table(err)
        //             console.log(err.responseText)
        //         })
        //         .always(() => {
        //             console.log('refreshed')
        //         });

        // }
        let lastCheckedTimestamp = 0;
        
        function fetchMessages() {
  let button = $('#send');
  let sendersId = button.data('sid');
  let receiversId = button.data('rid');
  const checkUrl = "{{ route('checkNewMessages', ['sid' => ':sid', 'rid' => ':rid']) }}";
  const formattedUrl = checkUrl.replace(':sid', sendersId).replace(':rid', receiversId);

  $.ajax({
    url: formattedUrl,
    method: 'GET',
    data: { lastCheckedTimestamp: lastCheckedTimestamp },
    success: function(data) {
      if (data.hasNewMessages) {
        // Call the fetchMessages function only if there are new messages
        fetchAndUpdateMessages();
        console.log('fetching');
      }
    }
  });
}

function fetchAndUpdateMessages() {
  let button = $('#send');
  let sendersId = button.data('sid');
  let receiversId = button.data('rid');
  const fetchUrl = "{{ route('fetchMessage', ['sid' => ':sid', 'rid' => ':rid']) }}";
  const formattedUrl = fetchUrl.replace(':sid', sendersId).replace(':rid', receiversId);

  $.ajax({
    url: formattedUrl,
    method: 'GET',
    success: function(data) {
      $('#content-body').html(data);
    }
  });

  lastCheckedTimestamp = Math.floor(Date.now() / 1000);

}
// fetchMessages();
// Call fetchMessages to start polling for new messages
setInterval(fetchMessages, 3000); // Poll every 3 seconds (adjust the interval as needed)


        function sendMessage(button) {
            let sendersId = button.data('sid');
            let receiversId = button.data('rid');
            let message = $('#msg').val();
            console.log(message);
            const addToCartUrl = "{{ route('store', ['sid' => ':sid', 'rid' => ':rid' , 'message' => ':msg']) }}";
            const formattedUrl = addToCartUrl.replace(':sid', sendersId).replace(':rid', receiversId).replace(':msg', message);
            $.get(formattedUrl, function(res) {
                    if (res.status) {
                        fetchMessages();
                    }
                }, 'json')
                .fail(err => {
                    console.table(err)
                    console.log(err.responseText)
                })
                .always(() => {
                    console.log('refreshed')
                });
        }
        // setInterval(fetchMessages, 1000);
    </script>
</body>

</html>