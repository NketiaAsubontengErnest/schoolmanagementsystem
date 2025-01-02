<?php $this->view('includes/header', ['crumbs' => $crumbs, 'actives' => $actives, 'hiddenSearch' => $hiddenSearch,]) ?>

<!-- Desktop sidebar -->
<?php $this->view('includes/sidebar', ['crumbs' => $crumbs, 'actives' => $actives, 'hiddenSearch' => $hiddenSearch,]) ?>

<!-- Mobile sidebar -->
<?php $this->view('includes/navbar', ['crumbs' => $crumbs, 'actives' => $actives, 'hiddenSearch' => $hiddenSearch,]) ?>

<main class="h-full overflow-y-auto">
    <div class="container px-6 mx-auto grid">
        <h4
            class="py-3 mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
            Report for Student <?= $row->first_name ?> <?= $row->last_name ?>
        </h4>
        <h4
            class="py-3 mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
            Number Present: <?= $row->attends->attended ?>
        </h4>

        <div class="w-full overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-3">Subject</th>
                            <th class="px-4 py-3">Assess. Mark (50%)</th>
                            <th class="px-4 py-3">Exam Mark (50%)</th>
                            <th class="px-4 py-3">Total (100%)</th>
                            <th class="px-4 py-3">Remarks</th>
                        </tr>
                    </thead>
                    <tbody
                        class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        <?php if ($rowreport) : ?>
                            <?php foreach ($rowreport as $row) : ?>
                                <tr class="text-gray-700 dark:text-gray-400">
                                    <td class="px-4 py-3">
                                        <p class="font-semibold"><?= esc($row->subject->title) ?></p>
                                    </td>
                                    <td class="px-4 py-3">
                                        <p class="font-semibold"><?= esc($row->contasses) ?></p>
                                    </td>
                                    <td class="px-4 py-3">
                                        <p class="font-semibold"><?= esc($row->exammark) ?></p>
                                    </td>
                                    <td class="px-4 py-3">
                                        <p class="font-semibold"><?= esc($row->contasses + $row->exammark) ?></p>
                                    </td>
                                    <td class="px-4 py-3">
                                        <p class="font-semibold"><?= esc(get_Stud_Remarks($row->contasses + $row->exammark)) ?></p>
                                    </td>
                                </tr>

                            <?php endforeach ?>
                        <?php else: ?>
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td colspan="7" class="px-4 py-3 align-middle text-center text-sm">
                                    No data found
                                </td>
                            </tr>
                        <?php endif ?>

                    </tbody>
                </table>
            </div>
            <div
                class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
                <span class="flex items-center col-span-3">
                    
                </span>
                <span class="col-span-2"></span>
                <!-- Pagination -->
                <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
                    <nav aria-label="Table navigation">
                        <a target="_blank" href="<?= HOME ?>/reports/download/<?= esc($row->studentid) ?>"
                            class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                            aria-label="Edit">
                           <span>Donload PDF</span>
                        </a>
                    </nav>
                </span>
            </div>
        </div>

    </div>
</main>
<?php $this->view('includes/footer', ['crumbs' => $crumbs, 'actives' => $actives, 'hiddenSearch' => $hiddenSearch,]) ?>