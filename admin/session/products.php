<?php include("../template/header.php"); ?>
<?php include("../config/db.php"); ?>

<?php
//print_r($_POST); //sending the form you will print the result inside of an array
// Array ( [txtID] => [txtName] => [action] => Add )
// to print files
//echo "<br/>";
//print_r($_FILES);
// Array ( [txtImage] => Array ( [name] => MAGNI.png [type] => image/png [tmp_name] => /opt/lampp/temp/phpjVhYGf [error] => 0 [size] => 9753 ) ) 

$txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
// isset -> empty? no, ok add this txtID value, yes ok add ""
$txtName = (isset($_POST['txtName'])) ? $_POST['txtName'] : "";
$txtImage = (isset($_FILES['txtImage']['name'])) ? $_FILES['txtImage']['name'] : "";
// asking for the action 
$action = (isset($_POST['action'])) ? $_POST['action'] : "";

// echo $txtID . "<br />";
// echo $txtName . "<br />";
// echo $txtImage . "<br />";
// echo $action . "<br />";


switch ($action) {
    case "Add":

        //INSERT INTO `books` (`id`, `name`, `image`) VALUES (NULL, 'Pedro', 'newimage.jpg') 
        //$sqlSentence = $conection->prepare("INSERT INTO `books` (`id`, `name`,`image`) VALUES (NULL, 'Marcos', 'newimage.jpg')");
        $sqlSentence = $conection->prepare("INSERT INTO books (name,image) VALUES (:name,:image);");
        $sqlSentence->bindParam(':name', $txtName);
        $sqlSentence->bindParam(':image', $txtImage);
        $sqlSentence->execute();
        // echo "Pressed btn add";
        break;

    case "Modify":
        echo "Pressed btn Modify";
        break;

    case "Cancel":
        echo "Pressed btn Cancel";
        break;
}

$sqlSentence = $conection->prepare("SELECT * FROM books");
$sqlSentence->execute();
$bookList = $sqlSentence->fetchAll(PDO::FETCH_ASSOC);

?>


<div class="container">
    <div class="row">
        <div class="col-md-5">
            <!-- b4-card-head-foot  -->
            <div class="card">
                <div class="card-header">
                    Books data
                </div>
                <div class="card-body">
                    <!-- !ctr-form-login  -->
                    <form method="post" enctype="multipart/form-data">
                        <!-- enctype="multipart/form-data" useful to receive files jpg png etc type image -->

                        <div class="form-group">
                            <label for="txtID">ID</label>
                            <input type="text" class="form-control" name="txtID" placeholder="ID">
                        </div>
                        <div class="form-group">
                            <label for="txtName">Name:</label>
                            <input type="text" class="form-control" name="txtName" placeholder="Name of the book">
                        </div>
                        <div class="form-group">
                            <label for="fileImage">Image</label>
                            <input type="file" class="form-control" name="txtImage">
                        </div>

                        <!-- b4-bgroup-defult  -->
                        <div class="btn-group" role="group" aria-label="">
                            <button type="submit" name="action" value="Add" class="btn btn-success">Add</button>
                            <button type="submit" name="action" value="Modify" class="btn btn-warning">Modify</button>
                            <button type="submit" name="action" value="Cancel" class="btn btn-info">Cancel</button>
                        </div>

                    </form>
                </div>

            </div>

        </div>
        <div class="col-md-7">
            Table of books (show data books)
            <!-- b4-table-default  -->
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Imagen</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($bookList as $book) { ?>
                        <tr>
                            <td> <?php echo $book['id'];?></td>
                            <td> <?php echo $book['name'];?></td>
                            <td> <?php echo $book['image'];?></td>
                            <td> Select | Delete</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>


        </div>
    </div>
</div>

<?php include("../template/footer.php"); ?>