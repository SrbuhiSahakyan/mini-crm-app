<?php

use App\Http\Controllers\Api\TicketController;

Route::post('/tickets', [TicketController::class, 'store'])->withoutMiddleware('auth');
Route::get('/tickets/statistics', [TicketController::class, 'statistics']);
