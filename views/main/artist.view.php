<style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f8f8;
            color: #333;
        }

        .artist-info {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 16px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .artist-info img {
            max-width: 100%;
            border-radius: 8px;
            margin-top: 20px;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 15px;
        }

        .gallery {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 10px;
            margin-top: 20px;
        }

        .gallery img {
            width: 100%;
            border-radius: 8px;
            cursor: pointer;
            transition: transform 0.3s ease-in-out;
        }

        .gallery img:hover {
            transform: scale(1.05);
        }
        .back-to-gallery{
            display: block;
            margin-top: 30px;
            text-decoration: none;
            color: #333;
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

    #photo-title {
        font-size: 16px;
        margin-bottom: 10px;
    }

    #comment {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        resize: none;
    }

    button {
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    button:hover {
        background-color: #45a049;
    }


        


    </style>

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

