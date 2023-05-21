<?php
    session_start();
    if(!isset($_SESSION['role']) || $_SESSION["role"] != "Admin") header('Location: ./login.php');

    include_once("./includes/DB.php");
    if(!isset($_GET["id"])) { header('Location: ./worker-manager.php'); die(); }
    
    $id = htmlspecialchars($_GET["id"]);

    $sql = $db->prepare('SELECT * FROM workers where id = :mid');
    try {
        $sql->execute(array(':mid' => $id));
        $data = $sql->fetch(PDO::FETCH_ASSOC);
        $rowChecker = $sql->rowCount();
        if($rowChecker < 1) { header('Location: ./worker-manager.php'); }
    } catch(PDOException $e) {
        echo $e->getMessage();
        header('Location: ./worker-manager.php?worker_err=invalidlogin'); die();
    }

    if(isset($_POST["envoyer"])) {
        //! Vérifie que la photo ait bien été upload
        if(file_exists($_FILES['image']['tmp_name']) || is_uploaded_file($_FILES['image']['tmp_name'])) {
            $urlPhoto = $_FILES['image'];
            $nom_photo = $urlPhoto['name'];

            $Photoextension = explode(".", $nom_photo);
            $Photoext = $Photoextension[count($Photoextension) - 1];

            if (strlen($nom_photo)==0) {
                $nom_photo="photo-placholder.png";
            }

            $sql = $db->prepare('UPDATE workers SET img = :img where id = :id');

            try {
                $sql->execute(array(
                    ':img' => $data["nom"].'.'.$Photoext,
                    ':id' => $id
                ));
                if($data["img"] != "photo-placholder.png") {
                    unlink("images/team-cards/".$data["img"]);
                }
                move_uploaded_file($urlPhoto['tmp_name'],'images/team-cards/'.$data["nom"].'.'.$Photoext);
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

            $sql = $db->prepare('UPDATE workers SET backgroundIMG = :img where id = :id');

            try {
                $sql->execute(array(
                    ':img' => $data["nom"].'-background.'.$Photoext,
                    ':id' => $id
                ));
                if($data["backgroundIMG"] != "background-placeholder.png") {
                    unlink("images/team-cards/".$data["backgroundIMG"]);
                }
                move_uploaded_file($urlPhoto['tmp_name'],'images/team-cards/'.$data["nom"].'-background.'.$Photoext);
            } catch(PDOException $e) {
                echo $e->getMessage();
                header('Location: ./worker-manager.php?worker_err=failedupdate'); die();
            }
        }

        //! Insertion des modifications
        $nom = htmlspecialchars($_POST['nom']);
        $expertise = htmlspecialchars($_POST['expertise']);
        $fonction = htmlspecialchars($_POST['fonction']);

        $sql = $db->prepare('UPDATE workers SET nom = :nom, expertise = :expertise, fonction = :fonction where id = :id');

        try {
            $sql->execute(array(
                ':nom' => $nom,
                ':expertise' => $expertise,
                ':fonction' => $fonction,
                ':id' => $id
            ));
            header('Location: ./worker-manager.php?worker_err=updated&name='.$nom); die();
        } catch(PDOException $e) {
            echo $e->getMessage();
            header('Location: ./worker-manager.php?worker_err=failedupdate'); die();
        }
    }

    include_once("./includes/header.inc.php");
?>
    <div class="container">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-lg-6">
                <p class="text-white text-center fs-3 text-decoration-underline">Photo de l'employé(e) :</p>
                <img onclick="triggerClick3('#image')" src="./images/team-cards/<?=$data["img"];?>" id="photo" class="img-fluid d-flex mx-auto my-3 rounded" style="max-height: 500px; border: 2px solid white;">
            </div>

            <div class="col-lg-6">
                <p class="text-white text-center fs-3 text-decoration-underline">Image de fond :</p>
                <img onclick="triggerClick3('#image2')" src="./images/team-cards/<?=$data["backgroundIMG"];?>" id="photo2" class="img-fluid d-flex mx-auto my-3 rounded" style="max-height: 500px; border: 2px solid white;">
            </div>
        </div>

        <form class="row g-3 needs-validation" novalidate action="./worker-update.php?id=<?=htmlspecialchars($_GET["id"])?>" method="POST" enctype="multipart/form-data">
            <div class="col-md-4">
                <label for="nom" class="form-label text-white text-decoration-underline fw-bolder">Nom de l'Employé(e) :</label>
                
                <input type="text" class="form-control" name="nom" id="nom" value="<?=$data["nom"];?>" required>
                <div class="valid-feedback">Prénom valide !</div>
                <div class="invalid-feedback">Prénom invalide !</div>
            </div>

            <div class="col-md-4">
                <label for="fonction" class="form-label text-white text-decoration-underline fw-bolder">Fonction de l'Employé(e) :</label>
                <input type="text" class="form-control" name="fonction" id="fonction" value="<?=$data["fonction"];?>" required>
                <div class="valid-feedback">Fonction valide !</div>
                <div class="invalid-feedback">Fonction invalide !</div>
            </div>
            
            <div class="col-md-4">
                <label for="expertise" class="form-label text-white text-decoration-underline fw-bolder">Année de début d'activité :</label>
                <input type="number" class="form-control" name="expertise" id="expertise" value="<?=$data["expertise"];?>" required>
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

            <div class="btn-group text-center mb-3">
                <button type="submit" name="envoyer" class="btn btn-primary">Envoyer</button>
                <a class="btn btn-danger" href="./worker-manager.php" role="button">Retour</a>
            </div>
        </form>
    </div>
<?php
    include_once("./includes/footer.inc.php");
?>