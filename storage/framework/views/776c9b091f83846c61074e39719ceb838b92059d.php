<div wire:poll.3000ms>
    <a class="nav-link" href="<?php echo e(route('messages.inbox')); ?>">
        <?php echo app('translator')->get('navigation.messages'); ?>
        <small class="d-none d-sm-none d-md-inline-block">
            <?php echo e($count); ?> <?php echo app('translator')->get('messages.newMessages'); ?>
        </small>
    </a>
</div>
<?php /**PATH /var/www/tagahanga.ru/data/www/tagahanga.ru/resources/views/livewire/unread-messages-count.blade.php ENDPATH**/ ?>