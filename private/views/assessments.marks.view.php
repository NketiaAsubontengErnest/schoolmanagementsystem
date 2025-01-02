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
            Edit Marks
        </h4>
        <?php if ($row): ?>
            <div
                class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                <form action="" method="post">
                    <!-- Invalid input -->

                    <div class="flex gap-6">
                        <!-- Admission Fee -->
                        <label class="block flex-1 text-sm">
                            <span class="text-gray-700 dark:text-gray-400">Subject ID<code class="text-red-700">*</code></span>
                            <input name="" type="text"
                                class="block w-full mt-1 text-sm <?= isset($errors['date_of_birth']) ? 'border-red-600' : '' ?> dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input"
                                value="<?= esc($row->studentid) ?>" readonly />
                            <?php if (isset($errors['date_of_birth'])) : ?>
                                <span class="text-xs text-red-600 dark:text-red-400">
                                    <?= $errors['date_of_birth'] ?>
                                </span>
                            <?php endif; ?>
                        </label>
                        <!-- Admission Fee -->
                        <label class="block flex-1 text-sm">
                            <span class="text-gray-700 dark:text-gray-400">Student Name <code class="text-red-700">*</code></span>
                            <input name=""
                                class="block w-full mt-1 text-sm <?= isset($errors['phone']) ? 'border-red-600' : '' ?> dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input"
                                value="<?= esc($row->student->first_name) ?> <?= esc($row->student->last_name) ?>" readonly />
                            <?php if (isset($errors['phone'])) : ?>
                                <span class="text-xs text-red-600 dark:text-red-400">
                                    <?= $errors['phone'] ?>
                                </span>
                            <?php endif; ?>
                        </label>
                    </div>

                    <div class="flex gap-6">
                        <label class="block flex-1 text-sm">
                            <span class="text-gray-700 dark:text-gray-400">Subject Title</span>
                            <input name=""
                                class="block w-full mt-1 text-sm <?= isset($errors['spouse_name']) ? 'border-red-600' : '' ?> dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input"
                                value="<?= get_var('spouse_name', $row->subject->title) ?>" readonly/>
                            <?php if (isset($errors['spouse_name'])) : ?>
                                <span class="text-xs text-red-600 dark:text-red-400">
                                    <?= $errors['spouse_name'] ?>
                                </span>
                            <?php endif; ?>
                        </label>
                    </div>

                    <div class="flex gap-6">

                        <label class="block flex-1 text-sm">
                            <span class="text-gray-700 dark:text-gray-400">Assessment (50%)</span> <code class="text-red-700">*</code>
                            <input name="contasses"
                                class="block w-full mt-1 text-sm <?= isset($errors['contasses']) ? 'border-red-600' : '' ?> dark:text-gray-300 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-red form-input"
                                value="<?= get_var('contasses', $row->contasses) ?>" />
                            <?php if (isset($errors['contasses'])) : ?>
                                <span class="text-xs text-red-600 dark:text-red-400">
                                    <?= $errors['contasses'] ?>
                                </span>
                            <?php endif; ?>
                        </label>
                        
                        <label class="block flex-1 text-sm">
                            <span class="text-gray-700 dark:text-gray-400">Exam Marks (50%)</span> <code class="text-red-700">*</code>
                            <input name="exammark"
                                class="block w-full mt-1 text-sm <?= isset($errors['exammark']) ? 'border-red-600' : '' ?> dark:text-gray-300 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-red form-input"
                                value="<?= get_var('exammark', $row->exammark) ?>" />
                            <?php if (isset($errors['exammark'])) : ?>
                                <span class="text-xs text-red-600 dark:text-red-400">
                                    <?= $errors['exammark'] ?>
                                </span>
                            <?php endif; ?>
                        </label>
                        
                    </div>


                    <div class="py-4">
                        <button
                            class="px-5 py-3 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                            Update Marks
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