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
                Edit Exams Fee for <?= $row->classname ?>
            </h4>

            <div
                class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                <form action="" method="post">
                    <!-- Invalid input -->
                    <h5 class="py-3 my-4 font-semibold text-gray-600 dark:text-gray-300">Student Bio</h5>

                    <div class="flex gap-6">
                        <label class="block flex-1 text-sm">
                            <span class="text-gray-700 dark:text-gray-400">
                                Number on Roll
                            </span>
                            <input name=""
                                class="block w-full mt-1 text-sm <?= isset($errors['classnum']) ? 'border-red-600' : '' ?> dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input"
                                value="<?= get_var('classnum', $row->classnum->numbers) ?>" readonly />
                            <?php if (isset($errors['classnum'])) : ?>
                                <span class="text-xs text-red-600 dark:text-red-400">
                                    <?= $errors['classnum'] ?>
                                </span>
                            <?php endif; ?>
                        </label>
                        <label class="block flex-1 text-sm">
                            <span class="text-gray-700 dark:text-gray-400">
                                Amount Per Person
                            </span>
                            <input name=""
                                class="block w-full mt-1 text-sm <?= isset($errors['numberpresent']) ? 'border-red-600' : '' ?> dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input"
                                value="<?= get_var('numberpresent', 'GHC '.$row->examsfee) ?>" readonly />
                            <?php if (isset($errors['numberpresent'])) : ?>
                                <span class="text-xs text-red-600 dark:text-red-400">
                                    <?= $errors['numberpresent'] ?>
                                </span>
                            <?php endif; ?>
                        </label>

                        <label class="block flex-1 text-sm">
                            <span class="text-gray-700 dark:text-gray-400">
                                Total Amount 
                            </span>
                            <input name=""
                                class="block w-full mt-1 text-sm <?= isset($errors['numberpaid']) ? 'border-red-600' : '' ?> dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input"
                                value="<?= get_var('numberpaid', 'GHC '.number_format(($row->examsfee * $row->classnum->numbers))) ?>" readonly />
                            <?php if (isset($errors['numberpaid'])) : ?>
                                <span class="text-xs text-red-600 dark:text-red-400">
                                    <?= $errors['numberpaid'] ?>
                                </span>
                            <?php endif; ?>
                        </label>

                        <label class="block flex-1 text-sm">
                            <span class="text-gray-700 dark:text-gray-400">
                                Total Paid 
                            </span>
                            <input name=""
                                class="block w-full mt-1 text-sm <?= isset($errors['numberpaid']) ? 'border-red-600' : '' ?> dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input"
                                value="<?= get_var('numberpaid', 'GHC '.number_format($row->examsfees->total_exam_amount)) ?>" readonly />
                            <?php if (isset($errors['numberpaid'])) : ?>
                                <span class="text-xs text-red-600 dark:text-red-400">
                                    <?= $errors['numberpaid'] ?>
                                </span>
                            <?php endif; ?>
                        </label>

                        <label class="block flex-1 text-sm">
                            <span class="text-gray-700 dark:text-gray-400">
                                Balance
                            </span>
                            <input name=""
                                class="block w-full mt-1 text-sm <?= isset($errors['numberpaid']) ? 'border-red-600' : '' ?> dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input"
                                value="<?= get_var('numberpaid', 'GHC '.number_format(($row->examsfee * $row->classnum->numbers) - $row->examsfees->total_exam_amount)) ?>" readonly />
                            <?php if (isset($errors['numberpaid'])) : ?>
                                <span class="text-xs text-red-600 dark:text-red-400">
                                    <?= $errors['numberpaid'] ?>
                                </span>
                            <?php endif; ?>
                        </label>

                        <label class="block flex-1 text-sm">
                            <span class="text-gray-700 dark:text-gray-400">
                                Amount
                            </span>
                            <input name="amount"
                                class="block w-full mt-1 text-sm <?= isset($errors['amount']) ? 'border-red-600' : '' ?> dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input"
                                value="<?= get_var('amount', $rowsfee->amount) ?>" />
                            <?php if (isset($errors['amount'])) : ?>
                                <span class="text-xs text-red-600 dark:text-red-400">
                                    <?= $errors['amount'] ?>
                                </span>
                            <?php endif; ?>
                        </label>
                    </div>

                    <div class="py-4">
                        <button
                            class="px-5 py-3 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                            Pay Class Exams Fee
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