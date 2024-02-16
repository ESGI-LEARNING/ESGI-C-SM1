let checkboxes = document.getElementsByClassName('hiddenCheckbox');
if (checkboxes) {
	for (let i = 0; i < checkboxes.length; i++) {
		checkboxes[i].addEventListener('change', function() {
			let hiddenForm = this.closest('form'); // Sélectionner le formulaire parent
			hiddenForm.value = this.checked ? 1 : 0;
			hiddenForm.submit();
		});
	}
}

