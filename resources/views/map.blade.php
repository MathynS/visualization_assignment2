<html>
<head>
    <meta charset="utf-8">
    <style>
        .state{
            fill: none;
            stroke: #a9a9a9;
            stroke-width: 1;
        }
        .state:hover{
            fill-opacity:0.5;
        }
        #tooltip {
            position: absolute;
            text-align: center;
            padding: 20px;
            margin: 10px;
            font: 12px sans-serif;
            background: lightsteelblue;
            border: 1px;
            border-radius: 2px;
            pointer-events: none;
        }
        #tooltip h4{
            margin:0;
            font-size:14px;
        }
        #tooltip{
            background:rgba(0,0,0,0.9);
            border:1px solid grey;
            border-radius:5px;
            font-size:12px;
            width:auto;
            padding:4px;
            color:white;
            opacity:0;
        }
        #tooltip table{
            table-layout:fixed;
            color: white;
        }
        #tooltip tr td{
            padding:0;
            margin:0;
        }
        #tooltip tr td:nth-child(1){
            width:50px;
        }
        #tooltip tr td:nth-child(2){
            text-align:center;
        }
        .slidecontainer {
            width: 100%; /* Width of the outside container */
        }

        /* The slider itself */
        .slider {
            -webkit-appearance: none;  /* Override default CSS styles */
            appearance: none;
            width: 100%; /* Full-width */
            height: 25px; /* Specified height */
            background: #d3d3d3; /* Grey background */
            outline: none; /* Remove outline */
            opacity: 0.7; /* Set transparency (for mouse-over effects on hover) */
            -webkit-transition: .2s; /* 0.2 seconds transition on hover */
            transition: opacity .2s;
        }

        /* Mouse-over effects */
        .slider:hover {
            opacity: 1; /* Fully shown on mouse-over */
        }

        /* The slider handle (use webkit (Chrome, Opera, Safari, Edge) and moz (Firefox) to override default look) */
        .slider::-webkit-slider-thumb {
            -webkit-appearance: none; /* Override default look */
            appearance: none;
            width: 25px; /* Set a specific slider handle width */
            height: 25px; /* Slider handle height */
            background: #4CAF50; /* Green background */
            cursor: pointer; /* Cursor on hover */
        }

        .slider::-moz-range-thumb {
            width: 25px; /* Set a specific slider handle width */
            height: 25px; /* Slider handle height */
            background: #4CAF50; /* Green background */
            cursor: pointer; /* Cursor on hover */
        }

        /* The switch - the box around the slider */
        .switch {
            vertical-align:top;
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        /* Hide default HTML checkbox */
        .switch input {display:none;}

        /* The slider */
        .checker {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .checker:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked + .checker {
            background-color: #2196F3;
        }

        input:focus + .checker {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked + .checker:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .checker.round {
            border-radius: 34px;
        }

        .checker.round:before {
            border-radius: 50%;
        }
    </style>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <script src="/js/uStates.js"></script>
    <script src="http://d3js.org/d3.v3.min.js"></script>
</head>
<body>

    <div id="app">
        <us-map></us-map>
    </div>

    <script src="{!! asset('js/app.js') !!}"></script>

</body>
</html>