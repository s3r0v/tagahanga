<?php $__env->startComponent('mail::message'); ?>

Hi <em><strong><?php echo e($notifiable->name); ?></strong></em>,<br>

Congratulations, <br>

<strong><?php echo e($subscriber->name); ?></strong> just subscribed to your premium content!<br>

Checkout <a href="<?php echo e(route('profile.show', ['username' => $subscriber->profile->username])); ?>">
<?php echo e($subscriber->profile->handle); ?></a> profile

<br>

<a href="<?php echo e(route('mySubscribers')); ?>">
    View My Subscribers
</a>

<br><br>

Regards,<br>
<?php echo e(env('APP_NAME')); ?>


<?php echo $__env->renderComponent(); ?><?php /**PATH /var/www/tagahanga.ru/data/www/tagahanga.ru/resources/views/emails/creatorPaidSubscriber.blade.php ENDPATH**/ ?>