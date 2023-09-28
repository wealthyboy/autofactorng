<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>{{ isset($page_title) ? $page_title .' |  '.config('app.name') :  $system_settings->meta_title  }}</title>

	<meta name="description" content="{{ isset($page_meta_description) ? $page_meta_description : $system_settings->meta_description }}">
	<meta name="keywords" content="{{ isset($meta_tag_keywords) ? $meta_tag_keywords : $system_settings->meta_tag_keywords }}" />
	<link rel="canonical" href="{{ Config('app.url') }}">
	<meta name="author" content="AuofactorNG">

	<link rel="stylesheet" preload href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

	<!-- Favicon -->
	<link rel="icon" type="image/x-icon" href="/images/favicon_io/favicon-32x32.png">
	<link rel="shortcut icon" type="image/x-icon" href="/images/favicon_io/favicon.ico">
	<link rel="icon" href="/images/favicon_io/favicon.ico" type="image/x-icon">
	<link rel="apple-touch-icon" href="/images/favicon_io/favicon-96x96.png">
	<!-- Main CSS File -->

	<link rel="stylesheet" href="/css/app.css?id={{ rand(1,2000)}}">



	<meta property="og:site_name" content="Autofactorng Co">
	<meta property="og:url" content="https://autofactorng.com/">
	<meta property="og:title" content=" autofactorng">
	<meta property="og:type" content="website">
	<meta property="og:description" content="{{ isset($page_meta_description) ? $page_meta_description : $system_settings->meta_description }}">
	<meta property="og:image:alt" content="">
	<meta name="twitter:site" content="@autofactorng">
	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:title" content="{{ isset($page_meta_description) ? $page_meta_description : $system_settings->meta_description }}">
	<meta name="twitter:description" content="{{ isset($page_meta_description) ? $page_meta_description : $system_settings->meta_description }}">

	<!-- Google tag (gtag.js) -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-BZEG8EJ1VC"></script>
	<script>
		window.dataLayer = window.dataLayer || [];

		function gtag() {
			dataLayer.push(arguments);
		}
		gtag('js', new Date());
		gtag('config', 'G-BZEG8EJ1VC');
	</script>


</head>


<body>

</html>