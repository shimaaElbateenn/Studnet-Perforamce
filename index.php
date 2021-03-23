<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Student Performance</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.23/sb-1.0.1/sp-1.2.2/datatables.min.css"/>
</head>
<body>

<?php require 'Model.php'; ?>
<?php $data = Model::CallAPI(); ?>
<?php $data = $data && json_decode($data) ? json_decode($data) : false; ?>

<div class="container">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand" href="#">
            <img src="logo.png" width="30" height="30" alt="">
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>


    <div class="row" style="margin-top: 3rem">
        <div class="col-md-12">
            <table id="table" class="display table">
                <thead>
                <tr>
                    <th>First Semester</th>
                    <th>Second Semester</th>
                    <th>Study Time</th>
                    <th>Failures</th>
                    <th>Absence</th>
                    <th>Actual Grade</th>
                    <th>Prediction Grade</th>
                </tr>
                </thead>

                <tbody>
                <?php if ($data) : ?>
                    <?php foreach ($data->data as $item) : ?>
                        <tr>
                            <td><?= $item[0] ?></td>
                            <td><?= $item[1] ?></td>
                            <td><?= $item[2] ?></td>
                            <td><?= $item[3] ?></td>
                            <td><?= $item[4] ?></td>
                            <td><?= $item[5] ?></td>
                            <td><?= $item[6] ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
<!--                    <tr>-->
<!--                        <td colspan="6">Couldn't find any data!</td>-->
<!--                    </tr>-->
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>


</div>




<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.23/sb-1.0.1/sp-1.2.2/datatables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

<script>
    $(document).ready( function () {
        $('#table').DataTable();
    });
</script>

</body>
</html>