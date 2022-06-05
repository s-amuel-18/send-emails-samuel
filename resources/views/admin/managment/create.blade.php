@extends('layouts.app')
{{-- @section('plugins.Datatables', true) --}}

@section('title', $data['title'])

@section('content_header')
    <h1>{{ $data['title'] }}</h1>
@stop

@section('content_2')

    <form action="{{ $data['route_send'] }}" method="POST">
        @csrf
        @method($data['method'])
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input placeholder="Nombre" id="name"
                        value="{{ old('name') ? old('name') : $data['update']['name'] ?? null }}" name="name" type="text"
                        class="form-control @error('name') is-invalid @enderror">

                    @error('name')
                        <span class="error invalid-feedback">Please enter a email address</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="price">Precio</label>
                    <input placeholder="Precio"
                        value="{{ old('price') ? old('price') : $data['update']['price'] ?? null }}" name="price"
                        id="price" type="number" min="1" class="form-control @error('price') is-invalid @enderror">

                    @error('price')
                        <span class="error invalid-feedback">Please enter a email address</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="desc">Descripcion</label>
                    <input placeholder="Descripcion"
                        value="{{ old('desc') ? old('desc') : $data['update']['desc'] ?? null }}" name="desc" id="desc"
                        type="text" class="form-control @error('desc') is-invalid @enderror">

                    @error('desc')
                        <span class="error invalid-feedback">Please enter a email address</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="price">Tiempo De Facturacion</label>
                    <select value="{{ old('billing_time_id') }}" name="billing_time_id" id="billing_time_id"
                        class="form-control @error('billing_time_id') is-invalid @enderror">
                        <option value="">-- Seleccionar Tiempo De Facturacion</option>
                        @foreach ($data['billing_times'] as $billing)
                            <option
                                {{ old('billing_time_id') == $billing->id ? 'selected' : ($data['update']['billing_time_id'] ?? null == $billing->id ? 'selected' : '') }}
                                value="{{ $billing->id }}">{{ $billing->name }}</option>
                        @endforeach
                    </select>

                    @error('billing_time_id')
                        <span class="error invalid-feedback">Please enter a email address</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-12">

                <button class="ml-auto d-block btn btn-primary btn-sm" type="submit">{{ $data['text_buttom'] }}</button>

            </div>
        </div>

    </form>


@stop
