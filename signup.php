<?php
    // header("Location: ./index.php");
    require_once("./includes/DB.php");

    if(isset($_POST["valider"])) {
        if(isset($_POST['email']) && isset($_POST['password']) && isset($_POST['password-confirm'])) {
            $email = htmlspecialchars($_POST['email']);
            $password = htmlspecialchars($_POST['password']);
            $passwordConfirm = htmlspecialchars($_POST['password-confirm']);
            $role = "Admin";

            //! On check si l'email et pseudo sont deja dans la bdd
            $check = $db->prepare('SELECT id, email FROM manager WHERE email = :email');
            $check->execute(array(':email' => $email));
            $data = $check->fetch();
            $row = $check->rowCount();
            echo($row);

            $email = strtolower($email);
            if($row == 0) {
                if(filter_var($email, FILTER_VALIDATE_EMAIL)){ // Si l'email est de la bonne forme
                    if($password === $passwordConfirm) { 

                        //! On hash le mot de passe avec Bcrypt, via un coût de 12
                        $cost = ['cost' => 12];
                        $password = password_hash($password, PASSWORD_BCRYPT, $cost);

                        $sql = $db->prepare('INSERT INTO manager(email, pwd, role) VALUES(:email, :password, :role)');
                        try {
                            $sql->execute(array(
                                ':password' => $password,
                                ':email' => $email,
                                ':role' => $role
                            ));

                            $_SESSION['id'] = $id;
                            $_SESSION['email'] = $email;
                            $_SESSION['role'] = $role;
                            
                            header('Location: ./signup.php?reg_err=validinsert'); die();
                        } catch(PDOException $e) {
                            echo $e->getMessage();
                            header('Location: ./signup.php?reg_err=invalidinsert'); die();
                        }

                    } else{ header('Location: ./signup.php?reg_err=password'); die();}
                } else{ header('Location: ./signup.php?reg_err=email'); die();}
            } else{ header('Location: ./signup.php?reg_err=already'); die();}

        }
    }
    include_once("./includes/header.inc.php");
?>
    <div class="container">
    <?php
        if(isset($_GET['reg_err'])) {
            $err = htmlspecialchars($_GET['reg_err']);

            switch($err) {
                case 'password':
                ?>
                    <div class="alert alert-danger text-center">
                    <strong>Erreur :</strong> L'adresse mail ou le mot de passe est incorrect.
                    </div>
                <?php
                break;

                case 'email':
                ?>
                    <div class="alert alert-danger text-center">
                    <strong>Erreur :</strong> L'adresse mail ou le mot de passe est incorrect.
                    </div>
                <?php
                break;
                
                case 'already':
                ?>
                    <div class="alert alert-danger text-center">
                    <strong>Erreur :</strong> Cette adresse est d"ja utilisée.
                    </div>
                <?php
                break;

                case 'validinsert':
                ?>
                    <div class="alert alert-success text-center">
                    <strong>Succès :</strong> Connection réussie !
                    </div>
                <?php
                break;

                case 'invalidinsert':
                ?>
                    <div class="alert alert-success text-center">
                    <strong>Erreur :</strong> Problème lors de la connection , veuillez essayer plus tard.
                    </div>
                <?php
                break;
            }
        }
    ?>
        <form method="POST" action="./signup.php">
            <div class="mb-3">
                <label for="email" class="form-label text-white text-decoration-underline fw-bolder">Email address</label>
                <input type="email" class="form-control" name="email" id="email">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label text-white text-decoration-underline fw-bolder">Mot de passe :</label>
                <input type="password" class="form-control" name="password" id="password">
            </div>
            <div class="mb-3">
                <label for="password-confirm" class="form-label text-white text-decoration-underline fw-bolder">Mot de passe :</label>
                <input type="password" class="form-control" id="password-confirm" name="password-confirm">
            </div>
            <center>
                <button type="submit" class="btn btn-primary" name="valider">Envoyer</button>
                <button type="reset" class="btn btn-danger" name="valider">Annuler</button>
            </center>
        </form>
    </div>
<?php
    include_once("./includes/footer.inc.php");
?>