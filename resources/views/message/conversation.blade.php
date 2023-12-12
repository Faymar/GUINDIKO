ß<!doctype html>
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
                <div class="container overflow-auto">
                    <div class="row">
                        <div class="col-md-6 col-lg-7 col-xl-8">
                            <ul class="list-unstyled">
                                @forelse ($conversation as $conversation)
                                @if ($conversation->userEnv_id == 5)
                                <li class="d-flex justify-content-between mb-4">
                                    <div class="card w-100">
                                        <div class="card-header d-flex justify-content-between p-3">
                                            <p class="text-muted small mb-0"><i class="far fa-clock"></i>{{$conversation->created_at->format('l d F Y à H\hi')}}</p>
                                            <p class="fw-bold mb-0">Moi</p>
                                        </div>
                                        <div class="card-body">
                                            <p class="mb-0">
                                                {{$conversation->contenu}}
                                            </p>
                                        </div>
                                    </div>
                                    <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-5.webp" alt="avatar" class="rounded-circle d-flex align-self-start ms-3 shadow-1-strong" width="60">
                                </li>
                                @else
                                <li class="d-flex justify-content-between mb-4">
                                    <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-6.webp" alt="avatar" class="rounded-circle d-flex align-self-start me-3 shadow-1-strong" width="60">
                                    <div class="card w-100">
                                        <div class="card-header d-flex justify-content-between p-3">
                                            <p class="fw-bold mb-0">{{$user->email}}</p>
                                            <p class="text-muted small mb-0"><i class="far fa-clock"></i>{{$conversation->created_at->format('l d F Y à H\hi')}}</p>
                                        </div>
                                        <div class="card-body">
                                            <p class="mb-0 ">
                                                {{$conversation->contenu}}
                                            </p>
                                        </div>
                                    </div>
                                </li>
                                @endif
                                @empty
                                <li class="d-flex justify-content-between mb-4">
                                    <div class="card w-100">
                                        <div class="card-header d-flex justify-content-between p-3">
                                            <p class="fw-bold mb-0">GUINDIKO</p>
                                        </div>
                                        <div class="card-body">
                                            <p class="mb-0">
                                                Bienvenue sur GUINDIKO, n'hésitez pas à contacter votre mentor. <br>
                                                Un avenir clair avec GUINDIKO.
                                            </p>
                                        </div>
                                    </div>
                                </li>
                                @endforelse
                            </ul>
                        </div>

                    </div>
                    <div class="bg-white">
                        <form action="{{'/envoyerMesage/'.$user->id}}" method="post">
                            @method('post')
                            @csrf
                            <div class="row">
                                <div class="col-md-11">
                                    <div class="form-outline p-2">
                                        <textarea name="contenu" class="form-control" id="textAreaExample2" rows="1"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-1 mt-2">
                                    <button type="submit" class="btn btn-info btn-rounded float-end">envoyer</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!-- <footer class="fixed-bottom bg-white">
        <div class="form-outline p-2">
            <textarea class="form-control" id="textAreaExample2" rows="4"></textarea>
        </div>
        <button type="button" class="btn btn-info btn-rounded float-end">Send</button>
    </footer> -->
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>