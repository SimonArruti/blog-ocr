<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-8">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4><?= ucfirst($comment->author) ?></h4>
            <label class="label label-info">Le <?= $comment->date ?></label>
        </div>
        <div class="panel-body">
            <p><?= $comment->message ?></p>

        <?php if (isset($_SESSION['is_online'])) : ?>

            <form id="form-comment" action="<?= URL . '/comments/warn/' . $post->id . '/' . $comment->id ?>" method="post">
                <p class="text-right">
                    <button type="submit" class="reply btn btn-default" data-id="<?= $comment->id ?>">Répondre</button>
                    <button class="btn btn-info" type="submit">Signaler le commentaire</button>
                </p>
            </form>

        <?php endif ?>
        </div>
    </div>
    </div>

</div>

<div style="margin-left: 50px;">
    <?php if(isset($comment->children)): ?>
        <?php foreach($comment->children as $comment): ?>
            <?php require('comments_front.php'); ?>
        <?php endforeach; ?>
    <?php endif; ?>
</div>



