<?php
    $page = "prestations";
    include_once("./includes/header.inc.php");
?>

    <div class="container my-3">
        <h1 class="text-decoration-underline text-center text-white py-2">Nous cours :</h1>
        <p class="text-white text-center fs-4">
            Nous vous proposons un cours <span class="text-decoration-underline">une fois par mois</span>, avec des <span class="text-decoration-underline">thèmes variés</span>.<br>
            Pour plus d'informations, veuillez nous <a href="./about-us.php#contact">contacter</a> au 04 68 93 46 59 ou passer en magasin.<br>
            <span class="text-decoration-underline"><span class="text-info">45 €</span> sont à prevoir pour y participer et repartir avec votre création.</span>
        </p>

        <div class="row justify-content-md-center">
            <div class="col-md-8 d-flex justify-content-center">
                <img src="./images/cours.png" alt="Photo de l'un de nos cours" title="Photo de l'un de nos cours" class="img-fluid" style="border: 2px solid white; border-radius: 25px; max-height: 600px;">
            </div>
        </div>

    </div>

<?php
    include_once("./includes/footer.inc.php");
?>