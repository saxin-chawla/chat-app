<main class="msger-chat">
    @foreach($messages as $message)
    @if($message->sendersId != auth()->user()->id)
    <div class="msg left-msg">
        @if($user->image != '')
            @php
                $name = asset('storage/' . $user->image);
            @endphp
        @else
            @php
                $name = "https://image.flaticon.com/icons/svg/145/145867.svg";
            @endphp
        @endif
        <div class="msg-img" style="background-image: url('{{ $name }}')"></div>
        <div class="msg-bubble">
            <div class="msg-info">
                <div class="msg-info-name">{{ $user->name }}</div>
                <div class="msg-info-time">{{ $message->created_at }}</div>
            </div>

            <div class="msg-text">
                {{ $message->messages }}
            </div>
        </div>
    </div>
    @else
    <div class="msg right-msg">
        @if($user->image != '')
            @php
                $name = asset('storage/' . auth()->user()->image);
            @endphp
        @else
            @php
                $name = "https://image.flaticon.com/icons/svg/145/145867.svg";
            @endphp
        @endif
        <div class="msg-img" style="background-image: url('{{ $name }}')"></div>


        <div class="msg-bubble">
            <div class="msg-info">
                <div class="msg-info-name">{{ auth()->user()->name }}</div>
                <div class="msg-info-time">{{ $message->created_at }}</div>
            </div>

            <div class="msg-text">
                {{ $message->messages }}
            </div>
        </div>
    </div>
    @endif
    @endforeach
</main>