<?php require_once __DIR__ . '/../controllers/load.php';

class Utils
{

    // method to sanitize user input
    public static function sanitize($input)
    {
        return htmlspecialchars(stripslashes(trim($input)));
    }

    // method to redirect to a different page
    public static function redirect($page)
    {
        if (!headers_sent()) {
            header("Location: $page");
            exit();
        } else {
            echo "<script>window.location.href='$page';</script>";
            exit();
        }
    }

    // method to set a flash message
    public static function setFlash($name, $message)
    {
        Session::start();
        $_SESSION[$name] = $message;
    }

    // method to display a flash message
    public static function displayFlash($name, $type)
{
    if (isset($_SESSION[$name])) {
        $alertType = $type === 'success' ? 'text-success bg-success bg-opacity-10' : 'text-danger bg-danger bg-opacity-10';
        $iconPath = $type === 'success'
            ? '<path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>'
            : '<path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm0 13a1 1 0 0 1-1-1V9a1 1 0 0 1 2 0v3.5a1 1 0 0 1-1 1Zm0-7a1.5 1.5 0 1 1 1.5-1.5A1.5 1.5 0 0 1 10 6Z"/>';

        echo '
        <div id="toast-container" style="position: fixed; bottom: 50px; right: 0px; z-index: 999999999;">
            <div class="toast show d-flex align-items-center w-100 max-w-xs p-2 mb-3 ' . $alertType . ' bg-white rounded shadow-sm border" role="alert" id="flash-toast">
                <div class="d-flex align-items-center justify-content-center flex-shrink-0 rounded me-3" style="width: 32px; height: 32px;">
                    <svg class="bi" width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                        ' . $iconPath . '
                    </svg>              
                </div>
                <div class="small flex-grow-1">' . htmlspecialchars($_SESSION[$name]) . '</div>
                <button type="button" class="btn-close ms-2 me-1" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
        <script>
            document.querySelectorAll("[data-bs-dismiss=\'toast\']").forEach(function(button) {
                button.addEventListener("click", function() {
                    this.closest(".toast").remove();
                });
            });

             // Auto-dismiss after 5 seconds
            setTimeout(function() {
                var toast = document.getElementById("flash-toast");
                if (toast) {
                    toast.remove();
                }
            }, 5000);
        </script>';
        unset($_SESSION[$name]);
    }
}

}
