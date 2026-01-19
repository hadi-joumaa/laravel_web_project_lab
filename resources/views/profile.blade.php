@extends('layout.app')

@section('title', $user->name . ' - Profile')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h1 class="card-title">{{ $user->name }}</h1>
                    <p class="text-muted">Member since {{ $user->created_at->format('F Y') }}</p>

                    <hr>

                    <div class="row mt-4 text-center">
                        <div class="col-md-4">
                            <div class="p-3 bg-light rounded">
                                <h5>Posts</h5>
                                <h2>{{$user->posts->count()}}</h2>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-3 bg-light rounded">
                                <h5>Likes Given</h5>
                                <h2>{{$user->likes($user->id)}}</h2>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-3 bg-light rounded">
                                <h5>friends</h5>
                                <h2>0</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
