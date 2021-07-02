<?php $__env->startSection('seo_title'); ?> <?php echo app('translator')->get('dashboard.withdrawal'); ?> - <?php $__env->stopSection(); ?>

<?php $__env->startSection( 'account_section' ); ?>

<div class="shadow-sm card add-padding">
    <h2 class="ml-2">
        <i class="fas fa-coins mr-2 pt-1"></i> <?php echo app('translator')->get('dashboard.withdrawal'); ?>
    </h2>
	<hr>

	<?php
if (! isset($_instance)) {
    $dom = \Livewire\Livewire::mount('withdrawals')->dom;
} elseif ($_instance->childHasBeenRendered('0IrLS9z')) {
    $componentId = $_instance->getRenderedChildComponentId('0IrLS9z');
    $componentTag = $_instance->getRenderedChildComponentTagName('0IrLS9z');
    $dom = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('0IrLS9z');
} else {
    $response = \Livewire\Livewire::mount('withdrawals');
    $dom = $response->dom;
    $_instance->logRenderedChild('0IrLS9z', $response->id, \Livewire\Livewire::getRootElementTagName($dom));
}
echo $dom;
?>

	<br>

</div>

<?php $__env->stopSection(); ?>


<?php $__env->startPush('extraJS'); ?>
<script>
    // listen to livewire growl messages
    window.livewire.on('request-amount', function (response) {
        $.growl({ title: response.amount, message: '' });
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make( 'account' , \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/tagahanga.ru/data/www/tagahanga.ru/resources/views/withdrawals/index.blade.php ENDPATH**/ ?>