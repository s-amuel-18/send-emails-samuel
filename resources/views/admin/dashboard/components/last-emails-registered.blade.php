@can('contact_email.index')

    <div class="col-md-6 table-responsive">

        <div class="card card-light">
            <div class="card-header">
                <h3 class="card-title">Ultimos 5 Registros De Hoy</h3>
                <div class="card-tools">

                    @can('contact_email.create')
                        <a href="{{ route('contact_email.create') }}" class="btn btn-info btn-sm text-white">
                            <i class="fas fa-plus"></i><span class="d-none d-md-inline-block ml-1">Nuevo email</span>
                        </a>
                    @endcan
                </div>
            </div>

            <div class="card-body table-responsive">

                @if ($registros_de_hoy_take->count() > 0)
                    <table class="table table-light table-striped table-hover text-nowrap table-valign-middle">
                        <thead class="">
                            <tr>
                                <th>Nombre Empresa</th>
                                <th>Email</th>
                                <th>Contacttos</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($registros_de_hoy_take as $i => $registro)
                                <tr>
                                    <td>{{ Str::limit($registro->nombre_empresa, 20) }}</td>
                                    <td>{{ $registro->email }}</td>
                                    <td>
                                        {{-- whatsapp --}}
                                        @if ($registro->whatsapp)
                                            <a target="_blanck" href="{{ $registro->whatsapp }}"
                                                class="btn btn-success btn-sm ">
                                                <i class="fab fa-whatsapp"></i>
                                            </a>
                                        @endif

                                        {{-- facebook --}}
                                        @if ($registro->facebook)
                                            <a target="_blanck" href="{{ $registro->facebook }}"
                                                class="btn bg-purple btn-sm ">
                                                <i class="fab fa-facebook"></i>
                                            </a>
                                        @endif

                                        {{-- instagram --}}
                                        @if ($registro->instagram)
                                            <a target="_blanck" href="{{ $registro->instagram }}"
                                                class="btn btn-danger btn-sm">
                                                <i class="fab fa-instagram"></i>
                                            </a>
                                        @endif

                                        {{-- url --}}
                                        @if ($registro->url)
                                            <a target="_blanck" href="{{ $registro->url }}" class="btn btn-info btn-sm">
                                                <i class="fas fa-external-link-alt"></i>
                                            </a>
                                        @endif

                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                @else
                    Sin Registros De Hoy
                @endif

            </div>
        </div>



    </div>

@endcan
