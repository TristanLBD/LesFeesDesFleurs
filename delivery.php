<?php
    $page = "prestations";
    include_once("./includes/header.inc.php");
    include_once("./includes/DB.php");
?>

    <div class="container d-flex flex-column align-items-center my-auto">

        <h1 class="text-decoration-underline text-center text-white pt-3">Nos Livraisons :</h1>
        <p class="text-white text-center fs-3">
            Les livraisons sont <span class="text-decoration-underline text-danger">disponibles</span> pour une <span class="text-decoration-underline text-danger">commande de 25 € minimum</span>.
            <br>Le <span class="text-decoration-underline text-danger">prix de livraison</span> peut varier selon la distance que nous devons parcourir.<br>
            <span class="text-decoration-underline">Liste non exhaustive.</span>
        </p>

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
                    <div class="py-2 px-3 rounded m-2"><?=ucwords($row["ville"]);?></div>
                <?php
                endforeach;
            ?>
        </div>

        <br>
        <p class="text-white text-center fs-3">Pour plus d'informations sur nos livraisons, veuillez nous <a href="./about-us.php#contact">contacter</a> au 04.68.93.46.59</p>

    </div>

<?php
    include_once("./includes/footer.inc.php")
?>