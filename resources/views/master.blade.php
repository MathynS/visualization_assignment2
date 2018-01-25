<html>
<head>
    <meta charset="utf-8">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/general.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <script src="/js/uStates.js"></script>
    <script src="http://d3js.org/d3.v3.min.js"></script>
    <script src="/js/areaChart.js"></script>
    <script src="/js/trendChart.js"></script>
    <script src="http://d3js.org/d3.v3.min.js"></script>

</head>
<body>
    <nav class="navbar navbar-inverse">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="#">Pollution data</a>
        </div>
        <ul class="nav navbar-nav">
          <li><a href="/map">US Map</a></li>
          <li><a href="/chart">Area chart</a></li>
        </ul>
      </div>
    </nav>

    <div id="app">
        @yield('content')
    </div>

    <script src="{!! asset('js/app.js') !!}"></script>

</body>
</html>
