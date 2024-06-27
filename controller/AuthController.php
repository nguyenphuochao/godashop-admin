<?php
class AuthController
{

    // Login form
    function login()
    {
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        $remember_me = $_POST['remember_me'];

        $staffRepository = new StaffRepository();
        $staff = $staffRepository->findByUserNamePassWord($username, $password);
        // error login wrong username or password
        if (!$staff) {
            $_SESSION["error"] = "Thông tin đăng nhập không chính xác";
            header("Location: login.php");
            exit;
        }
        // error login account is not active
        if ($staff->getIsActive() == 0) {
            $_SESSION["error"] = "Tài khoản của bạn đã bị khóa";
            header("Location: login.php");
            exit;
        }
        // success login
        if (!empty($remember_me)) {
            setcookie("email", $staff->getEmail(), time() + 604800); // lưu remember me 7 ngày
            setcookie("name", $staff->getName(), time() + 604800); // 7×24×60×60=604,800 giây
        }
        $_SESSION["email"] = $staff->getEmail();
        $_SESSION["name"] = $staff->getName();
        header("Location: index.php");
    }

    // Logout
    function logout()
    {
        session_destroy();
        setcookie("email", "", time() - 43200);
        setcookie("name", "", time() - 43200);
        header("Location: login.php");
    }
}
