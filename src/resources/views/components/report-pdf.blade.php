<html>

<head>
    <meta http-equiv="Content-Language" content="th" />
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <!-- Bootstrap 3.x only : DOMPDF support float, not flexbox -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <!-- thai font -->
    <link href="https://fonts.googleapis.com/css2?family=Sarabun" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Sarabun&display=swap" rel="stylesheet">

    <style>
        @font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: normal;
            src: url("{{ asset('fonts/THSarabuNew.ttf') }}") format('truetype');
        }

        @font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: bold;
            src: url("{{ asset('fonts/THSarabuNew Bold.ttf') }}") format('truetype');
        }

        @font-face {
            font-family: 'THSarabunNew';
            font-style: italic;
            font-weight: normal;
            src: url("{{ asset('fonts/THSarabuNew italic.ttf') }}") format('truetype');
        }

        @font-face {
            font-family: 'THSarabunNew';
            font-style: italic;
            font-weight: bold;
            src: url("{{ asset('fonts/THSarabuNew Bolditalic.ttf') }}") format('truetype');
        }
        .head {
            font-size: 20px;
        }
       
        .cen {
            margin-left: auto;
            margin-right: auto;
            width: 90%;
        }
        .result {
            margin-top: 20px;
            margin-left: auto;
            
            width: 50%;
        }
        td,tr {
            border: 1px solid black;
            
        }
        .b {
            border: 1px solid;
            width: 120px;
        }
        #namereport {
            font-size: 20px;
            text-align: center;
        }
        

        body {
            font-family: 'Sarabun', sans-serif;


        }
        .center {
            align-content: center;
        }
    </style>
</head>


{{ $slot }}


</html>
