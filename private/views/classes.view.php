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
            Classes
        </h4>
        <div
            class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
            <form action="" method="post">
                <!-- Invalid input -->
                <label class="block py-4 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">
                        Class Name
                    </span>
                    <input name="classname"
                        class="block w-full mt-1 text-sm <?= isset($errors['classname']) ? 'border-red-600' : '' ?> dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input"
                        placeholder="KG 1 A" />
                    <?php if (isset($errors['classname'])) : ?>
                        <span class="text-xs text-red-600 dark:text-red-400">
                            <?= $errors['classname'] ?>
                        </span>
                    <?php endif; ?>
                </label>

                <div class="flex gap-6">
                    <!-- Admission Fee -->
                    <label class="block flex-1 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Admission Fee</span>
                        <input name="admissionfee"
                            class="block w-full mt-1 text-sm <?= isset($errors['admissionfee']) ? 'border-red-600' : '' ?> dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input"
                            placeholder="50.00" />
                        <?php if (isset($errors['admissionfee'])) : ?>
                            <span class="text-xs text-red-600 dark:text-red-400">
                                <?= $errors['admissionfee'] ?>
                            </span>
                        <?php endif; ?>
                    </label>

                    <!-- School Fee -->
                    <label class="block flex-1 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">School Fee</span>
                        <input name="schoolfee"
                            class="block w-full mt-1 text-sm <?= isset($errors['admissionfee']) ? 'border-red-600' : '' ?> dark:text-gray-300 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-red form-input"
                            placeholder="2.50" />
                        <?php if (isset($errors['schoolfee'])) : ?>
                            <span class="text-xs text-red-600 dark:text-red-400">
                                <?= $errors['schoolfee'] ?>
                            </span>
                        <?php endif; ?>
                    </label>

                    <label class="block flex-1 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Classes Fee</span>
                        <input name="classesfee"
                            class="block w-full mt-1 text-sm <?= isset($errors['classesfee']) ? 'border-red-600' : '' ?> dark:text-gray-300 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-red form-input"
                            placeholder="2.50" />
                        <?php if (isset($errors['classesfee'])) : ?>
                            <span class="text-xs text-red-600 dark:text-red-400">
                                <?= $errors['classesfee'] ?>
                            </span>
                        <?php endif; ?>
                    </label>

                    <label class="block flex-1 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Exams Fee</span>
                        <input name="examsfee"
                            class="block w-full mt-1 text-sm <?= isset($errors['examsfee']) ? 'border-red-600' : '' ?> dark:text-gray-300 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-red form-input"
                            placeholder="2.50" />
                        <?php if (isset($errors['examsfee'])) : ?>
                            <span class="text-xs text-red-600 dark:text-red-400">
                                <?= $errors['examsfee'] ?>
                            </span>
                        <?php endif; ?>
                    </label>
                </div>


                <div class="py-4">
                    <button
                        class="px-5 py-3 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                        Add Class
                    </button>
                </div>

            </form>
        </div>
        <div class="w-full overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-3">Class Name</th>
                            <th class="px-4 py-3">Admission Fees</th>
                            <th class="px-4 py-3">School Fees</th>
                            <th class="px-4 py-3">Classes Fees</th>
                            <th class="px-4 py-3">Exams Fee</th>
                            <th class="px-4 py-3">Actions</th>
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
                                        GHC <?= esc($row->admissionfee) ?>
                                    </td>

                                    <td class="px-4 py-3 text-sm">
                                        GHC <?= esc($row->schoolfee) ?>
                                    </td>

                                    <td class="px-4 py-3 text-sm">
                                        GHC <?= esc($row->classesfee) ?>
                                    </td>

                                    <td class="px-4 py-3 text-sm">
                                        GHC <?= esc($row->examsfee) ?>
                                    </td>

                                    <td class="px-4 py-3">
                                        <div class="flex items-center space-x-4 text-sm">
                                            <a href="<?= HOME ?>/classes/edit/<?= esc($row->id) ?>"
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
                                            <!-- Add Link with Plus Icon -->
                                            <a href="<?= HOME ?>/classes/add/<?= esc($row->id) ?>""
                                                class=" flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-green-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                                aria-label="Add">
                                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                                                </svg>
                                            </a>
                                        </div>
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