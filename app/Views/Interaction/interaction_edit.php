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
        margin: 20px;
    }

    .form-control {
        max-width: 400px;
    }

    button{
        margin-top: 10px;
    }
</style>


<h2 style="margin: 20px;">Edit message</h2>

<div class="row">
    <div style="min-width: 500px; margin: 15px" class="col-md-6">
        <div class="form-container">
            <form method="post" action="<?= base_url('admin/messages/edit/' . $msg['interactionid']) ?>">
                <div class="form-group">
                    <label for="useremail">User email:</label>
                    <input class="form-control" type="text" name="useremail" id="useremail" value="<?= esc($msg['useremail']) ?>">
                </div>

                <div class="form-group">
                    <label for="event">Subject:</label>
                    <input class="form-control" type="text" name="subject" id="subject" value="<?= esc($msg['subject']) ?>">
                </div>
                <div class="form-group">
                    <label for="message">Message:</label>
                    <textarea id="message" name="message" class="form-control md-textarea" style="min-width: 500px; min-height: 400px;"><?= esc($msg['message']) ?></textarea>

                </div>

                <button type="submit" class="btn btn-dark">Update</button>

                <!-- Add the delete button -->
                <button type="button" class="btn btn-danger" onclick="confirmDelete()">Delete</button>
            </form>

            <!-- Add a hidden form for delete action -->
            <form id="deleteForm" method="post" action="<?= base_url('admin/messages/delete/' . $msg['interactionid']) ?>"></form>
        </div>
    </div>
</div>


<script>
    function confirmDelete() {
        if (confirm("Are you sure you want to delete this message?")) {
            // If confirmed, submit the form with an additional parameter indicating the delete action
            document.getElementById("deleteForm").submit();
        }
    }
</script>
