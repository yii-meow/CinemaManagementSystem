function toggleLike(event, element) {
    event.preventDefault();
    const postID = element.closest('.action-item').getAttribute('data-post-id');

    fetch(`${rootUrl}/PostInteraction/likeAction`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: new URLSearchParams({
            postID: postID,
            userID: userID
        })
    })
        .then(response => response.text()) // Get raw text response
        .then(text => {
            console.log('Raw response:', text); // for debugging
            try {
                const data = JSON.parse(text); // Parse JSON
                if (data.success) {
                    const likeIcon = document.getElementById('like-button-' + postID);
                    const likeCountElem = document.getElementById('like-count-' + postID);

                    // Consistent class names for liked/unliked
                    likeIcon.className = data.isLiked ? 'fa fa-heart liked' : 'fa fa-heart-o unliked';

                    likeCountElem.textContent = data.likeCount;
                } else {
                    console.error('Error updating like status:', data.error);
                }
            } catch (e) {
                console.error('Invalid JSON response:', text);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
}
