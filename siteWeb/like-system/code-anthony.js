function setLike(id) {

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4) {
            if (request.status == 200) {
                alert('Liked !');
            }
        }
    };
    request.open('GET', 'like-system/like.php?id=' + id);
    request.send();
}

function setDislike(id) {

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4) {
            if (request.status == 200) {
                alert('Disliked !');
            }
        }
    };
    request.open('GET', 'like-system/dislike.php?id=' + id);
    request.send();
}