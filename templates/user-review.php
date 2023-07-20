<div class="offset-md-1 col-md-10 review">
    <div class="row">
        <div class="col-md-1">
            <div class="profile-image-container review-image" style="background-image: url('<?= $review->user->getImageUser() ?>');"></div>
        </div>
        <div class="col-md-9 author-details-continer">
            <h4 class="author-name">
                <a href="<?php BASE_URL ?>/profile/<?= $review->user->id ?>"><?= $review->user->getFullName() ?></a>
            </h4>
            <p><i class="fas fa-star"></i> <?= $review->rating ?></p>
        </div>
        <div class="col-md-12">
            <p class="comment-title">Comentário:</p>
            <p><?= $review->review ?></p>
        </div>
    </div>
</div>