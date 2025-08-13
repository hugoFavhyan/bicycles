<?= view('templates/header', ['title' => 'Start Parking']) ?>

<div class="bg-gray-900 text-white min-h-screen flex items-center justify-center">
    <div class="bg-gray-800 p-8 rounded-lg shadow-lg w-full max-w-md">
        <div class="text-center mb-8">
            <h2 class="text-2xl font-bold"><?= lang('App.start_new_parking_session') ?></h2>
            <p class="text-gray-400"><?= lang('App.select_one_of_your_bicycles_to_begin') ?></p>
        </div>

        <form action="/parking/store" method="post">
            <div class="mb-6">
                <label for="bicycle_id" class="block text-gray-400 mb-2"><?= lang('App.select_bicycle') ?></label>
                <select name="bicycle_id" id="bicycle_id" class="bg-gray-700 text-white w-full py-2 px-3 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <?php foreach ($bicycles as $bicycle): ?>
                        <option value="<?= $bicycle['id'] ?>"><?= $bicycle['brand'] ?> - <?= $bicycle['serial'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded transition duration-300"><?= lang('App.start_parking') ?></button>
        </form>
        <div class="text-center mt-6">
            <a href="/dashboard" class="text-sm text-gray-400 hover:text-white"><?= lang('App.back_to_dashboard') ?></a>
        </div>
    </div>
</div>

<?= view('templates/footer') ?>
