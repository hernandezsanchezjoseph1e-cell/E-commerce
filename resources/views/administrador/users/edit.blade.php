@extends('layouts.app')

@section('content')
<div class="p-6 space-y-6">

    <div class="bg-white p-6 rounded shadow">
        <h3 class="font-semibold mb-4">Información del usuario</h3>

        @include('administrador.users.partials.form-profile', [
            'user' => $user,
            'roles' => $roles
        ])
    </div>

</div>
@endsection