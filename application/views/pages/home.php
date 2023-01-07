<div class="container"><h1><?= $title; ?></h1>
    <div class="list-group">
        <?php foreach($document as $row) { ?>
            <a class="list-group-item list-group-item-action" href="<?= base_url(); ?><?= $row['id']; ?>"><?= $row['title']; ?></a>
        <?php } ?>
    </div>
</div>