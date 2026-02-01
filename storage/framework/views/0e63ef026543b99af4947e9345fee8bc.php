<?php $__env->startSection('title', 'Accueil'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
        <h1 class="text-4xl font-bold text-gray-900 mb-8">Bienvenue sur la Ligue Sportive</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-2xl font-semibold mb-4">Prochains matchs</h2>
                <?php if($upcomingMatches->count() > 0): ?>
                    <ul class="space-y-4">
                        <?php $__currentLoopData = $upcomingMatches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $match): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="border-b border-gray-200 pb-4">
                                <div class="flex items-center justify-between">
                                    <div class="flex-1">
                                        <div class="flex items-center space-x-4">
                                            <div class="flex-1 text-right">
                                                <div class="font-medium"><?php echo e($match->homeTeam->name); ?></div>
                                            </div>
                                            <div class="text-center text-gray-500">
                                                <?php echo e($match->match_date->format('d/m H:i')); ?>

                                            </div>
                                            <div class="flex-1">
                                                <div class="font-medium"><?php echo e($match->awayTeam->name); ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                <?php else: ?>
                    <p class="text-gray-500">Aucun match à venir</p>
                <?php endif; ?>
            </div>

            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-2xl font-semibold mb-4">Derniers résultats</h2>
                <?php if($recentMatches->count() > 0): ?>
                    <ul class="space-y-4">
                        <?php $__currentLoopData = $recentMatches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $match): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="border-b border-gray-200 pb-4">
                                <div class="flex items-center justify-between">
                                    <div class="flex-1">
                                        <div class="flex items-center space-x-4">
                                            <div class="flex-1 text-right">
                                                <div class="font-medium"><?php echo e($match->homeTeam->name); ?></div>
                                            </div>
                                            <div class="text-center">
                                                <span class="text-lg font-bold"><?php echo e($match->home_score); ?> - <?php echo e($match->away_score); ?></span>
                                            </div>
                                            <div class="flex-1">
                                                <div class="font-medium"><?php echo e($match->awayTeam->name); ?></div>
                                            </div>
                                        </div>
                                        <div class="text-center text-sm text-gray-500 mt-1">
                                            <?php echo e($match->match_date->format('d/m/Y')); ?>

                                        </div>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                <?php else: ?>
                    <p class="text-gray-500">Aucun résultat récent</p>
                <?php endif; ?>
            </div>
        </div>

        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-2xl font-semibold mb-4">Classement actuel</h2>
            <?php if($standings->count() > 0): ?>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Pos</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Équipe</th>
                                <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase">J</th>
                                <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase">G</th>
                                <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase">N</th>
                                <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase">P</th>
                                <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase">Pts</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php $__currentLoopData = $standings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $standing): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm font-medium"><?php echo e($standing->position); ?></td>
                                    <td class="px-4 py-3 whitespace-nowrap">
                                        <a href="<?php echo e(route('public.team', $standing->team->slug)); ?>" class="text-sm font-medium text-blue-600 hover:text-blue-800">
                                            <?php echo e($standing->team->name); ?>

                                        </a>
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-center"><?php echo e($standing->played); ?></td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-center"><?php echo e($standing->won); ?></td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-center"><?php echo e($standing->drawn); ?></td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-center"><?php echo e($standing->lost); ?></td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm font-bold text-center"><?php echo e($standing->points); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
                <div class="mt-4 text-center">
                    <a href="<?php echo e(route('public.standings')); ?>" class="text-blue-600 hover:text-blue-800">Voir le classement complet</a>
                </div>
            <?php else: ?>
                <p class="text-gray-500">Aucun classement disponible</p>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.public', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\abdel\OneDrive\Desktop\project web\resources\views/public/index.blade.php ENDPATH**/ ?>