@extends('layout.app')

@section('content')
    <div class="row">

        <!-- MAIN FEED -->
        <div class="col-md-8">

            <!-- Create Post -->
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <form method="post" action="{{ route('posts.create') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <textarea name="content" class="form-control" rows="3" placeholder="What's on your mind?" required></textarea>
                        </div>

                        <div class="mb-3">

                            <label class="form-label fw-semibold">Upload Image or Video (optional)</label>
                            <input type="file" name="image_url" class="form-control" accept="image/*">
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fa fa-paper-plane me-1"></i> Post
                        </button>
                    </form>
                </div>
            </div>

            <h4 class="mb-3">Posts</h4>

            <!-- Post Card -->
            @foreach ($posts as $post)
                <div class="card mb-3 shadow-sm">
                    <div class="card-body">

                        <!-- Post Header -->
                        <div class="d-flex justify-content-between mb-2">
                            <div>
                                <h6 class="mb-0 fw-semibold">
                                    <a href="/profile/{{ $post->user->id }}"
                                        class="text-decoration-none text-dark">{{ $post->user->name }}</a>
                                </h6>
                                <small class="text-muted">{{ $post->created_at->diffForHumans() }}</small>
                            </div>


                            @if (Auth::user()->id == $post->user->id)
                                <div class="dropdown">

                                    <button class="btn btn-sm btn-light" data-bs-toggle="dropdown">
                                        <i class="fa fa-ellipsis"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="/post/edit/{{ $post->id }}">Edit</a></li>
                                        <li><a class="dropdown-item text-danger" href="/post/delete/{{ $post->id }}"
                                                onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
                                        </li>
                                    </ul>
                                </div>
                            @endif
                            @if (Auth::user()->id != $post->user->id)
                                <button class="btn btn-sm btn-primary d-flex align-items-center gap-1 addFriendBtn" data-user-id="{{$post->user->id}}">
                                    <i class="fa fa-user-plus" ></i> Add Friend
                                </button>
                            @endif

                        </div>

                        <!-- Post Image (optional) -->
                        @if($post->image_url)
                        <div class="mb-3">
                            <img src="{{ asset('storage/' . $post->image_url) }}" class="img-fluid rounded">
                        </div>
                        @endif
                        <!-- Post Content -->
                        <p>
                            {{ $post->content }}
                        </p>



                        <!-- Post Actions -->
                        <div class="d-flex gap-2">
                            <button class="btn btn-sm btn-secondary like_btn" data-post-id={{ $post->id }}>
                                <i class="fa fa-heart"></i> <span class="likes-count">{{ $post->likes()->count() }}</span>

                            </button>

                        </div>

                    </div>
                </div>

            @endforeach

            <!-- Pagination -->
            <div class="d-flex justify-content-center">
                <ul class="pagination">
                    <li class="page-item disabled"><a class="page-link">Previous</a></li>
                    <li class="page-item active"><a class="page-link">1</a></li>
                    <li class="page-item"><a class="page-link">2</a></li>
                    <li class="page-item"><a class="page-link">Next</a></li>
                </ul>
            </div>

        </div>

        <!-- SIDEBAR -->
        <div class="col-md-4">

            <!-- Suggested Friends -->
            <div class="card shadow-sm mb-4">
                <div class="card-header text-white" style="background-color: var(--primary-color);">
                    <h6 class="mb-0">
                        <i class="fa fa-user-friends me-1"></i> Suggested Friends
                    </h6>
                </div>

                <div class="card-body">

                    <!-- Friend Item -->
                    <div class="d-flex align-items-center mb-3">
                        <img src="https://via.placeholder.com/45" class="rounded-circle me-3" alt="">
                        <div class="flex-grow-1">
                            <div class="fw-semibold">Sarah Ali</div>
                            <small class="text-muted">3 mutual friends</small>
                        </div>
                        <button class="btn btn-sm btn-primary">
                            Add
                        </button>
                    </div>




                </div>
            </div>

            <!-- Info Card -->
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <p class="fw-semibold mb-1">Welcome to Connectly</p>
                    <small class="text-muted">
                        Connect, share, and grow your network.
                    </small>
                </div>
            </div>

        </div>

    </div>
@endsection

@section('scripts')
    <script>
        document.querySelectorAll(".like_btn").forEach((btn) => {
            btn.addEventListener('click', (e) => {
                const button = e.currentTarget;
                const post_id = button.dataset.postId;
                fetch('{{ route('like') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            post_id: post_id
                        })
                    })
                    .then(response => response.json())
                    .then(function(data) {
                        const countSpan = button.querySelector('.likes-count');
                        if (countSpan) {
                            countSpan.innerText = data.likes_count;
                        }
                        if (data.liked) {
                            button.classList.remove('btn-secondary');

                            button.classList.add('btn-primary');
                        } else {
                            button.classList.remove('btn-primary');

                            button.classList.add('btn-secondary');
                        }


                    });
            });

        });


    </script>
@endsection
