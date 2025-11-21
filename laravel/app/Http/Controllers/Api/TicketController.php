<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\TicketService;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Resources\TicketResource;

class TicketController extends Controller
{
    protected $service;
    public function __construct(TicketService $service) { 
        $this->service = $service;
    }

    public function store(StoreTicketRequest $request) {
        $files = (array) $request->file('files');
        $ticket = $this->service->createTicket($request->validated(), $files);
        return new TicketResource($ticket);
    }

    public function statistics() {
        return response()->json(
            $this->service->getStatistics()
        );
    }
}
 