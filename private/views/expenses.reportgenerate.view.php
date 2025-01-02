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
            Reports
        </h4>
        <?php
        $totalincome = 0;
        $totalexpense = 0;
        ?>

        <div
            class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50  dark:text-gray-400 dark:bg-gray-800">
            <span class="flex items-center col-span-3 justify-end">
                <form action="" method="post">
                    <button name="export" value="excel"
                        class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-green-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray">
                        Export to Excel
                    </button>
                </form>
            </span>
        </div>

        <div class="w-full overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-3">Revenue</th>
                            <th class="px-4 py-3">Amount (GHC)</th>
                        </tr>
                    </thead>

                    <tbody
                        class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        <?php if ($rowsrev) : ?>
                            <?php foreach ($rowsrev as $row) :
                                $totalincome += $row->total_amount;
                            ?>
                                <tr class="text-gray-700 dark:text-gray-400">
                                    <td class="px-4 py-3">
                                        <p class="font-semibold"><?= esc($row->incomtypename) ?></p>
                                    </td>
                                    <td class="px-4 py-3">
                                        <p class="font-semibold"><?= esc(number_format($row->total_amount, 2)) ?></p>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                            <?php if ($rowpta):
                                $totalincome += $rowpta->total_pta;
                            ?>
                                <tr class="text-gray-700 dark:text-gray-400">
                                    <td class="px-4 py-3">
                                        <p class="font-semibold">PTA Fees</p>
                                    </td>
                                    <td class="px-4 py-3">
                                        <p class="font-semibold"><?= esc(number_format($rowpta->total_pta, 2)) ?></p>
                                    </td>
                                </tr>
                            <?php endif ?>
                            
                            <?php if ($rowtution->total_schoolfees):
                                $totalincome += $rowtution->total_schoolfees;
                            ?>
                                <tr class="text-gray-700 dark:text-gray-400">
                                    <td class="px-4 py-3">
                                        <p class="font-semibold">School Fees</p>
                                    </td>
                                    <td class="px-4 py-3">
                                        <p class="font-semibold"><?= esc(number_format($rowtution->total_schoolfees, 2)) ?></p>
                                    </td>
                                </tr>
                            <?php endif ?>

                            <?php if ($rowtution->total_classfee):
                                $totalincome += $rowtution->total_classfee;
                            ?>
                                <tr class="text-gray-700 dark:text-gray-400">
                                    <td class="px-4 py-3">
                                        <p class="font-semibold">Classes Fees</p>
                                    </td>
                                    <td class="px-4 py-3">
                                        <p class="font-semibold"><?= esc(number_format($rowtution->total_classfee, 2)) ?></p>
                                    </td>
                                </tr>
                            <?php endif ?>
                            
                            <?php if ($rowsexamf):
                                $totalincome += $rowsexamf->total_examf;
                            ?>
                                <tr class="text-gray-700 dark:text-gray-400">
                                    <td class="px-4 py-3">
                                        <p class="font-semibold">Examination Fees</p>
                                    </td>
                                    <td class="px-4 py-3">
                                        <p class="font-semibold"><?= esc(number_format($rowsexamf->total_examf, 2)) ?></p>
                                    </td>
                                </tr>
                            <?php endif ?>
                        <?php else: ?>
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td colspan="4" class="px-4 py-3 align-middle text-center text-sm">
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
                    TOTAL INCOME
                </span>
                <span class="col-span-2"></span>
                <!-- Pagination -->
                <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
                    <h4
                        class="text-lg font-semibold text-gray-600 dark:text-gray-300">
                        GHC <?= esc(number_format($totalincome, 2)) ?>
                    </h4>
                </span>
            </div>
        </div>
        <h4
            class="py-3 mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
        </h4>
        <div class="w-full overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-3">Expenditure</th>
                            <th class="px-4 py-3">Amount (GHC)</th>
                        </tr>
                    </thead>
                    <tbody
                        class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        <?php if ($rowsexp) :
                        ?>
                            <?php foreach ($rowsexp as $row) :
                                $totalexpense += $row->total_amount;
                            ?>
                                <tr class="text-gray-700 dark:text-gray-400">
                                    <td class="px-4 py-3">
                                        <p class="font-semibold"><?= esc($row->expntype) ?></p>
                                    </td>
                                    <td class="px-4 py-3">
                                        <p class="font-semibold"><?= esc(number_format($row->total_amount, 2)) ?></p>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        <?php else: ?>
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td colspan="4" class="px-4 py-3 align-middle text-center text-sm">
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
                    TOTAL EXPENDITURE
                </span>
                <span class="col-span-2"></span>
                <!-- Pagination -->
                <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
                    <h4
                        class="text-lg font-semibold text-gray-600 dark:text-gray-300">
                        GHC <?= esc(number_format($totalexpense, 2)) ?>
                    </h4>
                </span>
            </div>
        </div>

        <h4
            class="py-3 mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
        </h4>


        <div class="w-full overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-3"></th>
                            <th class="px-4 py-3">Income (GHC)</th>
                            <th class="px-4 py-3">Expenditure (GHC)</th>
                            <th class="px-4 py-3">Profit / Loss</th>
                        </tr>
                    </thead>
                    <tbody
                        class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        <?php if ($rowsexp) : ?>
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-4 py-3">
                                    <p class="font-semibold">TOTAL</p>
                                </td>
                                <td class="px-4 py-3">
                                    <p class="font-semibold"><?= esc(number_format($totalincome, 2)) ?></p>
                                </td>
                                <td class="px-4 py-3">
                                    <p class="font-semibold"><?= esc(number_format($totalexpense, 2)) ?></p>
                                </td>
                                <td class="px-4 py-3">
                                    <p class="font-semibold"><?= esc(number_format($totalincome - $totalexpense, 2)) ?></p>
                                </td>
                            </tr>
                        <?php else: ?>
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td colspan="4" class="px-4 py-3 align-middle text-center text-sm">
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