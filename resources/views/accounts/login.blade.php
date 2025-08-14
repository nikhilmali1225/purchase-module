<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .form-container {
            max-width: 400px;
            margin: 50px auto;
            margin-top: 120px;
            padding: 30px;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.1);
        }

        .error {
            color: red;
            font-size: 0.875em;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="form-container">
            <h3 class="text-center mb-4">Login</h3>
            <form id="form_data">
                @csrf
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email address"
                        required>
                    <label for="email">Email address</label>
                </div>

                <div class="form-floating mb-3 position-relative">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password"
                        required>
                    <label for="password">Password</label>
                    <span class="position-absolute top-50 end-0 translate-middle-y me-3" style="cursor: pointer;"
                        onclick="togglePassword()">
                        <i class="bi bi-eye-slash" id="toggleIcon"></i>
                    </span>
                    <span class="error" id="passwordError"></span>
                </div>
                <button type="submit" id="loginBtn" class="btn btn-primary w-100">
                    <span id="btnText">Login</span>
                    <span id="btnSpinner" class="spinner-border spinner-border-sm ms-2" style="display:none;"></span>
                </button>
            </form>

            <div class="text-center mt-3">
                <a href="/">Don't have an account? Register</a>
            </div>
        </div>
    </div>
</body>

<script>
    function togglePassword() {
        const password = document.getElementById('password');
        const icon = document.getElementById('toggleIcon');
        if (password.type === "password") {
            password.type = "text";
            icon.classList.remove("bi-eye-slash");
            icon.classList.add("bi-eye");
        } else {
            password.type = "password";
            icon.classList.remove("bi-eye");
            icon.classList.add("bi-eye-slash");
        }
    }
    $(document).ready(function() {
        let isPasswordValid = true;

        $('#password').on('input', function() {
            let password = $(this).val();
            let msgDiv = $('#passwordError');
            if (password.length < 8) {
                msgDiv.text('password should atleast contain 8 letters');
                isPasswordValid = false;
            } else {
                msgDiv.text("");
                isPasswordValid = true;
            }
        })

        $('#form_data').submit(function(e) {
            e.preventDefault();

            if (isPasswordValid) {
                let form = $('#form_data')[0];
                let data = new FormData(form);
                $("#loginBtn").prop("disabled", true);
                $("#btnText").text("Signing in...");
                $("#btnSpinner").show();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: "/login_user",
                    data: data,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        window.location.href = '/' + response.redirect;
                    },
                    error: function(xhr) {
                        Swal.fire({
                            title: 'Error',
                            text: 'Invalid Credentials.',
                            icon: 'error',
                            confirmButtonText: 'Try Again'
                        });
                    },
                    complete: function() {
                        $("#loginBtn").prop("disabled", false);
                        $("#btnText").text("Login");
                        $("#btnSpinner").hide();
                    }
                });
            }
        });

    })
</script>

</html>
