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
                Edit Pay Fee for <?=$row->classes->classname?>
            </h4>

            <div
                class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                <form action="" method="post">
                    <!-- Invalid input -->
                    <h5 class="py-3 my-4 font-semibold text-gray-600 dark:text-gray-300">Student Bio</h5>

                    <div class="flex gap-6">
                        <label class="block flex-1 text-sm">
                            <span class="text-gray-700 dark:text-gray-400">
                               Number of Student in Class 
                            </span>
                            <input name=""
                                class="block w-full mt-1 text-sm <?= isset($errors['classnum']) ? 'border-red-600' : '' ?> dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input"
                                value="<?= get_var('classnum', $row->classes->classnum->numbers) ?>" readonly />
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
                                value="<?= get_var('numberpresent', $row->numberpresent) ?>" readonly/>
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
                                value="<?= get_var('numberpaid', $row->numberpaid) ?>" />
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
                                value="<?= get_var('numnotpaid', $row->numnotpaid) ?>" />
                            <?php if (isset($errors['numnotpaid'])) : ?>
                                <span class="text-xs text-red-600 dark:text-red-400">
                                    <?= $errors['numnotpaid'] ?>
                                </span>
                            <?php endif; ?>
                        </label>
                        
                    </div>

                    <div class="flex gap-6">
                        <!-- Admission Fee -->
                        <label class="block flex-1 text-sm">
                            <span class="text-gray-700 dark:text-gray-400">School fee in GHC <code class="text-red-700">*</code></span>
                            <input name="schoolfeeghc"
                                class="block w-full mt-1 text-sm <?= isset($errors['schoolfeeghc']) ? 'border-red-600' : '' ?> dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input"
                                value="<?= get_var('schoolfeeghc', $row->schoolfeeghc) ?>" />
                            <?php if (isset($errors['schoolfeeghc'])) : ?>
                                <span class="text-xs text-red-600 dark:text-red-400">
                                    <?= $errors['schoolfeeghc'] ?>
                                </span>
                            <?php endif; ?>
                        </label>

                        <!-- School Fee -->
                        <label class="block flex-1 text-sm">
                            <span class="text-gray-700 dark:text-gray-400">School fee in CFA<code class="text-red-700">*</code></span>
                            <input name="schoolfeecfa"
                                class="block w-full mt-1 text-sm <?= isset($errors['schoolfeecfa']) ? 'border-red-600' : '' ?> dark:text-gray-300 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-red form-input"
                                value="<?= get_var('schoolfeecfa', $row->schoolfeecfa) ?>"" />
                        <?php if (isset($errors['schoolfeecfa'])) : ?>
                            <span class=" text-xs text-red-600 dark:text-red-400">
                            <?= $errors['schoolfeecfa'] ?>
                            </span>
                        <?php endif; ?>
                        </label>
                        
                        <!-- Admission Fee -->
                        <label class="block flex-1 text-sm">
                            <span class="text-gray-700 dark:text-gray-400">Classes fee in GHC <code class="text-red-700">*</code></span>
                            <input name="classfeeghc"
                                class="block w-full mt-1 text-sm <?= isset($errors['classfeeghc']) ? 'border-red-600' : '' ?> dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input"
                                value="<?= get_var('classfeeghc', $row->classfeeghc) ?>" />
                            <?php if (isset($errors['classfeeghc'])) : ?>
                                <span class="text-xs text-red-600 dark:text-red-400">
                                    <?= $errors['classfeeghc'] ?>
                                </span>
                            <?php endif; ?>
                        </label>

                        <!-- School Fee -->
                        <label class="block flex-1 text-sm">
                            <span class="text-gray-700 dark:text-gray-400">Classes fee in CFA<code class="text-red-700">*</code></span>
                            <input name="classfeecfa"
                                class="block w-full mt-1 text-sm <?= isset($errors['classfeecfa']) ? 'border-red-600' : '' ?> dark:text-gray-300 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-red form-input"
                                value="<?= get_var('classfeecfa', $row->classfeecfa) ?>"" />
                        <?php if (isset($errors['classfeecfa'])) : ?>
                            <span class=" text-xs text-red-600 dark:text-red-400">
                            <?= $errors['classfeecfa'] ?>
                            </span>
                        <?php endif; ?>
                        </label>                       
                        
                        <!-- Admission Fee -->
                        <label class="block flex-1 text-sm">
                            <span class="text-gray-700 dark:text-gray-400">Feeding fee in GHC <code class="text-red-700">*</code></span>
                            <input name="feedfeeghc"
                                class="block w-full mt-1 text-sm <?= isset($errors['feedfeeghc']) ? 'border-red-600' : '' ?> dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input"
                                value="<?= get_var('feedfeeghc', $row->feedfeeghc) ?>" />
                            <?php if (isset($errors['feedfeeghc'])) : ?>
                                <span class="text-xs text-red-600 dark:text-red-400">
                                    <?= $errors['feedfeeghc'] ?>
                                </span>
                            <?php endif; ?>
                        </label>

                        <!-- School Fee -->
                        <label class="block flex-1 text-sm">
                            <span class="text-gray-700 dark:text-gray-400">Feeding fee in CFA<code class="text-red-700">*</code></span>
                            <input name="feedfeecfa"
                                class="block w-full mt-1 text-sm <?= isset($errors['feedfeecfa']) ? 'border-red-600' : '' ?> dark:text-gray-300 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-red form-input"
                                value="<?= get_var('feedfeecfa', $row->feedfeecfa) ?>"" />
                        <?php if (isset($errors['feedfeecfa'])) : ?>
                            <span class=" text-xs text-red-600 dark:text-red-400">
                            <?= $errors['feedfeecfa'] ?>
                            </span>
                        <?php endif; ?>
                        </label>
                       
                    </div>

                    <div class="py-4">
                        <button
                            class="px-5 py-3 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                           Update Pay for Class
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