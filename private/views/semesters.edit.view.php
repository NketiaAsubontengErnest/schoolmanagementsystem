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
            Edit Semesters
        </h4>
        <?php if ($row): ?>
            <div
                class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                <form action="" method="post">
                    <!-- Invalid input -->
                    <div class="flex gap-6">

                        <label class="block flex-1 text-sm">
                            <span class="text-gray-700 dark:text-gray-400">Semester Name</span>
                            <input name="semester" type="semester" value="<?= get_var('semester', $row->semester) ?>"
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
                                    <option <?=get_select('academyearid', $acyear->id, $row->academyearid)?> value="<?= esc($acyear->id) ?>"><?= esc($acyear->academicyear) ?></option>
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
                            <input name="reportdate" type="date" value="<?= get_var('reportdate', $row->reportdate) ?>"
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
                            <input name="nextdate" type="date" value="<?= get_var('nextdate', $row->nextdate) ?>"
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
                            <input name="numofdays" type="number" value="<?= get_var('numofdays', $row->numofdays) ?>"
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
                            Udate Semester
                        </button>
                    </div>

                </form>
            </div>
        <?php else: ?>
            No data found
        <?php endif ?>
    </div>
</main>
<?php $this->view('includes/footer', ['crumbs' => $crumbs, 'actives' => $actives, 'hiddenSearch' => $hiddenSearch,]) ?>