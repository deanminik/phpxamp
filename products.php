<?php include("template/header.php"); ?>
<?php include("admin/config/db.php");
$sqlSentence = $conection->prepare("SELECT * FROM books");
$sqlSentence->execute();
$bookList = $sqlSentence->fetchAll(PDO::FETCH_ASSOC);
?>

<?php foreach ($bookList as $book) { ?>

    <div class="col-md-3">
        <div class="card">
            <img class="card-img-top" src="./img/<?php echo $book['image']?>" alt="">
            <div class="card-body">
                <h4 class="card-title"><?php echo $book['name'];?></h4>
                <a name="" id="" class="btn btn-primary" href="#" role="button">See more</a>
            </div>
        </div>
    </div>

<?php } ?>



<?php include("template/footer.php"); ?>