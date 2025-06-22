<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<title>{{ $title ?? 'Las Fresitas' }}</title>

<link rel="icon" href="/images/fresitas.jpeg" sizes="any">
<link rel="icon" href="/images/fresitas.jpeg" type="image/jpeg">
<link rel="apple-touch-icon" href="/images/fresitas.jpeg">

<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

@vite(['resources/css/app.css', 'resources/js/app.js'])
@fluxAppearance
