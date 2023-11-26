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


    </style>

<body>

<div class="artist-info" id="artist-info">
    <h1 id="artist-name"></h1>
    <div id="artist-works" class="gallery"></div>
    <a href="/gallery" class="back-to-gallery">Back to Gallery</a>
</div>


</body>

<script>// artist.js
document.addEventListener('DOMContentLoaded', () => {
    const artistNameElement = document.getElementById('artist-name');
    const artistWorksElement = document.getElementById('artist-works');

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

    // Fonction pour ouvrir le modal (similaire à votre code existant)
    const openModal = (photo) => {
        // Mettez ici le code pour ouvrir le modal avec les détails de la photo
    };
});
</script>

