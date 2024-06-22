<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Đăng nhập</title>

    <!-- Custom fonts for this template-->
    <link href="public/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="public/css/sb-admin.css" rel="stylesheet">
    <link href="public/css/admin.css" rel="stylesheet">
    <style>
        .error {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>

<body class="bg-dark">
    <div class="container">
        <div class="card card-login mx-auto mt-5">
            <div class="card-header card-header-login">
                <img src="public/images/logo.jpg">
            </div>
            <div class="card-body">
                <!-- alert -->
                <?php
                session_id() || session_start();
                if (isset($_SESSION['error'])) {
                    echo "<div class='alert alert-danger'>" . $_SESSION['error'] . "</div>";
                    unset($_SESSION['error']);
                }
                ?>
                <form id="form-login" action="index.php?c=auth&a=login" method="POST">
                    <div class="form-group">
                        <input type="text" id="username" name="username" class="form-control" placeholder="Tài khoản" autofocus="autofocus">
                    </div>
                    <div class="form-group">
                        <input type="password" id="password" name="password" class="form-control" placeholder="Mật khẩu" name="password">
                    </div>
                    <div class="form-group">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" value="remember_me" name="remember_me">
                                Nhớ mật khẩu
                            </label>
                        </div>
                    </div>
                    <button class="btn btn-primary btn-block">Đăng nhập</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="public/vendor/jquery/jquery.min.js"></script>
    <script src="public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="public/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
</body>

</html>

<script>
    $("#form-login").validate({
        rules: {
            username: "required",
            password: "required"
        },
        messages: {
            username: "Vui lòng nhập tên tài khoản",
            password: "Vui lòng nhập mật khẩu"
        }
    });
</script>