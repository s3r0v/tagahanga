<?php $__env->startSection('section_title'); ?>
	<strong>Payments Settings</strong>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('section_body'); ?>

<?php
if (! isset($_instance)) {
    $dom = \Livewire\Livewire::mount('admin-payment-settings')->dom;
} elseif ($_instance->childHasBeenRendered('GxA2nkz')) {
    $componentId = $_instance->getRenderedChildComponentId('GxA2nkz');
    $componentTag = $_instance->getRenderedChildComponentTagName('GxA2nkz');
    $dom = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('GxA2nkz');
} else {
    $response = \Livewire\Livewire::mount('admin-payment-settings');
    $dom = $response->dom;
    $_instance->logRenderedChild('GxA2nkz', $response->id, \Livewire\Livewire::getRootElementTagName($dom));
}
echo $dom;
?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/tagahanga.ru/data/www/tagahanga.ru/resources/views/admin/payments-setup.blade.php ENDPATH**/ ?>