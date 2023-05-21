<?php
    if(!isset($page)) {
        $page = "Accueil";
    }
?>
<nav class="navbar navbar-expand-lg navbar-dark menuRose">
    <div class="container-fluid">
        <a class="navbar-brand" href="./index.php"><img src="./images/logo-rond.png" alt="Notre Logo" style="width: 1.5em; border-radius: 50%; border: 2px solid white;"> LesFéesDesFleurs11</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav" style="display: flex; justify-content: space-between; width: 100%;">
                <div class="navbarPerso" style="display: flex;">
                    <li class="nav-item">
                        <a class="nav-link <?php if(strtolower($page) == "accueil") {echo('active');};?>" aria-current="page" href="./index.php"><i class="fa-solid fa-house"></i> Accueil</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle <?php if(strtolower($page) == "prestations") {echo('active');};?>" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-flower1"></i> Nos Prestations
                        </a>    
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="./mariage.php"><img src="./images/diamond-ring.png" style="width: 1em;"> Mariages</a></li>
                            <li><a class="dropdown-item" href="./deuil.php"><i class="fa-solid fa-cross"></i> Deuil</a></li>
                            <li><a class="dropdown-item" href="./autres-occasions.php"><i class="bi bi-flower1"></i> Toutes autres occasions</a></li>
                            <hr class="sep-2" />
                            <li><a class="dropdown-item" href="./cadeaux.php"><i class="fa-solid fa-gift"></i> Cadeaux</a></li>
                            <li><a class="dropdown-item" href="./decorations.php"><i class="bi bi-flower1"></i> Décorations</a></li>
                            <li><a class="dropdown-item" href="./show-articles-toys.php"><img src="./images/jouet.png" style="width: 1em;"> Jouts pour enfants</a></li>
                            <li><a class="dropdown-item" href="./show-articles-vaisselle.php"><img src="./images/bowl.png" style="width: 1em;"> Vaisselle</a></li>
                            <hr class="sep-2" />
                            <li><a class="dropdown-item" href="./nos-cours.php"><i class="fa-solid fa-graduation-cap"></i> Nos cours</a></li>
                            <hr class="sep-2" />
                            <li><a class="dropdown-item" href="./delivery.php"><i class="fa-solid fa-truck"></i> Nos Livraisons</a></li>
                        </ul>
                    </li>

                    <a class="nav-link <?php if(strtolower($page) == "about-us") {echo('active');};?>" aria-current="page" href="./about-us.php"><i class="fa-regular fa-circle-question"></i> À propos de nous</a>
                    <a class="nav-link <?php if(strtolower($page) == "contact") {echo('active');};?>" aria-current="page" href="./about-us.php?l=c#contact"><i class="fa-solid fa-phone"></i> Nous Contacter 04.68.93.46.59</a>
                </div>

                <?php if(isset($_SESSION["role"]) && $_SESSION["role"] == "Admin"):  ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active navbarPerso" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="display: flex; align-items: center;">
                            <?= $_SESSION["role"]?>&nbsp;
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink" style="left: -80px;">
                        
                            <li><a class="dropdown-item" style="text-align: center;"><button type="button" class="btn btn-success">Gestion <i class="fa-solid fa-gear gear"></i></button></a></li>
                            <hr class="sep-2"/>
                            <li><a class="dropdown-item" href="./worker-manager.php"><i class="fa-solid fa-user"></i> Employé(e)s</a></li>
                            <li><a class="dropdown-item" href="./delivery-manager.php"><i class="fa-solid fa-truck"></i> Livraisons</a></li>
                            <hr class="sep-2"/>
                            <li><a class="dropdown-item" href="./logout.php" style="text-align: center;"><button type="button" class="btn btn-danger">Déconnexion <i class="fa-solid fa-power-off"></i></button></a></li>
                        </ul>
                    </li>
                <?php else: ?>
                    <a class="nav-link text-center" aria-current="page" href="./login.php"><i class="fa-solid fa-right-to-bracket"></i> </a>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>