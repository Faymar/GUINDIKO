<!doctype html>
<html lang="fr">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>

<body>
    <header>
        <!-- place navbar here -->
    </header>
    <main>
        <section style="background-color: #eee;">
            <div class="container py-5">

                <div class="row">

                    <div class="col-md-6 col-lg-5 col-xl-4 mb-4 mb-md-0">

                        <h5 class="font-weight-bold mb-3 text-center text-lg-start">Member</h5>

                        <div class="card">
                            <div class="card-body">
                                @foreach ($users as $user)
                                <ul class="list-unstyled mb-0">
                                    <li class="p-2 border-bottom" style="background-color: #eee;">
                                        <a href="{{'/coversation/'.$user->id}}" class="d-flex justify-content-between">
                                            <div class="d-flex flex-row">
                                                <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-8.webp" alt="avatar" class="rounded-circle d-flex align-self-center me-3 shadow-1-strong" width="60">
                                                <div class="pt-1">
                                                    <p class="fw-bold mb-0">{{$user->email}}</p>
                                                </div>
                                            </div>
                                            <div class="pt-1">
                                                <p class="small text-muted mb-1">Just now</p>
                                                <span class="badge bg-danger float-end">1</span>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                                @endforeach
                            </div>
                        </div>

                    </div>

                    <div class="col-md-6 col-lg-7 col-xl-8">

                        <ul class="list-unstyled">
                            <li class="d-flex justify-content-between mb-4">
                                <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-6.webp" alt="avatar" class="rounded-circle d-flex align-self-start me-3 shadow-1-strong" width="60">
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between p-3">
                                        <p class="fw-bold mb-0">Brad Pitt</p>
                                        <p class="text-muted small mb-0"><i class="far fa-clock"></i> 12 mins ago</p>
                                    </div>
                                    <div class="card-body">
                                        <p class="mb-0">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                                            labore et dolore magna aliqua.
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li class="d-flex justify-content-between mb-4">
                                <div class="card w-100">
                                    <div class="card-header d-flex justify-content-between p-3">
                                        <p class="fw-bold mb-0">Lara Croft</p>
                                        <p class="text-muted small mb-0"><i class="far fa-clock"></i> 13 mins ago</p>
                                    </div>
                                    <div class="card-body">
                                        <p class="mb-0">
                                            Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque
                                            laudantium.
                                        </p>
                                    </div>
                                </div>
                                <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-5.webp" alt="avatar" class="rounded-circle d-flex align-self-start ms-3 shadow-1-strong" width="60">
                            </li>
                            <li class="d-flex justify-content-between mb-4">
                                <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-6.webp" alt="avatar" class="rounded-circle d-flex align-self-start me-3 shadow-1-strong" width="60">
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between p-3">
                                        <p class="fw-bold mb-0">Brad Pitt</p>
                                        <p class="text-muted small mb-0"><i class="far fa-clock"></i> 10 mins ago</p>
                                    </div>
                                    <div class="card-body">
                                        <p class="mb-0">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                                            labore et dolore magna aliqua.
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li class="bg-white mb-3">
                                <div class="form-outline">
                                    <textarea class="form-control" id="textAreaExample2" rows="4"></textarea>
                                    <label class="form-label" for="textAreaExample2">Message</label>
                                </div>
                            </li>
                            <button type="button" class="btn btn-info btn-rounded float-end">Send</button>
                        </ul>

                    </div>

                </div>

            </div>
        </section>
    </main>
    <footer>
        <!-- place footer here -->
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>