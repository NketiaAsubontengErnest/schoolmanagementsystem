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
            Fee Records
        </h4>
        <div class="w-full overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-3">Class Name</th>
                            <th class="px-4 py-3">Total School Fees</th>
                            <th class="px-4 py-3">Total Class Fees</th>
                            <th class="px-4 py-3">Arrears School Fees</th>
                            <th class="px-4 py-3">Arrears Class Fees</th>
                            <th class="px-4 py-3">Total Arrears</th>
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
                                        <p class="font-semibold"><?= esc($row->classname) ?></p>
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        GHC <?= esc(number_format($row->totalfees->total_schoolfee, 2)) ?>
                                    </td>

                                    <td class="px-4 py-3 text-sm">
                                        GHC <?= esc(number_format($row->totalfees->total_classfee, 2)) ?>
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        GHC <?= esc(number_format($row->totalfees->total_schoolfee_unpaid, 2)) ?>
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        GHC <?= esc(number_format($row->totalfees->total_classfee_unpaid, 2)) ?>
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        <?php
                                        $totalarreas = $row->totalfees->total_schoolfee_unpaid + $row->totalfees->total_classfee_unpaid;
                                        ?>
                                        GHC <?= esc(number_format($totalarreas, 2)) ?>
                                    </td>
                                    <?php if (Auth::access('administrator')): ?>
                                        <td class="px-4 py-3">
                                            <div class="flex items-center space-x-4 text-sm">
                                                <!-- Add Link with Plus Icon -->
                                                <a href="<?= HOME ?>/fees/clearclass/<?= esc($row->id) ?>"
                                                    class=" flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-green-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                                    aria-label="Add">
                                                    <span>Clearance</span>
                                                </a>
                                            </div>
                                        </td>
                                    <?php endif ?>
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
        </div>

    </div>
</main>
<?php $this->view('includes/footer', ['crumbs' => $crumbs, 'actives' => $actives, 'hiddenSearch' => $hiddenSearch,]) ?>