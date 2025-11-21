<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Services\TicketService;

class TicketController extends Controller
{
    protected $service;

    public function __construct(TicketService $service) {
        $this->service = $service;
    }

    public function index(Request $request) {
        $tickets = $this->service->getTicketsForAdmin($request->all());
        return view('admin.tickets.index', compact('tickets'));
    }

    public function show(Ticket $ticket) {
        return view('admin.tickets.show', compact('ticket'));
    }

    public function updateStatus(Request $request, Ticket $ticket) {
        $status = $request->input('status');
        $this->service->updateStatus($ticket, $status);
        return redirect()->back()->with('success', 'Статус обновлен');
    }
}
