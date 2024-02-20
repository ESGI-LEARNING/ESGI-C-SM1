document.addEventListener('DOMContentLoaded', async () => {
    const accessKey = 'DSKCITSO2pfygjgKwqp8SZiiwYepEtgHvCbOExTiRnw';
    const gallery = document.querySelector('.gallery');
    const modal = document.getElementById('modal');
    const modalImage = document.getElementById('modal-image');
    const userName = document.getElementById('user-name');
    const photoTitle = document.getElementById('photo-title');
    const commentInput = document.getElementById('comment');
    const closeModalButton = document.getElementById('close-modal');
    const addCommentButton = document.getElementById('add-comment');

    if (gallery && modal && modalImage && userName && photoTitle && commentInput && closeModalButton && addCommentButton) {
        const response = await fetch(`https://api.unsplash.com/photos/?client_id=${accessKey}`);
        const data = await response.json();

        data.forEach(photo => {
            const img = document.createElement('img');
            img.src = photo.urls.small;
            img.alt = photo.alt_description;
            img.addEventListener('click', () => {
                modalImage.src = photo.urls.regular;
                userName.textContent = `${photo.user.username}`;
                const encodedArtistName = encodeURIComponent(photo.user.username);
                userName.setAttribute('data-artist-name', encodedArtistName);
                userName.setAttribute('data-artist-id', photo.user.id);
                photoTitle.textContent = `${photo.alt_description}`;
                modal.style.display = 'block';
            });
            gallery.appendChild(img);
        });

        closeModalButton.addEventListener('click', () => modal.style.display = 'none');
        addCommentButton.addEventListener('click', () => console.log(`Added comment: ${commentInput.value}`));
        userName.addEventListener('click', () => window.location.href = `/artist?name=${userName.getAttribute('data-artist-name')}`);
    }
});