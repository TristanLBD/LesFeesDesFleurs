<?php
    include_once("./includes/header.inc.php");
?>

    <div class="container-fluid d-flex align-items-center justify-content-center my-auto">
        <div class="text-center row d-flex flex-column align-items-center justify-content-center">
            <div class=" col-md-6">
                <p class="fs-1 fw-bolder text-decoration-underline text-white">Erreur !</p>
                <img src="./images/404-error-bordered.png" alt="" class="img-fluid">
            </div>
            <div class=" col-md-6 mt-5 text-white">
                <p class="fs-3"> <span class="text-danger">Opps!</span> Une erreur est survenue !</p>
                <p class="lead">
                    La page que vous recherchez n'existe pas.
                </p>
                <a href="./index.php" class="btn btn-primary">Retourner a l'Acceuil <i class="fa-solid fa-house"></i></a>
            </div>
        </div>
    </div>

<?php
    include_once("./includes/footer.inc.php");
?>