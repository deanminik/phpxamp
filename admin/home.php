<?php include("template/header.php"); ?>

<div class="col-md-12">
    <div class="jumbotron">
        <h1 class="display-3">Welcome <?php echo $userName?></h1>
        <p class="lead">We are going to adminitrate our books</p>
        <hr class="my-2">
        <p>More info</p>
        <p class="lead">
            <a class="btn btn-primary btn-lg" href="session/products.php" role="button">Manage books</a>
        </p>
    </div>
</div>


<?php include("template/footer.php"); ?>