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
            Students List for <b><?=esc($row->classname)?></b>
        </h4>
        <div class="w-full overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">

                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-3">Student</th>
                            <th class="px-4 py-3">Gender</th>
                            <th class="px-4 py-3">Attendance</th>
                            <th class="px-4 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody
                        class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        <?php if ($rows) : ?>
                            <?php foreach ($rows as $row) : ?>
                                <tr class="text-gray-700 dark:text-gray-400">
                                    <td class="px-4 py-3">
                                        <div class="flex items-center text-sm">
                                            <!-- Avatar with inset shadow -->
                                            <div class="relative hidden w-12 h-12 mr-3 rounded-full md:block">
                                                <?php if ($row->image): ?>
                                                    <?php
                                                    // Use the image from the current row instead of `Auth::getImage()`
                                                    $image = ROOT . "/" . $row->image;
                                                    ?>
                                                    <img
                                                        class="object-cover w-full h-full rounded-full"
                                                        style="width: 100%; height: 100%; border-radius: 50%;"
                                                        src="<?= $image ?>"
                                                        alt="Student Image"
                                                        loading="lazy" />
                                                <?php endif; ?>
                                                <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                                            </div>
                                            <div>
                                                <p class="font-semibold"><?= esc($row->last_name) ?> <?= esc($row->first_name) ?></p>
                                                <p class="text-xs text-gray-600 dark:text-gray-400">
                                                    <?= esc($row->studentid) ?>
                                                </p>
                                            </div>
                                        </div>
                                        <p class="font-semibold"></p>
                                    </td>

                                    <td class="px-4 py-3 text-sm">
                                        <?= esc($row->gender) ?>
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        <?= esc($row->attends->attended) ?>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="flex items-center space-x-4 text-sm">
                                            <?php if (Auth::assert('assistacademic')): ?>
                                                <a href="<?= HOME ?>/reports/reportview/<?= esc($row->studentid) ?>"
                                                    class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                                    aria-label="Edit">
                                                    <svg
                                                        class="w-5 h-5"
                                                        aria-hidden="true"
                                                        fill="currentColor"
                                                        viewBox="0 0 20 20"> 
                                                    </svg>
                                                    <span>Report</span>
                                                </a>
                                            <?php endif ?>
                                        </div>
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
                </span>
            </div>
        </div>

    </div>
</main>
<?php $this->view('includes/footer', ['crumbs' => $crumbs, 'actives' => $actives, 'hiddenSearch' => $hiddenSearch,]) ?>