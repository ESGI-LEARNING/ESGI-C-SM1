document.addEventListener('DOMContentLoaded', () => {
    const artistNameElement = document.getElementById('artist-name');
    const artistWorksElement = document.getElementById('artist-works');
    const modal = document.getElementById('modal');
    const modalImage = document.getElementById('modal-image');
    const photoTitle = document.getElementById('photo-title');
    const commentInput = document.getElementById('comment');
    const closeModalButton = document.getElementById('close-modal');
    const addCommentButton = document.getElementById('add-comment');

    if (artistNameElement && artistWorksElement && modal && modalImage && photoTitle && commentInput && closeModalButton && addCommentButton) {
        const artistName = new URLSearchParams(window.location.search).get('name');

        artistNameElement.textContent = `Henri Cartier-Bresson`;

        fetchArtistWorks(artistName);

        closeModalButton.addEventListener('click', () => modal.style.display = 'none');
        addCommentButton.addEventListener('click', () => console.log(`Added comment: ${commentInput.value}`));
        document.getElementById('back-to-gallery').addEventListener('click', () => window.location.href = '/gallery');

        function openModal(photo) {
            modalImage.src = photo.urls.regular;
            photoTitle.textContent = `Title: ${photo.alt_description}`;
            modal.style.display = 'block';
        }

        function fetchArtistWorks(artistName) {
            const accessKey = 'DSKCITSO2pfygjgKwqp8SZiiwYepEtgHvCbOExTiRnw';
            fetch(`https://api.unsplash.com/users/${artistName}/photos/?client_id=${accessKey}&per_page=20`)
                .then(response => response.json())
                .then(data => data.forEach(photo => {
                    const img = document.createElement('img');
                    img.src = photo.urls.small;
                    img.alt = photo.alt_description;
                    img.addEventListener('click', () => openModal(photo));
                    artistWorksElement.appendChild(img);
                }))
                .catch(error => console.error('Error fetching artist works:', error));
        }
    }
});