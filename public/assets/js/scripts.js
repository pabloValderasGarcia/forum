var date = new Date();
date.setFullYear( date.getFullYear() - 18 );

let maxBirthDate;
if (date.getDate() > 0 && date.getDate() < 10) {
    maxBirthDate = date.getFullYear() + '-' + date.getMonth() + '-0' + date.getDate();
} else {
    maxBirthDate = date.getFullYear() + '-' + date.getMonth() + '-' + date.getDate();
}

const dates = document.querySelectorAll('.birthDate');
dates.forEach(date => {
    date.setAttribute('max', maxBirthDate);
});




const categoryButtons = document.querySelectorAll('.categoryPostButton');

categoryButtons.forEach(button => {
    button.onclick = () => {
        document.getElementById('categoryPost').setAttribute("value", button.textContent);
    }
});




var path = window.location.pathname;
if (path.includes('post') && /\d/.test(path)) {
    document.getElementById('secretIdPost').setAttribute('value', 
    document.getElementById('sendComment').getAttribute('idPost'));
}




var loadFile = function (event) {
    var image = document.getElementById("output");
    image.src = URL.createObjectURL(event.target.files[0]);
    var changeButton = document.getElementById('changeImage');
    changeButton.style.color = 'gray';
    changeButton.style.borderLeft = '3px solid green';
    changeButton.style.borderRight = '3px solid green';
    changeButton.style.borderBottom = '4px solid green';
};




let deletesPost = document.querySelectorAll('.deleteLinkPost');
deletesPost.forEach(deletes => {
    let url = deletes.dataset.url;
    deletes.addEventListener("click", () => {
        document.getElementById('deleteFormPost').action = url;
    });
});

let deletesComment = document.querySelectorAll('.deleteLinkComment');
deletesComment.forEach(deletes => {
    let url = deletes.dataset.url;
    deletes.addEventListener("click", () => {
        document.getElementById('deleteFormComment').action = url;
    });
});