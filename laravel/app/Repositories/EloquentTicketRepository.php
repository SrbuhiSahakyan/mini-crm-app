<?php

namespace App\Repositories;

use App\Models\Ticket;

class EloquentTicketRepository implements TicketRepositoryInterface
{
    public function all(): array {
        return Ticket::all()->toArray();
    }

    public function find(int $id): ?Ticket {
        return Ticket::find($id);
    }

    public function create(array $data): Ticket {
        return Ticket::create($data);
    }

    public function update(Ticket $ticket, array $data): Ticket {
        $ticket->update($data);
        return $ticket;
    }

    public function delete(Ticket $ticket): bool {
        return $ticket->delete();
    }

    public function getFiltered(array $filters): array {
        $query = Ticket::query();
        if (isset($filters['status'])) {
            $query->where('status', $filters['status']);
        }
        if (isset($filters['email'])) {
            $query->whereHas('customer', function ($q) use ($filters) {
                $q->where('email', 'like', '%' . $filters['email'] . '%');
            });
        }
        if (isset($filters['phone'])) {
            $query->whereHas('customer', function ($q) use ($filters) {
                $q->where('phone', 'like', '%' . $filters['phone'] . '%');
            });
        }
        if (isset($filters['date_from'])) {
            $query->whereDate('created_at', '>=', $filters['date_from']);
        }
        if (isset($filters['date_to'])) {
            $query->whereDate('created_at', '<=', $filters['date_to']);
        }
        return $query->get()->toArray();
    }
}
