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

    button{
        margin-top: 10px;
    }
</style>

<h2 style="margin: 20px;">Edit user</h2>

<div class="form-container">
    <form method="post" action="<?= base_url('admin/users/edit/' . $user['userid']) ?>">
        <div class="form-group">
            <label for="first_name">Firstname:</label>
            <input class="form-control" type="text" name="first_name" id="first_name" value="<?= esc($user['firstname']) ?>">
        </div>

        <div class="form-group">
            <label for="last_name">Lastname:</label>
            <input class="form-control" type="text" name="last_name" id="last_name" value="<?= esc($user['lastname']) ?>">
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input class="form-control" type="email" name="email" id="email" value="<?= esc($user['email']) ?>">
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input class="form-control" type="password" name="password" id="password" >
        </div>

        <button type="submit" class="btn btn-dark">Update</button>

        <!-- Add the delete button -->
        <button type="button" class="btn btn-danger" onclick="confirmDelete()">Delete</button>
    </form>

    <!-- Confirmation popup script -->
    <script>
        function confirmDelete() {
            if (confirm("Are you sure you want to delete this user?")) {
                // If confirmed, submit the form with an additional parameter indicating the delete action
                document.getElementById("deleteForm").submit();
            }
        }
    </script>

    <!-- Add a hidden form for delete action -->
    <form id="deleteForm" method="post" action="<?= base_url('admin/users/delete/' . $user['userid']) ?>"></form>
</div>
