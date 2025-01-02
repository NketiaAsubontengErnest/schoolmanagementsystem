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
            Add and Clear Arrears
        </h4>
        <?php if (Auth::access('matron')): ?>
            <div
                class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">

                <span class="text-gray-700 dark:text-gray-400">Class</span>

                <form method="get">
                    <select
                        class="w-full pl-8 pr-2 text-sm text-gray-700 placeholder-gray-600 bg-gray-100 border-0 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input"
                        name="search_class"
                        id="searchInputclass">
                        <?php if ($rowclas): ?>
                            <option <?= get_select('search_class', "", isset($_GET['search_class']) ? $_GET['search_class'] : "") ?> value="">Choose Class</option>
                            <?php foreach ($rowclas as $clas): ?>
                                <option <?= get_select('search_class', esc($clas->id), isset($_GET['search_class']) ? $_GET['search_class'] : "") ?> value="<?= esc($clas->id) ?>"><?= esc($clas->classname) ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </form>

                <script>
                    const selectElement = document.getElementById('searchInputclass');

                    // Trigger form submission when an option is selected
                    selectElement.addEventListener('change', () => {
                        selectElement.form.submit();
                    });

                    // Place the cursor at the end of the input field after load or submit
                    document.addEventListener("DOMContentLoaded", () => {
                        moveCursorToEnd(selectElement);
                    });

                    function moveCursorToEnd(element) {
                        const value = element.value; // Store the current value
                        element.focus(); // Focus the input field
                        element.value = ''; // Temporarily clear the value
                        element.value = value; // Restore the value to move the cursor to the end
                    }
                </script>


                <form method="post">
                    <!-- Invalid input -->
                    <div class="flex gap-6">
                        <label class="block flex-1 text-sm">
                            <span class="text-gray-700 dark:text-gray-400">Date</span>
                            <input name="date" type="date"
                                class="block w-full mt-1 text-sm <?= isset($errors['date']) ? 'border-red-600' : '' ?> dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input" />
                            <?php if (isset($errors['date'])) : ?>
                                <span class="text-xs text-red-600 dark:text-red-400">
                                    <?= $errors['date'] ?>
                                </span>
                            <?php endif; ?>
                        </label>

                        <div class="block flex-1 text-sm relative">
                            <span class="text-gray-700 dark:text-gray-400">Student Name</span>
                            <div class="relative">
                                <input
                                    type="text"
                                    id="dropdownSearch"
                                    class="block w-full mt-1 text-sm dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input"
                                    placeholder="Search for a student..."
                                    style="text-align: left;"
                                    onkeyup="filterStudents()">
                                <div id="dropdownMenu"
                                    class="absolute w-full mt-1 bg-white dark:bg-gray-700 shadow-md rounded-lg max-h-60 overflow-y-auto border border-gray-300 dark:border-gray-600 hidden">
                                    <div data-value="" class="dropdown-item p-2 hover:bg-gray-200 dark:hover:bg-gray-600 cursor-pointer">
                                        --Select Student--
                                    </div>
                                    <?php foreach ($rows as $stud): ?>
                                        <div
                                            data-value="<?= esc($stud->studentid) ?>"
                                            class="dropdown-item p-2 hover:bg-gray-200 dark:hover:bg-gray-600 cursor-pointer" style="text-align: left;"><?= esc($stud->first_name) ?> <?= esc($stud->last_name) ?></div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <input type="hidden" name="studentnum" id="selectedStudent">
                            <?php if (isset($errors['studentnum'])) : ?>
                                <span class="text-xs text-red-600 dark:text-red-400"><?= $errors['studentnum'] ?></span>
                            <?php endif; ?>
                        </div>

                        <!-- Admission Fee -->
                        <label class="block flex-1 text-sm">
                            <span class="text-gray-700 dark:text-gray-400">Amount</span>
                            <input name="amount"
                                class="block w-full mt-1 text-sm <?= isset($errors['amount']) ? 'border-red-600' : '' ?> dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input"
                                placeholder="50.00" />
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
                            Add Arreas
                        </button>
                    </div>

                </form>
            </div>
        <?php endif ?>

        <div class="w-full overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-3">Date</th>
                            <th class="px-4 py-3">Student No.</th>
                            <th class="px-4 py-3">Student Name</th>
                            <th class="px-4 py-3">Class</th>
                            <th class="px-4 py-3">Amount</th>
                            <?php if (Auth::access('matron')): ?>
                                <th class="px-4 py-3">Actions</th>
                            <?php endif ?>
                        </tr>
                    </thead>
                    <tbody
                        class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        <?php if ($rowsfeeds) : ?>
                            <?php foreach ($rowsfeeds as $row) : ?>
                                <tr class="text-gray-700 dark:text-gray-400">
                                    <td class="px-4 py-3">
                                        <p class="font-semibold"><?= esc($row->date) ?></p>
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        <?= esc($row->studentnum) ?>
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        <?= esc($row->student->first_name) ?> <?= esc($row->student->last_name) ?> (<?= esc($row->student->gender) ?>)
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        <?= esc($row->student->class->classname) ?>
                                    </td>

                                    <td class="px-4 py-3 text-sm">
                                        GHC <?= esc(number_format($row->amount, 2)) ?>
                                    </td>
                                    <?php if (Auth::access('matron')): ?>
                                        <td class="px-4 py-3">
                                            <div class="flex items-center space-x-4 text-sm">
                                                <form method="post">
                                                    <button name="cleararres" value="<?= esc($row->id) ?>"
                                                        class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                                        aria-label="Edit">
                                                        <span>Clear</span>
                                                    </button>
                                                </form>
                                                <form method="post" onsubmit="return confirmDelete()">
                                                    <button name="deletearres" value="<?= esc($row->id) ?>"
                                                        class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-red-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                                        aria-label="Edit">
                                                        <span>Delete</span>
                                                    </button>
                                                </form>
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
            <div
                class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
                <span class="flex items-center col-span-3">
                    <form action="" method="post">
                        <button name="export" value="excel"
                            class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-green-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray">
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
    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this arrears?");
        }
    </script>
</main>
<?php $this->view('includes/footer', ['crumbs' => $crumbs, 'actives' => $actives, 'hiddenSearch' => $hiddenSearch,]) ?>