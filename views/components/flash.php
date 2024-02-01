<?php
$flashService = new \Core\Session\FlashService();
if (!empty($_SESSION['flash'])) {
    $messageType = $_SESSION['flash']['success'] ? 'success' : 'error';
    $message = $_SESSION['flash']['success'] ?? $_SESSION['flash']['error'];
    echo "<div class='alert alert-$messageType'>$message</div>";
}
unset($_SESSION['flash']);
?>