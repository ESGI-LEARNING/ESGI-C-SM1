Bonjour, <?= $username; ?>!


Vous recevez cet e-mail car nous avons reçu une demande de vérification de votre compte.


<a href="<?= url('/verify-email', ['id' => $id, 'token' => $token]); ?>" class="button button-primary" target="_blank"
   rel="noopener">
    Verifier mon compte
</a>