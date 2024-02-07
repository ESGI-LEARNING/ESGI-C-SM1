let avatar_input = document.querySelector('#form__avatar input')
let wrapper = document.querySelector('#wrapper__avatar_img')

if (avatar_input && wrapper) {
	avatar_input.addEventListener('change', async e => {
		const formData = new FormData()
		formData.append('avatar[]', e.target.files[0])

		const response = await fetch('/profile/avatar', {
			method: 'POST',
			body: formData
		}).then(response => response.text())

		window.location.reload()
	})
}