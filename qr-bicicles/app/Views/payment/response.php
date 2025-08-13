<?= view('templates/header', ['title' => lang('App.payment_response')]) ?>

<div class="bg-gray-900 text-white min-h-screen flex items-center justify-center">
    <div class="bg-gray-800 p-8 rounded-lg shadow-lg w-full max-w-md text-center">
        <h2 class="text-3xl font-bold mb-4"><?= lang('App.payment_response') ?></h2>
        <p class="text-gray-400 mb-8"><?= lang('App.transaction_being_processed') ?></p>
        <p class="mb-4"><strong><?= lang('App.transaction_id') ?>:</strong> <?= esc($transactionId) ?></p>
        <p class="text-sm text-gray-500 mb-8"><?= lang('App.notification_payment_confirmed') ?></p>
        <a href="/dashboard" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded transition duration-300">
            <?= lang('App.back_to_dashboard') ?>
        </a>
    </div>
</div>

<?= view('templates/footer') ?>
