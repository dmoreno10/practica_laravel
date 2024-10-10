@extends('layouts.app')

@section('content')
   <h1>Listado de usuarios</h1>
   <div class="col-md-12">
    Usuarios registrados
    <hr>
        <div class="row card card-outline ">
            <div class="card-header">
                <div class="card-tools">
                    <a href="{{url('/users/create')}}" class="btn btn-primary">
                        Crear Usuario
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
            </div>

            <div class="container">
                <div class="card">
                    <div class="card-header">Manage Users</div>
                    <div class="card-body">
                        {{ $dataTable->table() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush


