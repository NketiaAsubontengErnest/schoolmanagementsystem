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
            Edit Expenditure
        </h4>
        <?php if ($row): ?>
            <div
                class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                <form action="" method="post">
                    <!-- Invalid input -->
                        <label class="block flex-1 text-sm">
                            <span class="text-gray-700 dark:text-gray-400">Date</span>
                            <input name="date" type="date"
                                class="block w-full mt-1 text-sm <?= isset($errors['date']) ? 'border-red-600' : '' ?> dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input" 
                                value="<?=esc(get_var('date', $row->date))?>"/>
                            <?php if (isset($errors['date'])) : ?>
                                <span class="text-xs text-red-600 dark:text-red-400">
                                    <?= $errors['date'] ?>
                                </span>
                            <?php endif; ?>
                        </label>

                        <label class="block flex-1 text-sm">
                            <span class="text-gray-700 dark:text-gray-400">
                                Type
                            </span>
                            <select name="typeid" id="" class="block w-full mt-1 text-sm <?= isset($errors['typeid']) ? 'border-red-600' : '' ?> dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input">
                                <option value="">--Select Type--</option>
                                <?php foreach ($rowstype as $type): ?>
                                    <option <?= esc(get_select('typeid', $type->id, $row->typeid)) ?> value=" <?=esc($type->id)?>"><?= esc($type->expntype) ?></option>
                                <?php endforeach ?>
                            </select>
                            <?php if (isset($errors['typeid'])) : ?>
                                <span class="text-xs text-red-600 dark:text-red-400">
                                    <?= $errors['typeid'] ?>
                                </span>
                            <?php endif; ?>
                        </label>

                        <!-- Admission Fee -->
                        <label class="block flex-1 text-sm">
                            <span class="text-gray-700 dark:text-gray-400">Amount</span>
                            <input name="amount"
                                class="block w-full mt-1 text-sm <?= isset($errors['amount']) ? 'border-red-600' : '' ?> dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input"
                                value="<?=esc(get_var('amount', $row->amount))?>"/>
                            <?php if (isset($errors['amount'])) : ?>
                                <span class="text-xs text-red-600 dark:text-red-400">
                                    <?= $errors['amount'] ?>
                                </span>
                            <?php endif; ?>
                        </label>

                    <!-- School Fee -->
                    <label class="block flex-1 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Discription</span>
                        <textarea name="discription" id="" class="block w-full mt-1 text-sm <?= isset($errors['admissionfee']) ? 'border-red-600' : '' ?> dark:text-gray-300 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-red form-input"><?=esc(get_var('discription', $row->discription))?></textarea>
                        <?php if (isset($errors['schoolfee'])) : ?>
                            <span class="text-xs text-red-600 dark:text-red-400">
                                <?= $errors['schoolfee'] ?>
                            </span>
                        <?php endif; ?>
                    </label>

                    <div class="py-4">
                        <button
                            class="px-5 py-3 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                            Update Expense
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