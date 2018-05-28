<?php
include('inc/pdo.php');
session_start();
include('inc/header.php');

    if(!empty($_GET['slug'])) {
    $slug = $_GET['slug'];
    $movie = getMovieBySlug($slug);
    if(empty($movie)) { redirectTo404(); }
    } else {echo 'dede'; redirectTo404(); }

    $title = $movie['title'] . ' ' . $movie['year'];

    $notation = false;
    if(isLogged()) {

    $user_id = $_SESSION['user']['id'];
    $note = getNoteForThisUserAndThisMovie($user_id,$movie['id']);
    if(!empty($note)){
    $notation = true;
    }
    }
?>

<div class="container">
    <div class="row">
        <div class="col-lg-6">
            <figcaption><h4> < DETAILS DE L'EVENEMENTS </h4></figcaption>
            <div class="container-fluid bg-3 text-center">
            <h1><?php echo $movie['title']; ?></h1>

    <?php if(isLogged() && $notation == false) { ?>
          <form action="addmovietosee.php" method="post">
              <input type="hidden" name="movie" value="<?= $movie['id']; ?>">
              <input type="submit" class="btn btn-success btn-xs pull-right" name="submitaddmovietosee" value="Ajouter film à liste des films à voir">
          </form>
    <?php } ?>

    <?php afficheOfTheFilm($movie['id'],$movie['title']); ?>
    <p>Année: <?php echo $movie['year']; ?></p>
    <p>Genres: <?php echo $movie['genres']; ?></p>
    <p>Plot: <?php echo $movie['plot']; ?></p>
    <p>Directors: <?php echo $movie['directors']; ?></p>
    <p>Cast: <?php echo $movie['cast']; ?></p>
    <p>Writers: <?php echo $movie['writers']; ?></p>
    <p>Runtime: <?php echo $movie['runtime']; ?></p>
    <p>Mpaa: <?php echo $movie['mpaa']; ?></p>
    <p>Rating: <?php echo $movie['rating']; ?></p>
    <p>Popularity: <?php echo $movie['popularity']; ?></p>


            </div>


        </div>

    </div>
</div>
<?php include('inc/view/footer.php');