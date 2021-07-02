

<?php $__env->startSection('seo_title'); ?> Yandex - <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-5">
	<div class="row">
		<div class="col-12 col-sm-12 col-md-6 offset-0 offset-sm-0 offset-md-3">
			<div class="card shadow-sm p-3">
				Subscribe
				<form method="POST" action="https://yoomoney.ru/quickpay/confirm.xml">   
				<input type="hidden" name="receiver" value="41001259469398">    
				<!-- <input type="hidden" name="formcomment" value="Благотворительное пожертвование <?php echo e($user->profile->username); ?>">
				<input type="hidden" name="short-dest" value="Благотворительное пожертвование <?php echo e($user->profile->username); ?>"> -->
				<input type="hidden" name="label" value="<?php echo e($subPlan->subscription_id); ?>"> 
				<input type="hidden" name="quickpay-form" value="donate">
				<input type="hidden" name="targets" value="Благотворительное пожертвование <?php echo e($user->profile->username); ?>"> 
				<input type="hidden" name="sum" value="<?php echo e(number_format($user->profile->finalPrice,2)); ?>" data-type="number"> 
				<!-- <input type="hidden" name="comment" value="Благотворительное пожертвование <?php echo e($user->profile->username); ?>"> -->
				<input type="hidden" name="need-fio" value="false">
				<input type="hidden" name="need-email" value="false">
				<input type="hidden" name="need-phone" value="false">
				<input type="hidden" name="need-address" value="false">
				<input type="submit" value="Перевести <?php echo e(number_format($user->profile->finalPrice,2)); ?> <?php echo e(opt('payment-settings.currency_symbol')); ?>" class="btn btn-primary">
				</form>
			</div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('welcome', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/tagahanga.ru/data/www/tagahanga.ru/resources/views/subscribe/yandex.blade.php ENDPATH**/ ?>