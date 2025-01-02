<?php $this->view('includes/header', ['crumbs' => $crumbs, 'actives' => $actives, 'hiddenSearch' => $hiddenSearch,]) ?>

<!-- Desktop sidebar -->
<?php $this->view('includes/sidebar', ['crumbs' => $crumbs, 'actives' => $actives, 'hiddenSearch' => $hiddenSearch,]) ?>

<!-- Mobile sidebar -->
<?php $this->view('includes/navbar', ['crumbs' => $crumbs, 'actives' => $actives, 'hiddenSearch' => $hiddenSearch,]) ?>

<main class="h-full overflow-y-auto">
  <div class="container px-6 mx-auto grid">
    <h2
      class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
      Dashboard
    </h2>
    <!-- Cards -->
    <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
      <?php if (Auth::getRank() != 'teacher' && Auth::getRank() != 'matron'): ?>
        <!-- Card -->
        <div
          class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
          <div
            class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
              <path
                d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"></path>
            </svg>
          </div>

          <div>
            <p
              class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
              Total Students
            </p>
            <p
              class="text-lg font-semibold text-gray-700 dark:text-gray-200">
              <?= esc($studNum->numbers) ?>
            <ul>
              <?php if ($studgenNum): ?>
                <?php foreach ($studgenNum as $gen): ?>
                  <li>
                    <div><b><?= esc($gen->gender) ?></b>: <?= esc($gen->count) ?></div>
                  </li>
                <?php endforeach; ?>
              <?php endif; ?>
            </ul>

            </p>
          </div>
        </div>
        <!-- Card -->
        <div
          class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
          <div
            class="p-3 mr-4 text-green-500 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-500">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
              <path
                fill-rule="evenodd"
                d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"
                clip-rule="evenodd"></path>
            </svg>
          </div>
          <div>
            <p
              class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
              Total Revenue
            </p>
            <p
              class="text-lg font-semibold text-gray-700 dark:text-gray-200">
              GHC <?= esc(number_format($totalIncom, 2)) ?>
            </p>
          </div>
        </div>
        <!-- Card -->
        <div
          class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
          <div
            class="p-3 mr-4 text-red-500 bg-red-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
              <path
                d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"></path>
            </svg>
          </div>
          <div>
            <p
              class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
              Staff Strength
            </p>
            <p
              class="text-lg font-semibold text-gray-700 dark:text-gray-200">
              <?= esc(number_format($rowempstr->strength)) ?>
            </p>
            <ul>
              <?php if ($empsgenNum): ?>
                <?php foreach ($empsgenNum as $gen): ?>
                  <li>
                    <div><b><?= esc($gen->gender) ?></b>: <?= esc($gen->count) ?></div>
                  </li>
                <?php endforeach; ?>
              <?php endif; ?>
            </ul>
          </div>
        </div>

        <!-- Card -->
        <div
          class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
          <div
            class="p-3 mr-4 text-teal-500 bg-teal-100 rounded-full dark:text-teal-100 dark:bg-teal-500">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
              <path
                fill-rule="evenodd"
                d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"
                clip-rule="evenodd"></path>
            </svg>
          </div>
          <div>
            <p
              class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
              Fee Arrears
            </p>
            <p
              class="text-lg font-semibold text-gray-700 dark:text-gray-200">
              GHC <?= esc(number_format($dataarres->total_arearse, 2)) ?>
            </p>
          </div>
        </div>
        <?php elseif(Auth::getRank() == 'matron'):?>
          <div
          class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
          <div
            class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
              <path
                d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"></path>
            </svg>
          </div>

          <div>
            <p
              class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
              Total Students
            </p>
            <p
              class="text-lg font-semibold text-gray-700 dark:text-gray-200">
              <?= esc($studNum->numbers) ?>
            <ul>
              <?php if ($studgenNum): ?>
                <?php foreach ($studgenNum as $gen): ?>
                  <li>
                    <div><b><?= esc($gen->gender) ?></b>: <?= esc($gen->count) ?></div>
                  </li>
                <?php endforeach; ?>
              <?php endif; ?>
            </ul>

            </p>
          </div>
        </div>
        <!-- Card -->
        <div
          class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
          <div
            class="p-3 mr-4 text-green-500 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-500">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
              <path
                fill-rule="evenodd"
                d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"
                clip-rule="evenodd"></path>
            </svg>
          </div>
          <div>
            <p
              class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
              Total Revenue
            </p>
            <p
              class="text-lg font-semibold text-gray-700 dark:text-gray-200">
              GHC <?= esc(number_format($totalIncom, 2)) ?>
            </p>
          </div>
        </div>
        <!-- Card -->
        <div
          class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
          <div
            class="p-3 mr-4 text-red-500 bg-red-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
              <path
                d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"></path>
            </svg>
          </div>
          <div>
            <p
              class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
              Staff Strength
            </p>
            <p
              class="text-lg font-semibold text-gray-700 dark:text-gray-200">
              <?= esc(number_format($rowempstr->strength)) ?>
            </p>
            <ul>
              <?php if ($empsgenNum): ?>
                <?php foreach ($empsgenNum as $gen): ?>
                  <li>
                    <div><b><?= esc($gen->gender) ?></b>: <?= esc($gen->count) ?></div>
                  </li>
                <?php endforeach; ?>
              <?php endif; ?>
            </ul>
          </div>
        </div>

        <!-- Card -->
        <div
          class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
          <div
            class="p-3 mr-4 text-teal-500 bg-teal-100 rounded-full dark:text-teal-100 dark:bg-teal-500">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
              <path
                fill-rule="evenodd"
                d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"
                clip-rule="evenodd"></path>
            </svg>
          </div>
          <div>
            <p
              class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
              Feeding Arrears
            </p>
            <p
              class="text-lg font-semibold text-gray-700 dark:text-gray-200">
              GHC <?= esc(number_format($dataarres->total_arearse, 2)) ?>
            </p>
          </div>
        </div>
        <?php else:?>
          <div
          class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
          <div
            class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
              <path
                d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"></path>
            </svg>
          </div>

          <div>
            <p
              class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
              Total Students
            </p>
            <p
              class="text-lg font-semibold text-gray-700 dark:text-gray-200">
              <?= esc($studNum->numbers) ?>
            <ul>
              <?php if ($studgenNum): ?>
                <?php foreach ($studgenNum as $gen): ?>
                  <li>
                    <div><b><?= esc($gen->gender) ?></b>: <?= esc($gen->count) ?></div>
                  </li>
                <?php endforeach; ?>
              <?php endif; ?>
            </ul>

            </p>
          </div>
        </div>
        <!-- Card -->
        <div
          class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
          <div
            class="p-3 mr-4 text-green-500 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-500">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
              <path
                fill-rule="evenodd"
                d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"
                clip-rule="evenodd"></path>
            </svg>
          </div>
          <div>
            <p
              class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
              Daily Total Revenue
            </p>
            <p
              class="text-lg font-semibold text-gray-700 dark:text-gray-200">
              GHC <?=esc(number_format($totalIncom['income']->total_fee, 2));?>
            </p>
            <ul>
              <li>
                <div><b>Cash:</b> <?=esc(number_format($totalIncom['income']->total_fee - $totalIncom['credit_income']->total_cred_fee, 2));?></div>
                <div><b>Arrears:</b> <?=esc(number_format($totalIncom['credit_income']->total_cred_fee, 2));?></div>
              </li>
            </ul>
          </div>
        </div>       

        <!-- Card -->
        <div
          class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
          <div
            class="p-3 mr-4 text-teal-500 bg-teal-100 rounded-full dark:text-teal-100 dark:bg-teal-500">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
              <path
                fill-rule="evenodd"
                d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"
                clip-rule="evenodd"></path>
            </svg>
          </div>
          <div>
            <p
              class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
              Fee Arrears
            </p>
            <p
              class="text-lg font-semibold text-gray-700 dark:text-gray-200">
              GHC <?= esc(number_format($dataarres->total_arearse, 2)) ?>
            </p>
          </div>
        </div>
      <?php endif ?>
    </div>

    <!-- New Table -->
    <div class="w-full overflow-hidden rounded-lg shadow-xs">
      <div class="w-full overflow-x-auto">
        <table class="w-full whitespace-no-wrap">
          <thead>
            <tr
              class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
              <th class="px-4 py-3">Semester</th>
              <th class="px-4 py-3">Academic Year</th>
              <th class="px-4 py-3">Status</th>
              <th class="px-4 py-3">Action</th>
            </tr>
          </thead>
          <tbody
            class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
            <?php if ($sems): ?>
              <?php foreach ($sems as $sem): ?>
                <tr class="text-gray-700 dark:text-gray-400">
                  <td class="px-4 py-3">
                    <div class="flex items-center text-sm">
                      <!-- Avatar with inset shadow -->
                      <div>
                        <p class="font-semibold"><?= esc($sem->semester) ?></p>
                        <p class="text-xs text-gray-600 dark:text-gray-400">
                          <?= esc($sem->academics->year) ?>
                        </p>
                      </div>
                    </div>
                  </td>
                  <td class="px-4 py-3 text-sm">
                    <?= esc($sem->academics->academicyear) ?>
                  </td>
                  <td class="px-4 py-3 text-xs">
                    <?php if ($sem->id ==  $_SESSION['semester']->id): ?>
                      <span
                        class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                        Active
                      </span>
                    <?php else: ?>
                      <span
                        class="px-2 py-1 font-semibold leading-tight text-orange-700 bg-orange-100 rounded-full dark:text-white dark:bg-orange-600">
                        In-Active
                      </span>
                    <?php endif; ?>
                  </td>
                  <td class="px-4 py-3 text-sm">
                    <?php if ($sem->id ==  $_SESSION['semester']->id): ?>
                      <span>In Use</span>
                    <?php else: ?>
                      <form action="" method="post">
                        <input type="hidden" name="semes" value="<?= esc($sem->id) ?>">
                        <button
                          class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                          aria-label="Edit">
                          <svg
                            class="w-5 h-5"
                            aria-hidden="true"
                            fill="currentColor"
                            viewBox="0 0 20 20">
                          </svg>
                          <span>Use</span>
                        </button>
                      </form>
                    <?php endif ?>
                  </td>
                </tr>
              <?php endforeach; ?>
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

    <!-- Charts -->
    <?php if (Auth::getRank() != 'teacher' && Auth::getRank() != 'matron'): ?>
      <h2
        class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Charts
      </h2>
      <div class="grid gap-6 mb-8 md:grid-cols-2">
        <div
          class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
          <h4 class="mb-4 font-semibold text-gray-800 dark:text-gray-300">
          Other Revenue
          </h4>

          <?php
          $incomeData = [];
          if ($rowsinc) {
            foreach ($rowsinc as $inc) {
              // Append each income record as an object to the incomeData array
              $incomeData[] = (object) [
                'incomtypename' => $inc->incomtypename,
                'total_amount' => $inc->total_amount
              ];
            }
          }
          // Convert to JSON
          $incomeDataJson = json_encode($incomeData);
          ?>
          <!-- Canvas element where the pie chart will render -->
          <canvas id="incom_pie" width="2" height="2"></canvas>

          <!-- Inline or external JavaScript to call the function -->
          <script>
            // Parse PHP JSON data
            const incomeData = <?php echo $incomeDataJson; ?>;

            // Extract labels and values from the parsed data
            const dataLabels = incomeData.map(item => item.incomtypename);
            const dataValues = incomeData.map(item => item.total_amount);

            // Chart function
            function generatePieChart(elementId, dataValues, dataLabels) {
              const pieConfig = {
                type: 'doughnut',
                data: {
                  datasets: [{
                    data: dataValues,
                    backgroundColor: dataValues.map((_, index) => `hsl(${(index * 60) % 360}, 70%, 50%)`),
                    label: 'Income Data',
                  }],
                  labels: dataLabels,
                },
                options: {
                  responsive: true,
                  cutoutPercentage: 80,
                  plugins: {
                    legend: {
                      display: true,
                      position: 'bottom',
                      labels: {
                        color: '#4B5563'
                      }
                    }
                  }
                },
              };

              const pieCtx = document.getElementById(elementId).getContext('2d');
              new Chart(pieCtx, pieConfig);
            }

            // Call the function with parsed data
            document.addEventListener("DOMContentLoaded", function() {
              generatePieChart('incom_pie', dataValues, dataLabels);
            });
          </script>

        </div>
        
      </div>

    <?php endif ?>
  </div>
</main>
<?php $this->view('includes/footer', ['crumbs' => $crumbs, 'actives' => $actives, 'hiddenSearch' => $hiddenSearch,]) ?>