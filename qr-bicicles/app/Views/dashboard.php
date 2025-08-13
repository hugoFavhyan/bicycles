<?= view('templates/header', ['title' => 'Dashboard']) ?>

<div class="bg-gray-900 text-white min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold"><?= lang('App.dashboard') ?></h1>
            <a href="/logout" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded"><?= lang('App.logout') ?></a>
        </div>

        <div class="bg-gray-800 rounded-lg p-6 mb-8">
            <h2 class="text-2xl font-semibold mb-4"><?= lang('App.welcome') ?>, <?= session()->get('name') ?>!</h2>
            <p class="text-gray-400"><?= lang('App.email') ?>: <?= session()->get('email') ?></p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
            <a href="/bicycles/create" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-6 px-4 rounded-lg text-center transition duration-300">
                <i class="fas fa-bicycle fa-2x mb-2"></i>
                <p><?= lang('App.register_new_bicycle') ?></p>
            </a>
            <a href="/parking/start" class="bg-green-500 hover:bg-green-600 text-white font-bold py-6 px-4 rounded-lg text-center transition duration-300">
                <i class="fas fa-parking fa-2x mb-2"></i>
                <p><?= lang('App.start_new_parking_session') ?></p>
            </a>
        </div>

        <div>
            <h3 class="text-2xl font-semibold mb-4"><?= lang('App.active_parking_sessions') ?></h3>
            <?php if (!empty($activeParkings)): ?>
                <div class="bg-gray-800 rounded-lg p-6">
                    <ul>
                        <?php foreach ($activeParkings as $parking): ?>
                            <li class="border-b border-gray-700 py-4 flex justify-between items-center">
                                <div>
                                    <p class="font-semibold"><?= lang('App.bicycle') ?>: <?= esc($parking['brand']) ?> - <?= esc($parking['serial']) ?></p>
                                    <p class="text-gray-400"><?= lang('App.start_time') ?>: <?= esc($parking['start_time']) ?> <span id="timer-<?= esc($parking['id']) ?>" class="text-lg font-bold ml-4"></span></p>
                                </div>
                                <a href="/parking/stop/<?= esc($parking['id']) ?>" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded"><?= lang('App.stop') ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php else: ?>
                <div class="bg-gray-800 rounded-lg p-6 text-center">
                    <p><?= lang('App.no_active_parking_sessions') ?></p>
                </div>
            <?php endif; ?>
        </div>

        <div class="mt-8">
            <h3 class="text-2xl font-semibold mb-4"><?= lang('App.past_parking_sessions') ?></h3>
            <?php if (!empty($pastParkings)): ?>
                <div class="bg-gray-800 rounded-lg p-6">
                    <ul>
                        <?php foreach ($pastParkings as $parking): ?>
                            <li class="border-b border-gray-700 py-4">
                                <p class="font-semibold"><?= lang('App.bicycle') ?>: <?= esc($parking['brand']) ?> - <?= esc($parking['serial']) ?></p>
                                <p class="text-gray-400"><?= lang('App.start_time') ?>: <?= esc($parking['start_time']) ?></p>
                                <p class="text-gray-400"><?= lang('App.end_time') ?>: <?= esc($parking['end_time']) ?></p>
                                <?php
                                $start = new DateTime($parking['start_time']);
                                $end = new DateTime($parking['end_time']);
                                $interval = $start->diff($end);
                                ?>
                                <p class="text-gray-400"><?= lang('App.duration') ?>: <?= esc($interval->format('%d days, %h hours, %i minutes, %s seconds')) ?></p>
                                
                                <?php if ($parking['total_paid'] === null && $parking['status'] === 'pending'): ?>
                                    <a href="/pay/wompi/<?= esc($parking['id']) ?>" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded mt-4 inline-block"><?= lang('App.pay_with_wompi') ?></a>
                                <?php endif; ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php else: ?>
                <div class="bg-gray-800 rounded-lg p-6 text-center">
                    <p><?= lang('App.no_past_parking_sessions') ?></p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const activeParkingsData = <?= !empty($activeParkings) ? json_encode($activeParkings) : '[]' ?>;

        function startTimer(startTime, elementId) {
            const timerElement = document.getElementById(elementId);
            const start = new Date(startTime).getTime();

            if (!timerElement) {
                return;
            }

            setInterval(function() {
                const now = new Date().getTime();
                const distance = now - start;

                const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                let timerString = '';
                if (days > 0) {
                    timerString += days + (days === 1 ? ' day ' : ' days ');
                }
                timerString += (hours < 10 ? "0" + hours : hours) + ":" + 
                               (minutes < 10 ? "0" + minutes : minutes) + ":" + 
                               (seconds < 10 ? "0" + seconds : seconds);
                
                timerElement.innerHTML = timerString;
            }, 1000);
        }

        activeParkingsData.forEach(parking => {
            startTimer(parking.start_time_iso, `timer-${parking.id}`);
        });
    });
</script>

<?= view('templates/footer') ?>
