

<?php $__env->startSection('title', 'Match'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
        <div class="bg-white shadow rounded-lg p-6 mb-6">
            <div class="text-center mb-6">
                <div class="flex items-center justify-center space-x-8">
                    <div class="flex-1 text-right">
                        <h2 class="text-2xl font-bold"><?php echo e($match->homeTeam->name); ?></h2>
                    </div>
                    <div class="text-center">
                        <?php if($match->status === 'finished'): ?>
                            <div class="text-4xl font-bold"><?php echo e($match->home_score); ?> - <?php echo e($match->away_score); ?></div>
                        <?php else: ?>
                            <div class="text-lg text-gray-500"><?php echo e($match->match_date->format('d/m/Y H:i')); ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="flex-1 text-left">
                        <h2 class="text-2xl font-bold"><?php echo e($match->awayTeam->name); ?></h2>
                    </div>
                </div>
                <div class="mt-4">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
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

            <div class="grid grid-cols-2 gap-4 text-sm text-center">
                <?php if($match->venue): ?>
                    <div>
                        <span class="font-medium">Lieu:</span> <?php echo e($match->venue); ?>

                    </div>
                <?php endif; ?>
                <?php if($match->round): ?>
                    <div>
                        <span class="font-medium">Journée:</span> <?php echo e($match->round); ?>

                    </div>
                <?php endif; ?>
            </div>
        </div>

        <?php if($match->events->count() > 0): ?>
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-xl font-semibold mb-4">Événements du match</h3>
                <ul class="space-y-2">
                    <?php $__currentLoopData = $match->events->sortBy('minute'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="flex items-center justify-between py-2 border-b border-gray-200">
                            <div class="flex items-center space-x-4">
                                <span class="font-medium"><?php echo e($event->minute); ?>'</span>
                                <span>
                                    <?php if($event->player): ?>
                                        <?php echo e($event->player->full_name); ?>

                                    <?php endif; ?>
                                    - 
                                    <?php if($event->type === 'goal'): ?> But
                                    <?php elseif($event->type === 'assist'): ?> Passe décisive
                                    <?php elseif($event->type === 'yellow_card'): ?> Carton jaune
                                    <?php elseif($event->type === 'red_card'): ?> Carton rouge
                                    <?php elseif($event->type === 'substitution'): ?> Remplacement
                                    <?php else: ?> <?php echo e($event->type); ?>

                                    <?php endif; ?>
                                </span>
                            </div>
                            <span class="text-sm text-gray-500">
                                <?php echo e($event->is_home_team ? $match->homeTeam->name : $match->awayTeam->name); ?>

                            </span>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.public', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\abdel\OneDrive\Desktop\project web\resources\views/public/match.blade.php ENDPATH**/ ?>