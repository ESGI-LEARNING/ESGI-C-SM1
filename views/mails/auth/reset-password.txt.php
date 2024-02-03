Bonjour, <?= $username; ?>!

Vous recevez cet e-mail car nous avons reçu une demande de réinitialisation de mot de passe pour votre compte.

Modifier mon mot de passe: <?= url('/reset-password', ['token' => $token]); ?>
