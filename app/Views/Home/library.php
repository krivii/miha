


<body>

<div class="container">
    <div class="row">
    <?php foreach ($images as $image): ?>
        <div class="col-3">
        <a href="<?= $image['path'] ?>" target="_blank">
            <img src="<?= $image['path'] ?>" alt="<?= $image['path'] ?>" style="width:100%">
            </a>
        </div>
            
    <?php endforeach; ?>
    </div>



</div>



