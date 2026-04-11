@extends('layouts.app')

@section('content')
<div class="p-6">

    <div class="bg-white p-6 rounded shadow">

        @include('gerente.users_cliente.partials.form-profile', [
            'user' => $user
        ])

    </div>

</div>
@endsection