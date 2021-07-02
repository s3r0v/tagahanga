<?php $__env->startComponent('mail::message'); ?>

Hi Admin,<br>

<strong><?php echo e($report->reporter_name); ?></strong> just created an abuse report for this url <small>only click if it is your own domain, otherwise it is recommended to ignore</small>: <br>
<br>
<a href="<?php echo e($report->reported_url); ?>"><?php echo e($report->reported_url); ?></a>
<br><br>
<strong>IP Address: </strong> <?php echo e($report->reporter_ip); ?>


<br>
<a href="<?php echo e(route('admin-moderate-content', ['contentType' => 'Image'])); ?>">
    View Abuse Reports
</a>

<br><br>

Regards,<br>
<?php echo e(env('APP_NAME')); ?>


<?php echo $__env->renderComponent(); ?><?php /**PATH /var/www/tagahanga.ru/data/www/tagahanga.ru/resources/views/emails/adminContentReported.blade.php ENDPATH**/ ?>