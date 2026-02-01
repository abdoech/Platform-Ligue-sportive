

<?php $__env->startSection('title', 'Classements'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-900">Classements</h1>
            <form method="GET" action="<?php echo e(route('public.standings')); ?>">
                <select name="season" onchange="this.form.submit()" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <?php $__currentLoopData = $seasons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $season): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($season); ?>" <?php echo e($season == $currentSeason ? 'selected' : ''); ?>>
                            Saison <?php echo e($season); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </form>
        </div>

        <div class="bg-white shadow overflow-hidden sm:rounded-md">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Pos</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Équipe</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">J</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">G</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">N</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">P</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">BP</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">BC</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">DB</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Pts</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php $__currentLoopData = $standings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $standing): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium"><?php echo e($standing->position); ?></td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <a href="<?php echo e(route('public.team', $standing->team->slug)); ?>" class="text-sm font-medium text-blue-600 hover:text-blue-800">
                                    <?php echo e($standing->team->name); ?>

                                </a>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center"><?php echo e($standing->played); ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center"><?php echo e($standing->won); ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center"><?php echo e($standing->drawn); ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center"><?php echo e($standing->lost); ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center"><?php echo e($standing->goals_for); ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center"><?php echo e($standing->goals_against); ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                                <?php echo e($standing->goal_difference > 0 ? '+' : ''); ?><?php echo e($standing->goal_difference); ?>

                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-center"><?php echo e($standing->points); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.public', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\abdel\OneDrive\Desktop\project web\resources\views/public/standings.blade.php ENDPATH**/ ?>