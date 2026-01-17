<?php
protected function schedule(Schedule $schedule)
{
    // cek order tunai yang expired tiap 5 menit
    $schedule->command('orders:cancel-expired')->everyFiveMinutes();
}
