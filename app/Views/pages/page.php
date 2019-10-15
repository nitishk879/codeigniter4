
<div class="container px-lg-5">
    <div class="row mx-lg-n5 bg-dark text-white">
        <div class="col-md-12 text-center">
            <h1><?php echo $title; ?></h1>
            <p>Hey this is page view from the page view under page class.</p>
        </div>
    </div>
    <div class="row mx-lg-n5">
        <div class="col py-3 px-lg-5 border bg-light">Custom column padding</div>
        <div class="col py-3 px-lg-5 border bg-light">Custom column padding</div>
    </div>
    <?php if (!empty($blogs)): ?>
        <?php foreach ($blogs as $blog): ?>
            <h3><?php echo $blog['blog_title']; ?></h3>
            <p><?php echo $blog['blog_description']; ?></p>
            <p><a href="<?= "/blog/{$blog['blog_slug']}" ?>">View article</a></p>
        <?php endforeach; ?>
    <?php endif; ?>
</div>