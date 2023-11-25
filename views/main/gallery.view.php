<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f8f8;
        }

        .gallery {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            padding: 20px;
        }

        .gallery img {
            width: 300px;
            height: auto;
            object-fit: cover;
            margin: 10px;
            cursor: pointer;
            transition: transform 0.3s ease-in-out;
            border-radius: 8px;
        }

        .gallery img:hover {
            transform: scale(1.05);
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            overflow: auto; /* Permet le défilement si le contenu du modal est trop grand */
        }

        .modal-content {
            position: relative;
            max-width: 50%; /* Ajustez la largeur du contenu du modal */
            margin: auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 16px rgba(0, 0, 0, 0.2);
            overflow: auto; /* Permet le défilement si le contenu du modal est trop grand */
        }

        .close {
            color: #333;
            float: right;
            font-size: 24px;
            font-weight: bold;
            cursor: pointer;
        }

        #modal-image {
            max-width: 100%;
            max-height: 60vh;
            border-radius: 8px;
            box-shadow: 0 0 16px rgba(0, 0, 0, 0.2);
        }

        #modal-info {
            margin-top: 20px;
        }

        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            padding: 10px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
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
            <button onclick="addComment()">Add Comment</button>
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
