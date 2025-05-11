<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AUTODOC FORUM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .forum-hero {
            background-image: url('/images/utils/worker.jpg');
            /* Replace with your image */
            background-size: cover;
            background-position: center;
            height: 500px;
            position: relative;
            color: white;
        }

        .forum-hero::before {
            content: "";
            position: absolute;
            inset: 0;
            background-color: rgba(0, 0, 0, 0.6);
            z-index: 1;
        }

        .forum-hero .container {
            position: relative;
            z-index: 2;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark py-3">
        <div class="container">
            <a class="navbar-brand fw-bold text-orange" href="/forum"><span class="text-white">AUTOFACTOR</span> <span class="text-warning">NG</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="/forum">Forum</a></li>
                    <li class="nav-item"><a class="nav-link" href="/car-reviews">Car Reviews</a></li>
                    <li class="nav-item"><a class="nav-link" href="/video-tips">Video Tips & Tutorials</a></li>
                </ul>
                <div class="d-flex gap-2">
                    <a href="#" class="btn btn-outline-light">My Account</a>
                    <a href="#" class="btn btn-warning">New Topic</a>
                </div>
            </div>
        </div>
    </nav>


    <main class="">
        @yield('content')
    </main>

    <!-- Hero Section -->


    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>

</html>