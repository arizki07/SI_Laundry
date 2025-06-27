<meta charset="utf-8">
<title>{{ $title ?? 'Indah Laundry' }} - Indah Laundry</title>
<meta name="robots" content="noindex">
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<meta name="keywords" content="{{ $keywords ?? 'Laundry, Cuci Baju, Jasa Laundry, Laundry Terdekat, Indah Laundry' }}">
<meta name="description" content="{{ $description ?? 'Indah Laundry menyediakan layanan laundry profesional, cepat, dan terpercaya untuk kebutuhan Anda.' }}">
<meta name="author" content="Epon">

{{-- Canonical URL --}}
<link rel="canonical" href="{{ url()->current() }}">

{{-- Open Graph / Facebook --}}
<meta property="og:title" content="{{ $title ?? 'Indah Laundry' }} - Indah Laundry" />
<meta property="og:description" content="{{ $description ?? 'Indah Laundry menyediakan layanan laundry profesional, cepat, dan terpercaya untuk kebutuhan Anda.' }}" />
<meta property="og:url" content="{{ url()->current() }}" />
<meta property="og:site_name" content="Indah Laundry">
<meta property="og:type" content="website" />
<meta property="og:image" content="{{ asset('assets/landing/img/favicon.png') }}" />

{{-- Twitter Card --}}
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $title ?? 'Indah Laundry' }} - Indah Laundry">
<meta name="twitter:description" content="{{ $description ?? 'Indah Laundry menyediakan layanan laundry profesional, cepat, dan terpercaya untuk kebutuhan Anda.' }}">
<meta name="twitter:image" content="{{ asset('assets/landing/img/favicon.png') }}">

<!-- Favicon -->
<link href="{{ asset('assets/landing/img/favicon.png') }}" rel="icon">

<!-- Google Web Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600;700&family=Open+Sans:wght@400;500&display=swap" rel="stylesheet">  

<!-- Icon Font Stylesheet -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

<!-- Libraries Stylesheet -->
<link href="{{ asset('assets/landing/lib/animate/animate.min.css') }}?v={{ hash('sha512', filemtime(public_path('assets/landing/lib/animate/animate.min.css'))) }}" rel="stylesheet">
<link href="{{ asset('assets/landing/lib/owlcarousel/assets/owl.carousel.min.css') }}?v={{ hash('sha512', filemtime(public_path('assets/landing/lib/owlcarousel/assets/owl.carousel.min.css'))) }}" rel="stylesheet">
<link href="{{ asset('assets/landing/lib/lightbox/css/lightbox.min.css') }}?v={{ hash('sha512', filemtime(public_path('assets/landing/lib/lightbox/css/lightbox.min.css'))) }}" rel="stylesheet">

<!-- Customized Bootstrap Stylesheet -->
<link href="{{ asset('assets/landing/css/bootstrap.min.css') }}?v={{ hash('sha512', filemtime(public_path('assets/landing/css/bootstrap.min.css'))) }}" rel="stylesheet">

<!-- Template Stylesheet -->
<link href="{{ asset('assets/landing/css/style.css') }}?v={{ hash('sha512', filemtime(public_path('assets/landing/css/style.css'))) }}" rel="stylesheet">