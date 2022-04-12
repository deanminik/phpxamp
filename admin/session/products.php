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
        $date = new DateTime();
        $fileName = ($txtImage != "") ? $date->getTimestamp() . "_" . $_FILES["txtImage"]["name"] : "image_default.jpg";
        $tmpImage = $_FILES["txtImage"]["tmp_name"];
        if ($tmpImage != "") {
            move_uploaded_file($tmpImage, "../../img/" . $fileName);
        }
        // $sqlSentence->bindParam(':image', $tmpImage);
        $sqlSentence->bindParam(':image', $fileName);
        $sqlSentence->execute();
        // echo "Pressed btn add";
        header("Location:products.php");
        break;

    case "Modify":

        $sqlSentence = $conection->prepare("UPDATE books SET name=:name WHERE id=:id");
        $sqlSentence->bindParam(':name', $txtName);
        $sqlSentence->bindParam(':id', $txtID);
        $sqlSentence->execute();

        if ($txtImage != "") {

            // upload the new image 
            $date = new DateTime();
            $fileName = ($txtImage != "") ? $date->getTimestamp() . "_" . $_FILES["txtImage"]["name"] : "image_default.jpg";
            $tmpImage = $_FILES["txtImage"]["tmp_name"];
            move_uploaded_file($tmpImage, "../../img/" . $fileName);

            // now delete the old image 
            $sqlSentence = $conection->prepare("SELECT image FROM books WHERE id=:id");
            $sqlSentence->bindParam(':id', $txtID);
            $sqlSentence->execute();
            $book = $sqlSentence->fetch(PDO::FETCH_LAZY); // fetch(PDO::FETCH_LAZY to assing one by one  
            if (isset($book["image"]) && ($book["image"] != "image_default.jpg")) {
                if (file_exists("../../img/" . $book["image"])) {
                    unlink("../../img/" . $book["image"]);
                }
            }


            $sqlSentence = $conection->prepare("UPDATE books SET image=:image WHERE id=:id");
            $sqlSentence->bindParam(':image', $fileName);
            $sqlSentence->bindParam(':id', $txtID);
            $sqlSentence->execute();

        }
        header("Location:products.php");

        break;

    case "select":
        //echo "select";
        $sqlSentence = $conection->prepare("SELECT * FROM books WHERE id=:id");
        $sqlSentence->bindParam(':id', $txtID);
        $sqlSentence->execute();
        $book = $sqlSentence->fetch(PDO::FETCH_LAZY); // fetch(PDO::FETCH_LAZY to assing one by one  

        $txtName = $book['name'];
        $txtImage = $book['image'];
        break;

    case "delete":
        //echo "delete";
        //step 1 search the image
        $sqlSentence = $conection->prepare("SELECT image FROM books WHERE id=:id");
        $sqlSentence->bindParam(':id', $txtID);
        $sqlSentence->execute();
        $book = $sqlSentence->fetch(PDO::FETCH_LAZY); // fetch(PDO::FETCH_LAZY to assing one by one  

        // step two exist the image name? = isset($book["image"]

        if (isset($book["image"]) && ($book["image"] != "image_default.jpg")) {
            // step three exist in the directory img    
            if (file_exists("../../img/" . $book["image"])) {
                // step four then delete        
                unlink("../../img/" . $book["image"]);
            }
        }
        // now delete in the database
        $sqlSentence = $conection->prepare("DELETE FROM books WHERE id=:id");
        $sqlSentence->bindParam(':id', $txtID);
        $sqlSentence->execute();
        header("Location:products.php");
        break;

    case "Cancel":
        //echo "cancel";
        header("Location:products.php");
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
                            <input type="text" required readonly class="form-control" value="<?php echo $txtID; ?>" name="txtID" placeholder="ID">
                        </div>
                        <div class="form-group">
                            <label for="txtName">Name:</label>
                            <input type="text" required class="form-control" value="<?php echo $txtName; ?>" name="txtName" placeholder="Name of the book">
                        </div>
                        <div class="form-group">
                            <label for="fileImage">Image:</label>

                            <?php echo $txtImage; ?>
                            <br />
                            <?php if ($txtImage != "") { ?>
                                <img src="../../img/<?php echo $txtImage ?>" width="50" alt="">
                            <?php } ?>
                            <input type="file" class="form-control" name="txtImage">
                        </div>

                        <!-- b4-bgroup-defult  -->
                        <div class="btn-group" role="group" aria-label="">
                            <button type="submit" name="action" <?php echo ($action == "select") ? "disabled" : ""; ?> value="Add" class="btn btn-success">Add</button>
                            <button type="submit" name="action" <?php echo ($action != "select") ? "disabled" : ""; ?> value="Modify" class="btn btn-warning">Modify</button>
                            <button type="submit" name="action" <?php echo ($action != "select") ? "disabled" : ""; ?> value="Cancel" class="btn btn-info">Cancel</button>
                        </div>

                    </form>
                </div>

            </div>

        </div>
        <div class="col-md-7">

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
                            <td> <?php echo $book['id']; ?></td>
                            <td> <?php echo $book['name']; ?></td>
                            <td>
                                <img src="../../img/<?php echo $book['image']; ?>" width="50" alt="">

                            </td>
                            <td>
                                <form method="POST">
                                    <input type="hidden" name="txtID" id="txtID" value="<?php echo $book['id']; ?>" />
                                    <input type="submit" name="action" value="select" class="btn btn-primary" />
                                    <input type="submit" name="action" value="delete" class="btn btn-danger" />
                                </form>

                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>


        </div>
    </div>
</div>

<?php include("../template/footer.php"); ?>