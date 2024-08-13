document.addEventListener('DOMContentLoaded', function () {
    const popups = document.querySelectorAll('.wp-block .popup-content');
    popups.forEach(popup => {
        popup.addEventListener('click', function () {
            alert('Popup content: ' + this.innerText);
        });
    });
});
