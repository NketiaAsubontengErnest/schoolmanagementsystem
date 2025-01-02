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
            Add Credit to student
        </h4>
        <div
            class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
            <form action="" method="post">
                <!-- Invalid input -->
                <div class="flex gap-6">
                    <label class="block flex-1 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">
                            Student
                        </span>
                        <select name="studentid" class="block w-full mt-1 text-sm <?= isset($errors['subjid']) ? 'border-red-600' : '' ?> dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input" id="">
                            <option value="">-- Select Student --</option>
                            <?php foreach ($rows as $stud): ?>
                                <option <?= get_select('studentid', esc($stud->studentid)) ?> value="<?= esc($stud->studentid) ?>"><?= esc($stud->first_name) ?> <?= esc($stud->last_name) ?> (<?= esc($stud->studentid) ?>) - <?= esc($stud->class->classname) ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?php if (isset($errors['subjid'])) : ?>
                            <span class="text-xs text-red-600 dark:text-red-400">
                                <?= $errors['subjid'] ?>
                            </span>
                        <?php endif; ?>
                    </label>
                    <label class="block flex-1 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">
                            Amount in GHC
                        </span>
                        <input name="credit" type="text" class="block w-full mt-1 text-sm <?= isset($errors['credit']) ? 'border-red-600' : '' ?> dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input">
                        <?php if (isset($errors['credit'])) : ?>
                            <span class="text-xs text-red-600 dark:text-red-400">
                                <?= $errors['credit'] ?>
                            </span>
                        <?php endif; ?>
                    </label>
                </div>

                <div class="py-4">
                    <button
                        class="px-5 py-3 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                        Add Credit
                    </button>
                </div>

            </form>
        </div>
    </div>
</main>
<?php $this->view('includes/footer', ['crumbs' => $crumbs, 'actives' => $actives, 'hiddenSearch' => $hiddenSearch,]) ?>