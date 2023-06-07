<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<style>
    .table-dark {
        background-color: #343a40;
        color: #fff;
    }
</style>
<body>
    <div style="margin: 20px">
        <div class="row">
            <div class="col-md-6">
                <h2>Media List</h2>
            </div>
            <div class="col-md-6 d-flex justify-content-end sticky-div" style="position: fixed; right: 0;">
                <div class="d-flex">
                    <form class="form-inline mr-2" method="get" action="<?= base_url('admin/photos/search/') ?>">
                        <input class="form-control mr-sm-2" type="text" name="query" autocomplete="off" placeholder="Search for files...">
                        <button class="btn btn-dark" type="submit">Search</button>
                    </form>
                    <form class="form-inline" method="get" action="<?= base_url('admin/photos/add') ?>">
                        <button class="btn btn-dark" name="addPhoto" type="submit" value="submit">Add files</button>
                    </form>
                </div>
            </div>
        </div>

        <div style="margin-top: 10px" style="max-height: 20px; overflow: auto;">
            <table style="margin: 10px; border-style: solid; margin-bottom: 150px;" class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Customer email</th>
                        <th scope="col">Event name</th>
                        <th scope="col">Path</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($media as $media): ?>
                        <tr>
                            <td><?= $media["mediaid"] ?></td>
                            <td><?= $media["customeremail"] ?></td>
                            <td><?= $media["event"] ?></td>
                            <td><?= $media["path"] ?></td>
                            <td><a href="<?= base_url('admin/photos/edit/' . $media['mediaid']) ?>" class="btn btn-secondary">Edit</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>            
        </div>
    </div>


