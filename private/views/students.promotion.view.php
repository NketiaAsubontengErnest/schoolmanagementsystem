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
            Promotion
        </h4>
        <?php if ($rows): ?>
            <div
                class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                <form action="" method="post">
                    <!-- Invalid input -->
                    <div class="flex gap-6">
                        <label class="block flex-1 text-sm">
                            <span class="text-gray-700 dark:text-gray-400">
                                Old Class
                            </span>
                            <select name="oldclass" class="block w-full mt-1 text-sm <?= isset($errors['oldclass']) ? 'border-red-600' : '' ?> dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input" id="">
                                <option <?= get_select('oldclass', '') ?> value="">-- Select Old Class --</option>
                                <?php foreach ($rows as $clas): ?>
                                    <?php if ($clas->classnum->numbers != 0): ?>
                                        <option <?= get_select('oldclass', esc($clas->id)) ?> value="<?= esc($clas->id) ?>"><?= esc($clas->classname) ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                            <?php if (isset($errors['subjoldclassid'])) : ?>
                                <span class="text-xs text-red-600 dark:text-red-400">
                                    <?= $errors['oldclass'] ?>
                                </span>
                            <?php endif; ?>
                        </label>
                        <label class="block flex-1 text-sm">
                            <span class="text-gray-700 dark:text-gray-400">
                                New Class
                            </span>
                            <select name="newclass" class="block w-full mt-1 text-sm <?= isset($errors['newclass']) ? 'border-red-600' : '' ?> dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input" id="">
                                <option <?= get_select('newclass', '') ?> value="">-- Select New Class --</option>
                                <?php foreach ($rows as $clas): ?>
                                    <?php if ($clas->classnum->numbers == 0): ?>
                                        <option <?= get_select('newclass', esc($clas->id)) ?> value="<?= esc($clas->id) ?>"><?= esc($clas->classname) ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                <option <?= get_select('newclass', '99') ?> value="99">Graduate</option>
                            </select>
                            <?php if (isset($errors['newclass'])) : ?>
                                <span class="text-xs text-red-600 dark:text-red-400">
                                    <?= $errors['newclass'] ?>
                                </span>
                            <?php endif; ?>
                        </label>
                    </div>

                    <div class="py-4">
                        <button
                            class="px-5 py-3 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                            Promote
                        </button>
                    </div>

                </form>
            </div>

        <?php else: ?>
            No data found!
        <?php endif ?>

    </div>
</main>
<?php $this->view('includes/footer', ['crumbs' => $crumbs, 'actives' => $actives, 'hiddenSearch' => $hiddenSearch,]) ?>