<style>
    .form-group {
        margin-bottom: 10px;
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

<h2 style="margin: 20px;">Add user</h2>
<div class="form-container">
    <form method="post" action="add">
        <div class="form-group">
            <label for="first_name">Firstname:</label>
            <input value="<?= isset($_POST['first_name']) ? set_value('first_name'): '' ?>" placeholder="Firstname" id="first_name" class="form-control" type="text" name="first_name">
            <?php if(isset($validation) && $validation->hasError('first_name')) : ?>
                <div class="text-danger">
                    <?= $validation->getError('first_name') ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="last_name">Lastname:</label>
            <input value="<?= isset($_POST['last_name']) ? set_value('last_name'): '' ?>" placeholder="Lastname" id="last_name" class="form-control" type="text" name="last_name">
            <?php if(isset($validation) && $validation->hasError('last_name')) : ?>
                <div class="text-danger">
                    <?= $validation->getError('last_name') ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="date_of_birth">Date of birth:</label>
            <input value="<?= isset($_POST['date_of_birth']) ? set_value('date_of_birth'): '' ?>" placeholder="2000-01-01" id="date_of_birth" class="form-control" type="date" name="date_of_birth">
            <?php if(isset($validation) && $validation->hasError('date_of_birth')) : ?>
                <div class="text-danger">
                    <?= $validation->getError('date_of_birth') ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input value="<?= isset($_POST['email']) ? set_value('email'): '' ?>" placeholder="Email" id="email" class="form-control" type="text" name="email">
            <?php if(isset($validation) && $validation->hasError('email')) : ?>
                <div class="text-danger">
                    <?= $validation->getError('email') ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input placeholder="Password" id="password" class="form-control" type="password" name="password">
            <?php if(isset($validation) && $validation->hasError('password')) : ?>
                <div class="text-danger">
                    <?= $validation->getError('password') ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="password_repeat">Repeat password:</label>
            <input placeholder="Repeat password" id="password_repeat" class="form-control" type="password" name="password_repeat">
            <?php if(isset($validation) && $validation->hasError('password_repeat')) : ?>
                <div class="text-danger">
                    <?= $validation->getError('password_repeat') ?>
                </div>
            <?php endif; ?>
        </div>

        <div style="margin-top: 10px" class="form-group">
            <button class="btn btn-dark" name="register" type="submit" value="submit">Add user</button>
        </div>
    </form>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.min.js"></script>
