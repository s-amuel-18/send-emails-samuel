@extends('layouts.app')
{{-- @section('plugins.Datatables', true) --}}
@section('plugins.Summernote', true)

<style>
    .note-editable.card-block {
        /* font-weight:  */
        min-height: 200px
    }

</style>


@section('title', 'Recomendaciones Al Sistema')

@section('content_header')
    <h1>Recomendaciones Al Sistema</h1>
@stop

@section('content_2')

    <div class="callout callout-info">
        <h4 class="alert-heading">Haznos Saber Tus Recomendaciones</h4>
        En este modulo puedes exponer tus recomendaciones asi el sistema.
    </div>

    <div class="">
        <div class="row">
            <div class="col-lg-4 offset-lg-4">

                @include('admin.recomendacion.components.create')

            </div>
        </div>

    </div>

@stop


@section('js')
    <script>
        $(function() {
            // Summernote
            $('#summernote').summernote()
        });
    </script>
@stop
