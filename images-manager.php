<?php
    session_start();
    if(!isset($_SESSION['role']) || $_SESSION["role"] != "Admin") header('Location: ./login.php');
    include_once("./includes/header.inc.php");
?>

    <div class="container">
        <h1 class="text-decoration-underline text-center text-white py-3 text-decoration-underline">Gestion des photos :</h1>
        <div class="accordion" id="accordionExample">

            <!--//! Menu main -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button collapsed text-decoration-underline" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <i class="fa-regular fa-image"></i>&nbsp;Image de la page principale :
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="container">
                            <h1 class="text-center py-3 text-decoration-underline mb-0">Page principale</h1>   
                            <div class="row">
                                <div class="col-md-6 d-flex flex-column my-auto">
                                    <p class="text-dark text-center fs-3 text-decoration-underline">Image Actuelle :</p>
                                    <img src="./images/boutique.jpg" alt="" class="img-fluid rounded mt-3 mx-auto">
                                </div>
                                <div class="col-md-6 d-flex flex-column my-auto">
                                    <p class="text-dark text-center fs-3 text-decoration-underline">Nouvelle Image :</p>
                                    <img src="./images/team-cards/background-placeholder.png" id="MainActualImg" onclick="triggerClick3('#main-actual')" class="img-fluid rounded mt-3 mx-auto">
                                </div>
                            </div>

                            <div class="row">
                                <form class="row needs-validation" novalidate action="./images-manager.php" method="POST">
                                    <div class="col text-center">
                                        <label for="expertise" class="form-label text-white text-decoration-underline fw-bolder">Photo de l'employé(e)</label><br>
                                        <input type="file" accept="image/*" required onchange="actuPhoto3(this, 'MainActualImg')" id="main-actual" name="image">
                                        <div class="valid-feedback">Image valide !</div>
                                        <div class="invalid-feedback">Image invalide !</div>
                                    </div>

                                    <div class="btn-group text-center py-3">
                                        <button type="submit" name="add" class="btn btn-primary">Ajouter</button>
                                        <button type="reset" class="btn btn-danger" onclick="resetFormImage('background','MainActualImg')">Annuler</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Menu XXX -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed text-decoration-underline" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        <i class="fa-regular fa-image"></i>&nbsp;Image de la page 
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6 d-flex flex-column my-auto">
                                    <p class="text-dark text-center fs-3 text-decoration-underline">Image Actuelle :</p>
                                    <img src="./images/boutique.jpg" alt="" class="img-fluid rounded mt-3 mx-auto">
                                </div>
                                <div class="col-md-6 d-flex flex-column my-auto">
                                    <p class="text-dark text-center fs-3 text-decoration-underline">Nouvelle Image :</p>
                                    <img src="./images/team-cards/background-placeholder.png" id="actualImg" onclick="triggerClick3('#actual')" class="img-fluid rounded mt-3 mx-auto">
                                </div>
                            </div>

                            <div class="row">
                                <form class="row needs-validation" novalidate action="./images-manager.php" method="POST">
                                    <div class="col text-center">
                                        <label for="expertise" class="form-label text-white text-decoration-underline fw-bolder">Photo de l'employé(e)</label><br>
                                        <input type="file" accept="image/*" required onchange="actuPhoto3(this, 'actualImg')" id="actual" name="image">
                                        <div class="valid-feedback">Image valide !</div>
                                        <div class="invalid-feedback">Image invalide !</div>
                                    </div>
                                    <div class="btn-group text-center py-3">
                                        <button type="submit" name="add" class="btn btn-primary">Ajouter</button>
                                        <button type="reset" class="btn btn-danger" onclick="resetFormImage('background','actualImg')">Annuler</button>
                                    </div>
                                </form>
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