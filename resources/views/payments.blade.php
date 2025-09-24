@extends('layouts.master')

@push('styles')
    <link href="https://cdn.datatables.net/v/bs5/dt-2.0.8/r-3.0.2/datatables.min.css" rel="stylesheet">
    <style>
        .drag-image.active {
            border: 2px dashed #007bff;
            background-color: #f8f9fa;
        }
    </style>
@endpush

@section('content')
    <div id="main-content">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mt-3 mb-3 page-title-box">
            <h4 class="page-title m-0">{{ __('messages.payments_page_title') }}</h4>
        </div>

        {{-- Upload card --}}
        <div class="card darkbg border border-dark rounded-10 mb-4" id="upload-card">
            <div class="card-header bg-secondary text-center text-light">
                <h5 class="card-title mb-0">{{ __('messages.batch_upload') }}</h5>
            </div>
            <div class="card-body text-center">
                <form id="upload-form" action="{{ route('payments.upload') }}" method="POST" enctype="multipart/form-data"
                    class="w-100">
                    @csrf
                    <div class="form-group mb-0 only-file-upload w-100" id="file-upload">
                        <label for="upload-files" class="w-100 mb-0">
                            <div class="drag-image text-center w-100" id="upload-container" style="cursor: pointer;">
                                <div class="icon mb-3"><i class="fas fa-cloud-upload-alt fa-2x"></i></div>
                                <h6 class="mb-1">Drag & Drop File Here</h6>
                                <span class="d-block mb-3">OR</span>
                                <button type="button" class="btn btn-primary"
                                    id="upload-browse-button">{{ __('messages.browse') }}</button>
                                <input type="file" id="upload-files" name="files[]" hidden multiple>
                            </div>
                        </label>
                        <button type="submit" class="btn btn-primary d-none" id="upload-submit">Upload</button>
                    </div>

                    {{-- Progress Bar --}}
                    <div id="progress-container" class="mt-3" style="display:none;">
                        <div class="progress" role="progressbar" aria-label="Upload progress" aria-valuenow="0"
                            aria-valuemin="0" aria-valuemax="100">
                            <div id="progress-bar" class="progress-bar" style="width: 0%"></div>
                        </div>
                        <p id="progress-text" class="mt-2 text-white"></p>
                    </div>
                </form>
            </div>
        </div>

        {{-- Results table --}}
        <div class="card darkbg border border-dark rounded-10 mb-4" id="resultsTable" style="display:none;">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 p-20">
                <div class="d-flex flex-wrap gap-2 gap-xxl-5 align-items-center">
                    <form class="table-src-form position-relative m-0">
                        <input type="text" class="form-control w-340" placeholder="Search here..." id="ext-search">
                        <div
                            class="src-btn position-absolute top-50 start-0 translate-middle-y bg-transparent p-0 border-0">
                            <span class="material-symbols-outlined">search</span>
                        </div>
                    </form>
                </div>
            </div>

            <div class="default-table-area mx-minus-1 table-product-list">
                <div class="table-responsive">
                    <table class="table align-middle" id="resultsDataTable">
                        <thead>
                            <tr>
                                <th scope="col" class="fw-medium">{{ __('messages.id_name') }}</th>
                                <th scope="col" class="fw-medium">{{ __('messages.total_invoice') }}</th>
                                <th scope="col" class="fw-medium">{{ __('messages.daysworked') }}</th>
                                <th scope="col" class="fw-medium">{{ __('messages.total_parcels') }}</th>
                            </tr>
                        </thead>
                        <tbody id="resultsBody">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.datatables.net/v/bs5/dt-2.0.8/r-3.0.2/datatables.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const uploadInput = document.getElementById('upload-files');
            const uploadForm = document.getElementById('upload-form');
            const browseButton = document.getElementById('upload-browse-button');
            const progressContainer = document.getElementById('progress-container');
            const progressBar = document.getElementById('progress-bar');
            const progressText = document.getElementById('progress-text');
            const uploadCard = document.getElementById('upload-card');
            const resultsTable = document.getElementById('resultsTable');
            const resultsBody = document.getElementById('resultsBody');
            const uploadContainer = document.getElementById('upload-container');
            const extSearch = document.getElementById('ext-search');

            const locale = '{{ app()->getLocale() }}';
            let resultsDT = null;

            function dtLanguage(loc) {
                if (loc === 'fr') {
                    return {
                        aria: {
                            sortAscending: ": activer pour trier la colonne par ordre croissant",
                            sortDescending: ": activer pour trier la colonne par ordre décroissant"
                        },
                        paginate: {
                            first: "Premier",
                            previous: "Précédent",
                            next: "Suivant",
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
                return {}; // default (English)
            }

            if (browseButton && uploadInput) {
                browseButton.addEventListener('click', e => {
                    e.preventDefault();
                    uploadInput.click();
                });
            }

            if (uploadForm && uploadInput) {
                uploadInput.addEventListener('change', () => {
                    if (uploadInput.files.length) uploadFiles();
                });

                uploadContainer.addEventListener('dragover', (e) => {
                    e.preventDefault();
                    uploadContainer.classList.add('active');
                });
                uploadContainer.addEventListener('dragleave', (e) => {
                    e.preventDefault();
                    uploadContainer.classList.remove('active');
                });
                uploadContainer.addEventListener('drop', (e) => {
                    e.preventDefault();
                    uploadContainer.classList.remove('active');
                    uploadInput.files = e.dataTransfer.files;
                    uploadFiles();
                });

                function setProcessingUI(active) {
                    if (active) {
                        progressBar.classList.add('progress-bar-striped', 'progress-bar-animated');
                        progressText.textContent = 'Processing on server...';
                    } else {
                        progressBar.classList.remove('progress-bar-striped', 'progress-bar-animated');
                    }
                }

                function initDataTable() {
                    if (resultsDT) {
                        resultsDT.destroy();
                    }
                    resultsDT = new DataTable('#resultsDataTable', {
                        responsive: true,
                        paging: true,
                        searching: true,
                        info: true,
                        order: [],
                        stripeClasses: [],
                        language: dtLanguage(locale),
                        // center pagination + info using Bootstrap utility classes
                        dom: 't' +
                            '<"mt-3 d-flex justify-content-center"p>' +
                            '<"mt-2 d-flex justify-content-center"i>'
                    });

                    if (extSearch) {
                        extSearch.addEventListener('keyup', () => {
                            resultsDT.search(extSearch.value).draw();
                        });
                    }
                }

                function uploadFiles() {
                    const formData = new FormData(uploadForm);
                    const files = Array.from(uploadInput.files || []);
                    const totalBytes = files.reduce((sum, file) => sum + file.size, 0);

                    progressContainer.style.display = 'block';
                    setProcessingUI(false);
                    progressBar.style.width = '0%';
                    progressBar.setAttribute('aria-valuenow', 0);
                    progressText.textContent = 'Preparing upload...';

                    const xhr = new XMLHttpRequest();
                    xhr.open('POST', uploadForm.action);
                    xhr.responseType = 'json';

                    let lastPercent = 0;
                    const updateProgress = percent => {
                        const bounded = Math.max(lastPercent, Math.min(Math.round(percent), 99));
                        lastPercent = bounded;
                        progressBar.style.width = `${bounded}%`;
                        progressBar.setAttribute('aria-valuenow', bounded);
                        progressText.textContent = `Uploading ${bounded}%...`;
                    };

                    xhr.upload.addEventListener('progress', e => {
                        if (e.lengthComputable && e.total > 0) {
                            updateProgress((e.loaded / e.total) * 100);
                        } else if (totalBytes > 0) {
                            updateProgress((e.loaded / totalBytes) * 100);
                        } else {
                            setProcessingUI(true);
                            progressText.textContent = 'Uploading...';
                        }
                    });

                    xhr.upload.addEventListener('load', () => {
                        setProcessingUI(true);
                        progressText.textContent = 'Processing on server...';
                    });

                    xhr.addEventListener('readystatechange', () => {
                        if (xhr.readyState > XMLHttpRequest.HEADERS_RECEIVED && lastPercent < 99) {
                            setProcessingUI(true);
                        }
                    });

                    xhr.addEventListener('load', () => {
                        setProcessingUI(false);
                        if (xhr.status >= 200 && xhr.status < 300) {
                            try {
                                progressBar.style.width = '100%';
                                progressBar.setAttribute('aria-valuenow', 100);
                                progressText.textContent = 'Upload complete';

                                const data = xhr.response ?? JSON.parse(xhr.responseText);

                                setTimeout(() => {
                                    uploadCard.style.display = 'none';
                                    resultsTable.style.display = 'block';
                                    progressContainer.style.display = 'none';

                                    resultsBody.innerHTML = '';
                                    data.forEach(row => {
                                        const tr = document.createElement('tr');
                                        tr.classList.add('text-white');

                                        const totalParcels = Number.isFinite(Number(row
                                            .total_parcels)) ? Number(row
                                            .total_parcels) : 0;

                                        tr.innerHTML = `
        <td class="text-white">${row.driver_id} - ${row.full_name}</td>
        <td class="text-white">${row.invoice_total} $</td>
        <td class="text-white">${row.days_with_parcels}</td>
        <td class="text-white">${totalParcels}</td>
    `;
                                        resultsBody.appendChild(tr);
                                    });


                                    initDataTable();
                                }, 300);
                            } catch (err) {
                                console.error('Error processing JSON response:', err);
                                progressText.textContent = 'Error processing response.';
                            }
                        } else {
                            console.error('Upload failed with status:', xhr.status);
                            progressText.textContent = 'Upload failed.';
                        }
                    });

                    xhr.addEventListener('error', () => {
                        setProcessingUI(false);
                        console.error('Network error during upload.');
                        progressText.textContent = 'Network error.';
                    });

                    const csrf = document.querySelector('meta[name="csrf-token"]');
                    if (csrf) xhr.setRequestHeader('X-CSRF-TOKEN', csrf.getAttribute('content'));
                    xhr.send(formData);
                }
            }
        });
    </script>
@endpush
