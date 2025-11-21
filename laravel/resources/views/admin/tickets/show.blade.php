@extends('layouts.admin')
@section('content')
    <div class="main mt_6">
        <a href="{{ route('admin.tickets.index') }}" class="back">Назад к списку</a>
        <h2  class="mt-4">Детали заявки #{{ $ticket->id }}</h2>
        <p><strong>Клиент:</strong> {{ $ticket->customer->name }}</p>
        <p><strong>Email:</strong> {{ $ticket->customer->email }}</p>
        <p><strong>Телефон:</strong> {{ $ticket->customer->phone }}</p>
        <p><strong>Тема:</strong> {{ $ticket->subject }}</p>
        <p><strong>Текст:</strong> {{ $ticket->body }}</p>
        <p><strong>Статус:</strong> {{ $ticket->status }}</p>
        <p><strong>Дата ответа менеджера:</strong> {{ $ticket->manager_replied_at ?? '-' }}</p>
        <h3>Файлы</h3>
        <ul class="files">
            @foreach($ticket->getMedia('files') as $file)
                <li>
                    <img src="{{ $file->getUrl() }}" alt="{{ $file->file_name }}" style="max-width:200px; margin-top:5px;">
                    <a href="{{ $file->getUrl() }}" download="{{ $file->file_name }}">Скачать</a>
                </li>
            @endforeach
        </ul>
        <form method="POST" action="{{ route('admin.tickets.status', $ticket) }}">
            @csrf
            <select name="status">
                <option value="0" {{ $ticket->status=='0'?'selected':'' }}>Новый</option>
                <option value="1" {{ $ticket->status=='1'?'selected':'' }}>В работе</option>
                <option value="2" {{ $ticket->status=='2'?'selected':'' }}>Обработан</option>
            </select>
            <button type="submit" class="update_btn">Обновить</button>
        </form>
    </div>
@endsection
