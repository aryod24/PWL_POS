<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register Pengguna</title>
    <!-- Google Font: Montserrat -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;700&display=swap">
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
            background-image: url('{{ asset('img/acer.avif') }}'); /* Latar belakang gambar */
            background-size: cover; /* Menyesuaikan gambar dengan ukuran layar */
            background-repeat: no-repeat; /* Menghindari pengulangan gambar */
            color: #333; /* Warna teks utama */
            font-family: 'Montserrat', sans-serif; /* Font yang digunakan */
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

        .user-icon {
            font-size: 4rem; /* Ukuran icon user */
            color: #4a90e2; /* Warna icon */
            text-align: center; /* Pusatkan icon */
            margin-bottom: 10px; /* Jarak bawah */
        }
    </style>
</head>
<body class="hold-transition login-page">
    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="{{ url('/') }}" class="h1"><b>Laptop</b>Store</a>
            </div>
            <div class="card-body">
                <div class="user-icon text-center">
                    <i class="fas fa-user"></i>
                </div>
                <p class="login-box-msg">Daftar untuk memulai sesi Anda</p>
                <form action="{{ url('register') }}" method="POST" id="form-register">
                    @csrf
                    <div class="form-group">
                        <label>Level Pengguna</label>
                        <select name="level_id" id="level_id" class="form-control" required>
                            <option value="">- Pilih Level -</option>
                            @foreach ($level as $l)
                                <option value="{{ $l->level_id }}">{{ $l->level_nama }}</option>
                            @endforeach
                        </select>
                        <small id="error-level_id" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" id="username" class="form-control" required>
                        <small id="error-username" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="nama" id="nama" class="form-control" required>
                        <small id="error-nama" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                        <small id="error-password" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <a href="{{ url('login') }}" class="btn btn-secondary btn-block">Kembali</a>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Sign Up</button>
                        </div>
                    </div>
                </form>
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
            $("#form-register").validate({
                rules: {
                    level_id: {
                        required: true,
                        number: true
                    },
                    username: {
                        required: true,
                        minlength: 3,
                        maxlength: 20
                    },
                    nama: {
                        required: true,
                        minlength: 3,
                        maxlength: 100
                    },
                    password: {
                        required: true,
                        minlength: 5,
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
