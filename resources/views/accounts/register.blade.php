<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .form-container {
            max-width: 400px;
            margin: 50px auto;
            padding: 30px;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .error {
            color: red;
            font-size: 0.875em;
        }

        .link {
            margin-top: 10px;
            margin-left: 30vh;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="form-container">
            <h3 class="text-center mb-4">Register</h3>
            <form id="form_data">
                @csrf
                <div class="row mb-3">
                    <div class="">
                        <div class="form-floating"> 
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Enter your Name" required>
                            <label for="name">Name</label>
                        </div>
                        <span class="error" id="nameError"></span>
                    </div>
                </div>

                <div class="form-floating mb-3">
                    <input type="email" class="form-control" name="email" id="email" placeholder="Email address"
                        required>
                    <label for="email">Email address</label>
                </div>

                <div class="form-floating mb-3 position-relative">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                    <label for="password">Password</label>
                    <span class="position-absolute top-50 end-0 translate-middle-y me-3" style="cursor: pointer;"
                        onclick="togglePassword('password', 'iconPassword')">
                        <i class="bi bi-eye-slash" id="iconPassword"></i>
                    </span>
                    <span class="error" id="passwordError"></span>
                </div>

                <div class="form-floating mb-3 position-relative">
                    <input type="password" class="form-control" id="cfpassword" name="cfpassword" placeholder="Confirm Password" required>
                    <label for="cfpassword">Confirm Password</label>
                    <span class="position-absolute top-50 end-0 translate-middle-y me-3" style="cursor: pointer;"
                        onclick="togglePassword('cfpassword', 'iconCfPassword')">
                        <i class="bi bi-eye-slash" id="iconCfPassword"></i>
                    </span>
                    <span class="error" id="cfPasswordError"></span>
                </div>


                <button type="submit" id="RegisterBtn" class="btn btn-primary w-100">
                    <span id="btnText">Register</span>
                    <span id="btnSpinner" class="spinner-border spinner-border-sm ms-2" style="display:none;"></span>
                </button>
                <br>
            </form>
            <div class="text-center mt-2">
                <a href="/login">Already a User? Login</a>
            </div>
        </div>
    </div>
</body>
<script>
    function togglePassword(id, iconId) {
        const field = $(`#${id}`);
        const icon = $(`#${iconId}`);

        if (field.attr('type') === 'password') {
            field.attr('type', 'text');
            icon.removeClass("bi-eye-slash").addClass("bi-eye");
        } else {
            field.attr('type', 'password');
            icon.removeClass("bi-eye").addClass("bi-eye-slash");
        }
    }

    $(document).ready(function() 
    {
        let isNameValid = true;
        let isPasswordValid = true;
        let iscfPasswordValid = true;


        $('#name').on('input', function() {
            let name = $(this).val().trim();
            let msgDiv = $('#nameError');
            if (name === "") {
                msgDiv.text('Name Cannot be Empty');
                isNameValid = false;
            } else if (!/^[a-zA-Z]/.test(name)) {
                msgDiv.text('Name Should only Contains letters');
                isNameValid = false;
            } else {
                msgDiv.text("");
                isNameValid = true;
            }
        })

        $('#password').on('input', function() 
        {
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

        $('#cfpassword').on('input', function() 
        {
            let password = $("#password").val();
            let cfpassword = $("#cfpassword").val();
            let msgDiv = $('#cfPasswordError');
            if (password != cfpassword) {
                msgDiv.text('Password and Confirm password does not match');
                iscfPasswordValid = false;
            } else {
                msgDiv.text("");
                iscfPasswordValid = true;
            }
        })

        $('#form_data').submit(function(e) {
            e.preventDefault();

                $("#RegisterBtn").prop("disabled", true);
                $("#btnText").text("Signing up...");
                $("#btnSpinner").show();
            if (isNameValid && isPasswordValid && iscfPasswordValid) {
                let form = $('#form_data')[0];
                let data = new FormData(form);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: '/register',
                    data: data,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        Swal.fire({
                            title: 'Registration Successful',
                            text: 'You will be redirected to login page.',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = response.redirect;
                            }
                        });
                    },
                    error: function(xhr) {
                        Swal.fire({
                            title: 'Error',
                            text: 'Registration failed. Please check your inputs.',
                            icon: 'error',
                            confirmButtonText: 'Try Again'
                        });
                    },
                    complete: function() {
                        $("#RegisterBtn").prop("disabled", false);
                        $("#btnText").text("Register");
                        $("#btnSpinner").hide();
                    }
                });

            }
        })
    })
</script>

</html>
