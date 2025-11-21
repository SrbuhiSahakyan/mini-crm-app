@extends('layouts.admin')
@section('title', 'Список заявок')
@section('content')
    <div class="main">
        <h2>Список заявок</h2>
        <div class="filter">
            @include('admin.tickets._filter')
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Клиент</th>
                    <th>Эл почта</th>
                    <th>Телефон</th>
                    <th>Тема</th>
                    <th>Статус</th>
                    <th>Дата создания</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($tickets as $ticket)
                    <tr>
                        <td>{{ $ticket->id }}</td>
                        <td>{{ $ticket->customer->name }}</td>
                        <td>{{ $ticket->customer->email }}</td>
                        <td>{{ $ticket->customer->phone }}</td>
                        <td>{{ $ticket->subject }}</td>
                        <td>
                            @if($ticket->status == 0)
                                Новый
                            @elseif($ticket->status == 1)
                                В работе
                            @elseif($ticket->status == 2)
                                Обработан
                            @endif
                        </td>
                        <td>{{ $ticket->created_at }}</td>
                        <td>
                        <td class="show_block">
                            <form action="{{ route('admin.tickets.show', $ticket) }}" method="GET">
                                <button type="submit" title="Посмотреть">
                                    <img src="{{ asset('img/eye.png') }}" alt="Eye">
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $tickets->links('pagination::bootstrap-5') }}
        <div class="ticket-statistics">
            <h5>Статистика тикетов</h5>
            <p >Сегодня: <span id="tickets-day">0</span></p>
            <p>Эта неделя: <span id="tickets-week">0</span></p>
            <p>Этот месяц: <span id="tickets-month">0</span></p>
        </div>
    </div>
@endsection
