<h2><?= esc($title); ?></h2>

<?= \Config\Services::validation()->listErrors(); ?>

<?php echo form_open('blog/create', 'enctype="multipart/form-data"'); ?>

    <label for="title">Title</label>
    <input type="input" name="title" /><br />

    <label for="body">Text</label>
    <textarea name="body"></textarea><br />

    <input type="file" name="userfile" />


    <input type="submit" name="submit" value="Create news item" />

<?php echo form_close(); ?>