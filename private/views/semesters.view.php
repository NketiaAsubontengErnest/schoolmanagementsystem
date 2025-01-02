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
            Semesters
        </h4>
        <?php if (Auth::access('assistacademic')): ?>
            <div
                class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                <form action="" method="post">
                    <!-- Invalid input -->
                    <div class="flex gap-6">

                        <label class="block flex-1 text-sm">
                            <span class="text-gray-700 dark:text-gray-400">Semester Name</span>
                            <input name="semester" type="semester"
                                class="block w-full mt-1 text-sm <?= isset($errors['semester']) ? 'border-red-600' : '' ?> dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input" />
                            <?php if (isset($errors['semester'])) : ?>
                                <span class="text-xs text-red-600 dark:text-red-400">
                                    <?= $errors['semester'] ?>
                                </span>
                            <?php endif; ?>
                        </label>

                        <label class="block flex-1 text-sm">
                            <span class="text-gray-700 dark:text-gray-400">
                                Academic Year
                            </span>
                            <select name="academyearid" id="" class="block w-full mt-1 text-sm <?= isset($errors['academyearid']) ? 'border-red-600' : '' ?> dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input">
                                <option value="">--Select Academic Year--</option>
                                <?php foreach ($rowsacd as $acyear): ?>
                                    <option value="<?= esc($acyear->id) ?>"><?= esc($acyear->academicyear) ?></option>
                                <?php endforeach ?>
                            </select>
                            <?php if (isset($errors['academyearid'])) : ?>
                                <span class="text-xs text-red-600 dark:text-red-400">
                                    <?= $errors['academyearid'] ?>
                                </span>
                            <?php endif; ?>
                        </label>

                    </div>
                    <div class="flex gap-6">
                        <label class="block flex-1 text-sm">
                            <span class="text-gray-700 dark:text-gray-400">Report Date</span>
                            <input name="reportdate" type="date"
                                class="block w-full mt-1 text-sm <?= isset($errors['reportdate']) ? 'border-red-600' : '' ?> dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input" />
                            <?php if (isset($errors['reportdate'])) : ?>
                                <span class="text-xs text-red-600 dark:text-red-400">
                                    <?= $errors['reportdate'] ?>
                                </span>
                            <?php endif; ?>
                        </label>

                        <label class="block flex-1 text-sm">
                            <span class="text-gray-700 dark:text-gray-400">
                                Next Term Begins
                            </span>
                            <input name="nextdate" type="date"
                                class="block w-full mt-1 text-sm <?= isset($errors['nextdate']) ? 'border-red-600' : '' ?> dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input" />
                            <?php if (isset($errors['nextdate'])) : ?>
                                <span class="text-xs text-red-600 dark:text-red-400">
                                    <?= $errors['nextdate'] ?>
                                </span>
                            <?php endif; ?>
                        </label>

                        <label class="block flex-1 text-sm">
                            <span class="text-gray-700 dark:text-gray-400">
                                Number of Days
                            </span>
                            <input name="numofdays" type="text"
                                class="block w-full mt-1 text-sm <?= isset($errors['numofdays']) ? 'border-red-600' : '' ?> dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input" />
                            <?php if (isset($errors['numofdays'])) : ?>
                                <span class="text-xs text-red-600 dark:text-red-400">
                                    <?= $errors['numofdays'] ?>
                                </span>
                            <?php endif; ?>
                        </label>

                    </div>
                    <div class="py-4">
                        <button
                            class="px-5 py-3 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                            Add Semester
                        </button>
                    </div>

                </form>
            </div>
        <?php endif; ?>
        <div class="w-full overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-3">Semester</th>
                            <th class="px-4 py-3">Academic Year</th>
                            <th class="px-4 py-3">Date Added</th>
                            <th class="px-4 py-3">Report Date</th>
                            <th class="px-4 py-3">Date Re Opening</th>
                            <th class="px-4 py-3">No. of Days</th>
                            <?php if (Auth::access('assistacademic')): ?>
                                <th class="px-4 py-3">Actions</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody
                        class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        <?php if ($rows) : ?>
                            <?php foreach ($rows as $row) : ?>
                                <tr class="text-gray-700 dark:text-gray-400">
                                    <td class="px-4 py-3">
                                        <p class="font-semibold"><?= esc($row->semester) ?></p>
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        <?= esc($row->academics->academicyear) ?>
                                    </td>

                                    <td class="px-4 py-3 text-sm">
                                        <?= esc($row->date) ?>
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        <?= esc($row->reportdate) ?>
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        <?= esc($row->nextdate) ?>
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        <?= esc($row->numofdays) ?>
                                    </td>
                                    <?php if (Auth::access('assistacademic')): ?>
                                        <td class="px-4 py-3">
                                            <div class="flex items-center space-x-4 text-sm">
                                                <a href="<?= HOME ?>/semesters/edit/<?= esc($row->id) ?>"
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
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach ?>
                        <?php else: ?>
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td colspan="4" class="px-4 py-3 align-middle text-center text-sm">
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
                    <?php $pager->display($rows ? count($rows) : 0); ?>
                </span>
            </div>
        </div>

    </div>
</main>
<?php $this->view('includes/footer', ['crumbs' => $crumbs, 'actives' => $actives, 'hiddenSearch' => $hiddenSearch,]) ?>