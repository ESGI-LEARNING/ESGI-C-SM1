
<body>

<div class="gallery"></div>

<div class="modal" id="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <img id="modal-image" alt="Enlarged Image">
        <div id="modal-info">
            <p id="user-name"></p>
            <p id="photo-title"></p>
            <textarea id="comment" placeholder="Add a comment"></textarea>
            <button onclick="addComment()">Add Comment</button>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="scripts.js"></script>
</body>

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
}

.modal-content {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 16px rgba(0, 0, 0, 0.2);
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
    max-height: 70vh;
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


<script>
const accessKey = 'DSKCITSO2pfygjgKwqp8SZiiwYepEtgHvCbOExTiRnw';
const gallery = $('.gallery');
const modal = $('#modal');
const modalImage = $('#modal-image');
const userName = $('#user-name');
const photoTitle = $('#photo-title');
const commentInput = $('#comment');

// Fetch photos from Unsplash API
$.ajax({
    url: `https://api.unsplash.com/photos/?client_id=${accessKey}`,
    method: 'GET',
    success: function (data) {
        data.forEach(photo => {
            const img = $('<img>').attr('src', photo.urls.small).attr('alt', photo.alt_description);
            img.click(() => openModal(photo));
            gallery.append(img);
        });
    }
});

function openModal(photo) {
    modalImage.attr('src', photo.urls.regular);
    userName.text(`By: ${photo.user.username}`);
    photoTitle.text(`Title: ${photo.alt_description}`);
    modal.show();
}

function closeModal() {
    modal.hide();
}

function addComment() {
    const comment = commentInput.val();
    // Add your logic to handle the comment (e.g., send it to a server)
    console.log(`Added comment: ${comment}`);
}

</script>
