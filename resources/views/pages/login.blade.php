<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hospital MS - Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body class="bg-light d-flex align-items-center" style="height:100vh;">
    @if(session("error"))
    <div class="alert alert-danger">
      {{session("error")}}

    </div>
    @endif
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-4">
          <div class="card shadow">
            <div class="card-body">
              <h3 class="text-center mb-4">Hospital MS - Login</h3>
              <form action="{{route('login.store')}}" method="post">
                @csrf
                <div class="mb-3">
                  <label for="email" class="form-label">Email address</label>
                  <input type="email" name="email" id="email" class="form-control" placeholder="Enter email" required>
                </div>
                <div class="mb-3">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" name="password" id="password" class="form-control" placeholder="Enter password" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Login</button>
              </form>
              <div class="mt-3 text-center">
                <a href="#">Forgot Password?</a>
              </div>
              <div class="mt-2 text-center">
                <span>Don’t have an account?</span>
                <a href="{{route('register.show')}}">Register</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
