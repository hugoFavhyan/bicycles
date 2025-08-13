<?= view('templates/header', ['title' => 'Order Details']) ?>

<div class="bg-gray-900 text-white min-h-screen flex items-center justify-center">
    <div class="bg-gray-800 p-8 rounded-lg shadow-lg w-full max-w-2xl">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold"><?= lang('App.order_details') ?></h2>
        </div>

        <?php if ($order): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <h3 class="text-xl font-semibold mb-4"><?= lang('App.summary') ?></h3>
                    <div class="space-y-2">
                        <p><strong><?= lang('App.order_id') ?>:</strong> <?= $order['id'] ?></p>
                        <p><strong><?= lang('App.total_amount') ?>:</strong> $<?= number_format($order['total_amount'], 2) ?> pesos</p>
                    </div>

                    <h3 class="text-xl font-semibold mt-8 mb-4"><?= lang('App.bicycle_details') ?></h3>
                    <?php $bicycle_data = json_decode($order['order_data'], true)['bicycle']; ?>
                    <div class="space-y-2">
                        <p><strong><?= lang('App.bicycle_brand') ?>:</strong> <?= esc($bicycle_data['brand']) ?></p>
                        <p><strong><?= lang('App.bicycle_color') ?>:</strong> <?= esc($bicycle_data['color']) ?></p>
                        <p><strong><?= lang('App.serial_number') ?>:</strong> <?= esc($bicycle_data['serial']) ?></p>
                    </div>
                </div>
                <div class="text-center">
                    <h3 class="text-xl font-semibold mb-4"><?= lang('App.scan_to_pay') ?></h3>
                    <div id="qr-code" class="flex justify-center mb-4"></div>
                    <form>
                        <script
                            src="https://checkout.wompi.co/widget.js"
                            data-render="button"
                            data-public-key="<?= $wompi['publicKey'] ?>"
                            data-currency="<?= $wompi['currency'] ?>"
                            data-amount-in-cents="<?= $wompi['amountInCents'] ?>"
                            data-reference="<?= $wompi['reference'] ?>"
                            data-signature:integrity="<?= $wompi['signature'] ?>"
                            data-redirect-url="<?= $wompi['redirectUrl'] ?>"
                        >
                        </script>
                    </form>
                </div>
            </div>
        <?php else: ?>
            <p class="text-center"><?= lang('App.order_not_found') ?></p>
        <?php endif; ?>
         <div class="text-center mt-6">
            <a href="/dashboard" class="text-sm text-gray-400 hover:text-white"><?= lang('App.back_to_dashboard') ?></a>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/davidshimjs-qrcodejs@0.0.2/qrcode.min.js"></script>
<script>
    new QRCode(document.getElementById("qr-code"), {
        text: "<?= $wompi['reference'] . '-' . $wompi['amountInCents'] . '-' . $wompi['currency'] ?>",
        width: 256,
        height: 256,
        colorDark : "#ffffff",
        colorLight : "#1f2937",
        correctLevel : QRCode.CorrectLevel.H
    });
</script>

<?= view('templates/footer') ?>
