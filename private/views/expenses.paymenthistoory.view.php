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
            Salary History
        </h4>

        <div class="w-full overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-3">Date</th>
                            <th class="px-4 py-3">Total Basic sal.</th>
                            <th class="px-4 py-3">Total Weekly Allow.</th>
                            <th class="px-4 py-3">Total Mountly Allow.</th>
                            <th class="px-4 py-3">Total SSNIT</th>
                            <th class="px-4 py-3">FOOD STIPEND</th>
                            <th class="px-4 py-3">TOTAL NET</th>
                            <th class="px-4 py-3">TOTAL</th>
                            <th class="px-4 py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody
                        class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        <?php if ($rows) : ?>
                            <?php foreach ($rows as $row) : ?>
                                <tr>
                                    <td class="px-4 py-3">
                                        <a href="<?= HOME ?>/expenses/mountlysalary/<?= esc($row->paymentdate) ?>">
                                            <p class="font-semibold"><?= esc($row->paymentdate) ?></p>
                                        </a>
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        <?= esc($row->total_basicsalary) ?>
                                    </td>

                                    <td class="px-4 py-3 text-sm">
                                        <?= esc($row->total_weeklyalowance) ?>
                                    </td>

                                    <td class="px-4 py-3 text-sm">
                                        <?= esc(number_format(($row->total_weeklyalowance * 4), 2)) ?>
                                    </td>

                                    <td class="px-4 py-3 text-sm">
                                        <?= esc($row->total_ssnitamount) ?>
                                    </td>


                                    <td class="px-4 py-3 text-sm">
                                        <?= esc($row->total_foodstipen) ?>
                                    </td>

                                    <td class="px-4 py-3 text-sm">
                                        <?= esc(number_format($row->total_basicsalary + $row->total_weeklyalowance, 2)) ?>
                                    </td>

                                    <td class="px-4 py-3 text-sm">
                                        <?= esc(number_format($row->total_basicsalary + ($row->total_weeklyalowance * 4) + $row->total_foodstipen + $row->total_ssnitamount, 2)) ?>
                                    </td>

                                    <td class="px-4 py-3 text-sm">
                                        <a href="<?= HOME ?>/expenses/mountlysalary/<?= esc($row->paymentdate) ?>">
                                            <p class="font-semibold">View</p>
                                        </a>
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