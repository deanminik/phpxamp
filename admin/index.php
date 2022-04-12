<?php

session_start();
if ($_POST) {
    if (($_POST['user'] == 'dean') && ($_POST['password'] == '123')) { // with a data base this is the line to change it 
        // example : $sqlSentence = $conection->prepare("SELECT * FROM books WHERE id=:id");
        // $sqlSentence->bindParam(':id', $txtID);
        // $sqlSentence->execute();
        // $book = $sqlSentence->fetch(PDO::FETCH_LAZY); // fetch(PDO::FETCH_LAZY to assing one by one  
        // $txtName = $book['name'];
        // $txtImage = $book['image'];

        $_SESSION['user'] = "ok";
        $_SESSION['userName'] = "dean";
        header("Location:home.php");
    } else {
        $message = "User or password are incorrect";
    }
}


?>

<!doctype html>
<html lang="en">

<head>
    <title>Administrator</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>

    <div class="container">
        <br /><br /><br />
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Login
                    </div>
                    <div class="card-body">
                        <?php if (isset($message)) { ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $message ?>
                            </div>
                        <?php   } ?>
                        <form method="POST">
                            <div class="form-group">
                                <label for="exampleInputEmail1">User</label>
                                <input type="text" class="form-control" name="user" placeholder="Enter your user">

                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" class="form-control" name="password" placeholder="Password">
                            </div>

                            <button type="submit" class="btn btn-primary">Sign In</button>
                        </form>


                    </div>

                </div>
            </div>

        </div>
    </div>
</body>

</html>