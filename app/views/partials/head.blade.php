<head>
  <meta charset="utf-8">
  <title>
  @yield('browser-title')
  </title>
  @yield('meta')
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Library CSS -->
  <link rel="stylesheet" href="/css/bs/bootstrap.min.css">
  <!-- <link rel="stylesheet" href="/css/bootstrap.min.css"> -->
  <link rel="stylesheet" href="/css/fonts/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="/css/animations.css" media="screen">
  <link rel="stylesheet" href="/css/superfish.css" media="screen">
  <link rel="stylesheet" href="/css/revolution-slider/css/settings.css" media="screen">
  <link rel="stylesheet" href="/css/prettyPhoto.css" media="screen">
  <link rel="stylesheet" href="/css/futura/stylesheet.css" media="screen">
  <link href="/css/jquery.pnotify.default.css" media="all" rel="stylesheet" type="text/css" />
  <!-- Theme CSS -->
  <link rel="stylesheet" href="/css/style.css">
  <!-- Skin -->
  <link rel="stylesheet" href="/css/colors/blue.css">
  <!-- Responsive CSS -->
  <link rel="stylesheet" href="/css/theme-responsive.css">
  <link rel="stylesheet" href="/css/custom.css">
  @if((Auth::check()) && (Auth::user()->access_level == 3) && (Auth::user()->roles->contains(3)))
  <link rel="stylesheet" href="/js/contextmenu/jquery.contextMenu.css" type="text/css" media="screen">
  <link rel="stylesheet" href="/css/datepicker.css" type="text/css" media="screen">
  @endif
  @yield('css')
  <!-- Favicons -->
  <link rel="shortcut icon" href="/favicon.ico">
  <link rel="apple-touch-icon" href="img/ico/apple-touch-icon.png">
  <link rel="apple-touch-icon" sizes="72x72" href="img/ico/apple-touch-icon-72.png">
  <link rel="apple-touch-icon" sizes="114x114" href="img/ico/apple-touch-icon-114.png">
  <link rel="apple-touch-icon" sizes="144x144" href="img/ico/apple-touch-icon-144.png">
  <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
  <!--[if lt IE 9]>
  <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
  <script src="js/respond.min.js"></script>
  <![endif]-->
  <!--[if IE]>
  <link rel="stylesheet" href="/css/ie.css">
  <![endif]-->
  @yield('js')
  <style>
  .menu ul>li>a {
	font-size:18px;
	color: #20368c;
}
</style>
</head>