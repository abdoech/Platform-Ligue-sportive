

<?php $__env->startSection('title', 'Équipes'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
        <h1 class="text-3xl font-bold text-gray-900 mb-6">Équipes</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php $__currentLoopData = $teams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $team): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="bg-white shadow rounded-lg overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <div class="flex-shrink-0 h-16 w-16 bg-gray-300 rounded-full flex items-center justify-center">
                                <span class="text-gray-600 font-bold text-xl"><?php echo e($team->name[0]); ?></span>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-900">
                                    <a href="<?php echo e(route('public.team', $team->slug)); ?>" class="hover:text-blue-600">
                                        <?php echo e($team->name); ?>

                                    </a>
                                </h3>
                                <?php if($team->city): ?>
                                    <p class="text-sm text-gray-500"><?php echo e($team->city); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="text-sm text-gray-600">
                            <p><?php echo e($team->players_count); ?> joueur<?php echo e($team->players_count > 1 ? 's' : ''); ?></p>
                            <?php if($team->stadium): ?>
                                <p class="mt-1">Stade: <?php echo e($team->stadium); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.public', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\abdel\OneDrive\Desktop\project web\resources\views/public/teams.blade.php ENDPATH**/ ?>