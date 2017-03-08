<div>


</div>

<div style="margin-left: 50px;">
    <?php if(isset($comment->children)): ?>
        <?php foreach($comment->children as $comment): ?>
            <?php require('comments_back.php'); ?>
        <?php endforeach; ?>
    <?php endif; ?>
</div>



