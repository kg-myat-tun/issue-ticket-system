<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Issue Ticket Demo</title>

    <style>

    </style>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<body>

    <header>
        <nav class="navbar navbar-expand-lg bg-light">
            <div class="container">
                <a class="navbar-brand" href="#">Issue Ticket Demo</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/">Home</a>
                        </li>
                        <li class="nav-item ms-3">
                            <a class="nav-link " aria-current="page" href="{{ route('login') }}">
                                <i class="fa-solid fa-arrow-right-to-bracket"></i>
                            </a>
                        </li>

                    </ul>

                </div>
            </div>
        </nav>
    </header>

    <main>
        <section class="container">
            <div class="row my-5">
                <div class="col-12">

                    @if(session('message'))
                        <span class="text-success mb-3"> {{ session('message') }} </span>
                    @endif

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Open Issue Ticket</h5>
                            <div class="mt-4">
                                <form action="{{ route('ticket.store') }}" class="row" method="post">
                                    @csrf
                                    <div class="col-8 mb-3">
                                        <label for="title" class="visually-hidden">Start typing</label>
                                        <input type="text" class="form-control  @error('title') is-invalid @enderror" name="title" value="{{ old("title") }}" id="title" placeholder="Start typing">
                                        @error("title")
                                            <small class="text-danger">
                                                {{ $message }}
                                            </small>
                                        @enderror
                                    </div>
                                    <div class="col-auto mb-3">
                                        <select class="form-select  @error('type') is-invalid @enderror" name="type" aria-label="Default select example">
                                            <option selected>Issue Type</option>
                                            @foreach($types as $type)
                                                <option value="{{ $type->id }}"  {{ old("type") == $type->id ? "selected" : "" }}>{{ $type->type }}</option>
                                            @endforeach
                                        </select>
                                        @error("type")
                                            <small class="text-danger">
                                                {{ $message }}
                                            </small>
                                        @enderror
                                    </div>
                                    <div class="col-auto mb-3">
                                        <button class="btn btn-primary">Open ticket</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Type</th>
                            <th>Created_at</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($issues as $issue)
                            <tr>
                                <td>{{ $issue->id }}</td>
                                <td>{{ $issue->title }}</td>
                                <td>{{ $issue->issue_type->type }}</td>
                                <td>{{ $issue->created_at->diffForHumans() }}</td>
                            </tr>
                        @endforeach

                        @if(count($issues) == 0)
                            <tr>
                                <td colspan="4" class="text-center text-info">There is no record yet!</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>

            </div>
        </section>
    </main>

    <footer>

    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>
