<div class="container">

    <h1><?= $header ?></h1>
    <p><?= $error ?></p>

    <?= validation_errors() ?>

    <?= form_open('add') ?>

    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Title</span>
        <input type="text" class="form-control" placeholder="Title" aria-label="Username" name="title" value="<?= set_value('title')?>" aria-describedby="basic-addon1">
    </div>

    <div class="input-group mb-3">
        <span class="input-group-text">Content</span>
        <textarea class="form-control" name="body" value="<?= set_value('body')?>" aria-label="Content"></textarea>
    </div>

    <button type="submit" name="submit">Submit</button>

</div>