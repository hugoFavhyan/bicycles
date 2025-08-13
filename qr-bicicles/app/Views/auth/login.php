<?= view('templates/header', ['title' => 'Login']) ?>

<div class="bg-gray-900 text-white min-h-screen flex items-center justify-center">
    <div class="bg-gray-800 p-8 rounded-lg shadow-lg w-full max-w-md">
        <div class="text-center mb-8">
            <i class="fas fa-bicycle fa-3x mx-auto mb-4"></i>
            <h2 class="text-2xl font-bold"><?= lang('App.welcome_back') ?></h2>
            <p class="text-gray-400"><?= lang('App.sign_in_to_continue') ?></p>
        </div>

        <?php if (session()->getFlashdata('msg')): ?>
            <div class="bg-red-500 text-white p-4 rounded mb-4"><?= session()->getFlashdata('msg') ?></div>
        <?php endif; ?>

        <form action="/login" method="post">
            <div class="mb-4">
                <label for="email" class="block text-gray-400 mb-2"><?= lang('App.email') ?></label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <i class="fas fa-envelope text-gray-500"></i>
                    </span>
                    <input type="email" id="email" name="email" placeholder="you@example.com" class="bg-gray-700 text-white w-full py-2 pl-10 pr-3 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
            </div>
            <div class="mb-6">
                <label for="password" class="block text-gray-400 mb-2"><?= lang('App.password') ?></label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <i class="fas fa-lock text-gray-500"></i>
                    </span>
                    <input type="password" id="password" name="password" placeholder="••••••••" class="bg-gray-700 text-white w-full py-2 pl-10 pr-3 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
            </div>
            <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded transition duration-300"><?= lang('App.login') ?></button>
        </form>

        <div class="text-center mt-6">
            <a href="/forgot-password" class="text-sm text-gray-400 hover:text-white"><?= lang('App.forgot_password') ?></a>
            <span class="text-gray-500 mx-2">|</span>
            <a href="/register" class="text-sm text-gray-400 hover:text-white"><?= lang('App.already_have_an_account_login') ?></a>
        </div>
    </div>
</div>

<?= view('templates/footer') ?>
