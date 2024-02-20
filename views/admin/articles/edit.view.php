<section>
    <legend><h2>Modifier l'article <?= $article->getName(); ?></h2></legend>
    <?= $this->component('form', $form); ?>

    <div class="flex flex-between">
        <?php foreach ($article->images as $image): ?>
           <div>
               <img src="<?= $image->image(100, 100) ?>" width="200" height="100" alt="<?= $image->getImage(); ?>">
               <form method="POST" action="/admin/articles/delete/images/<?= $image->getId(); ?>"
                     onsubmit="return confirm('Êtes-vous sûr(e) de supprimer cette image ?')">
                   <input type="hidden" name="csrf_token" value="<?= $this->csrfToken; ?>">
                   <button type="submit" class="button button-red">Supprimer</button>
               </form>
           </div>
        <?php endforeach; ?>
    </div>
</section>
