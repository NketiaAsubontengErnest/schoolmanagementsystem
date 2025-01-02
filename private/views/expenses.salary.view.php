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
            Employees Compensation
        </h4>
        <?php if (Auth::access('administrator')): ?>
            <form action="" method="post">
                <div class="py-4">
                    <button name="pay" value="make" class="px-5 py-3 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                        Make Payment
                    </button>
                </div>
            </form>
        <?php endif ?>

        <div class="w-full overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-3">Name</th>
                            <th class="px-4 py-3">Gender</th>
                            <th class="px-4 py-3">Title</th>
                            <th class="px-4 py-3">Basic Salary</th>
                            <th class="px-4 py-3">Weekly Allowance</th>
                            <th class="px-4 py-3">Mountly Allowance</th>
                            <th class="px-4 py-3">SSNIT</th>
                            <th class="px-4 py-3">FOOD STIPEND</th>
                            <th class="px-4 py-3">NET PAY</th>
                            <th class="px-4 py-3">TOTAL</th>
                        </tr>
                    </thead>
                    <tbody
                        class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        <?php if ($rows) : ?>
                            <?php foreach ($rows as $row) : ?>
                                <tr>
                                    <td class="px-4 py-3">
                                        <p class="font-semibold"><?= esc($row->first_name) ?> <?= esc($row->last_name) ?></p>
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        <?= esc($row->gender) ?>
                                    </td>

                                    <td class="px-4 py-3 text-sm">
                                        <?= esc(get_Staff_Posi($row->job_titil)) ?>
                                    </td>

                                    <td class="px-4 py-3 text-sm">
                                        <?= esc($row->basic_salary) ?>
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        <?= esc($row->weeklyallowance) ?>
                                    </td>

                                    <td class="px-4 py-3 text-sm">
                                        <?= esc(number_format($row->weeklyallowance * 4.00, 2)) ?>
                                    </td>

                                    <td class="px-4 py-3 text-sm">
                                        <?= esc($row->ssnitamount) ?>
                                    </td>

                                    <td class="px-4 py-3 text-sm">
                                        <?= esc($row->foodalloance) ?>
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        <?= esc(number_format($row->weeklyallowance + $row->basic_salary, 2)) ?>
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        <?= esc(number_format(($row->weeklyallowance * 4) + ($row->basic_salary + $row->foodalloance), 2)) ?>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        <?php else: ?>
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td colspan="2" class="px-4 py-3 align-middle text-center text-sm">
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
                    <form action="" method="post">
                        <button name="export" value="excel" class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-green-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray">
                            Export to Excel
                        </button>
                    </form>
                </span>
                <span class="col-span-2">
                    <a href="<?= HOME ?>/expenses/paymenthistoory" name="pay" value="make" class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-red-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray">
                        Payment History
                    </a>
                </span>
                <!-- Pagination -->
                <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
                    <?php $pager->display($rows ? count($rows) : 0); ?>
                </span>
            </div>
        </div>

    </div>
</main>
<?php $this->view('includes/footer', ['crumbs' => $crumbs, 'actives' => $actives, 'hiddenSearch' => $hiddenSearch,]) ?>