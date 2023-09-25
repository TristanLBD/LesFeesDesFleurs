//! Page Loader
window.onload = function () {
    var loaderContent = document.querySelector('.loader');
    removeFadeOut(loaderContent, 1500);
};

function removeFadeOut( el, speed ) {
    var seconds = speed/1000;
    el.style.transition = "opacity "+seconds+"s ease";

    el.style.opacity = 0;
    document.body.style.overflowY = "scroll";

    setTimeout(function() {
        el.parentNode.removeChild(el);
    }, speed);
};

//! Bootstrap Form Validate
(function() {
    'use strict';
    window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
        form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
        });
    }, false);
})();

function triggerClick3(id) {
    document.querySelector(id).click();
}

function actuPhoto3(element,img) {
    var image = document.getElementById(img);
    var fReader = new FileReader();
    fReader.readAsDataURL(element.files[0]);
    fReader.onloadend = function(event) {
        var imgToChange = document.getElementById(img);
        imgToChange.src = event.target.result;
    }
}

function resetFormImage(type, target) {
    if (type == "background") {
        var imgToChange = document.getElementById(target);
        imgToChange.src = "./images/team-cards/background-placeholder.png";
    } else if (type == "image") {
        var imgToChange = document.getElementById(target);
        imgToChange.src = "./images/team-cards/photo-placholder.png";
    } //! img profile
}