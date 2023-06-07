<style>
    .img {
        max-width: 80%;
        height: auto;
        margin: 20px;
    }

    .form-group {
        margin-bottom: 10px;
    }

    .form-container {
        margin: 30px;
    }

    .form-control {
        max-width: 400px;
    }

    button{
        margin-top: 10px;
    }
</style>


<h2 style="margin: 20px;">Edit photo</h2>
<div class="row">
    <div style="width: 500px; margin: 20px" class="col-md-6">
        <div class="form-container">
            <form method="post" action="<?= base_url('admin/photos/edit/' . $media['mediaid']) ?>">
                <div class="form-group">
                    <label for="customeremail">Customer email:</label>
                    <input class="form-control" type="text" name="customeremail" id="customeremail" value="<?= esc($media['customeremail']) ?>">
                </div>

                <div class="form-group">
                    <label for="event">Event name:</label>
                    <input class="form-control" type="text" name="event" id="event" value="<?= esc($media['event']) ?>">
                </div>
                <div class="form-group">
                    <label for="path">Path:</label>
                    <input class="form-control" type="text" name="path" id="path" value="<?= esc($media['path']) ?>">
                </div>

                <button type="submit" class="btn btn-dark">Update</button>

                <!-- Add the delete button -->
                <button type="button" class="btn btn-danger" onclick="confirmDelete()">Delete</button>
            </form>

            <!-- Add a hidden form for delete action -->
            <form id="deleteForm" method="post" action="<?= base_url('admin/photos/delete/' . $media['mediaid']) ?>"></form>
        </div>
    </div>
    <div class="col-md-6">
        <img src="<?= $media['path'] ?>" alt="<?= $media['path'] ?>" class="img img-thumbnail">
    </div>
</div>


<script>
    function confirmDelete() {
        if (confirm("Are you sure you want to delete this photo?")) {
            // If confirmed, submit the form with an additional parameter indicating the delete action
            document.getElementById("deleteForm").submit();
        }
    }
</script>
