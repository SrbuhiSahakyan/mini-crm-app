@extends('layouts.app')
@section('title', 'Свяжитесь с нами')
@section('content')
  <div class="widget">
    <div class="widget_body">
      <h3>Свяжитесь с нами</h3>
      @if(session('message'))
        <div id="result" class="success_message">{{ session('message') }}</div>
      @else
        <div id="result" class="success_message" style="display:none;"></div>
      @endif
      <form id="widgetForm">
        <div class="form_control">
          <input name="name" placeholder="Имя" />
          <div class="error" data-field="name"></div>
        </div>
        <div class="form_control">
          <input name="email" placeholder="Email" />
          <div class="error" data-field="email"></div>
        </div>
        <div class="form_control">
          <input name="phone" placeholder="+380XXXXXXXXX" />
          <div class="error" data-field="phone"></div>
        </div>
        <div class="form_control">
          <input name="subject" placeholder="Тема" />
          <div class="error" data-field="subject"></div>
        </div>
        <div class="form_control">
          <textarea name="text" placeholder="Текст"></textarea>
          <div class="error" data-field="text"></div>
        </div>
        <div class="form_control">
          <input type="file" class="file" name="files[]" multiple />
          <div class="error" data-field="files"></div>
        </div>
        <div class="submit">
          <button type="submit">Отправить</button>
        </div>
      </form>
    </div>
  </div>
@endsection
