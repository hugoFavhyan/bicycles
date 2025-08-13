<?= view('templates/header', ['title' => 'Register Bicycle']) ?>

<div class="bg-gray-900 text-white min-h-screen flex items-center justify-center">
    <div class="bg-gray-800 p-8 rounded-lg shadow-lg w-full max-w-md">
        <div class="text-center mb-8">
            <h2 class="text-2xl font-bold"><?= lang('App.register_bicycle') ?></h2>
            <p class="text-gray-400"><?= lang('App.add_a_new_bicycle_to_your_account') ?></p>
        </div>

        <form action="/bicycles/create" method="post">
            <div class="mb-4">
                <label for="brand" class="block text-gray-400 mb-2"><?= lang('App.bicycle_brand') ?></label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <i class="fas fa-bicycle text-gray-500"></i>
                    </span>
                    <input type="text" id="brand" name="brand" placeholder="e.g., Trek, Specialized" class="bg-gray-700 text-white w-full py-2 pl-10 pr-3 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
            </div>
            <div class="mb-4">
                <label for="color" class="block text-gray-400 mb-2"><?= lang('App.bicycle_color') ?></label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <i class="fas fa-palette text-gray-500"></i>
                    </span>
                    <input type="text" id="color" name="color" placeholder="e.g., Red, Blue" class="bg-gray-700 text-white w-full py-2 pl-10 pr-3 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
            </div>
            <div class="mb-6">
                <label for="serial" class="block text-gray-400 mb-2"><?= lang('App.serial_number') ?></label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <i class="fas fa-hashtag text-gray-500"></i>
                    </span>
                    <input type="text" id="serial" name="serial" placeholder="Your bicycle's serial number" class="bg-gray-700 text-white w-full py-2 pl-10 pr-3 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
            </div>
            <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded transition duration-300"><?= lang('App.register_bicycle') ?></button>
        </form>
        <div class="text-center mt-6">
            <a href="/dashboard" class="text-sm text-gray-400 hover:text-white"><?= lang('App.back_to_dashboard') ?></a>
        </div>
    </div>
</div>

<?= view('templates/footer') ?>
