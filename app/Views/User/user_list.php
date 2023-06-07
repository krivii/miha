<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        .table-dark {
            background-color: #343a40;
            color: #fff;
        }
    </style>
</head>
<body>
    <div style="margin: 20px">
        <div class="row">
            <div class="col-md-6">
                <h2>User List</h2>
            </div>
            <div class="col-md-6 d-flex justify-content-end sticky-div" style="position: fixed; right: 0;">
                <div class="d-flex">
                    <form class="form-inline" method="get" action="<?= base_url('admin/users/search/') ?>">
                        <input class="form-control mr-sm-2" type="text" name="query" autocomplete="off" placeholder="Search for user...">
                        <button class="btn btn-dark" type="submit">Search</button>
                    </form>
                    <form style="margin-left: 10px" class="form-inline" method="get" action="<?= base_url('admin/users/add') ?>">
                        <button class="btn btn-dark" name="addUser" type="submit" value="submit">Add user</button>
                    </form>
                </div>  
            </div>
        </div>


        <div style="margin-top: 10px" style="max-height: 20px; overflow: auto;">
            <table style="border-style: solid; " class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Firstname</th>
                        <th scope="col">Lastname</th>
                        <th scope="col">Email</th>
                        <th scope="col">Birthday</th>
                        <th scope="col">How did you find me</th>
                        <th scope="col">Created</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?= $user["userid"] ?></td>
                            <td><?= $user["firstname"] ?></td>
                            <td><?= $user["lastname"] ?></td>
                            <td><?= $user["email"] ?></td>
                            <td><?= $user["dateofbirth"] ?></td>
                            <td><?= $user["howdidyoufindme"] ?></td>
                            <td><?= $user["created"] ?></td>
                            <td><a href="<?= base_url('admin/users/edit/' . $user['userid']) ?>" class="btn btn-secondary">Edit</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>            
        </div>
        </div>
</body>
</html>
