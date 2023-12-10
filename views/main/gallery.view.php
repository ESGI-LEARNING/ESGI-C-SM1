<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery</title>

</head>
<body>

<div class="gallery"></div>

<div class="modal" id="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <img id="modal-image" alt="Enlarged Image">
        <div id="modal-info">
        <p id="user-name" onclick="redirectToArtistPage()"><?php echo $photo->user->username; ?></p>
            <p id="photo-title"></p>
            <textarea id="comment" placeholder="Add a comment"></textarea>
            <button class="btn_comment" onclick="addComment()">Add Comment</button>
        </div>
    </div>
</div>

<script src="scripts.js"></script>
<script>
   const accessKey = 'DSKCITSO2pfygjgKwqp8SZiiwYepEtgHvCbOExTiRnw';
    const gallery = document.querySelector('.gallery');
    const modal = document.getElementById('modal');
    const modalImage = document.getElementById('modal-image');
    const userName = document.getElementById('user-name');
    const photoTitle = document.getElementById('photo-title');
    const commentInput = document.getElementById('comment');

    // Fetch photos from Unsplash API
    fetch(`https://api.unsplash.com/photos/?client_id=${accessKey}`)
        .then(response => response.json())
        .then(data => {
            data.forEach(photo => {
                const img = document.createElement('img');
                img.src = photo.urls.small;
                img.alt = photo.alt_description;
                img.addEventListener('click', () => openModal(photo));
                gallery.appendChild(img);
            });
        });

        const openModal = (photo) => {
    modalImage.src = photo.urls.regular;
    userName.textContent = `By: ${photo.user.username}`;
    const encodedArtistName = encodeURIComponent(photo.user.username);
    userName.setAttribute('data-artist-name', encodedArtistName);
    // Ajoutez l'ID de l'utilisateur comme attribut data
    userName.setAttribute('data-artist-id', photo.user.id);
    photoTitle.textContent = `Title: ${photo.alt_description}`;
    modal.style.display = 'block';
};


    const closeModal = () => {
        modal.style.display = 'none';
    };

    const addComment = () => {
        const comment = commentInput.value;
        // Add your logic to handle the comment (e.g., send it to a server)
        console.log(`Added comment: ${comment}`);
    };

    const redirectToArtistPage = () => {
        const artistName = userName.getAttribute('data-artist-name');
        window.location.href = `/artist?name=${artistName}`;
    };
</script>

</body>
</html>
