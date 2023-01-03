@can('user.index')



    <div class="card card-light">
        <div class="card-header">
            <h3 class="card-title">Usuarios</h3>
            <div class="card-tools">

                @can('user.create')
                    <a href="{{ route('contact_email.estadisticas') }}" class="btn btn-info btn-sm text-white ">
                        <i class="fas fa-fw fa-mail-bulk"></i><span class="d-none d-md-inline-block ml-1">Estadistica
                            de
                            registros</span>
                    </a>
                @endcan
            </div>
        </div>

        <div class="card-body table-responsive card_view_more-">
            <table id="table_users"
                class="w-100 datatable table table-light table-striped table-hover text-nowrap table-valign-middle">
                <thead class="">
                    <tr>
                        {{-- <th>ID</th> --}}
                        <th>username</th>
                        <th>Cantidad</th>
                        <th>

                            <span data-placement="top" data-toggle="tooltip" title="Correos enviados">
                                C/E
                            </span>

                        </th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($usr_registros_hoy as $i => $usr)
                        <tr>
                            {{-- <td>{{ $usr->id }}</td> --}}
                            <td>
                                <div class="d-flex align-items-center">
                                    <div style="width: 27px; height: 27px;"
                                        class="mr-2 bg-{{ $usr->color }} d-flex justify-content-center align-items-center rounded-circle">
                                        <i class="fa fa-user" style="font-size: 12px"></i>
                                    </div>
                                    <div class="">
                                        {{ $usr->username }}
                                    </div>

                                </div>
                            </td>
                            <td>
                                <a
                                    href="{{ route('contact_email.index', ['username' => $usr->username, 'date_filter' => now()->format('Y-m-d')]) }}">
                                    <span style="font-size: 14px"
                                        class="badge  badge-{{ $usr->emails_registros_count > 0 ? 'success' : 'danger' }}">{{ $usr->emails_registros_count }}</span>
                                </a>
                            </td>
                            <td>
                                <a
                                    href="{{ route('contact_email.shipping_history', ['username' => $usr->username, 'date' => now()->format('Y-m-d')]) }}">
                                    <span class="badge bg-purple"
                                        style="font-size: 14px">{{ $usr->email_enviado_count }}</span>
                                </a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>



    @push('js')
        <script>
            $(function() {
                const table = document.getElementById("table_users")
                const datatable = $(table).DataTable({
                    "pageLength": 5,
                    "responsive": true,
                    "scrollX": true,
                    "bPaginate": true,
                    "sPaginationType": "numbers",
                    "order": [
                        [1, "DESC"]
                    ],
                });
            });
        </script>
    @endpush
@endcan
