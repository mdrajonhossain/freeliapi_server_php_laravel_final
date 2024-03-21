<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="bg-light min-vh-100 d-flex align-items-center justify-content-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card border-0">
                    <h1 class="card-header border-0 text-center bg-info text-white">Login</h1>
                    <div class="card-body">
                        <form id="resourceForm">
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" id="email" name="email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" id="password" name="password" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <div class="form-check">
                                    <input type="checkbox" id="remember_me" name="remember_me" class="form-check-input">
                                    <label for="remember_me" class="form-check-label">Remember me</label>
                                </div>
                                <a href="#" class="text-sm text-primary">Forgot Password?</a>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="toast-container  position-fixed top-0 end-0 p-3" style="z-index: 50">
        <div class="toast bg-success" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-body text-white">Login Successfully</div>
        </div>
    </div>





    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
    document.getElementById('resourceForm').addEventListener('submit', async function(event) {
        event.preventDefault();

        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        try {
            const response = await fetch(
                'http://localhost/freeliapi_server_php_laravel_final/api/user_loginmidleweare', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({
                        email: document.getElementById('email').value,
                        password: document.getElementById('password').value
                    })
                });
            const data = await response.json();
            console.log(data);
            if (data.access_token) {
                $('.toast').toast('show');
            }
        } catch (error) {
            console.error(error);
        }
    });
    </script>





</body>

</html>