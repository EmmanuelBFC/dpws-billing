<div>
    <div wire:ignore x-data class="col-lg-12"  
    x-init="() => {
        const post = FilePond.create($refs.input);
        post.setOptions({
            allowMultiple: {{ $attributes->has('multiple') ? 'true' : 'false' }},
            server: {
                process:(fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                    @this.upload('{{ $attributes->whereStartsWith('wire:model')->first() }}', file, load, error, progress)
                },
                revert: (filename, load) => {
                    @this.removeUpload('{{ $attributes->whereStartsWith('wire:model')->first() }}', filename, load)
                },
            },
            acceptedFileTypes: {!! $attributes->get('acceptedFileTypes') ?? 'null' !!},
        });
    }">
        <div class="input-style-1" >
            <label for="email-id-column">Piece(s) jointe(s) du rapport</label>
            <input id="pic" type="file" x-ref="input" multiple />
            <span class="text-muted">Uniquement les images</span>
        </div>
    </div>
</div>