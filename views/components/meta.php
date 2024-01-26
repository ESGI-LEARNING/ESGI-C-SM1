<!DOCTYPE html>
<html class="" lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
	      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>
		<?php
			if(isset($page->name)){
				echo $page->name;
			}else{
				echo 'Template Front';
			}
		?>
	</title>
	<meta name="description" content="
	<?php
    if(isset($page->metadescription)){
        echo $page->metadescription;
    }else{
        echo 'Template Front';
    }
    ?>">
    <?= assetLoader(); ?>
</head>