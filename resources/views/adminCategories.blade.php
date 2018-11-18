
@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="/admin/" class="btn">Zurück</a> 
        <form action="/admin/categories/newCategory" method="POST">
            {{ csrf_field() }}
            <input type="text" value="{{ old('name') }}"  name="name"/>
            <button class="btn btn-primary">Erzeugen</button>
        </form>
        <!-- Current Vendors -->
        @if (count($categories) > 0)
        <div class="panel panel-default">
            <div class="panel-heading">
                <h1>Kategorien</h1>
            </div>

            <div class="panel-body">
                <table class="table table-striped vendor-table">
                    <thead>
                        <th>Kategorie</th>
                        <th>Aktionen</th>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td class="table-text">
                                    <form action="/admin/categories/{{ $category->id }}" method="POST">
                                        {{ csrf_field() }}
                                        <input type="text" value="{{ $category->name }}"  name="name"/>
                                        <button class="btn btn-primary">Speichern</button>
                                    </form>
                                </td>
                                <td>
                                    <form action="/admin/categories/{{ $category->id }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}

                                        <button class="btn btn-danger">Löschen</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif
    </div>
@endsection