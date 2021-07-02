<?php $__env->startSection('section_title'); ?>
	<strong>Pages Manager - Page Update</strong>
	<br/>
	<a href="<?php echo e(route('admin-cms')); ?>">Pages Overview</a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('section_body'); ?>
	
	<form method="POST">
		<?php echo e(csrf_field()); ?>


		<dl>
		<dt>Page Title</dt>
		<dd><input type="text" name="page_title" class="form-control" value="<?php echo e($p->page_title); ?>"></dd>
		<br>
		<dt>Page Content</dt>
		<dd><textarea name="page_content" class="textarea form-control" rows="8"><?php echo e($p->page_content); ?></textarea></dd>
		<dt>&nbsp;</dt>
		<dd><input type="submit" name="sb_page" class="btn btn-primary" value="Save"></dd>
		</dl>

	</form>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/tagahanga.ru/data/www/tagahanga.ru/resources/views/admin/update-page.blade.php ENDPATH**/ ?>