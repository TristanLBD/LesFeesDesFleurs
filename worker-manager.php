<?php
    session_start();
    if(!isset($_SESSION['role']) || $_SESSION["role"] != "Admin") header('Location: ./login.php');

    include_once("./includes/DB.php");

    if(isset($_GET["delete"])) {
        $id = htmlspecialchars($_GET["delete"]);

        $getImg = $db->prepare('SELECT nom,img, backgroundIMG FROM workers WHERE id = :mid');
        try {
            $getImg->execute(array(':mid' => $id));
            $checker = $getImg->fetch(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo $e->getMessage();
            header('Location: ./worker-manager.php?worker_err=invalidlogin'); die();
        }

        $req = $db->prepare('DELETE FROM workers WHERE id = :mid');
        try {
            $req->execute(array(':mid' => $id));
            //! Suppression des images de profil
            if($checker["img"] != "photo-placholder.png") {
                unlink("images/team-cards/".$checker["img"]);
            }
            if($checker["backgroundIMG"] != "background-placeholder.png") {
                unlink("images/team-cards/".$checker["backgroundIMG"]);
            }
            header('Location: ./worker-manager.php?worker_err=deleted&nom='.$checker["nom"]); die();
        } catch(PDOException $e) {
            echo $e->getMessage();
            header('Location: ./worker-manager.php?worker_err=invalidlogin'); die();
        }
    }

    if(isset($_POST["envoyer"])) {
        $nom = htmlspecialchars($_POST["nom"]);
        $fonction = htmlspecialchars($_POST["fonction"]);
        $expertise = htmlspecialchars($_POST["expertise"]);
        
        $erreur = False;

        if(!$erreur) {
            $req = $db->prepare('INSERT INTO workers (nom, expertise, fonction) VALUES (:nom, :expertise, :fonction)');

            try {
                $req->execute(array(
                    ':nom' => $nom,
                    ':expertise' => $expertise,
                    ':fonction' => $fonction
                ));
                //! on redirige pas ici car on check et traite les images
            } catch(PDOException $e) {
                echo $e->getMessage();
                header('Location: ./worker-manager.php?worker_err=invalidlogin');
            }	
        } else {
            echo "On a trouvé des erreurs dans le filtrage des informations";
        }

        //! gerer la photo de profil
        if(file_exists($_FILES['image']['tmp_name']) || is_uploaded_file($_FILES['image']['tmp_name'])) {
            $urlPhoto = $_FILES['image'];
            $nom_photo = $urlPhoto['name'];

            $Photoextension = explode(".", $nom_photo);
            $Photoext = $Photoextension[count($Photoextension) - 1];

            if (strlen($nom_photo)==0) {
                $nom_photo="photo-placholder.png";
            }

            $sql = $db->prepare('UPDATE workers SET img = :img where nom = :nom');

            try {
                $sql->execute(array(
                    ':img' => $nom.'.'.$Photoext,
                    ':nom' => $nom
                ));
                move_uploaded_file($urlPhoto['tmp_name'],'images/team-cards/'.$nom.'.'.$Photoext);
            } catch(PDOException $e) {
                echo $e->getMessage();
                header('Location: ./worker-manager.php?worker_err=failedupdate'); die();
            }
        }
        
        //! Vérifie que le background ait bien été upload
        if(file_exists($_FILES['image2']['tmp_name']) || is_uploaded_file($_FILES['image2']['tmp_name'])) {
            $urlPhoto = $_FILES['image2'];
            $nom_photo = $urlPhoto['name'];

            $Photoextension = explode(".", $nom_photo);
            $Photoext = $Photoextension[count($Photoextension) - 1];

            if (strlen($nom_photo)==0) {
                $nom_photo="photo-placholder.png";
            }

            $sql = $db->prepare('UPDATE workers SET backgroundIMG = :img where nom = :nom');

            try {
                $sql->execute(array(
                    ':img' => $nom.'-background.'.$Photoext,
                    ':nom' => $nom
                ));
                unlink("images/team-cards/".$data["backgroundIMG"]);
                move_uploaded_file($urlPhoto['tmp_name'],'images/team-cards/'.$nom.'-background.'.$Photoext);
            } catch(PDOException $e) {
                echo $e->getMessage();
                header('Location: ./worker-manager.php?worker_err=failedupdate'); die();
            }
        }

        header('Location: ./worker-manager.php?worker_err=success&name='.$nom);
    }

    include_once("./includes/header.inc.php");

?>
    <div class="container my-3">
    <p class="text-white text-center fs-3 text-decoration-underline">Gestion du personnel :</p>
            
        <?php
            if(isset($_GET['worker_err'])) {
                $err = htmlspecialchars($_GET['worker_err']);

                switch($err) {
                    case 'updated':
                    ?>
                        <div class="alert alert-success text-center">
                            <strong><i class="fa-solid fa-triangle-exclamation"></i> Succès :</strong> L' employé(e) <?php if(isset($_GET['nom'])) { echo(ucwords(htmlspecialchars($_GET["nom"]))); } ?> à correctement été modifié(e) !
                        </div>
                    <?php
                    break;

                    case 'deleted':
                    ?>
                        <div class="alert alert-warning text-center">
                            <strong><i class="fa-solid fa-triangle-exclamation"></i> Attention :</strong> L'employé(e) <?php if(isset($_GET['nom'])) { echo(ucwords(htmlspecialchars($_GET["nom"]))); } ?> viens d'être supprimé(e) !
                        </div>
                    <?php
                    break;

                    case 'failedupdate':
                    ?>
                        <div class="alert alert-danger text-center">
                            <strong><i class="fa-solid fa-circle-xmark"></i> Erreur :</strong> Un problème est survenu lors de la mise a jour de l'employé(e), veuillez reessayer  plus tard.
                        </div>
                    <?php
                    break;

                    case 'success':
                    ?>
                        <div class="alert alert-success text-center">
                            <strong><i class="fa-solid fa-circle-check"></i> Succès :</strong> L' employé(e) <?php if(isset($_GET['nom'])) { echo(ucwords(htmlspecialchars($_GET["nom"]))); } ?> à correctement été ajouté(e) !
                        </div>
                    <?php
                    break;

                    case 'invalidlogin':
                    ?>
                        <div class="alert alert-danger text-center">
                            <strong><i class="fa-solid fa-circle-xmark"></i> Erreur :</strong> Problème lors de la connection , veuillez essayer plus tard.
                        </div>
                    <?php
                    break;
                }
            }
        ?>



        <div class="d-flex align-content-start flex-wrap justify-content-center">







            <?php
                $check = $db->prepare('SELECT id,nom,img FROM workers');
                try {
                    $check->execute();
                    $data = $check->fetchAll(PDO::FETCH_ASSOC);
                } catch(PDOException $e) {
                    echo $e->getMessage();
                    header('Location: ./worker-manager.php?worker_err=invalidlogin'); die();
                }

                foreach ($data as $row): ?>
                    <div class="py-2 px-3 rounded m-2 text-center bg-white article" style="height: 175px;">
                        <img src="./images/team-cards/<?=$row["img"];?>" class="img-fluid rounded" style="max-height: 100px;"><br>
                        <span class="text-decoration-underline"><?=$row["nom"];?></span><br>
                        <div class="btn-group">
                            <a class="btn btn-warning" href="./worker-update.php?id=<?=$row["id"];?>" role="button">Modifier</a>
                            <a class="btn btn-danger" href="./worker-manager.php?delete=<?=$row["id"];?>&name=<?=$row["nom"];?>" role="button">Supprimer</a>
                        </div>
                    </div>
                <?php
                endforeach;
            ?>

        </div>



        <hr class="sep-2" />
        <p class="text-white text-center fs-3 text-decoration-underline">Ajout d'un membre du personnel :</p>


        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-lg-6">
                <p class="text-white text-center fs-3 text-decoration-underline">Photo de l'employé(e) :</p>
                <img onclick="triggerClick3('#image')" src="./images/team-cards/photo-placholder.png" id="photo" class="img-fluid d-flex mx-auto my-3 rounded" style="max-height: 500px; border: 2px solid white;">
            </div>

            <div class="col-lg-6">
                <p class="text-white text-center fs-3 text-decoration-underline">Image de fond :</p>
                <img onclick="triggerClick3('#image2')" src="./images/team-cards/background-placeholder.png" id="photo2" class="img-fluid d-flex mx-auto my-3 rounded" style="max-height: 500px; border: 2px solid white;">
            </div>
        </div>

        <hr class="sep-2" />

        <form class="row g-3 needs-validation" novalidate action="./worker-manager.php" method="POST" enctype="multipart/form-data">

            <div class="col-md-4">
                <label for="nom" class="form-label text-white text-decoration-underline fw-bolder">Nom de l'Employé(e) :</label>
                
                <input type="text" required class="form-control" name="nom" id="nom" placeholder="Ex : Laurie" required>
                <div class="valid-feedback">Prénom valide !</div>
                <div class="invalid-feedback">Prénom invalide !</div>
            </div>

            <div class="col-md-4">
                <label for="fonction" class="form-label text-white text-decoration-underline fw-bolder">Fonction de l'Employé(e) :</label>
                <input type="text" required class="form-control" name="fonction" id="fonction" placeholder="Ex : Fleuriste" required>
                <div class="valid-feedback">Fonction valide !</div>
                <div class="invalid-feedback">Fonction invalide !</div>
            </div>
            
            <div class="col-md-4">
                <label for="expertise" class="form-label text-white text-decoration-underline fw-bolder">Année de début d'activité :</label>
                <input type="number" required class="form-control" name="expertise" id="expertise" placeholder="Ex : 2003" required>
                <div class="valid-feedback">Expertise valide !</div>
                <div class="invalid-feedback">Expertise invalide !</div>
            </div>

            <div class="col-md-6">
                <label for="expertise" class="form-label text-white text-decoration-underline fw-bolder">Photo de l'employé(e)</label><br>
                <input type="file" accept="image/*" onchange="actuPhoto3(this, 'photo')" id="image" name="image">
                <div class="valid-feedback">Image valide !</div>
                <div class="invalid-feedback">Image invalide !</div>
            </div>

            <div class="col-md-6">
                <label for="expertise" class="form-label text-white text-decoration-underline fw-bolder">Image de fond :</label><br>
                <input type="file" accept="image/*" onchange="actuPhoto3(this, 'photo2')" id="image2" name="image2">
                <div class="valid-feedback">Image valide !</div>
                <div class="invalid-feedback">Image invalide !</div>
            </div>

            <div class="btn-group text-center py-3">
                <button type="submit" name="envoyer" class="btn btn-primary">Ajouter</button>
                <button type="reset" class="btn btn-danger" onclick="resetFormImage('image','photo'), resetFormImage('background','photo2')">Annuler</button>
            </div>
        </form>
    </div>
<?php
    include_once("./includes/footer.inc.php");
?>

