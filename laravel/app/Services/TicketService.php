<?php

namespace App\Services;

use App\Repositories\TicketRepositoryInterface;
use App\Models\Ticket;
use App\Models\Customer;
use Illuminate\Support\Carbon;
use Illuminate\Http\UploadedFile;

class TicketService
{
    protected TicketRepositoryInterface $tickets;

    public function __construct(TicketRepositoryInterface $tickets) {
        $this->tickets = $tickets;
    }

    public function createTicket(array $data, array $files = []): Ticket {
        $customer = $this->findOrCreateCustomer($data);
        $todayTickets = Ticket::where('customer_id', $customer->id)->whereDate('created_at', Carbon::today())->count();
        if ($todayTickets > 0) {
            throw new \Exception('Вы можете отправлять только один тикет в сутки');
        }
        $ticket = $this->tickets->create([
            'customer_id' => $customer->id,
            'subject' => $data['subject'],
            'text' => $data['text'],
            'status' => '0',
            'manager_replied_at' => null,
        ]);
        foreach ($files as $file) {
            if ($file instanceof UploadedFile) {
                $ticket->addMedia($file)->toMediaCollection('files');
            }
        }
        return $ticket;
    }

    protected function findOrCreateCustomer(array $data): Customer {
        return Customer::firstOrCreate([
            'email' => $data['email'] ?? null,
            'phone' => $data['phone'] ?? null,
        ]);
    }

    public function updateStatus(Ticket $ticket, string|int $status): Ticket {
        $ticket->status = $status;
        if ($status != 0) {
            $ticket->manager_replied_at = now();
        }
        $ticket->save();
        return $ticket;
    }

    public function getStatistics(): array {
        return [
            'day' => Ticket::whereDate('created_at', Carbon::today())->count(),
            'week'=> Ticket::whereBetween('created_at',[Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count(),
            'month' => Ticket::whereBetween('created_at',[Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->count(),
        ];
    }

    public function getTicketsForAdmin(array $filters) {
        $query = Ticket::query()->with('customer', 'media');
        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }
        if (!empty($filters['email'])) {
            $query->whereHas('customer', fn($q) => $q->where('email', 'like', '%' . $filters['email'] . '%'));
        }
        if (!empty($filters['phone'])) {
            $query->whereHas('customer', fn($q) => $q->where('phone', 'like', '%' . $filters['phone'] . '%'));
        }
        if (!empty($filters['date_from'])) {
            $query->whereDate('created_at', '>=', $filters['date_from']);
        }
        if (!empty($filters['date_to'])) {
            $query->whereDate('created_at', '<=', $filters['date_to']);
        }
        return $query->orderBy('created_at', 'desc')->paginate(20);
    }

    public function updateTicketStatus(Ticket $ticket, string $status) {
        $ticket->update([
            'status' => $status,
            'manager_replied_at' => now(),
        ]);
    }
}
