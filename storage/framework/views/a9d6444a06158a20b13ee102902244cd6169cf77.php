<?php $__env->startComponent('mail::message'); ?>

Hi Admin,<br>

<strong><?php echo e($name); ?></strong> just sent you a message via your site contact form: <br>
<br>

<strong>Email:</strong> <?php echo e($email); ?><br>
<strong>Subject:</strong> <?php echo e($subject); ?><br>
<strong>Message: </strong><br>
<?php echo e($message); ?>


<br>
<strong>IP Address: </strong> <?php echo e(request()->ip()); ?>


<br><br>

Regards,<br>
<?php echo e(env('APP_NAME')); ?>


<?php echo $__env->renderComponent(); ?><?php /**PATH /var/www/tagahanga.ru/data/www/tagahanga.ru/resources/views/emails/adminContactFormMail.blade.php ENDPATH**/ ?>