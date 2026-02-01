

<?php $__env->startSection('title', 'Matchs'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-900">Matchs</h1>
            <form method="GET" action="<?php echo e(route('public.matches')); ?>">
                <select name="season" onchange="this.form.submit()" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="">Toutes les saisons</option>
                    <?php $__currentLoopData = $seasons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $season): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($season); ?>" <?php echo e(request('season') == $season ? 'selected' : ''); ?>>
                            Saison <?php echo e($season); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </form>
        </div>

        <div class="bg-white shadow overflow-hidden sm:rounded-md">
            <ul class="divide-y divide-gray-200">
                <?php $__currentLoopData = $matches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $match): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li>
                        <a href="<?php echo e(route('public.match', $match->id)); ?>" class="block hover:bg-gray-50">
                            <div class="px-4 py-4 sm:px-6">
                                <div class="flex items-center justify-between">
                                    <div class="flex-1">
                                        <div class="flex items-center space-x-4">
                                            <div class="flex-1 text-right">
                                                <div class="text-sm font-medium text-gray-900"><?php echo e($match->homeTeam->name); ?></div>
                                            </div>
                                            <div class="text-center">
                                                <?php if($match->status === 'finished'): ?>
                                                    <span class="text-lg font-bold"><?php echo e($match->home_score); ?> - <?php echo e($match->away_score); ?></span>
                                                <?php else: ?>
                                                    <span class="text-sm text-gray-500"><?php echo e($match->match_date->format('d/m H:i')); ?></span>
                                                <?php endif; ?>
                                            </div>
                                            <div class="flex-1">
                                                <div class="text-sm font-medium text-gray-900"><?php echo e($match->awayTeam->name); ?></div>
                                            </div>
                                        </div>
                                        <div class="mt-2 text-center">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                <?php if($match->status === 'finished'): ?> bg-green-100 text-green-800
                                                <?php elseif($match->status === 'live'): ?> bg-red-100 text-red-800
                                                <?php else: ?> bg-gray-100 text-gray-800
                                                <?php endif; ?>">
                                                <?php if($match->status === 'finished'): ?> Terminé
                                                <?php elseif($match->status === 'live'): ?> En direct
                                                <?php else: ?> Programmé
                                                <?php endif; ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>

        <div class="mt-4">
            <?php echo e($matches->links()); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.public', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\abdel\OneDrive\Desktop\project web\resources\views/public/matches.blade.php ENDPATH**/ ?>