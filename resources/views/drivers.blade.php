@extends('layouts.master')

@section('content')
    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mt-3 mb-3">
        <h4 class="page-title m-0">{{ __('messages.drivers') }}</h4>
        <button type="button" class="btn btn-primary ms-auto" onclick="window.location='{{ route('newdriver') }}'">
            <i class="mdi mdi-plus me-1"></i> <span>{{ __('messages.add_driver_btn') }}</span>
        </button>
    </div>

    <div class="mb-3">
        <div class="input-group">
            <input type="text" id="table-search-input" class="form-control"
                placeholder="{{ __('messages.search_placeholder') }}" aria-label="{{ __('messages.search') }}">
            <button class="btn btn-info" id="table-search-button">
                {{ __('messages.search') }}
            </button>
        </div>
    </div>

    <div class="card darkbg">
        <div class="card-body">
            <div class="default-table-area mx-minus-1 table-recent-orders">
                <div class="table-responsive">
                    <table class="table align-middle w-100" id="driversTable">
                        <thead>
                            <tr>
                                <th scope="col" class="fw-medium">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="flexCheckDefault1">
                                    </div>
                                </th>
                                <th scope="col" class="fw-medium text-start">{{ __('messages.driver') }}</th>
                                <th scope="col" class="fw-medium">{{ __('messages.phone') }}</th>
                                <th scope="col" class="fw-medium">{{ __('messages.added_by') }}</th>
                                <th scope="col" class="fw-medium">{{ __('messages.created_on') }}</th>
                                <th scope="col" class="fw-medium ">{{ __('messages.actions') }}</th>
                                <th scope="col" class="fw-medium">#</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($drivers as $driver)
                                @php
                                    $addedByUser = \App\Models\User::find($driver->added_by);
                                    $firstName = explode(' ', trim($driver->full_name))[0] ?? $driver->full_name;
                                @endphp
                                <tr>
                                    <td class="text-white" style="width: 62px;">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="flexCheckDefault2">
                                        </div>
                                    </td>
                                    <td class="text-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1 ms-0 position-relative top-0">
                                                <h3 class="fw-medium mb-0 fs-16 text-white">
                                                    {{ $driver->driver_id }} -
                                                    <span class="d-inline d-md-none">{{ $firstName }}</span>
                                                    <span class="d-none d-md-inline">{{ $driver->full_name }}</span>
                                                </h3>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-white">{{ $driver->phone_number }}</td>
                                    <td class="text-white">{{ $addedByUser ? $addedByUser->full_name : '' }}</td>
                                    <td class="text-white text-start">
                                        {{ \Carbon\Carbon::parse($driver->created_at)->format('d-m-y') }}
                                    </td>
                                    <td class="text-white ">
                                        <a href="{{ route('drivers.show', $driver->id) }}" class="action-icon text-white"
                                            title="{{ __('messages.view') }}">
                                            <span class="material-icons">remove_red_eye</span>
                                        </a>
                                        <a href="{{ route('drivers.edit', $driver->id) }}" class="action-icon text-white"
                                            title="{{ __('messages.edit') }}">
                                            <span class="material-icons">create</span>
                                        </a>
                                        <form action="{{ route('drivers.delete', $driver->id) }}" method="POST"
                                            class="d-inline m-0 p-0">
                                            @csrf @method('DELETE')
                                            <button type="submit"
                                                class="action-icon text-danger border-0 bg-transparent p-0"
                                                onclick="return confirm('{{ __('messages.confirm_delete_driver') }}')"
                                                title="{{ __('messages.delete') }}">
                                                <span class="material-icons">delete</span>
                                            </button>
                                        </form>
                                    </td>
                                    <td class="text-white">
                                        <span
                                            class="material-icons text{{ $driver->active ? '-success' : '-danger' }}">circle</span>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-2.0.8/r-3.0.2/datatables.min.js"></script>
    <script>
        $(function() {
            const locale = @json(app()->getLocale());

            function dtLanguage(loc) {
                if (loc === 'fr') {
                    return {
                        aria: {
                            sortAscending: ": activer pour trier la colonne par ordre croissant",
                            sortDescending: ": activer pour trier la colonne par ordre décroissant"
                        },
                        paginate: {
                            first: "Premier",
                            previous: "&laquo;",
                            next: "&raquo;",
                            last: "Dernier"
                        },
                        emptyTable: "Aucune donnée disponible",
                        info: "Affichage de _START_ à _END_ sur _TOTAL_ entrées",
                        infoEmpty: "Affichage de 0 à 0 sur 0 entrée",
                        infoFiltered: "(filtré à partir de _MAX_ entrées au total)",
                        lengthMenu: "Afficher _MENU_ entrées",
                        loadingRecords: "Chargement...",
                        processing: "Traitement...",
                        search: "Rechercher:",
                        zeroRecords: "Aucun enregistrement correspondant trouvé"
                    };
                }
                return {
                    paginate: {
                        previous: "&laquo;",
                        next: "&raquo;"
                    }
                };
            }

            const dt = $('#driversTable').DataTable({
                paging: true,
                pageLength: 50,
                lengthChange: false,
                autoWidth: false,
                order: [
                    [2, 'asc']
                ],
                responsive: true,
                columnDefs: [{
                        targets: 0,
                        width: "28px",
                        className: "text-center",
                        orderable: false,
                        responsivePriority: 1
                    }, // checkbox
                    {
                        targets: 1,
                        responsivePriority: 2
                    }, // driver left-aligned
                    {
                        targets: 2,
                        responsivePriority: 10000
                    }, // phone
                    {
                        targets: 3,
                        responsivePriority: 10001,
                        orderable: false
                    }, // added by
                    {
                        targets: 4,
                        responsivePriority: 10002,
                        orderable: false
                    }, // created on
                    {
                        targets: 5,
                        responsivePriority: 3,
                        orderable: false
                    }, // actions
                    {
                        targets: 6,
                        width: "28px",
                        orderable: false,
                        responsivePriority: 4
                    } // status left-aligned
                ],

                dom: "<'row'<'col-12'tr>>" +
                    "<'row'<'col-12 d-flex justify-content-center'p>>" +
                    "<'row'<'col-12 d-flex justify-content-center'i>>",
                language: dtLanguage(locale)
            });

            $('#table-search-input').on('input', function() {
                dt.search(this.value).draw();
            });
            $('#table-search-button').on('click', function() {
                dt.search($('#table-search-input').val()).draw();
            });
        });
    </script>
@endpush
