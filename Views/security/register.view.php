<?php include __DIR__ . '/../components/header.view.php'; ?>
    <h1>Page d'enregistrement</h1>
    <p>Lorem ipsum dolor sit amet consectetu</p>
    <form>
        <label for="email">Email</label>
        <input type="email" name="email" id="email">
        <label for="password">Mot de passe</label>
        <input type="password" name="password" id="password">
        <label for="password2">Confirmer le mot de passe</label>
        <input type="password" name="password2" id="password2">
        <input type="submit" value="S'enregistrer">
    </form>
<?php include __DIR__ . '/../components/footer.view.php'; ?>