<?php
/**
 * Bootstrap pagination template with formal styling
 */
?>
<?php if ($pager->getPageCount() > 1): ?>
<nav aria-label="<?= lang('Pager.pageNavigation') ?>" class="mt-4">
    <ul class="pagination justify-content-center">
        <?php if ($pager->hasPrevious()): ?>
            <li class="page-item">
                <a class="page-link" href="<?= $pager->getPrevious() ?>" aria-label="<?= lang('Pager.previous') ?>" style="border: 1px solid #dee2e6; color: #495057;">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
        <?php else: ?>
            <li class="page-item disabled">
                <span class="page-link" style="border: 1px solid #dee2e6; color: #6c757d;">&laquo;</span>
            </li>
        <?php endif ?>

        <?php foreach ($pager->links() as $link): ?>
            <?php if ($link['active']): ?>
                <li class="page-item active">
                    <span class="page-link" style="background-color: #0d6efd; border-color: #0d6efd; color: white;">
                        <?= $link['title'] ?>
                    </span>
                </li>
            <?php else: ?>
                <li class="page-item">
                    <a class="page-link" href="<?= $link['uri'] ?>" style="border: 1px solid #dee2e6; color: #495057;">
                        <?= $link['title'] ?>
                    </a>
                </li>
            <?php endif ?>
        <?php endforeach ?>

        <?php if ($pager->hasNext()): ?>
            <li class="page-item">
                <a class="page-link" href="<?= $pager->getNext() ?>" aria-label="<?= lang('Pager.next') ?>" style="border: 1px solid #dee2e6; color: #495057;">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        <?php else: ?>
            <li class="page-item disabled">
                <span class="page-link" style="border: 1px solid #dee2e6; color: #6c757d;">&raquo;</span>
            </li>
        <?php endif ?>
    </ul>
</nav>

<style>
.pagination {
    margin-bottom: 0;
}
.page-link {
    padding: 0.5rem 0.75rem;
    font-size: 0.9rem;
    transition: all 0.2s ease-in-out;
}
.page-link:hover {
    background-color: #e9ecef;
    color: #0d6efd;
    border-color: #dee2e6;
}
.page-item.active .page-link {
    font-weight: 500;
}
.page-item.disabled .page-link {
    background-color: #f8f9fa;
}
</style>
<?php endif ?> 