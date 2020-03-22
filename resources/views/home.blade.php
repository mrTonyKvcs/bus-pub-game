@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @foreach($users as $user)
            @if (Auth::id() != $user->id)
                <div class="mb-3 col-md-8">
                    <div class="card">
                        <div class="card-body">
                            {{ $user->email }}
                        </div>
                    </div>
                </div>
                @endif
        @endforeach
    </div>
</div>
@endsection
