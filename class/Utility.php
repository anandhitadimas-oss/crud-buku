<?php
class Utility {
    public static function setFlash($message, $type = "success") {
        // pastikan session aktif
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['flash'] = [
            'message' => $message,
            'type' => $type
        ];
    }

    public static function showFlash() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!empty($_SESSION['flash'])) {
            $flash = $_SESSION['flash'];
            $color = $flash['type'] == "success" ? "alert-success" : "alert-danger";
            echo "<div class='alert $color alert-dismissible fade show' role='alert'>
                    {$flash['message']}
                    <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                  </div>";
            unset($_SESSION['flash']); // hapus setelah ditampilkan
        }
    }

    public static function redirect($url) {
        header("Location: $url");
        exit;
    }
}
