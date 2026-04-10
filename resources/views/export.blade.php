@extends('layouts.app')

@section('content')
<livewire:export.export/>
@stop
@push('scripts')

    <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>

    <script>

        function html_table_to_excel(type)
        {
            var data = document.getElementById('employee_data');

            var file = XLSX.utils.table_to_book(data, {sheet: "sheet"});

            XLSX.write(file, { bookType: type, bookSST: true, type: 'base64' });

            XLSX.writeFile(file, 'export.' + type);
        }

        const export_button = document.getElementById('export_button');

        export_button.addEventListener('click', () =>  {
            html_table_to_excel('xlsx');
        });
    </script>
@endpush
