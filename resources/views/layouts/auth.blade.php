<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="recaptcha-site-key" content="{{ config('services.recaptcha.site_key') }}">


	<title>{{ isset($page_title) ? $page_title .'   '.config('app.name') :  $system_settings->meta_title  }}</title>
	<meta property="og:title" content="{{ isset($seo['page_title']) ? $seo['page_title'] : optional($system_settings)->meta_title }}">
	<meta name="description" content="{{ isset($seo['page_meta_description'])  ? $seo['page_meta_description'] : optional($system_settings)->meta_description }}">
	<meta name="keywords" content="" />
	<link rel="canonical" href="{{ Config('app.url') }}">
	<meta name="author" content="Autofactorng">

	<link rel="preload" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" as="style" onload="this.onload=null;this.rel='stylesheet'">

	<!-- Favicon -->
	<link rel="icon" type="image/x-icon" href="/images/favicon_io/favicon-32x32.png">
	<link rel="shortcut icon" type="image/x-icon" href="/images/favicon_io/favicon.ico">
	<link rel="icon" href="/images/favicon_io/favicon.ico" type="image/x-icon">
	<link rel="apple-touch-icon" href="/images/favicon_io/favicon-96x96.png">
	<!-- Main CSS File -->

	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

	<!-- Favicon -->
	<!-- <link rel="icon" type="image/x-icon" href="assets/images/icons/favicon.png"> -->
	<!-- Main CSS File -->
	<link rel="stylesheet" type="text/css" href="/vendor/fontawesome-free/css/all.min.css">

	<link rel="stylesheet" href="/css/app.css">
	<style>
		.cursor-pointer {
			cursor: pointer;
		}
	</style>
</head>

<script type="application/ld+json" class="yoast-schema-graph">
	{
		"@context": "https://schema.org",
		"@graph": [{
			"@type": "WebPage",
			"@id": "https://mypartsng.com/",
			"url": "https://mypartsng.com/",
			"name": "Auto Parts Online Shop in Nigeria - MyParts Nigeria",
			"isPartOf": {
				"@id": "https://mypartsng.com/#website"
			},
			"about": {
				"@id": "https://mypartsng.com/#organization"
			},
			"primaryImageOfPage": {
				"@id": "https://mypartsng.com/#primaryimage"
			},
			"image": {
				"@id": "https://mypartsng.com/#primaryimage"
			},
			"thumbnailUrl": "https://mypartsng.com/media/118768995_2753153064932520_4689473077351712330_o.jpg",
			"datePublished": "2019-03-25T12:07:23+00:00",
			"dateModified": "2022-08-08T09:28:42+00:00",
			"description": "We provide you with high quality Auto Parts for various vehicles and help you save money by offering you the lowest rates you can find.",
			"breadcrumb": {
				"@id": "https://mypartsng.com/#breadcrumb"
			},
			"inLanguage": "en-US",
			"potentialAction": [{
				"@type": "ReadAction",
				"target": ["https://mypartsng.com/"]
			}]
		}, {
			"@type": "ImageObject",
			"inLanguage": "en-US",
			"@id": "https://mypartsng.com/#primaryimage",
			"url": "https://mypartsng.com/media/118768995_2753153064932520_4689473077351712330_o.jpg",
			"contentUrl": "https://mypartsng.com/media/118768995_2753153064932520_4689473077351712330_o.jpg",
			"width": 720,
			"height": 700,
			"caption": "Auto Parts MyParts Nigeria"
		}, {
			"@type": "BreadcrumbList",
			"@id": "https://mypartsng.com/#breadcrumb",
			"itemListElement": [{
				"@type": "ListItem",
				"position": 1,
				"name": "Home"
			}]
		}, {
			"@type": "WebSite",
			"@id": "https://mypartsng.com/#website",
			"url": "https://mypartsng.com/",
			"name": "MyParts Nigeria",
			"description": "One Stop Auto Parts Website in Nigeria",
			"publisher": {
				"@id": "https://mypartsng.com/#organization"
			},
			"potentialAction": [{
				"@type": "SearchAction",
				"target": {
					"@type": "EntryPoint",
					"urlTemplate": "https://mypartsng.com/?s={search_term_string}"
				},
				"query-input": "required name=search_term_string"
			}],
			"inLanguage": "en-US"
		}, {
			"@type": "Organization",
			"@id": "https://mypartsng.com/#organization",
			"name": "MyParts Nigeria",
			"url": "https://mypartsng.com/",
			"logo": {
				"@type": "ImageObject",
				"inLanguage": "en-US",
				"@id": "https://mypartsng.com/#/schema/logo/image/",
				"url": "https://mypartsng.com/media/2021/03/My_Parts_logo-100.png",
				"contentUrl": "https://mypartsng.com/media/2021/03/My_Parts_logo-100.png",
				"width": 327,
				"height": 100,
				"caption": "MyParts Nigeria"
			},
			"image": {
				"@id": "https://mypartsng.com/#/schema/logo/image/"
			},
			"sameAs": ["https://www.facebook.com/myautoparts", "https://twitter.com/Mypartsng", "https://www.instagram.com/mypartsnigeria/"]
		}]
	}
</script>


<body>
	<div id="app" class="page-wrapper">
		@yield('content')
	</div>
	<!-- End .newsletter-popup -->

	<a id="scroll-top" href="#top" title="Top" role="button"><i class="icon-angle-up"></i></a>

	<!-- Plugins JS File -->
	<script src="/js/jquery.min.js"></script>
	<script src="/js/app.js?id={{ rand(1,2000)}}"></script>

	@yield('page-scripts')


</body>

</html>