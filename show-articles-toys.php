<?php
    $page = "prestations";
    include_once("./includes/header.inc.php");
?>

<span class="text-decoration-underline text-center text-white pt-3 fs-1">Nos jouets pour enfants :</span></span>
<span class="text-center text-white fs-3">
    Ces articles peuvent être <span class="text-decoration-underline">offerts</span> , cependant ils sont en <span class="text-danger text-decoration-underline">quantité limité</span>, <br>
    appelez nous ou passez en magasin pour de plus amples informations !
</span>
<div class="album py-5">
    <div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">


            <div class="col article">
                <div class="card shadow-sm">
                    <div class="card-imgBox">
                        <img src="./images/articles/horloges.png" class="img-fluid" style="height: 100%; width: 100%; object-fit: cover;">
                    </div>

                    <div class="card-body">
                        <span class="card-title text-decoration-underline fw-bolder">Horloges</span>
                        <p class="card-text">Nous possédons différentes <span class="text-decoration-underline">horloges mécaniques design</span>.<br><br>
                        <span class="text-danger">Pour de plus amples informations veuillez nous <a href="./about-us.php#contact">contacter</a> ou passer en magasin.</span></p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <a class="btn btn-danger" role="button">Marque : Cades</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <div class="col article">
                <div class="card shadow-sm">
                    <div class="card-imgBox">
                        <img src="./images/articles/bougie.jpg" class="img-fluid" style="height: 100%; width: 100%; object-fit: cover;">
                    </div>

                    <div class="card-body">
                        <span class="card-title text-decoration-underline fw-bolder">Bougies</span>
                        <p class="card-text">Nous possédons différentes <span class="text-decoration-underline">Bougies Design</span>.<br><br>
                        <span class="text-danger">Pour de plus amples informations veuillez nous <a href="./about-us.php#contact">contacter</a> ou passer en magasin.</span></p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <a class="btn btn-danger" role="button">Marque : Drake</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <div class="col article">
                <div class="card shadow-sm">
                    <div class="card-imgBox">
                        <img src="./images/articles/parfum.jpg" class="img-fluid" style="height: 100%; width: 100%; object-fit: cover;">
                    </div>

                    <div class="card-body">
                        <span class="card-title text-decoration-underline fw-bolder">Parfums et Diffuseurs</span>
                        <p class="card-text">Nous possédons différents <span class="text-decoration-underline">Parfums et Diffuseurs de Parfums</span>.<br><br>
                        <span class="text-danger">Pour de plus amples informations veuillez nous <a href="./about-us.php#contact">contacter</a> ou passer en magasin.</span></p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <a class="btn btn-danger" role="button">Marque : Mathilde M</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>

<?php
    include_once("./includes/footer.inc.php");
?>