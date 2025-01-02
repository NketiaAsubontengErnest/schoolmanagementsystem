<?php $this->view('includes/header', ['crumbs' => $crumbs, 'actives' => $actives, 'hiddenSearch' => $hiddenSearch,]) ?>

<!-- Desktop sidebar -->
<?php $this->view('includes/sidebar', ['crumbs' => $crumbs, 'actives' => $actives, 'hiddenSearch' => $hiddenSearch,]) ?>

<!-- Mobile sidebar -->
<?php $this->view('includes/navbar', ['crumbs' => $crumbs, 'actives' => $actives, 'hiddenSearch' => $hiddenSearch,]) ?>

<main class="h-full overflow-y-auto">
    <div class="container px-6 mx-auto grid">
        <!-- Validation inputs -->
        <?php if ($row): ?>
            <h4
                class="py-3 mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
                Clearance Payment for <?= $row->classes->classname ?>
            </h4>

            <div
                class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                <form action="" method="post">

                    <div class="flex gap-6">
                        <label class="block flex-1 text-sm">
                            <span class="text-gray-700 dark:text-gray-400">
                                Date
                            </span>
                            <input name="" type="date"
                                class="block w-full mt-1 text-sm <?= isset($errors['classnum']) ? 'border-red-600' : '' ?> dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input"
                                value="<?= get_var('classnum', $row->date) ?>" readonly />
                            <?php if (isset($errors['classnum'])) : ?>
                                <span class="text-xs text-red-600 dark:text-red-400">
                                    <?= $errors['classnum'] ?>
                                </span>
                            <?php endif; ?>
                        </label>
                        <label class="block flex-1 text-sm">
                            <span class="text-gray-700 dark:text-gray-400">
                                Number Present
                            </span>
                            <input name="numberpresent"
                                class="block w-full mt-1 text-sm <?= isset($errors['numberpresent']) ? 'border-red-600' : '' ?> dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input"
                                value="<?= get_var('numberpresent', $row->numberpresent) ?>" readonly />
                            <?php if (isset($errors['numberpresent'])) : ?>
                                <span class="text-xs text-red-600 dark:text-red-400">
                                    <?= $errors['numberpresent'] ?>
                                </span>
                            <?php endif; ?>
                        </label>

                        <label class="block flex-1 text-sm">
                            <span class="text-gray-700 dark:text-gray-400">
                                Number Paid <code class="text-red-700">*</code>
                            </span>
                            <input name="numberpaid"
                                class="block w-full mt-1 text-sm <?= isset($errors['numberpaid']) ? 'border-red-600' : '' ?> dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input"
                                value="<?= get_var('numberpaid', $row->numberpaid) ?>" readonly/>
                            <?php if (isset($errors['numberpaid'])) : ?>
                                <span class="text-xs text-red-600 dark:text-red-400">
                                    <?= $errors['numberpaid'] ?>
                                </span>
                            <?php endif; ?>
                        </label>

                        <label class="block flex-1 text-sm">
                            <span class="text-gray-700 dark:text-gray-400">
                                Number Not Paid <code class="text-red-700">*</code>
                            </span>
                            <input name="numnotpaid"
                                class="block w-full mt-1 text-sm <?= isset($errors['numnotpaid']) ? 'border-red-600' : '' ?> dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input"
                                value="<?= get_var('numnotpaid', $row->numnotpaid) ?>" readonly />
                            <?php if (isset($errors['numnotpaid'])) : ?>
                                <span class="text-xs text-red-600 dark:text-red-400">
                                    <?= $errors['numnotpaid'] ?>
                                </span>
                            <?php endif; ?>
                        </label>

                    </div>
                </form>
            </div>

        <?php else: ?>
            No data found
        <?php endif ?>

        <div class="w-full overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-3">Student #</th>
                            <th class="px-4 py-3">Student Name</th>
                            <th class="px-4 py-3">School Fees</th>
                            <th class="px-4 py-3">Classes Fees</th>
                            <?php if (Auth::access('administrator')): ?>
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
                                        <p class="font-semibold"><?= esc($row->studentnumber) ?></p>
                                    </td>
                                    <td class="px-4 py-3">
                                        <p class="font-semibold"><?= esc($row->students->first_name) ?> <?= esc($row->students->last_name) ?></p>
                                    </td>
                                    <td class="px-4 py-3">
                                        <p class="font-semibold">GHC <?= esc($row->schoolfee) ?></p>
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        GHC <?= esc($row->classfee) ?>
                                    </td>
                                    <?php if (Auth::access('administrator')): ?>
                                        <td class="px-4 py-3">
                                            <div class="flex items-center space-x-4 text-sm">
                                                <form method="post">
                                                    <button name="clearstud" value="<?= esc($row->id) ?>"
                                                        class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                                        aria-label="Edit">
                                                        <span>Clear</span>
                                                    </button>
                                                </form>
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
    </div>
</main>
<?php $this->view('includes/footer', ['crumbs' => $crumbs, 'actives' => $actives, 'hiddenSearch' => $hiddenSearch,]) ?>