<?php
include('inc/pdo.php');
include('inc/header.php'); ?>


<div class="container">
  <div class="row">
        <div class="col-lg-6">
            <figcaption><h4> < EVENEMENTS RECENTS</h4></figcaption>
            <div class="container-fluid bg-3 text-center">
        <div class="row">
            <div class="col-sm-3">
                <img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive" alt="Image">
        </div>
        <div class="col-sm-3">
            <p>detail de l'evenement blablabla</p>
        </div>
    </div>
</div>
<div class="container-fluid bg-3 text-center">
    <div class="row">
        <div class="col-sm-3">
            <img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive"  alt="Image">
        </div>
        <div class="col-sm-3">
            <p>detail de l'evenement blablabla</p>
        </div>

    </div>
</div>

        </div>
        <div class="col-lg-6">

            <figcaption><h4> CHERCHER UN EVENEMENT></h4></figcaption>
            <div class="grid">

                <form action="" method="get" class="search">

                    <div class="form__field">
                        <input type="search" name="search" placeholder="Concert,Festival... Code postal?" class="form__input">
                        <input type="submit" value="Recherche" class="button">
                    </div>

                </form>
                <div>
                    <h4>< ENVIE DE CONNAITRE DE NOUVEAUX ARTISTE ? ></h4>
                    <h4>< OU ENVIE DE TE FAIRE CONNAITRES ? ></h4>
                    <h4>< ALORS CHERCHE UN CONCERTS ></h4>
                    <h4>< OU ? ></h4>
                    <h4>< POSTE TES EVENEMENTS></h4>
                </div>


            </div>
        </div>
  </div>
</div>




<div class="évenements">

</div>


<?php include('inc/footer.php');?>









