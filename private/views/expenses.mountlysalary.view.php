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
            Mountly Salary for <?= esc(date('F, Y', strtotime($rows[0]->paymentdate))) ?>
        </h4>
        <?php
        $total_basic_salary = 0;
        $total_weekly_allowance = 0;
        $total_mountly_salary = 0;
        $total_ssnit_salary = 0;
        $total_food_salary = 0;
        ?>
        <div class="w-full overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-3">Name</th>
                            <th class="px-4 py-3">Gender</th>
                            <th class="px-4 py-3">Title</th>
                            <th class="px-4 py-3">Basic Sal.</th>
                            <th class="px-4 py-3">Weekly Allow.</th>
                            <th class="px-4 py-3">Mountly Allow.</th>
                            <th class="px-4 py-3">SSNIT</th>
                            <th class="px-4 py-3">FOOD STIP.</th>
                            <th class="px-4 py-3">NET PAY</th>
                            <th class="px-4 py-3">TOTAL</th>
                        </tr>
                    </thead>
                    <tbody
                        class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        <?php if ($rows) : ?>
                            <?php foreach ($rows as $row) :
                                $total_basic_salary += $row->basicsalary;
                                $total_weekly_allowance += $row->weeklyalowance;
                                $total_mountly_salary += $row->weeklyalowance * 4.00;
                                $total_ssnit_salary += $row->ssnitamount;
                                $total_food_salary += $row->foodstipen;
                            ?>
                                <tr>
                                    <td class="px-4 py-3">
                                        <p class="font-semibold"><?= esc($row->staff->first_name) ?> <?= esc($row->staff->last_name) ?></p>
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        <?= esc($row->staff->gender) ?>
                                    </td>

                                    <td class="px-4 py-3 text-sm">
                                        <?= esc(get_Staff_Posi($row->staff->job_titil)) ?>
                                    </td>

                                    <td class="px-4 py-3 text-sm">
                                        <?= esc($row->basicsalary) ?>
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        <?= esc($row->weeklyalowance) ?>
                                    </td>

                                    <td class="px-4 py-3 text-sm">
                                        <?= esc(number_format($row->weeklyalowance * 4.00, 2)) ?>
                                    </td>

                                    <td class="px-4 py-3 text-sm">
                                        <?= esc($row->ssnitamount) ?>
                                    </td>

                                    <td class="px-4 py-3 text-sm">
                                        <?= esc($row->foodstipen) ?>
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        <?= esc(number_format($row->weeklyalowance + $row->basicsalary, 2)) ?>
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        <?= esc(number_format(($row->weeklyalowance * 4) + ($row->basicsalary + $row->foodstipen), 2)) ?>
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
                    <tfoot>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-3">Total </th>
                            <th class="px-4 py-3"></th>
                            <th class="px-4 py-3"></th>
                            <th class="px-4 py-3">GHC <?= esc($total_basic_salary) ?></th>
                            <th class="px-4 py-3">GHC <?= esc($total_weekly_allowance) ?></th>
                            <th class="px-4 py-3">GHC <?= esc($total_mountly_salary) ?></th>
                            <th class="px-4 py-3">GHC <?= esc($total_ssnit_salary) ?></th>
                            <th class="px-4 py-3">GHC <?= esc($total_food_salary) ?></th>
                            <th class="px-4 py-3">GHC <?= esc(number_format(($total_weekly_allowance * 4) + $total_basic_salary, 2)) ?></th>
                            <th class="px-4 py-3">GHC <?= esc(number_format($total_basic_salary + $total_mountly_salary + $total_food_salary, 2)) ?></th>
                        </tr>
                    </tfoot>
                </table>
            </div>

        </div>

    </div>
</main>
<?php $this->view('includes/footer', ['crumbs' => $crumbs, 'actives' => $actives, 'hiddenSearch' => $hiddenSearch,]) ?>