<style>
    .form-group {
        margin-bottom: 15px;
    }

    .form-container {
        margin: 30px;
    }

    .form-control {
        max-width: 300px;
    }

    button {
        margin-top: 10px;
    }
    
</style>
<div style="margin-top: 10px" class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="box">
            <h2 >Upload file</h2>
            </div>
        </div>
        <div class="col-md-auto">
            <div class="box"><h3 style="color: green"><?= '✔ ' . $added ?></h3></div>
        </div>
    </div>

</div>

<div class="form-container">
    <form method="post" enctype="multipart/form-data" action="<?= base_url('admin/photos/add') ?>">
        <div class="form-group">
            <label for="event">Event name:</label>
            <input value="<?= isset($_POST['event']) ? set_value('event') : '' ?>" class="form-control" type="text" name="event" id="event" placeholder="Event name">
            <?php if(isset($validation) && $validation->hasError('event')) : ?>
                <div class="text-danger">
                    <?= $validation->getError('event') ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label for="customer">Select customer:</label>
            <select class="form-control" name="customer" id="customer">
                <?php foreach($users as $user): ?>
                    <option value="<?= $user['userid'] ?>"><?= $user['email'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <input multiple name="media[]" class="form-control" type="file" id="media">
            <?php if(isset($validation) && $validation->hasError('media')) : ?>
                <div class="text-danger">
                    <?= $validation->getError('media') ?>
                </div>
            <?php endif; ?>
        </div>
        <div style="margin-top: 10px" class="form-group">
            <button class="btn btn-dark" name="addPhoto" type="submit" value="submit">Add files</button>
            <form style="" class="" method="get" action="<?= base_url('admin/photos') ?>">
                <button class="btn btn-dark" name="seeFiles" type="submit" value="submit">See files</button>
            </form>
        </div>
    </form>
</div>
