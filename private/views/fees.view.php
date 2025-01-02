<?php $this->view('includes/header', ['crumbs' => $crumbs, 'actives' => $actives, 'hiddenSearch' => $hiddenSearch,]) ?>

<!-- Desktop sidebar -->
<?php $this->view('includes/sidebar', ['crumbs' => $crumbs, 'actives' => $actives, 'hiddenSearch' => $hiddenSearch,]) ?>

<!-- Mobile sidebar -->
<?php $this->view('includes/navbar', ['crumbs' => $crumbs, 'actives' => $actives, 'hiddenSearch' => $hiddenSearch,]) ?>

<main class="h-full overflow-y-auto">
    <div class="container px-6 mx-auto grid">
        <!-- Validation inputs -->
        <h4
            class="py-3 mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
            Fee Records
        </h4>
        <div class="w-full overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-3">Class Name</th>
                            <th class="px-4 py-3">Total Number</th>
                            <th class="px-4 py-3">Number Present</th>
                            <th class="px-4 py-3">Number Absent</th>
                            <?php if (Auth::access('assistfinance')): ?>
                            <th class="px-4 py-3">Actions</th>
                            <?php endif ?>
                        </tr>
                    </thead>
                    <tbody
                        class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        <?php if ($rows) : ?>
                            <?php foreach ($rows as $row) : ?>
                                <tr class="text-gray-700 dark:text-gray-400">
                                    <td class="px-4 py-3">
                                        <p class="font-semibold"><?= esc($row->classname) ?></p>
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        <?= esc($row->classnum->numbers) ?>
                                    </td>

                                    <td class="px-4 py-3 text-sm">
                                        <?= esc($row->attends->attendance_count) ?>
                                    </td>

                                    <td class="px-4 py-3 text-sm">
                                        <?= esc($row->attends->absent_count) ?>
                                    </td>
                                    <?php if (Auth::access('assistfinance')): ?>
                                    <td class="px-4 py-3">
                                        <div class="flex items-center space-x-4 text-sm"> 
                                            <?php if($row->attends->attendance_count>0):?>                                   
                                            <!-- Add Link with Plus Icon -->
                                            <a href="<?= HOME ?>/fees/record/<?= esc($row->id) ?>"
                                                class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-green-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                                aria-label="Add">
                                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                                                </svg>
                                                <span>Pay Fees</span>
                                            </a>
                                            <?php endif?>
                                        </div>
                                    </td>
                                    <?php endif ?>
                                </tr>
                            <?php endforeach ?>
                        <?php else: ?>
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td colspan="5" class="px-4 py-3 align-middle text-center text-sm">
                                    No data found
                                </td>
                            </tr>
                        <?php endif ?>

                    </tbody>
                </table>
            </div>
        </div>

        <h4
            class="py-3 mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
            Class Payments
        </h4>
        <div class="w-full overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-3">Class Name</th>
                            <th class="px-4 py-3">School Fees</th>
                            <th class="px-4 py-3">Classes Fees</th>
                            <th class="px-4 py-3">Feeding Fees</th>
                            <th class="px-4 py-3">Actions</th>
                        </tr>
                    </thead>
                   
                    <tbody
                        class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        <?php if ($rowsfee) : ?>
                            <?php foreach ($rowsfee as $row) : ?>
                                <tr class="text-gray-700 dark:text-gray-400">
                                    <td class="px-4 py-3">
                                        <p class="font-semibold"><?= esc($row->classes->classname) ?></p>
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        GHC <?= esc($row->schoolfeeghc) ?> 
                                    </td>

                                    <td class="px-4 py-3 text-sm">
                                        GHC <?= esc($row->classfeeghc) ?> 
                                    </td>
                                    <td class="px-4 py-3 text-sm"> 
                                        GHC <?= esc($row->feedfeeghc) ?> 
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="flex items-center space-x-4 text-sm">
                                            <a href="<?= HOME ?>/fees/record/<?= esc($row->classes->id) ?>"
                                                class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                                aria-label="Edit">
                                                <svg
                                                    class="w-5 h-5"
                                                    aria-hidden="true"
                                                    fill="currentColor"
                                                    viewBox="0 0 20 20">
                                                    <path
                                                        d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                                </svg>
                                            </a>                                            
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        <?php else: ?>
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td colspan="5" class="px-4 py-3 align-middle text-center text-sm">
                                    No data found
                                </td>
                            </tr>
                        <?php endif ?>

                    </tbody>
                </table>
            </div>
        </div>

    </div>
</main>
<?php $this->view('includes/footer', ['crumbs' => $crumbs, 'actives' => $actives, 'hiddenSearch' => $hiddenSearch,]) ?>