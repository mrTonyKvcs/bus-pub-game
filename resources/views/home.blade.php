@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @foreach($users as $user)
            @if (Auth::id() != $user->id)
                <div class="mb-3 col-md-8">
                    <div class="card">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div class="d-flex">
                                <h4 class="mb-0">{{ $user->email }}</h4>
                                <div class="active-icon active-icon--{{ $user->isOnline() }}"></div>
                            </div>
                            <div class="d-flex">
                                @if(!Auth::user()->isFriendWith($user))
                                    <a href="{{ route('friendable.add-friend', $user->id) }}" class="action-button">
                                        +
                                    </a>

                                @else
                                    <a href="{{ route('friendable.delete-friend', $user->id) }}" class="action-button">
                                        delete friend
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</div>
@endsection
