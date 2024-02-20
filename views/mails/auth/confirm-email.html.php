<table class="subcopy" width="100%" cellpadding="0" cellspacing="0" role="presentation">
    <tr>
        <td>
            Bonjour, <?= $username; ?>!
        </td>
    </tr>
</table>

<table class="subcopy" width="100%" cellpadding="0" cellspacing="0" role="presentation">
    <tr>
        <td>
            Vous recevez cet e-mail car nous avons reçu une demande de vérification de votre compte.
        </td>
    </tr>
</table>

<table class="action" align="center" width="100%" cellpadding="0" cellspacing="0" role="presentation">
    <tr>
        <td align="center">
            <table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation">
                <tr>
                    <td align="center">
                        <table border="0" cellpadding="0" cellspacing="0" role="presentation">
                            <tr>
                                <td>
                                    <a href="<?= url('/verify-email', ['id' => $id, 'token' => $token]); ?>" class="button button-primary" target="_blank"
                                       rel="noopener">
                                        Verifier mon compte
                                    </a>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>