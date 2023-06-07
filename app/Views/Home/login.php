<?php if(isset($validation)) : ?>
    <div class="text-danger">
        <?= $validation->listErrors() ?>
    </div>
<?php endif; ?>

<div class="container d-flex align-items-center justify-content-center vh-100">
  <form action="login" method="post" style="min-width: 400px;">
    <!-- Email input -->
    <div class="form-outline mb-4 text-center">
      <input value="<?= isset($_POST['email']) ? set_value('email') : '' ?>" placeholder="Email" type="text" name="email" id="email" class="form-control" />
    </div>

    <!-- Password input -->
    <div class="form-outline mb-4 text-center">
      <input placeholder="Password" type="password" name="password" id="password" class="form-control" />
    </div>

    <!-- Submit button -->
    <div class="text-center">
      <button style="min-width: 400px;" type="submit" class="btn btn-primary btn-block mb-4">Sign in</button>
    </div>

    <!-- Register buttons -->
    <div class="text-center">
      <p>Don't have an account? <a href="/registration">Register</a></p>
    </div>
  </form>
</div>
