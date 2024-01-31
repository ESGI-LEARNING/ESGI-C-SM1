<?php
$flashService = new \Core\Session\FlashService();
if (!empty($_SESSION['flash'])) {
    $messageType = $_SESSION['flash']['success'] ? 'success' : 'error';
    $message = $flashService->getFlash('success') ?? $flashService->getFlash('error');
    echo "<div class='alert alert-$messageType'>$message</div>";
}
?>