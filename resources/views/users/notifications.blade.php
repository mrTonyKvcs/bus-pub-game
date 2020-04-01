@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h2>Ismerőseid</h2>
        </div>
        @forelse($friends as $friend)
        <div class="mb-3 col-md-12">
            <div class="card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        {{ $friend->name }}
                        <div class="active-icon active-icon--{{ $friend->isOnline() }} ml-3"></div>
                    </div>
                    <a href="{{ route('friendable.delete-friend', $friend->id) }}" class="btn btn-danger">
                        Törlés
                    </a>
                </div>
            </div>
        </div>
    @empty
            <p>-</p>
        @endforelse
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h2>Ismerősnek jelölt</h2>
        </div>
        @forelse($recipients as $recipient)
        <div class="mb-3 col-md-12">
            <div class="card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        {{ $recipient->sender->name }}
                    </div>
                    <div>
                        <a class="btn btn-success" href="{{ route('friendable.confirmation', $recipient->sender->id) }}">Visszaigazol</a>
                    <a href="{{ route('friendable.deny-friend-request', $recipient->sender->id) }}" class="btn btn-warning">Visszavonás </a>
                    </div>
                </div>
            </div>
        </div>
    @empty
            <p>-</p>
        @endforelse
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h2>Ismerősnek jelöltem!</h2>
        </div>
        @forelse($senders as $sender)
        <div class="mb-3 col-md-12">
            <div class="card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    {{ $sender->recipient->name }}

                </div>
            </div>
        </div>
        @empty
            <p>-</p>
        @endforelse
    </div>
</div>
@endsection
