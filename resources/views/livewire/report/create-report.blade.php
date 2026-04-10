@push('styles')
    <link href="{{ asset('assets/css/filepond.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/filepond-plugin-image-preview.css') }}" rel="stylesheet" />
@endpush
<div>
    <div class="form-elements-wrapper">

        @if ($shift_22h)
            <div class="row">
                <div class="col-lg-2 mt-4">
                    <label for="shift">Shift de 22h30-06h30</label>
                </div>
                <div class="col-lg-2">
                    <div class="input-style-1">
                        <label>De:</label>
                        <input type="time" wire:model="startHour" />
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="input-style-1">
                        <label>A:</label>
                        <input type="time" wire:model="endHour" />
                    </div>
                </div>
                <div class="col-lg-2 mt-5">
                    <button wire:click="shift22h" class="btn btn-primary me-1 mb-1">Chercher</button>
                </div>
            </div>
        @endif
        <div class="card-style">
            <div class="row">
                <div class="col-lg-6">
                    <div class="input-style-1">
                        <label>Opérateur de pesée 1</label>
                        <input type="text" wire:model.defer="operator_name_one" />
                    </div>

                </div>
                <div class="col-lg-6">
                    <div class="input-style-1">
                        <label>Opérateur de pesée 2</label>
                        <input wire:model.defer="operator_name_two" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="input-style-1">
                        <label>Nom HSE 1</label>
                        <input type="text" wire:model.defer="operator_hse_one" />
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="input-style-1">
                        <label>Nom HSE 2</label>
                        <input type="text" wire:model.defer="operator_hse_two" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="input-style-1">
                        <label>Commentaire incident</label>
                        <textarea wire:model.defer="disciplinary_comment" rows="3"></textarea>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="input-style-1">
                        <label>Commentaire Discipline</label>
                        <textarea wire:model.defer="incidental_comment" rows="3"></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="input-style-1">
                        <label>Commentaire production</label>
                        <textarea wire:model.defer="production_comment" rows="1"></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="input-style-1">
                        <label>Nombre de factures cash</label>
                        <input type="text" disabled wire:model="number_cash_invoices" />
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="input-style-1">
                        <label>Montant total à verser</label>
                        <input type="text" disabled wire:model.defer="amount_pay" />
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="input-style-1">
                        <label>Nombre de factures à facturer</label>
                        <input type="text" disabled wire:model="number_invoice_to_be_billed" />
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-lg-6">
                <div class="card-style">
                    <h6 class="mb-25"> Pesées complètes</h6>
                    <div class="input-style-1">
                        <label>Total pesée complète</label>
                        <input type="number" min="0" wire:model.defer="total_complete_weighing" />
                    </div>
                    <div class="input-style-1">
                        <label>Nombre de pesées complètes payés cash</label>
                        <input type="number" min="0" wire:model.defer="total_complete_weighing_cash" />
                    </div>
                    <div class="input-style-1">
                        <label>Nombre de pesées complètes à facturer (non payés)</label>
                        <input type="number" min="0" wire:model.defer="total_complete_weighing_invoiced" />
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card-style">
                    <h6 class="mb-25"> Pesées incomplètes</h6>
                    <div class="input-style-1">
                        <label>Total pesée incomplète</label>
                        <input type="number" min="0" wire:model.defer="total_incomplete_weighing" />
                    </div>
                    <div class="input-style-1">
                        <label>Nombre de pesées incomplètes payés cash</label>
                        <input type="number" min="0" wire:model.defer="total_incomplete_weighing_cash" />
                    </div>
                    <div class="input-style-1">
                        <label>Nombre de pesées incomplètes à facturer (non payés)</label>
                        <input type="number" min="0" wire:model.defer="total_incomplete_weighing_invoiced" />
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 mt-3">
            <div class="card-style">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="input-style-1">
                            <label>Nombre total de pesées type 1</label>
                            <input disabled wire:model.defer="total_number_type_1_weighings" />
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="input-style-1">
                            <label>Nombre total de pesées type 2</label>
                            <input disabled wire:model.defer="total_number_type_2_weighings" />
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="input-style-1">
                            <label>Nombre total de pesées</label>
                            <input disabled wire:model.defer="total_number_weighings" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- pices jointes du rapport --}}
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="card-style">
                    <x-forms.filepond wire:model="images" acceptedFileTypes="['image/*']" multiple />
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="card-style">
                    <h6 class="mb-25"> Corps de l'email</h6>
                    <div class="col-lg-12">
                        <div class="input-style-1">
                            <label>Objet de l'email</label>
                            <input wire:model.defer="subject" />
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="input-style-1">
                            <label>Ajouter un message</label>
                            <textarea wire:model.defer="body" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <x-forms.filepond-attachement wire:model="attachments" multiple />
                    </div>
                </div>
            </div>
        </div>
        {{-- email --}}


        @if (session()->has('success'))
            <div id="alert-message" class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                <strong>Enregistré avec succès</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="col-12 d-flex justify-content-end mt-3">
            <button wire:click="save" wire:loading.attr="disabled" class="btn btn-primary me-1 mb-1">
                <div class="spinner-border" wire:loading role="status" wire:target="save"></div>
                <div wire:loading.remove wire:target="save"> Enregistrer </div>
            </button>
            <button type="reset" class="main-btn danger-btn btn-hover me-1 mb-1">Annuler</button>
        </div>
    </div>
</div>

@push('scripts')
    <script src="{{ asset('assets/js/filepond-plugin-image-preview.js') }}"></script>
    <script src="{{ asset('assets/js/filepond.js') }}"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
    <script>
        // Register the plugin
        FilePond.registerPlugin(FilePondPluginImagePreview);
        FilePond.registerPlugin(FilePondPluginFileValidateType);
        FilePond.setOptions({
            labelIdle: 'Glissez-déposez vos fichiers ou <span class="filepond--label-action"> parcourir </span>',
            labelFileProcessing: 'Téléchargement',
            labelFileProcessingComplete: 'Téléchargement terminé',
            labelTapToUndo: 'appuyez sur la croix pour annuler',
            labelFileTypeNotAllowed: 'Fichier de type non valide',
            fileValidateTypeLabelExpectedTypes: 'Sélectionner une image de type {allButLastType} ou {lastType}',
            labelTapToCancel: 'Appuyer sur le loader pour annuler',
        });


        document.addEventListener('filepont', () => {
            const pond = FilePond.create(
                document.getElementById('pic'));
            pond.removeFiles({
                revert: true
            });
        })
        document.addEventListener('filepont', () => {
            const pond = FilePond.create(
                document.getElementById('attachment'));
            pond.removeFiles({
                revert: true
            });
        })

        document.addEventListener('closeAlert', () => {
            setTimeout(() => {
                let alertNode = document.querySelector('#alert-message');
                let alert = new bootstrap.Alert(alertNode);
                alert.close()
            }, 6000)
        })
    </script>
@endpush
