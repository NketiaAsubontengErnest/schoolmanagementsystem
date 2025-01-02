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
            Add Student
        </h4>
        <div
            class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
            <form method="POST" enctype="multipart/form-data">

                <h5 class="py-3 my-4 font-semibold text-gray-600 dark:text-gray-300">Student Bio</h5>

                <div class="flex gap-6">
                    <label class="block flex-1 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">
                            First Name <code class="text-red-700">*</code>
                        </span>
                        <input name="first_name"
                            class="block w-full mt-1 text-sm <?= isset($errors['first_name']) ? 'border-red-600' : '' ?> dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input"
                            value="<?= get_var('first_name') ?>" />
                        <?php if (isset($errors['first_name'])) : ?>
                            <span class="text-xs text-red-600 dark:text-red-400">
                                <?= $errors['first_name'] ?>
                            </span>
                        <?php endif; ?>
                    </label>
                    <label class="block flex-1 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">
                            Last Name <code class="text-red-700">*</code>
                        </span>
                        <input name="last_name"
                            class="block w-full mt-1 text-sm <?= isset($errors['last_name']) ? 'border-red-600' : '' ?> dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input"
                            value="<?= get_var('last_name') ?>" />
                        <?php if (isset($errors['last_name'])) : ?>
                            <span class="text-xs text-red-600 dark:text-red-400">
                                <?= $errors['last_name'] ?>
                            </span>
                        <?php endif; ?>
                    </label>
                    <label class="block flex-1 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">
                            Gender <code class="text-red-700">*</code>
                        </span>
                        <select name="gender" id="" class="block w-full mt-1 text-sm <?= isset($errors['gender']) ? 'border-red-600' : '' ?> dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input">
                            <option <?= get_select('gender', '') ?> value="">-- Select Gender --</option>
                            <option <?= get_select('gender', 'Male') ?> value="Male">Male</option>
                            <option <?= get_select('gender', 'Female') ?> value="Female">Female</option>
                        </select>
                        <?php if (isset($errors['gender'])) : ?>
                            <span class="text-xs text-red-600 dark:text-red-400">
                                <?= $errors['gender'] ?>
                            </span>
                        <?php endif; ?>
                    </label>
                </div>

                <div class="flex gap-6">
                    <!-- Admission Fee -->
                    <label class="block flex-1 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Date of Birth <code class="text-red-700">*</code></span>
                        <input name="date_of_birth" type="date"
                            class="block w-full mt-1 text-sm <?= isset($errors['date_of_birth']) ? 'border-red-600' : '' ?> dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input"
                            value="<?= get_var('date_of_birth') ?>" />
                        <?php if (isset($errors['date_of_birth'])) : ?>
                            <span class="text-xs text-red-600 dark:text-red-400">
                                <?= $errors['date_of_birth'] ?>
                            </span>
                        <?php endif; ?>
                    </label>

                    <!-- School Fee -->
                    <label class="block flex-1 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">NHIS ID Number </span>
                        <input name="health_insurance"
                            class="block w-full mt-1 text-sm <?= isset($errors['health_insurance']) ? 'border-red-600' : '' ?> dark:text-gray-300 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-red form-input"
                            value="<?= get_var('health_insurance') ?>"" />
                        <?php if (isset($errors['health_insurance'])) : ?>
                            <span class=" text-xs text-red-600 dark:text-red-400">
                        <?= $errors['health_insurance'] ?>
                        </span>
                    <?php endif; ?>
                    </label>

                    <!-- School Fee -->
                    <label class="block flex-1 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Address <code class="text-red-700">*</code></span>
                        <input name="address"
                            class="block w-full mt-1 text-sm <?= isset($errors['address']) ? 'border-red-600' : '' ?> dark:text-gray-300 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-red form-input"
                            value="<?= get_var('address') ?>"" />
                        <?php if (isset($errors['address'])) : ?>
                            <span class=" text-xs text-red-600 dark:text-red-400">
                        <?= $errors['address'] ?>
                        </span>
                    <?php endif; ?>
                    </label>

                    <label class="block flex-1 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Nationality <code class="text-red-700">*</code></span>
                        <select name="nationality" id="" class="block w-full mt-1 text-sm <?= isset($errors['nationality']) ? 'border-red-600' : '' ?> dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input">
                            <option <?= get_select('nationality', '') ?> value="">-- Select Nationality --</option>
                            <option <?= get_select('nationality', 'Ghana') ?> value="Ghana">Ghana</option>
                            <option <?= get_select('nationality', 'Togo') ?> value="Togo">Togo</option>
                            <option <?= get_select('nationality', 'Nigeria') ?> value="Nigeria">Nigeria</option>
                        </select>
                        <?php if (isset($errors['nationality'])) : ?>
                            <span class="text-xs text-red-600 dark:text-red-400">
                                <?= $errors['nationality'] ?>
                            </span>
                        <?php endif; ?>
                    </label>
                </div>

                <h5 class="py-3 my-4 font-semibold text-gray-600 dark:text-gray-300">Parents Details</h5>

                <div class="flex gap-6">

                    <label class="block flex-1 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Mother Name</span>
                        <input name="mother_name"
                            class="block w-full mt-1 text-sm <?= isset($errors['mother_name']) ? 'border-red-600' : '' ?> dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input"
                            value="<?= get_var('mother_name') ?>" />
                        <?php if (isset($errors['mother_name'])) : ?>
                            <span class="text-xs text-red-600 dark:text-red-400">
                                <?= $errors['mother_name'] ?>
                            </span>
                        <?php endif; ?>
                    </label>

                    <label class="block flex-1 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Mother Phone </span>
                        <input name="mother_phone"
                            class="block w-full mt-1 text-sm <?= isset($errors['mother_phone']) ? 'border-red-600' : '' ?> dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input"
                            value="<?= get_var('mother_phone') ?>" />
                        <?php if (isset($errors['mother_phone'])) : ?>
                            <span class="text-xs text-red-600 dark:text-red-400">
                                <?= $errors['mother_phone'] ?>
                            </span>
                        <?php endif; ?>
                    </label>

                    <label class="block flex-1 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Father Name</span>
                        <input name="father_name"
                            class="block w-full mt-1 text-sm <?= isset($errors['father_name']) ? 'border-red-600' : '' ?> dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input"
                            value="<?= get_var('father_name') ?>" />
                        <?php if (isset($errors['father_name'])) : ?>
                            <span class="text-xs text-red-600 dark:text-red-400">
                                <?= $errors['father_name'] ?>
                            </span>
                        <?php endif; ?>
                    </label>

                    <!-- School Fee -->
                    <label class="block flex-1 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Father Phone</span>
                        <input name="father_phone"
                            class="block w-full mt-1 text-sm <?= isset($errors['father_phone']) ? 'border-red-600' : '' ?> dark:text-gray-300 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-red form-input"
                            value="<?= get_var('father_phone') ?>" />
                        <?php if (isset($errors['father_phone'])) : ?>
                            <span class="text-xs text-red-600 dark:text-red-400">
                                <?= $errors['father_phone'] ?>
                            </span>
                        <?php endif; ?>
                    </label>
                </div>

                <h5 class="py-3 my-4 font-semibold text-gray-600 dark:text-gray-300">Emegency Contact Details</h5>

                <div class="flex gap-6">
                    <label class="block flex-1 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Full Name</span>
                        <input name="emegency_name"
                            class="block w-full mt-1 text-sm <?= isset($errors['emegency_name']) ? 'border-red-600' : '' ?> dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input"
                            value="<?= get_var('emegency_name') ?>" />
                        <?php if (isset($errors['emegency_name'])) : ?>
                            <span class="text-xs text-red-600 dark:text-red-400">
                                <?= $errors['emegency_name'] ?>
                            </span>
                        <?php endif; ?>
                    </label>

                    <label class="block flex-1 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Phone</span>
                        <input name="emegency_phone"
                            class="block w-full mt-1 text-sm <?= isset($errors['emegency_phone']) ? 'border-red-600' : '' ?> dark:text-gray-300 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-red form-input"
                            value="<?= get_var('emegency_phone') ?>" />
                        <?php if (isset($errors['emegency_phone'])) : ?>
                            <span class="text-xs text-red-600 dark:text-red-400">
                                <?= $errors['emegency_phone'] ?>
                            </span>
                        <?php endif; ?>
                    </label>

                    <label class="block flex-1 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Address</span>
                        <input name="emegency_location"
                            class="block w-full mt-1 text-sm <?= isset($errors['emegency_location']) ? 'border-red-600' : '' ?> dark:text-gray-300 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-red form-input"
                            value="<?= get_var('emegency_location') ?>" />
                        <?php if (isset($errors['emegency_location'])) : ?>
                            <span class="text-xs text-red-600 dark:text-red-400">
                                <?= $errors['emegency_location'] ?>
                            </span>
                        <?php endif; ?>
                    </label>
                </div>

                <h5 class="py-3 my-4 font-semibold text-gray-600 dark:text-gray-300">Educational Details</h5>

                <div class="flex gap-6">
                    <label class="block flex-1 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Class</span> <code class="text-red-700">*</code>
                        <select name="classid" id="" class="block w-full mt-1 text-sm <?= isset($errors['classid']) ? 'border-red-600' : '' ?> dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input">
                            <option <?= get_select('classid', '') ?> value="">-- Select Class --</option>
                            <?php foreach ($rows as $class): ?>
                                <option <?= get_select('classid', esc($class->id)) ?> value="<?= esc($class->id) ?>"><?= esc($class->classname) ?></option>
                            <?php endforeach; ?>
                        </select>

                        <?php if (isset($errors['classid'])) : ?>
                            <span class="text-xs text-red-600 dark:text-red-400">
                                <?= $errors['classid'] ?>
                            </span>
                        <?php endif; ?>
                    </label>
                </div>

                <div class="flex gap-6">
                    <label class="block flex-1 text-sm">
                        <h4>Image</h4>
                        <div class="flex flex-col items-center space-y-4">
                            <figure class="flex flex-col items-center">
                                <?php
                                $image = ASSETS . "/img/6606-male-user.png";
                                ?>
                                <img src="<?= $image ?>" id="imageDisplay" class="border border-primary rounded mb-2" style="width:200px; height: 250px;" alt="User Image">
                                <figcaption class="italic text-gray-600 mt-2">Click to Upload</figcaption>
                            </figure>

                            <input hidden type="file" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-500" name="image" onchange="readURL(this)">

                            <button id="toggleButton" type="button" class="mt-2 bg-blue-500 text-white px-4 py-2 rounded" onclick="toggleCamera()">Open Camera</button>

                            <div class="italic text-red-600 mb-4 w-full text-center" id="sel_img">Upload student image</div>
                        </div>
                        <?php if (isset($errors['image'])): ?>
                            <div class="bg-yellow-100 text-yellow-800 text-sm rounded p-4 mb-4">
                                <?= $errors['image'] ?>
                            </div>
                        <?php endif; ?>
                    </label>
                </div>

                <div class="py-4">
                    <button type="submit" class="px-5 py-3 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">Add Student</button>
                </div>
            </form>
        </div>
    </div>
</main>


<?php $this->view('includes/footer', ['crumbs' => $crumbs, 'actives' => $actives, 'hiddenSearch' => $hiddenSearch,]) ?>