<body>
<div class="artist-info" id="artist-info">
        <h1 id="artist-name"></h1>
        <div id="artist-works" class="gallery"></div>
        <a href="/gallery" class="back-to-gallery">Back to Gallery</a>
    </div>
    <div class="modal" id="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <img id="modal-image" alt="Enlarged Image">
            <div id="modal-info">
                <p id="photo-title"></p>
                <textarea id="comment" placeholder="Add a comment"></textarea>
                <button onclick="addComment()">Add Comment</button>
                <div id="comments-container"></div>
            </div>
        </div>
    </div>



</body>

<script>// artist.js
  document.addEventListener('DOMContentLoaded', () => {
        const artistNameElement = document.getElementById('artist-name');
        const artistWorksElement = document.getElementById('artist-works');
        const modal = document.getElementById('modal');
        const modalImage = document.getElementById('modal-image');
        const photoTitle = document.getElementById('photo-title');
        const commentInput = document.getElementById('comment');
     

        // Fonction pour ouvrir le modal
        const openModal = (photo) => {
            modalImage.src = photo.urls.regular;
            const encodedArtistName = encodeURIComponent(photo.user.username);
         
            photoTitle.textContent = `Title: ${photo.alt_description}`;
            modal.style.display = 'block';
        };

        // Fonction pour fermer le modal
        const closeModal = () => {
            modal.style.display = 'none';
        };

        // Fonction pour ajouter un commentaire
        const addComment = () => {
            const comment = commentInput.value;
            // Ajoutez votre logique pour gérer le commentaire (par exemple, l'envoyer à un serveur)
            console.log(`Added comment: ${comment}`);
        };
        

        // Récupérer le nom de l'artiste depuis l'URL
        const urlParams = new URLSearchParams(window.location.search);
        const artistName = urlParams.get('name');

        // Mettre à jour le titre de la page avec le nom de l'artiste
        document.title = `Artist Profile - ${artistName}`;
        artistNameElement.textContent = `Artist: ${artistName}`;

        // Utiliser l'API Unsplash pour récupérer les œuvres de l'artiste
        const accessKey = 'DSKCITSO2pfygjgKwqp8SZiiwYepEtgHvCbOExTiRnw';
        fetch(`https://api.unsplash.com/users/${artistName}/photos/?client_id=${accessKey}&per_page=20`)
        .then(response => response.json())
        .then(data => {
            data.forEach(photo => {
                const img = document.createElement('img');
                img.src = photo.urls.small;
                img.alt = photo.alt_description;
                img.addEventListener('click', () => openModal(photo));
                artistWorksElement.appendChild(img);
            });
        });

        // Associer la fonction de fermeture du modal au bouton de fermeture
        document.querySelector('.close').addEventListener('click', closeModal);

        // Associer la fonction d'ajout de commentaire au bouton d'ajout de commentaire
        document.getElementById('modal-info').addEventListener('click', addComment);
    });

    
</script>

