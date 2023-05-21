<?php
    session_start();
    if(!isset($_SESSION['role']) || $_SESSION["role"] != "Admin") header('Location: ./login.php');

    include_once("./includes/DB.php");

    if(isset($_GET["delete"])) {
        $id = htmlspecialchars($_GET["delete"]);
        $ville = htmlspecialchars($_GET["ville"]);
        $req = $db->prepare('DELETE FROM lieux_livraisons WHERE id = :mid ');
        $req->bindParam(':mid', $id);

        try {
            $req->execute();
            header('Location: ./delivery-manager.php?delivery_err=deleted&ville='.$ville.'');
        } catch(PDOException $e) {
            echo $e->getMessage();
            header('Location: ./delivery-manager.php?delivery_err=invalidlogin');
        }
    }



    if(isset($_POST["add"])) {
        $ville = htmlspecialchars($_POST["ville"]);
        $ville = mb_strtolower($ville);

        // ! Vérifier que le nom soit pas trop long pour la BDD
        if(strlen($ville) > 70 || strlen($ville) == 0) {
            header('Location: ./delivery-manager.php?delivery_err=length'); die();
        }

        //! On verifie que la ville n'existe pas déja
        $check = $db->prepare('SELECT id, ville FROM lieux_livraisons WHERE ville = ?');
        try {
            $check->execute(array($ville));
            $data = $check->fetch(PDO::FETCH_ASSOC);
            $row = $check->rowCount();

            if($row > 0) {
                header('Location: ./delivery-manager.php?delivery_err=already&ville='.$ville); die();
            }

        } catch(PDOException $e) {
            echo $e->getMessage();
            header('Location: ./delivery-manager.php?delivery_err=invalidlogin'); die();
        }


        //! Si la ville exite pas , on l'ajoute 
        $req = $db->prepare('INSERT INTO lieux_livraisons(ville) VALUES(:ville);');
        $req->bindParam(':ville', $ville);

        try {
            $req->execute();
            header('Location: ./delivery-manager.php?delivery_err=success&ville='.$ville);
        } catch(PDOException $e) {
            echo $e->getMessage();
            header('Location: ./delivery-manager.php?delivery_err=invalidlogin'); die();
        }
    }

    include_once("./includes/header.inc.php");
?>
    <?php
        if(isset($_GET['delivery_err'])) {
            $err = htmlspecialchars($_GET['delivery_err']);

            switch($err) {
                case 'already':
                ?>
                    <div class="alert alert-danger text-center">
                        <strong><i class="fa-solid fa-circle-xmark"></i> Erreur :</strong> La ville <?php if(isset($_GET['ville'])) { echo(ucwords(htmlspecialchars($_GET["ville"]))); } ?> existe déja !
                    </div>
                <?php
                break;

                case 'length':
                ?>
                    <div class="alert alert-danger text-center">
                        <strong><i class="fa-solid fa-circle-xmark"></i> Erreur :</strong> Le nom de ville spécifié est trop long !
                    </div>
                <?php
                break;


                case 'deleted':
                ?>
                    <div class="alert alert-warning text-center">
                        <strong><i class="fa-solid fa-triangle-exclamation"></i> Attention :</strong> La ville <?php if(isset($_GET['ville'])) { echo(ucwords(htmlspecialchars($_GET["ville"]))); } ?> viens d'être supprimée !
                    </div>
                <?php
                break;


                case 'success':
                ?>
                    <div class="alert alert-success text-center">
                        <strong><i class="fa-solid fa-circle-check"></i> Succès :</strong> La ville <?php if(isset($_GET['ville'])) { echo(ucwords(htmlspecialchars($_GET["ville"]))); } ?> à correctement été ajoutée !
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

    <div class="container text-center">
        <h1 class="text-decoration-underline text-center text-white pt-3">Gestion des livraisons :</h1>

        <form method="POST" action="./delivery-manager.php">
            <div class="mb-3">
                <label for="ville" class="form-label text-white text-decoration-underline fs-4 fw-bolder">Ajouter une destination :</label>
                <input type="text" class="form-control" name="ville" id="ville" placeholder="Entrez la ville ici.." autofocus required>
            </div>

            <div class="text-center"><button type="submit" name="add" class="btn btn-primary">Ajouter</button></div>
        </form>
        <hr class="sep-2"/>
    </div>
    
    
    <p class="text-decoration-underline text-center text-white fs-4 pt-3">Supprimer une destination :</p>

    <div class="d-flex align-content-start flex-wrap justify-content-center delivery-container">
        <?php
            $check = $db->prepare('SELECT id, ville FROM lieux_livraisons');
            try {
                $check->execute();
                $data = $check->fetchAll(PDO::FETCH_ASSOC);
            } catch(PDOException $e) {
                echo $e->getMessage();
                header('Location: ./delivery-manager.php?delivery_err=invalidlogin'); die();
            }

            foreach ($data as $row): ?>
                <div class="py-2 px-3 rounded m-2">
                    <?= ucwords($row["ville"]); ?>
                    <a class="btn btn-danger" href="./delivery-manager.php?delete=<?=$row["id"];?>&ville=<?=$row["ville"];?>" role="button"><i title="Supprimer cette ville" class="fa-solid fa-circle-xmark"></i></a>
                </div>
            <?php
            endforeach;
        ?>
        
    </div>

<?php
    include_once("./includes/footer.inc.php");
?>