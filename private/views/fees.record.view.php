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
                Pay Fee for <?= $row->classname ?>
            </h4>
            <?php if (Auth::access('assistfinance')): ?>
                <div
                    class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                    <form action="" method="post">

                        <div class="flex gap-6">
                            <label class="block flex-1 text-sm">
                                <span class="text-gray-700 dark:text-gray-400">
                                    Number of Student in Class
                                </span>
                                <input name="classnum"
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
                                    Number Present
                                </span>
                                <input name="numberpresent"
                                    class="block w-full mt-1 text-sm <?= isset($errors['numberpresent']) ? 'border-red-600' : '' ?> dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input"
                                    value="<?= get_var('numberpresent', $row->attends->attendance_count) ?>" readonly />
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
                                    value="<?= get_var('numberpaid', $row->attends->num_paid) ?>" readonly />
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
                                <input name=""
                                    class="block w-full mt-1 text-sm <?= isset($errors['numberpaid']) ? 'border-red-600' : '' ?> dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input"
                                    value="<?= get_var('numberpaid', $row->attends->num_not_paid) ?>" readonly />
                                <?php if (isset($errors['numberpaid'])) : ?>
                                    <span class="text-xs text-red-600 dark:text-red-400">
                                        <?= $errors['numberpaid'] ?>
                                    </span>
                                <?php endif; ?>
                            </label>

                        </div>

                        <h5>Expected Fees</h5>

                        <div class="flex gap-6">
                            <!-- Admission Fee -->
                            <label class="block flex-1 text-sm">
                                <span class="text-gray-700 dark:text-gray-400">School fee in GHC <code class="text-red-700">*</code></span>
                                <input name=""
                                    class="block w-full mt-1 text-sm <?= isset($errors['schoolfeeghc']) ? 'border-red-600' : '' ?> dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input"
                                    value="<?= get_var('schoolfeeghc', $row->attends->total_schoolfee) ?>" readonly/>
                                <?php if (isset($errors['schoolfeeghc'])) : ?>
                                    <span class="text-xs text-red-600 dark:text-red-400">
                                        <?= $errors['schoolfeeghc'] ?>
                                    </span>
                                <?php endif; ?>
                            </label>                           

                            <!-- Admission Fee -->
                            <label class="block flex-1 text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Classes fee in GHC <code class="text-red-700">*</code></span>
                                <input name=""
                                    class="block w-full mt-1 text-sm <?= isset($errors['classfeeghc']) ? 'border-red-600' : '' ?> dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input"
                                    value="<?= get_var('classfeeghc', $row->attends->total_classfee) ?>" readonly/>
                                <?php if (isset($errors['classfeeghc'])) : ?>
                                    <span class="text-xs text-red-600 dark:text-red-400">
                                        <?= $errors['classfeeghc'] ?>
                                    </span>
                                <?php endif; ?>
                            </label>

                        </div>

                        <h5>Paid Fees</h5>
                        <div class="flex gap-6">
                            <!-- Admission Fee -->
                            <label class="block flex-1 text-sm">
                                <span class="text-gray-700 dark:text-gray-400">School fee in GHC <code class="text-red-700">*</code></span>
                                <input name="schoolfeeghc"
                                    class="block w-full mt-1 text-sm <?= isset($errors['schoolfeeghc']) ? 'border-red-600' : '' ?> dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input"
                                    value="<?= get_var('schoolfeeghc', $row->attends->total_schoolfee_paid) ?>" readonly/>
                                <?php if (isset($errors['schoolfeeghc'])) : ?>
                                    <span class="text-xs text-red-600 dark:text-red-400">
                                        <?= $errors['schoolfeeghc'] ?>
                                    </span>
                                <?php endif; ?>
                            </label>  

                            <label class="block flex-1 text-sm">
                                <span class="text-gray-700 dark:text-gray-400">School fee Not Paid <code class="text-red-700">*</code></span>
                                <input name=""
                                    class="block w-full mt-1 text-sm <?= isset($errors['schoolfeeghc']) ? 'border-red-600' : '' ?> dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input"
                                    value="<?= get_var('schoolfeeghc', $row->attends->total_schoolfee_unpaid) ?>" readonly/>
                                <?php if (isset($errors['schoolfeeghc'])) : ?>
                                    <span class="text-xs text-red-600 dark:text-red-400">
                                        <?= $errors['schoolfeeghc'] ?>
                                    </span>
                                <?php endif; ?>
                            </label>      

                            <!-- Admission Fee -->
                            <label class="block flex-1 text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Feeding fee in GHC <code class="text-red-700">*</code></span>
                                <input name="feedfeeghc"
                                    class="block w-full mt-1 text-sm <?= isset($errors['feedfeeghc']) ? 'border-red-600' : '' ?> dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input"
                                    value="<?= get_var('feedfeeghc') ?>" />
                                <?php if (isset($errors['feedfeeghc'])) : ?>
                                    <span class="text-xs text-red-600 dark:text-red-400">
                                        <?= $errors['feedfeeghc'] ?>
                                    </span>
                                <?php endif; ?>
                            </label>

                        </div>

                        <div class="flex gap-6">
                             <!-- Admission Fee -->
                             <label class="block flex-1 text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Classes fee<code class="text-red-700">*</code></span>
                                <input name="classfeeghc"
                                    class="block w-full mt-1 text-sm <?= isset($errors['classfeeghc']) ? 'border-red-600' : '' ?> dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input"
                                    value="<?= get_var('classfeeghc', $row->attends->total_classfee_paid) ?>" readonly/>
                                <?php if (isset($errors['classfeeghc'])) : ?>
                                    <span class="text-xs text-red-600 dark:text-red-400">
                                        <?= $errors['classfeeghc'] ?>
                                    </span>
                                <?php endif; ?>
                            </label>

                            <!-- Admission Fee -->
                            <label class="block flex-1 text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Classes fee Not Paid <code class="text-red-700">*</code></span>
                                <input name=""
                                    class="block w-full mt-1 text-sm <?= isset($errors['classfeeghc']) ? 'border-red-600' : '' ?> dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input"
                                    value="<?= get_var('classfeeghc', $row->attends->total_classfee_unpaid) ?>" readonly/>
                                <?php if (isset($errors['classfeeghc'])) : ?>
                                    <span class="text-xs text-red-600 dark:text-red-400">
                                        <?= $errors['classfeeghc'] ?>
                                    </span>
                                <?php endif; ?>
                            </label>
                        </div>

                        <div class="py-4">
                            <button
                                class="px-5 py-3 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                                Accept Class Payment
                            </button>
                        </div>

                    </form>
                </div>

            <?php else: ?>
                No data found
            <?php endif ?>
        <?php endif ?>

        <div class="w-full overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-3">Date</th>
                            <th class="px-4 py-3">Number Present</th>
                            <th class="px-4 py-3">Number Paid</th>
                            <th class="px-4 py-3">Number Not Paid</th>
                            <th class="px-4 py-3">School Fees</th>
                            <th class="px-4 py-3">Classes Fees</th>
                            <th class="px-4 py-3">Feeding Fees</th>
                            <?php if (Auth::access('assistfinance')): ?>
                                <th class="px-4 py-3">Actions</th>
                            <?php endif ?>
                        </tr>
                    </thead>
                    <tbody
                        class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        <?php if ($rowsfee) : ?>
                            <?php foreach ($rowsfee as $row) : ?>
                                <tr class="text-gray-700 dark:text-gray-400">
                                    <td class="px-4 py-3">
                                        <p class="font-semibold"><?= esc($row->date) ?></p>
                                    </td>
                                    <td class="px-4 py-3">
                                        <p class="font-semibold"><?= esc($row->numberpresent) ?></p>
                                    </td>
                                    <td class="px-4 py-3">
                                        <p class="font-semibold"><?= esc($row->numberpaid) ?></p>
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        <?= esc($row->numnotpaid) ?>
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        GHC <?= esc($row->schoolfeeghc) ?>
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        GHC <?= esc($row->classfeeghc) ?> 
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        GHC <?= esc($row->feedfeeghc) ?>
                                    </td>
                                    <?php if (Auth::access('assistfinance')): ?>
                                        <td class="px-4 py-3">
                                            <div class="flex items-center space-x-4 text-sm">
                                                <a href="<?= HOME ?>/fees/edit/<?= esc($row->id) ?>"
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
                                    <?php endif ?>
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
        </div>
    </div>
</main>
<?php $this->view('includes/footer', ['crumbs' => $crumbs, 'actives' => $actives, 'hiddenSearch' => $hiddenSearch,]) ?>