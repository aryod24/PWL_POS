<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Pengguna</title>
    <!-- Google Font: Montserrat -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
    
    <style>
        body {
            color: #333; /* Warna teks utama */
            font-family: 'Montserrat', sans-serif; /* Font yang digunakan */
        }

        .img {
            background-image:  url('{{ asset('img/acer.avif') }}') ; /* Pastikan path benar */
            background-size: cover; /* Mengatur gambar untuk menutupi seluruh halaman */
            background-position: center; /* Memusatkan gambar */
            position: fixed; /* Memastikan gambar tetap di belakang */
            top: 0;
            left: 0;
            width: 100%;
            height: 100%; /* Mengatur tinggi menjadi 100% */
            z-index: -1; /* Memastikan gambar di belakang elemen lain */
        }

        .login-box {
            background: rgba(255, 255, 255, 0.9); /* Latar belakang putih transparan */
            border-radius: 10px; /* Sudut membulat */
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2); /* Bayangan kotak */
        }

        .card-header {
            background-color: #4a90e2; /* Warna latar belakang header */
            color: white; /* Warna teks header */
            border-top-left-radius: 10px; /* Sudut membulat kiri atas */
            border-top-right-radius: 10px; /* Sudut membulat kanan atas */
        }

        .login-box-msg {
            font-weight: 500; /* Teks lebih tebal */
            margin-bottom: 20px; /* Jarak bawah */
        }

        .input-group .form-control {
            border-radius: 5px; /* Sudut membulat untuk input */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Bayangan input */
        }

        .btn-primary {
            background-color: #6ab04c; /* Warna tombol */
            border-color: #6ab04c; /* Warna border tombol */
            transition: background-color 0.3s ease; /* Transisi warna */
        }

        .btn-primary:hover {
            background-color: #4a90e2; /* Warna tombol saat hover */
            border-color: #4a90e2; /* Warna border saat hover */
        }

        .error-text {
            margin-top: 5px; /* Jarak atas untuk pesan error */
            font-size: 0.875rem; /* Ukuran font untuk pesan error */
        }

        /* Styling for the icon container */
        .icon-container {
            text-align: center; /* Center the icon horizontally */
            margin-bottom: 20px; /* Add some space below the icon */
        }

        .icon-container i {
            font-size: 4rem; /* Make the icon larger */
            color: #4a90e2; /* Color the icon */
        }
    </style>
</head>
<body class="hold-transition login-page">
    <div class="img"></div> <!-- Menambahkan elemen untuk gambar latar belakang -->
    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="{{ url('/') }}" class="h1"><b>Laptop</b>Store</a>
            </div>
            <div class="card-body">
                <div class="icon-container">
                    <i class="fas fa-user-circle"></i> <!-- Ikon yang menunjukkan pengguna -->
                </div>
                <p class="login-box-msg">Sign in to start your session</p>
                <form action="{{ url('login') }}" method="POST" id="form-login">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" id="username" name="username" class="form-control" placeholder="Username">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        <small id="error-username" class="error-text text-danger"></small>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" id="password" name="password" class="form-control" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        <small id="error-password" class="error-text text-danger"></small>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember">Remember Me</label>
                            </div>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                    </div>
                </form>
                Don't have account?<a href="{{ url('register') }}"> Sign Up</a>
            </div>
        </div>
    </div>
    <!-- jQuery -->
    <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- jquery-validation -->
    <script src="{{ asset('adminlte/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/jquery-validation/additional-methods.min.js') }}"></script>
    <!-- SweetAlert2 -->
    <script src="{{ asset('adminlte/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function() {
            $("#form-login").validate({
                rules: {
                    username: {
                        required: true,
                        minlength: 4,
                        maxlength: 20
                    },
                    password: {
                        required: true,
                        minlength: 6,
                        maxlength: 20
                    }
                },
                submitHandler: function(form) {
                    $.ajax({
                        url: form.action,
                        type: form.method,
                        data: $(form).serialize(),
                        success: function(response) {
                            if (response.status) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: response.message,
                                }).then(function() {
                                    window.location = response.redirect;
                                });
                            } else {
                                $('.error-text').text('');
                                $.each(response.msgField, function(prefix, val) {
                                    $('#error-' + prefix).text(val[0]);
                                });
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Terjadi Kesalahan',
                                    text: response.message
                                });
                            }
                        }
                    });
                    return false;
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.input-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
</body>
</html>
