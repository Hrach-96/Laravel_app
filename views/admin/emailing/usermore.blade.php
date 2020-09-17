@foreach($users as $user)
    <div class="col-md-12 jbpgs-post-start-col">
        <div class="emailing_div p-3 bg-white" style="box-shadow: 0 0 10px rgba(0, 0, 0, 0.2)">
            <div class="mr-2">
                @if(is_null($user->avatar))
                    <img src="{{ asset("images/avatar/default.jpg") }}" class="emailing-col-img" alt="">
                @else
                    <img src="{{ asset("images/avatar/$user->avatar") }}" class="emailing-col-img" alt="">
                @endif
            </div>
            <div>
                <h5>{{ $user->first_name }} {{ $user->last_name }}</h5>
            </div>
        </div>
    </div>
@endforeach