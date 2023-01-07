<a href="<?= base_url(); ?>edit/<?= $document['id']; ?>">Edit</a>

<div class="container">
    <?= form_open('delete') ?>
    <input type="hidden" name="id" value="<?= $document['id']; ?>">
    <button type="submit" name="submit">Submit</button>
</div>

<p><?= $document['body'] ?></p>