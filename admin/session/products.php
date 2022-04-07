<?php include("../template/header.php"); ?>

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
                            <input type="file" class="form-control" name="fileImage">
                        </div>

                        <!-- b4-bgroup-defult  -->
                        <div class="btn-group" role="group" aria-label="">
                            <button type="button" class="btn btn-success">Add</button>
                            <button type="button" class="btn btn-warning">Modify</button>
                            <button type="button" class="btn btn-info">Cancel</button>
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
                    <tr>
                        <td>2</td>
                        <td>Learn php</td>
                        <td>imagen.jpg</td>
                        <td>Select | Delete</td>
                    </tr>
                </tbody>
            </table>


        </div>
    </div>
</div>

<?php include("../template/footer.php"); ?>