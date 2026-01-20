@extends('layout.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow-sm">

                <div class="card-body p-0">

                    @forelse($notifications as $notification )


                    <!-- Notification (Unread) -->
                    <div class="d-flex justify-content-between align-items-start p-3 border-bottom bg-light">
                        <div>
                            <small class="text-muted">
                                {{$notification->message}}
                            </small>
                            <div class="text-muted small mt-1">
                                {{$notification->timestamp}}
                            </div>
                        </div>
@if(
    $notification->type === 'addFriend' &&
    auth()->user()->checkFriendStatus(
        $notification->sender_id,
        $notification->receiver_id
    ) === 'pending'
)
    <form action="{{ route('addFriend') }}" method="POST">
        @csrf
        <input type="hidden" name="notification_id" value="{{ $notification->id }}">

        <button class="btn btn-sm btn-success" type="submit" name="status" value="accept">
            Accept
        </button>

        <button class="btn btn-sm btn-danger" type="submit" name="status" value="reject">
            Reject
        </button>
    </form>
@endif



                    </div>


                    @empty
                    <div class="p-4 text-center text-muted">
                        No notifications found.
                    </div>

                    @endforelse




                </div>
            </div>

        </div>
    </div>
</div>
@endsection
