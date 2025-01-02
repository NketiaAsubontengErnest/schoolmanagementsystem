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
            Add Employees
        </h4>
        <div
            class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
            <form action="" method="post">
                <!-- Invalid input -->
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
                        <select name="gender" id="" class="block w-full mt-1 text-sm <?= isset($errors['classname']) ? 'border-red-600' : '' ?> dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input">
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
                    <!-- Admission Fee -->
                    <label class="block flex-1 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Phone <code class="text-red-700">*</code></span>
                        <input name="phone"
                            class="block w-full mt-1 text-sm <?= isset($errors['phone']) ? 'border-red-600' : '' ?> dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input"
                            value="<?= get_var('phone') ?>" />
                        <?php if (isset($errors['phone'])) : ?>
                            <span class="text-xs text-red-600 dark:text-red-400">
                                <?= $errors['phone'] ?>
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
                </div>

                <div class="flex gap-6">
                    <!-- Admission Fee -->
                    <label class="block flex-1 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">National ID Number <code class="text-red-700">*</code></span>
                        <input name="gh_id"
                            class="block w-full mt-1 text-sm <?= isset($errors['gh_id']) ? 'border-red-600' : '' ?> dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input"
                            value="<?= get_var('gh_id') ?>" />
                        <?php if (isset($errors['gh_id'])) : ?>
                            <span class="text-xs text-red-600 dark:text-red-400">
                                <?= $errors['gh_id'] ?>
                            </span>
                        <?php endif; ?>
                    </label>

                    <!-- School Fee -->
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
                    <!-- School Fee -->
                    <label class="block flex-1 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">NHIS ID Number</span>
                        <input name="health_ins_id"
                            class="block w-full mt-1 text-sm <?= isset($errors['health_ins_id']) ? 'border-red-600' : '' ?> dark:text-gray-300 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-red form-input"
                            value="<?= get_var('health_ins_id') ?>" />
                        <?php if (isset($errors['health_ins_id'])) : ?>
                            <span class="text-xs text-red-600 dark:text-red-400">
                                <?= $errors['health_ins_id'] ?>
                            </span>
                        <?php endif; ?>
                    </label>
                </div>

                <div class="flex gap-6">
                    <label class="block flex-1 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Spouse Full Name</span>
                        <input name="spouse_name"
                            class="block w-full mt-1 text-sm <?= isset($errors['spouse_name']) ? 'border-red-600' : '' ?> dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input"
                            value="<?= get_var('spouse_name') ?>" />
                        <?php if (isset($errors['spouse_name'])) : ?>
                            <span class="text-xs text-red-600 dark:text-red-400">
                                <?= $errors['spouse_name'] ?>
                            </span>
                        <?php endif; ?>
                    </label>

                    <label class="block flex-1 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Spouse Phone</span>
                        <input name="spouse_phone"
                            class="block w-full mt-1 text-sm <?= isset($errors['spouse_phone']) ? 'border-red-600' : '' ?> dark:text-gray-300 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-red form-input"
                            value="<?= get_var('spouse_phone') ?>" />
                        <?php if (isset($errors['spouse_phone'])) : ?>
                            <span class="text-xs text-red-600 dark:text-red-400">
                                <?= $errors['spouse_phone'] ?>
                            </span>
                        <?php endif; ?>
                    </label>
                </div>

                <div class="flex gap-6">
                    <label class="block flex-1 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Job Titile</span> <code class="text-red-700">*</code>
                        <select name="job_titil" id="" class="block w-full mt-1 text-sm <?= isset($errors['job_titil']) ? 'border-red-600' : '' ?> dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input">
                            <option <?= get_select('job_titil', '') ?> value="">-- Job Titile --</option>
                            <option <?= get_select('job_titil', 'teacher') ?> value="teacher">Teacher</option>
                            <option <?= get_select('job_titil', 'cook') ?> value="cook">Cook</option>
                            <option <?= get_select('job_titil', 'janitor') ?> value="janitor">Janitor</option>
                            <option <?= get_select('job_titil', 'driver') ?> value="driver">Driver</option>
                            <option <?= get_select('job_titil', 'security') ?> value="security">Security</option>
                            <option <?= get_select('job_titil', 'store seeper') ?> value="store seeper">Store Keeper</option>
                            <option <?= get_select('job_titil', 'counselor') ?> value="counselor">Counselor</option>
                            <option <?= get_select('job_titil', 'assistfinance') ?> value="assistfinance">Assistant H Finance</option>
                            <option <?= get_select('job_titil', 'assistacademic') ?> value="assistacademic">Assistant H Academic</option>
                            <option <?= get_select('job_titil', 'headmaster') ?> value="headmaster">Headmaster</option>
                            <option <?= get_select('job_titil', 'matron') ?> value="matron">Matron</option>
                            <option <?= get_select('job_titil', 'administrator') ?> value="administrator">Administrator</option>
                            <option <?= get_select('job_titil', 'multimedia') ?> value="multimedia">Multimedia</option>
                            <option <?= get_select('job_titil', 'proprietor') ?> value="proprietor">Proprietor</option>
                        </select>

                        <?php if (isset($errors['job_titil'])) : ?>
                            <span class="text-xs text-red-600 dark:text-red-400">
                                <?= $errors['job_titil'] ?>
                            </span>
                        <?php endif; ?>
                    </label>

                    <label class="block flex-1 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Employment Type</span> <code class="text-red-700">*</code>
                        <select name="status" id="" class="block w-full mt-1 text-sm <?= isset($errors['status']) ? 'border-red-600' : '' ?> dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input">
                            <option <?= get_select('status', '') ?> value="">-- Employment Type --</option>
                            <option <?= get_select('status', 'Full Time') ?> value="Full Time">Full Time</option>
                            <option <?= get_select('status', 'Part Time') ?> value="Part Time">Part Time</option>
                        </select>
                        <?php if (isset($errors['spouse_phone'])) : ?>
                            <span class="text-xs text-red-600 dark:text-red-400">
                                <?= $errors['spouse_phone'] ?>
                            </span>
                        <?php endif; ?>
                    </label>

                    <label class="block flex-1 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Basic Salary</span> <code class="text-red-700">*</code>
                        <input name="basic_salary"
                            class="block w-full mt-1 text-sm <?= isset($errors['basic_salary']) ? 'border-red-600' : '' ?> dark:text-gray-300 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-red form-input"
                            value="<?= get_var('basic_salary') ?>" />
                        <?php if (isset($errors['basic_salary'])) : ?>
                            <span class="text-xs text-red-600 dark:text-red-400">
                                <?= $errors['basic_salary'] ?>
                            </span>
                        <?php endif; ?>
                    </label>

                    <label class="block flex-1 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Weekly Allowance</span> <code class="text-red-700">*</code>
                        <input name="weeklyallowance"
                            class="block w-full mt-1 text-sm <?= isset($errors['weeklyallowance']) ? 'border-red-600' : '' ?> dark:text-gray-300 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-red form-input"
                            value="<?= get_var('weeklyallowance') ?>" />
                        <?php if (isset($errors['weeklyallowance'])) : ?>
                            <span class="text-xs text-red-600 dark:text-red-400">
                                <?= $errors['weeklyallowance'] ?>
                            </span>
                        <?php endif; ?>
                    </label>

                    <label class="block flex-1 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">SSNIT Amount</span>
                        <input name="ssnitamount"
                            class="block w-full mt-1 text-sm <?= isset($errors['ssnitamount']) ? 'border-red-600' : '' ?> dark:text-gray-300 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-red form-input"
                            value="<?= get_var('ssnitamount') ?>" />
                    </label>

                    <label class="block flex-1 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Food Stipend</span>
                        <input name="foodalloance"
                            class="block w-full mt-1 text-sm <?= isset($errors['foodalloance']) ? 'border-red-600' : '' ?> dark:text-gray-300 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-red form-input"
                            value="<?= get_var('foodalloance') ?>" />
                        <?php if (isset($errors['foodalloance'])) : ?>
                            <span class="text-xs text-red-600 dark:text-red-400">
                                <?= $errors['foodalloance'] ?>
                            </span>
                        <?php endif; ?>
                    </label>
                </div>

                <div class="py-4">
                    <button
                        class="px-5 py-3 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                        Add Employee
                    </button>
                </div>

            </form>
        </div>

    </div>
</main>
<?php $this->view('includes/footer', ['crumbs' => $crumbs, 'actives' => $actives, 'hiddenSearch' => $hiddenSearch,]) ?>