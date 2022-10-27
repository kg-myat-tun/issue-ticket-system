@extends("Admin.master")

@section("content")
    <div class="row d-flex align-items-center justify-content-center vh-100">
        <div class="col-5">
            <div class="card px-3">
                <div class="card-body">
                    <h4 class="text-info text-center mb-4">Login To Admin Panel</h4>
                    <form action="{{ route('login.store') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                   value="{{ old("email") }}" id="email" placeholder="name@example.com">
                            @error("email")
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                                   value="{{ old("password") }}" id="password" placeholder="Enter your password">
                            @error("password")
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="mb-3 mt-4">
                            <button class="btn btn-info w-100">
                                <span class="me-3">Sign In</span> <i class="fa-solid fa-arrow-right-to-bracket"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


