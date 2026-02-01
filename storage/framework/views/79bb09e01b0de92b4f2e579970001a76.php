<?php $__env->startSection('title', $team->name); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
        <div class="bg-white shadow rounded-lg p-6 mb-6">
            <div class="flex items-center mb-4">
                <div class="flex-shrink-0 h-20 w-20 bg-gray-300 rounded-full flex items-center justify-center">
                    <span class="text-gray-600 font-bold text-2xl"><?php echo e($team->name[0]); ?></span>
                </div>
                <div class="ml-4">
                    <h1 class="text-3xl font-bold text-gray-900"><?php echo e($team->name); ?></h1>
                    <?php if($team->city): ?>
                        <p class="text-lg text-gray-600"><?php echo e($team->city); ?></p>
                    <?php endif; ?>
                </div>
            </div>
            <?php if($team->description): ?>
                <p class="text-gray-700 mb-4"><?php echo e($team->description); ?></p>
            <?php endif; ?>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                <?php if($team->stadium): ?>
                    <div>
                        <span class="font-medium">Stade:</span> <?php echo e($team->stadium); ?>

                    </div>
                <?php endif; ?>
                <?php if($team->founded_year): ?>
                    <div>
                        <span class="font-medium">Fondé en:</span> <?php echo e($team->founded_year); ?>

                    </div>
                <?php endif; ?>
                <div>
                    <span class="font-medium">Joueurs:</span> <?php echo e($team->players->count()); ?>

                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-2xl font-semibold mb-4">Joueurs</h2>
                <?php if($team->players->count() > 0): ?>
                    <ul class="divide-y divide-gray-200">
                        <?php $__currentLoopData = $team->players->where('is_active', true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $player): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="py-3">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <div class="font-medium"><?php echo e($player->full_name); ?></div>
                                        <div class="text-sm text-gray-500">
                                            <?php if($player->position): ?>
                                                <?php echo e($player->position); ?>

                                            <?php endif; ?>
                                            <?php if($player->position && $player->age): ?>
                                                ·
                                            <?php endif; ?>
                                            <?php if($player->age): ?>
                                                Âge: <?php echo e($player->age); ?> ans
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <?php if($player->jersey_number): ?>
                                        <span class="text-sm font-medium text-gray-900">#<?php echo e($player->jersey_number); ?></span>
                                    <?php endif; ?>
                                </div>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                <?php else: ?>
                    <p class="text-gray-500">Aucun joueur enregistré</p>
                <?php endif; ?>
            </div>

            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-2xl font-semibold mb-4">Statistiques</h2>
                <?php if($team->standings->count() > 0): ?>
                    <div class="space-y-2">
                        <?php $__currentLoopData = $team->standings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $standing): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="border-b border-gray-200 pb-2 mb-2">
                                <div class="font-medium">Saison <?php echo e($standing->season); ?></div>
                                <div class="text-sm text-gray-600">
                                    Position: <?php echo e($standing->position ?? 'N/A'); ?> | 
                                    Points: <?php echo e($standing->points); ?> | 
                                    Matchs: <?php echo e($standing->played); ?>

                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php else: ?>
                    <p class="text-gray-500">Aucune statistique disponible</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.public', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\abdel\OneDrive\Desktop\project web\resources\views/public/team.blade.php ENDPATH**/ ?>