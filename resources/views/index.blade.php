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

                        </div>

                        <!-- Post Image (optional) -->
                        <div class="mb-3">
                            <img src="{{ asset('storage/' . $post->image_url) }}" class="img-fluid rounded"
                                alt="Post Image">
                        </div>
                        <!-- Post Content -->
                        <p>
                            {{ $post->content }}
                        </p>



                        <!-- Post Actions -->
                        <div class="d-flex gap-2">
                            <button class="btn btn-sm btn-secondary like_btn" data-post-id={{ $post->id }}>
                                <i class="fa fa-heart"></i> <span class="likes-count">{{ $post->likes()->count() }}</span>

                            </button>
                            <button class="btn btn-sm btn-primary view-comments-btn" data-post-id="{{ $post->id }}"
                                data-bs-toggle="modal" data-bs-target="#commentsModal">
                                <i class="fa fa-comment"></i> View
                            </button>

                        </div>

                    </div>
                </div>
                  <!-- Comments Modal -->
            <div class="modal fade" id="commentsModal" tabindex="-1">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">

                        <!-- Header -->
                        <div class="modal-header">
                            <h5 class="modal-title">Comments</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <!-- Add Comment -->
                        <div class="mb-3">
                            <textarea id="newCommentContent{{$post->id}}" class="form-control" rows="2" placeholder="Write a comment..."></textarea>
                            <button class="btn btn-primary btn-sm mt-2 addCommentBtn" data-post-id="{{$post->id}}">
                                Comment
                            </button>
                        </div>

                        <hr>

                        <div class="modal-body" id="commentsBody{{$post->id}}">
                            <div class="mb-3">

                                <div class="d-flex gap-2">
                                    <div class="bg-light rounded p-2 w-100">
                                        <strong>John Doe</strong>
                                        <p class="mb-1">This is a main comment example.</p>
                                        <small class="text-muted">
                                            2 minutes ago · <a href="#" class="reply-btn">Reply</a>
                                        </small>
                                    </div>
                                </div>

                                <!-- Reply Input -->
                                <div class="reply-box mt-2 ms-5">
                                    <textarea class="form-control" rows="2" placeholder="Write a reply..."></textarea>
                                    <button class="btn btn-sm btn-primary mt-1">
                                        Reply
                                    </button>
                                </div>

                                <!-- Replies -->
                                <div class="ms-5 mt-2">

                                    <div class="d-flex gap-2 mb-2">
                                        <div class="bg-light rounded p-2 w-100">
                                            <strong>Sarah Ali</strong>
                                            <p class="mb-1">This is a reply to the comment.</p>
                                            <small class="text-muted">1 minute ago</small>
                                        </div>
                                    </div>

                                    <div class="d-flex gap-2 mb-2">
                                        <div class="bg-light rounded p-2 w-100">
                                            <strong>Ahmed Hassan</strong>
                                            <p class="mb-1">Another reply example.</p>
                                            <small class="text-muted">Just now</small>
                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>

                        <!-- Footer -->
                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>

                    </div>
                </div>
            </div>
            @endforeach

            <!-- Comments Modal -->
            <div class="modal fade" id="commentsModal" tabindex="-1">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">

                        <!-- Header -->
                        <div class="modal-header">
                            <h5 class="modal-title">Comments</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <!-- Add Comment -->
                        <div class="mb-3">
                            <textarea id="newCommentContent" class="form-control" rows="2" placeholder="Write a comment..."></textarea>
                            <button class="btn btn-primary btn-sm mt-2 addCommentBtn">
                                Comment
                            </button>
                        </div>

                        <hr>

                        <div class="modal-body" id="commentsBody">
                            <div class="mb-3">

                                <div class="d-flex gap-2">
                                    <div class="bg-light rounded p-2 w-100">
                                        <strong>John Doe</strong>
                                        <p class="mb-1">This is a main comment example.</p>
                                        <small class="text-muted">
                                            2 minutes ago · <a href="#" class="reply-btn">Reply</a>
                                        </small>
                                    </div>
                                </div>

                                <!-- Reply Input -->
                                <div class="reply-box mt-2 ms-5">
                                    <textarea class="form-control" rows="2" placeholder="Write a reply..."></textarea>
                                    <button class="btn btn-sm btn-primary mt-1">
                                        Reply
                                    </button>
                                </div>

                                <!-- Replies -->
                                <div class="ms-5 mt-2">

                                    <div class="d-flex gap-2 mb-2">
                                        <div class="bg-light rounded p-2 w-100">
                                            <strong>Sarah Ali</strong>
                                            <p class="mb-1">This is a reply to the comment.</p>
                                            <small class="text-muted">1 minute ago</small>
                                        </div>
                                    </div>

                                    <div class="d-flex gap-2 mb-2">
                                        <div class="bg-light rounded p-2 w-100">
                                            <strong>Ahmed Hassan</strong>
                                            <p class="mb-1">Another reply example.</p>
                                            <small class="text-muted">Just now</small>
                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>

                        <!-- Footer -->
                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>

                    </div>
                </div>
            </div>

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

        document.querySelectorAll('.addCommentBtn').forEach((btn) =>{
            btn.addEventListener('click',(e) => {
                const btn = e.currentTarget;
                const post_id = btn.dataset.postId;
                let commentContent = document.getElementById('newCommentContent' + post_id).value;
                fetch('{{route('comment')}}',{
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            'post_id' : post_id,
                            'commentContent' : commentContent
                        })
                    }).then(response => response.json()).then(function (data){
                        let modalId = "commentsBody" + post_id;
                        document.getElementById(modalId).append(data.comments);
                        console.log(data.error);
                    });
            });
        });
    </script>
@endsection
