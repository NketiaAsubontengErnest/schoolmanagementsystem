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
            Edit Class
        </h4>
        <?php if ($row): ?>
            <div
                class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                <form action="" method="post">
                    <!-- Invalid input -->
                    <label class="block py-4 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">
                            Class Name
                        </span>
                        <input name="classname"
                            class="block w-full mt-1 text-sm <?= isset($errors['classname']) ? 'border-red-600' : '' ?> dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input"
                            value="<?= esc($row->classname) ?>" />
                        <?php if (isset($errors['classname'])) : ?>
                            <span class="text-xs text-red-600 dark:text-red-400">
                                <?= $errors['classname'] ?>
                            </span>
                        <?php endif; ?>
                    </label>

                    <!-- Admission Fee -->
                    <label class="block flex-1 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Admission Fee</span>
                        <input name="admissionfee"
                            class="block w-full mt-1 text-sm <?= isset($errors['admissionfee']) ? 'border-red-600' : '' ?> dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input"
                            value="<?= esc($row->admissionfee) ?>" />
                        <?php if (isset($errors['admissionfee'])) : ?>
                            <span class="text-xs text-red-600 dark:text-red-400">
                                <?= $errors['admissionfee'] ?>
                            </span>
                        <?php endif; ?>
                    </label>
                    <div class="flex gap-6">
                        <!-- School Fee -->
                        <label class="block flex-1 text-sm">
                            <span class="text-gray-700 dark:text-gray-400">School Fee</span>
                            <input name="schoolfee"
                                class="block w-full mt-1 text-sm <?= isset($errors['admissionfee']) ? 'border-red-600' : '' ?> dark:text-gray-300 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-red form-input"
                                value="<?= esc($row->schoolfee) ?>" />
                            <?php if (isset($errors['schoolfee'])) : ?>
                                <span class="text-xs text-red-600 dark:text-red-400">
                                    <?= $errors['schoolfee'] ?>
                                </span>
                            <?php endif; ?>
                        </label>
                        <!-- School Fee -->
                        <label class="block flex-1 text-sm">
                            <span class="text-gray-700 dark:text-gray-400">Classes Fee</span>
                            <input name="classesfee"
                                class="block w-full mt-1 text-sm <?= isset($errors['classesfee']) ? 'border-red-600' : '' ?> dark:text-gray-300 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-red form-input"
                                value="<?= esc($row->classesfee) ?>" />
                            <?php if (isset($errors['classesfee'])) : ?>
                                <span class="text-xs text-red-600 dark:text-red-400">
                                    <?= $errors['classesfee'] ?>
                                </span>
                            <?php endif; ?>
                        </label>
                        <!-- School Fee -->
                        <label class="block flex-1 text-sm">
                            <span class="text-gray-700 dark:text-gray-400">Exams Fee</span>
                            <input name="examsfee"
                                class="block w-full mt-1 text-sm <?= isset($errors['examsfee']) ? 'border-red-600' : '' ?> dark:text-gray-300 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-red form-input"
                                value="<?= esc($row->examsfee) ?>" />
                            <?php if (isset($errors['examsfee'])) : ?>
                                <span class="text-xs text-red-600 dark:text-red-400">
                                    <?= $errors['examsfee'] ?>
                                </span>
                            <?php endif; ?>
                        </label>
                    </div>

                    <div class="py-4">
                        <button
                            class="px-5 py-3 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                            Update Class
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