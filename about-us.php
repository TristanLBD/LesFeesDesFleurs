<?php
    if(isset($_GET["l"]) && $_GET["l"] == "c") {
        $page = "contact";
    } else {
        $page = "about-us";
    }
    include_once("./includes/header.inc.php");
    include_once("./includes/DB.php");

?>
<div class="container-fluid">

<section>
    <h1 class="text-decoration-underline text-center text-white py-3">Qui sommes-nous ?</h1>
    <p class="text-white text-center fs-3">Maison fondée en 2011 , <br>nous sommes des <span class="text-decoration-underline">artisantes fleuristes diplomées</span> situées a <em class="text-decoration-underline">Saint-Marcel sur Aude</em> .</p>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6">
                <img src="./images/boutique.jpg" alt="Une photo de notre devanture" title="La devanture du magasin" class="img-fluid article" style="border: 2px solid white; border-radius: 25px;">
            </div>
            <div class="col-sm-3"></div>
        </div>
    </div>
</section>

<hr class="sep-2"/>

<section>
    <h1 class="text-decoration-underline text-center text-white py-3">Notre équipe :</h1>

    <div class="card-container flex-row-reverse">

        <?php
            $sql = $db->prepare('SELECT * FROM workers');
            try {
                $sql->execute();
                $data = $sql->fetchAll(PDO::FETCH_ASSOC);
            } catch(PDOException $e) {
                echo $e->getMessage();
                header('Location: ./worker-manager.php?worker_err=invalidlogin'); die();
            }

            foreach ($data as $row): ?>
                <?php 
                    if($row["expertise"] == "9999") {
                        $anneExpertise = "9999";
                    }  else {
                        $anneExpertise = date('Y')-$row["expertise"];
                    }
                ?>

                <div class="card article" style="background-image: linear-gradient(to bottom, rgba(0, 0, 0, 0.1), rgba(0, 0, 0, 0.1)), url('./images/team-cards/<?=$row['backgroundIMG']?>');">
                    <div class="content">
                        <div class="imgBx"><img src="./images/team-cards/<?=$row['img']?>"></div>
                        <div class="contentBx">
                            <h3><?=$row["nom"];?><br><span><?php if($row["fonction"] == "0") { echo(""); } else { echo($row["fonction"]); } ;?><br><?php if($anneExpertise == "9999") {} else { echo $anneExpertise;?> an<?php if($anneExpertise > 1){ echo("s"); }}?> <?php if($anneExpertise != "9999"){ echo(" d'expérience"); } ?></span></h3>
                        </div>
                    </div>
                    <ul class="sci">
                        <li style="--i:1">
                            <!-- <a href="#"><i class="fab fa-facebook-f"></i></a> -->
                            <a href="https://www.facebook.com/LesFeesDesFleurs" target="_blank"><i class="fa-brands fa-facebook"></i></a>
                        </li>
                        <!-- <li style="--i:2">
                            <a href="#"><i class="fab fa-twitter"></i></a>
                        </li> -->
                        <li style="--i:2">
                            <!-- <a href="#"><i class="fab fa-instagram"></i></a> -->
                            <a href="https://www.instagram.com/les.fees.des.fleurs/" target="_blank"><i class="fa-brands fa-instagram"></i></a>
                        </li>
                    </ul>
                </div>
            <?php
            endforeach;
        ?>

    </div>
</section>

<hr class="sep-2" />

<section id="contact">
    <div class="row">
        <h1 class="text-decoration-underline text-center text-white py-3">Nous contacter :</h1>
        <div class="col-lg-5 d-flex flex-column justify-content-center">
            <p class="text-white text-center fs-3">
                Nous somme situés a Saint-Marcel sur Aude.<br>
                <i class="bi bi-mailbox"></i> Rte de Saint-Pons, 11120 <span class="text-decoration-underline">Saint-Marcel-sur-Aude</span><br>
                <i class="fa-solid fa-envelope"></i> <a href="mailto:lesfeesdesfleurs11@gmail.com" class="text-white text-decoration-none" >lesfeesdesfleurs11@gmail.com</a><br>
                <i class="fa-solid fa-phone"></i> 04 68 93 46 59<br>
            </p>
            <table class="table text-center text-white horaires-table">
                <thead>
                    <tr>
                        <th scope="col"><i class="fa-solid fa-clock"></i></th>
                        <th scope="col">Lundi</th>
                        <th scope="col">Du Mardi au Samedi</th>
                        <th scope="col">Dimanche et jours fériés</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">Matin</th>
                        <td class="redText">Fermé</td>
                        <td class="greenText">9h - 12h30</td>
                        <td class="greenText">10h - 12h</td>
                    </tr>
                    <tr>
                        <th scope="row">Après Midi</th>
                        <td class="redText">Fermé</td>
                        <td class="greenText">14h - 19h</td>
                        <td class="redText">Fermé</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="col-lg-7">
            <div class="container">

            <form class="row g-3 needs-validation" novalidate action="https://formsubmit.co/feb0d87dfcc4898e1428f9d4c02605d0" method="POST">
                <!-- Honeypot -->
                <input type="text" name="_honey" style="display: none;">

                <!-- Disable Captcha -->
                <input type="hidden" name="_captcha" value="false">

                <input type="hidden" name="_next" value="http://127.0.0.1/fleuristev3/thanks.php">
                <!-- <input type="hidden" name="_next" value="https://yourdomain.co/thanks.html"> -->


                <div class="col-md-6">
                    <label for="prenom" class="form-label text-white text-decoration-underline fw-bolder">Prénom :</label>
                    <input type="text" class="form-control" name="Prenom" id="prenom" placeholder="Ex : LesFées" required>
                    <div class="valid-feedback">Prénom valide !</div>
                    <div class="invalid-feedback">Prénom invalide !</div>
                </div>
                <div class="col-md-6">
                    <label for="nom" class="form-label text-white text-decoration-underline fw-bolder">Nom :</label>
                    <input type="text" class="form-control" name="Nom" id="nom" placeholder="Ex : DesFleurs" required>
                    <div class="valid-feedback">Nom valide !</div>
                    <div class="invalid-feedback">Nom invalide !</div>
                </div>
                <div class="col-md-8">
                    <label for="emailInfo" class="form-label text-white text-decoration-underline fw-bolder">E-mail :</label>
                    <input type="email" class="form-control" name="email" id="emailInfo" placeholder="Ex : lesfees@gmail.com" required>
                    <div class="valid-feedback">E-mail valide !</div>
                    <div class="invalid-feedback">E-mail invalide !</div>
                </div>
                <div class="col-md-4">
                    <label for="phoneNumber" class="form-label text-white text-decoration-underline fw-bolder">Numéro de télephone :</label>
                    <input type="text" class="form-control" name="phone" pattern="^((\+33|0)[1-9])(\d{2})(\d{2})(\d{2})(\d{2})$" id="phoneNumber" placeholder="00 00 00 00 00" required>
                    <!-- <input type="text" class="form-control" name="phone" pattern="^((\+)33|0)[1-9](\d{2}){4}$" id="phoneNumber" placeholder="00 00 00 00 00" required> -->
                    <div class="valid-feedback">Numéro valide !</div>
                    <div class="invalid-feedback">Numéro invalide !</div>
                </div>
                <div class="col-md-12">
                    <label for="comments" class="form-label text-white text-decoration-underline fw-bolder">Sujet :</label>
                    <select class="form-select" aria-label="Default select example" name="Sujet" required>
                        <option selected disabled style="display:none;">Choisissz l'une des raisons ci-dessous :</option>
                        <option value="Mariage"><img src="./images/diamond-ring.png" style="width: 1em;">Mariage</option>
                        <option value="Deuil"><i class="fa-solid fa-cross"></i> Deuil</option>
                        <option value="Cadeaux"><i class="fa-solid fa-gift"></i> Cadeaux</option>
                        <option value="Décoration"><i class="bi bi-flower1"></i> Décoration</option>
                        <option value="Livraisons"><i class="fa-solid fa-truck"></i> Livraisons</option>
                        <option value="Autre.."><i class="fa-solid fa-circle-question"></i> Autre..</option>
                    </select>
                    <div class="valid-feedback">Message valide !</div>
                    <div class="invalid-feedback">Veuillez préciser votre problème ou question !</div>
                </div>
                <div class="col-md-12">
                    <label for="comments" class="form-label text-white text-decoration-underline fw-bolder">Un soucis , une question ?</label>
                    <textarea class="form-control" id="comments" name="Commentaire,&nbsp;Question" rows="3" placeholder="A propos de .." required></textarea>
                    <div class="valid-feedback">Message valide !</div>
                    <div class="invalid-feedback">Veuillez préciser votre problème ou question !</div>
                </div>  
                <div class="text-center"><button type="submit" class="btn btn-primary">Envoyer</button></div>
            </form>
            
            </div>
        </div>
    </div>



    
</section>

<hr class="sep-2" />

<section>
    <h1 class="text-decoration-underline text-center text-white py-3">Ou nous trouver :</h1>
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d181.63585204392183!2d2.9186393385551344!3d43.2477826765455!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12b1b1b5ed087d7f%3A0xaeef62896bc352e!2sLes%20F%C3%A9es%20des%20Fleurs!5e0!3m2!1sfr!2sfr!4v1673451525680!5m2!1sfr!2sfr" width="100%" height="500" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</section>
</div>

<?php
    include_once("./includes/footer.inc.php");
?>
