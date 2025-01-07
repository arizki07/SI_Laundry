<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>{{ !empty($judul) ? $judul : '' }} - INDAH LAUNDRY (Stand Alone).</title>
    <link href="{{ asset('assets/landing/img/favicon.png') }}" rel="icon">
    <!-- CSS files -->
    <link href="{{ asset('assets/dist/css/tabler.min.css') }}?v={{ hash('sha512', filemtime(public_path('assets/dist/css/tabler.min.css'))) }}" rel="stylesheet" />
    <link href="{{ asset('assets/dist/css/tabler-flags.min.css') }}?v={{ hash('sha512', filemtime(public_path('assets/dist/css/tabler-flags.min.css'))) }}" rel="stylesheet" />
    <link href="{{ asset('assets/dist/css/tabler-payments.min.css') }}?v={{ hash('sha512', filemtime(public_path('assets/dist/css/tabler-payments.min.css'))) }}" rel="stylesheet" />
    <link href="{{ asset('assets/dist/css/tabler-vendors.min.css') }}?v={{ hash('sha512', filemtime(public_path('assets/dist/css/tabler-vendors.min.css'))) }}" rel="stylesheet" />
    <link href="{{ asset('assets/dist/css/demo.min.css') }}?v={{ hash('sha512', filemtime(public_path('assets/dist/css/demo.min.css'))) }}" rel="stylesheet" />
    <link href="{{ asset('assets/dist/css/custom.css') }}?v={{ hash('sha512', filemtime(public_path('assets/dist/css/custom.css'))) }}" rel="stylesheet" />
    <link href="{{ asset('assets/extentions/fontawesome/css/all.min.css') }}?v={{ hash('sha512', filemtime(public_path('assets/extentions/fontawesome/css/all.min.css'))) }}" rel="stylesheet">
    <link href="{{ asset('assets/extentions/select2/css/select2.css') }}?v={{ hash('sha512', filemtime(public_path('assets/extentions/select2/css/select2.css'))) }}" rel="stylesheet">
    <link href="{{ asset('assets/extentions/datatables/Select-1.6.0/css/select.bulma.css') }}?v={{ hash('sha512', filemtime(public_path('assets/extentions/datatables/Select-1.6.0/css/select.bulma.css'))) }}" rel="stylesheet">
    <link href="{{ asset('assets/extentions/placeholder/placeholder-loading.min.css') }}?v={{ hash('sha512', filemtime(public_path('assets/extentions/placeholder/placeholder-loading.min.css'))) }}" rel="stylesheet">
    <link href="{{ asset('assets/extentions/richtext/richtext.min.css') }}?v={{ hash('sha512', filemtime(public_path('assets/extentions/richtext/richtext.min.css'))) }}" rel="stylesheet">

    {{-- Datatables --}}
    <link href="{{ asset('assets/extentions/datatables/DataTables-1.13.4/css/dataTables.bootstrap5.css') }}?v={{ hash('sha512', filemtime(public_path('assets/extentions/datatables/DataTables-1.13.4/css/dataTables.bootstrap5.css'))) }}"
    rel="stylesheet">
    <link href="{{ asset('assets/extentions/datatables/Buttons-2.3.4/css/buttons.bootstrap5.min.css') }}?v={{ hash('sha512', filemtime(public_path('assets/extentions/datatables/Buttons-2.3.4/css/buttons.bootstrap5.min.css'))) }}" rel="stylesheet">
    <link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css"
     rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="http://keith-wood.name/css/jquery.signature.css">
    <link href="{{ asset('assets/extentions/xeditable/jquery-editable.css') }}?v={{ hash('sha512', filemtime(public_path('assets/extentions/xeditable/jquery-editable.css'))) }}" rel="stylesheet" />

    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }
    </style>
</head>
