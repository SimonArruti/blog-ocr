<div>
    <h4><?= $comment->author ?></h4>
    <h4><?= $comment->id ?></h4>
    <strong>Le <?= $comment->date ?></strong>
    <p><?= $comment->message ?></p>
    <p><?= $comment->reply_id ?></p>

    <?php if (isset($_SESSION['is_online'])) : ?>

        <form id="form-comment" action="<?= URL . '/comments/warn/' . $post->id . '/' . $comment->id ?>" method="post">
            <button type="submit">Signaler le commentaire</button>
        </form>
        <div>
            <button type="submit" class="reply" data-id="<?= $comment->id ?>">Répondre</button>
        </div>

    <?php endif ?>

</div>

<div style="margin-left: 50px;">
    <?php if(isset($comment->children)): ?>
        <?php foreach($comment->children as $comment): ?>
            <?php require('comments_front.php'); ?>
        <?php endforeach; ?>
    <?php endif; ?>
</div>



