<?php

include('inc/pdo.php');
include('inc/header.php'); ?>


    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <figcaption><h4> < LES EVENEMENTS</h4></figcaption>

                <div class="container-fluid bg-3 text-center">
                    <div class="row">




                        <div class="ex3">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</div>


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



                </div>
            </div>
        </div>
    </div>




    <div class="évenements">

    </div>


<?php include('inc/footer.php');?>