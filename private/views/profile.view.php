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
            Profile Details
        </h4>
        <?php if (Auth::getStaff()): ?>
            <div
                class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                <form action="" method="post">
                    <!-- Invalid input -->
                    <div class="flex gap-6">
                        <label class="block flex-1 text-sm">
                            <span class="text-gray-700 dark:text-gray-400">First Name</span>
                            <input name=""
                                class="block w-full mt-1 text-sm <?= isset($errors['date_of_birth']) ? 'border-red-600' : '' ?> dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input"
                                value="<?= esc(Auth::getStaff()->first_name) ?>" readonly />
                        </label>
                        <label class="block flex-1 text-sm">
                            <span class="text-gray-700 dark:text-gray-400">Last Name</span>
                            <input name=""
                                class="block w-full mt-1 text-sm <?= isset($errors['date_of_birth']) ? 'border-red-600' : '' ?> dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input"
                                value="<?= esc(Auth::getStaff()->last_name) ?>" readonly />
                        </label>
                    </div>
                    <!-- Invalid input -->
                    <div class="flex gap-6">
                        <label class="block flex-1 text-sm">
                            <span class="text-gray-700 dark:text-gray-400">Date of Birth</span>
                            <input name="" type="date"
                                class="block w-full mt-1 text-sm <?= isset($errors['date_of_birth']) ? 'border-red-600' : '' ?> dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input"
                                value="<?= esc(Auth::getStaff()->date_of_birth) ?>" readonly />
                        </label>
                        <label class="block flex-1 text-sm">
                            <span class="text-gray-700 dark:text-gray-400">Gender</span>
                            <input name=""
                                class="block w-full mt-1 text-sm <?= isset($errors['date_of_birth']) ? 'border-red-600' : '' ?> dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input"
                                value="<?= esc(Auth::getStaff()->gender) ?>" readonly />
                        </label>
                    </div>
                    <div class="flex gap-6">
                        <label class="block flex-1 text-sm">
                            <span class="text-gray-700 dark:text-gray-400">Phone</span>
                            <input name="" type=""
                                class="block w-full mt-1 text-sm <?= isset($errors['date_of_birth']) ? 'border-red-600' : '' ?> dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input"
                                value="<?= esc(Auth::getStaff()->phone) ?>" readonly />
                        </label>
                        <label class="block flex-1 text-sm">
                            <span class="text-gray-700 dark:text-gray-400">Address</span>
                            <input name=""
                                class="block w-full mt-1 text-sm <?= isset($errors['date_of_birth']) ? 'border-red-600' : '' ?> dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input"
                                value="<?= esc(Auth::getStaff()->address) ?>" readonly />
                        </label>
                    </div>

                    <div class="flex gap-6">
                        <label class="block flex-1 text-sm">
                            <span class="text-gray-700 dark:text-gray-400">Password</span>
                            <input name="password" type="password"
                                class="block w-full mt-1 text-sm <?= isset($errors['password']) ? 'border-red-600' : '' ?> dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input"
                                value="" />
                            <?php if (isset($errors['password'])) : ?>
                                <span class="text-xs text-red-600 dark:text-red-400">
                                    <?= $errors['password'] ?>
                                </span>
                            <?php endif; ?>
                        </label>
                        <label class="block flex-1 text-sm">
                            <span class="text-gray-700 dark:text-gray-400">Retype Password</span>
                            <input name="retyppassword" type="password"
                                class="block w-full mt-1 text-sm <?= isset($errors['retyppassword']) ? 'border-red-600' : '' ?> dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input"
                                value="" />
                            <?php if (isset($errors['retyppassword'])) : ?>
                                <span class="text-xs text-red-600 dark:text-red-400">
                                    <?= $errors['retyppassword'] ?>
                                </span>
                            <?php endif; ?>
                        </label>
                    </div>

                    <div class="py-4">
                        <button
                            class="px-5 py-3 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                            Update Password
                        </button>
                    </div>

                </form>
            </div>

        <?php else: ?>
            No data found
        <?php endif ?>

        <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
            <div class="flex gap-6">
                <label class="block flex-1 text-sm">
                    <h4>Image</h4>
                    <form method="POST" enctype="multipart/form-data">
                        <div class="flex flex-col items-center space-y-4">
                            <div class="flex flex-col items-center">
                                <?php
                                $image = ASSETS . "/img/6606-male-user.png";

                                if (Auth::getImage()) {
                                    $image = ROOT . "/" . Auth::getImage();
                                }
                                ?>
                                <img src="<?= $image ?>" id="imageDisplay" class="border border-primary rounded mb-2" style="width:200px; height: 250px;"
                                    alt="User Image">
                            </div>
                            <input type="file" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-500" name="image" onchange="readURL(this)" required>

                            <div class="italic text-red-600 mb-4 w-full text-center" id="sel_img">Upload your image to begin Registration</div>
                        </div>
                        <?php if (isset($errors['image'])): ?>
                            <div class="bg-yellow-100 text-yellow-800 text-sm rounded p-4 mb-4">
                                <?= $errors['image'] ?>
                            </div>
                        <?php endif; ?>
                        <button
                            class="px-5 py-3 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                            Save Image
                        </button>
                    </form>
                </label>
            </div>
        </div>

    </div>
</main>

<?php $this->view('includes/footer', ['crumbs' => $crumbs, 'actives' => $actives, 'hiddenSearch' => $hiddenSearch,]) ?>