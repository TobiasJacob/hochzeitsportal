
@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="/admin/newVendor" class="btn">Neuer Partner</a>
        <a href="/admin/categories" class="btn">Kategorien verwalten</a> 

        <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has('alert-' . $msg))
            <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}</p>
            @endif
        @endforeach
        </div>

        <!-- Current Vendors -->
        @if (count($vendors) > 0)
        <div class="panel panel-default">
            <div class="panel-heading">
                <h1>Partner</h1>
            </div>

            <div class="panel-body">
                <table class="table table-striped vendor-table">
                    <thead>
                        <th>Anbieter</th>
                        <th>Kategorie</th>
                        <th>Beschreibung</th>
                        <th>Aktionen</th>
                    </thead>
                    <tbody>
                        @foreach ($vendors as $vendor)
                            <tr>
                                <!-- Vendor Name -->
                                <td class="table-text">
                                    <div>{{ $vendor->name }}</div>
                                </td>

                                <td class="table-text">
                                    <div>{{ is_object($vendor->category) ? $vendor->category->name : NULL }}</div>
                                </td>

                                <td class="table-text">
                                    <div>{{ $vendor->description }}</div>
                                </td>
        
                                <!-- Delete Button -->
                                <td>
                                    <form action="/admin/{{ $vendor->id }}" method="POST">
                                    <a href="/admin/{{$vendor->id}}" class="btn btn-primary">Bearbeiten</a> 
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