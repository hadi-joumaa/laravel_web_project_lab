<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Social Media App')</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet">

    <style>
        :root {
            --primary-color: #6B9071;
            --secondary-color: #AEC3B0;
            --light-color: #E3EED4;
        }

        body {
            background-color: var(--light-color);
        }

        .navbar {
            background-color: var(--primary-color);
        }

        .navbar-brand,
        .nav-link {
            color: #ffffff !important;
        }

        .nav-link:hover {
            color: var(--secondary-color) !important;
        }
        .btn-primary {
    background-color: var(--primary-color);
    border-color: var(--primary-color);
}

.btn-primary:hover {
    background-color: #5a7d65; /* darker green */
    border-color: #5a7d65;
}
.pagination .page-link {
    color: var(--primary-color);
    border-color: var(--secondary-color);
}

.pagination .page-link:hover {
    background-color: var(--secondary-color);
    color: #fff;
    border-color: var(--secondary-color);
}

.pagination .page-item.active .page-link {
    background-color: var(--primary-color);
    border-color: var(--primary-color);
    color: #fff;
}

.pagination .page-item.disabled .page-link {
    color: #9ca3af;
    background-color: #f8f9fa;
    border-color: #dee2e6;
}

    </style>
</head>

<body>

<!-- HEADER -->
<nav class="navbar navbar-expand-lg">
    <div class="container">
       <a class="navbar-brand fw-semibold d-flex align-items-center gap-2" href="#">
    <i class="fa-solid fa-comment-dots" style="color:#fff;"></i>
    <span>Connectly</span>
</a>


        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">

            <!-- Left menu -->
            <ul class="navbar-nav me-auto">


            </ul>

            <!-- Right menu -->
            <ul class="navbar-nav">


                <li class="nav-item">
                    <a class="nav-link" href="{{route('register')}}">Register</a>
                </li>

                <!-- Notifications -->
                <li class="nav-item position-relative ms-3">
                    <a href="#" class="nav-link">
                        <i class="fa fa-bell fa-lg"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            3
                        </span>
                    </a>
                </li>

                <!-- User dropdown -->
                <li class="nav-item dropdown ms-2">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                    {{Auth::user() ? Auth::user()->name : ""}}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                      <li><a class="dropdown-item" href="/profile/{{ auth()->id() }}">Profile</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{route('logout')}}">Logout</a></li>
                    </ul>
                </li>
            </ul>

        </div>
    </div>
</nav>

<!-- PAGE CONTENT -->
<main class="container my-4">

     <main class="container my-4">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </main>


<!-- FOOTER -->
<footer class="text-center py-4 mt-5"
        style="background-color: var(--primary-color); color: #fff;">

    <div class="container">

        <h5 class="fw-semibold mb-2">
            <i class="fa-solid fa-comment-dots me-1"></i> Connectly
        </h5>

        <div class="d-flex justify-content-center gap-3 mb-3">
            <a href="#" class="text-white text-decoration-none">
                <i class="fab fa-facebook fa-lg"></i>
            </a>
            <a href="#" class="text-white text-decoration-none">
                <i class="fab fa-instagram fa-lg"></i>
            </a>
            <a href="#" class="text-white text-decoration-none">
                <i class="fab fa-linkedin fa-lg"></i>
            </a>
            <a href="#" class="text-white text-decoration-none">
                <i class="fab fa-github fa-lg"></i>
            </a>
        </div>

        <small class="d-block">
            © 2025 Connectly. All rights reserved.
        </small>



    </div>
</footer>

@yield('scripts')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
