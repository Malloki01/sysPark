@extends('layouts.template')

@section('content')
    <!-- Aquí llamas al componente Livewire -->
    @livewire('registros-controller', ['tipo_operacion' => 'salida'])
@endsection