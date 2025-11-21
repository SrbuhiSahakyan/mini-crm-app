<?php

namespace App\Repositories;

use App\Models\Ticket;

interface TicketRepositoryInterface
{
    public function all(): array;
    public function find(int $id): ?Ticket;
    public function create(array $data): Ticket;
    public function update(Ticket $ticket, array $data): Ticket;
    public function delete(Ticket $ticket): bool;
    public function getFiltered(array $filters): array;
}
