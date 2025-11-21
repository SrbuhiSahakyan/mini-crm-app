<form method="GET" action="{{ route('admin.tickets.index') }}" class="row g-3 mb-4">
    <div class="col-md-2">
        <input type="text" name="email" class="form-control" placeholder="Эл почта" value="{{ request('email') }}">
    </div>
    <div class="col-md-2">
        <input type="text" name="phone" class="form-control" placeholder="Телефон" value="{{ request('phone') }}">
    </div>
    <div class="col-md-2">
        <select name="status" class="form-select">
            <option value="">Статус</option>
            <option value="0" {{ request('status')=='0'?'selected':'' }}>Новый</option>
            <option value="1" {{ request('status')=='1'?'selected':'' }}>В работе</option>
            <option value="2" {{ request('status')=='2'?'selected':'' }}>Обработан</option>
        </select>
    </div>
    <div class="col-md-2">
        <input type="date" name="date_from" class="form-control" value="{{ request('date_from') }}">
    </div>
    <div class="col-md-2">
        <input type="date" name="date_to" class="form-control" value="{{ request('date_to') }}">
    </div>
    <div class="col-md-2 filter_btn">
        <button type="submit" class="btn btn-primary w-100">Фильтр</button>
    </div>
</form>
