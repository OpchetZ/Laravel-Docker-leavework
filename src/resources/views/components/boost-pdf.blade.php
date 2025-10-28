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

        body {
            font-family: 'Sarabun', sans-serif;


        }

        /* table {
            font-family: 'THSarabunNew';
            border-collapse: collapse;
            
        }
        td,th{
            border: 1px solid;
        } */
         /* span {
            display: inline-block;
         } */
         .dis {
            display: inline;
            
         }
         .dissign {
            display: inline;
            position: absolute;
            top:50px;
            left: 70px;
            font-size: 20px
         }.dissignn {
            display: inline;
            position: absolute;
            top:45px;
            left: 50px;
            font-size: 20px
         }
         .dis1 {
            display: inline;
            margin-left: 4em;
         }
         .dissign1 {
            display: inline;
            
         }
         .dissign2 {
            display: inline;
            margin-left: 20px;
         }
         .dis2 {
            display: inline;
            position: absolute;
            left: 400px;
         }
         .dis3 {
            display: inline;
            position: absolute;
            left: 470px;
         }
        .b {
            border: 1px solid;
            width: 60px;
        }

        .a {
            border: 1px solid;

        }
        .dot {
            position: absolute;
            left: 450px;
            top: 157px;
        }
        .dot2 {
            position: absolute;
            right: 303px;
            top: 157px;
        }
        .dot3 {
            position: absolute;
            left: 450px;
            top: 148px;
        }
        .dot4 {
            position: absolute;
            right: 303px;
            top: 148px;
        }
        .posi {
            display: inline;
            position: absolute;
            left: -15px;
        }
        .dondelete1 {
            display: inline;
            position: absolute;
            left: 90px;
        }

        /* .col-xs-6 {
            border: 1px solid;
            
        } */
        /* #posi {
            position: absolute;
            right: 75px;
        }

        #nam {
            position: relative;
            right: -45px;
        } */
        #ttab {
            margin-left: 2em;
        }
        #tab2 {
            margin-left: 2em;
            margin-right: 3em;
        }
        .tab2 {
            margin-left: 3em;
            margin-right: 5em;
        }
        .tab {
            margin-left: 7em;
            margin-right: 4em;
        }
        #tab{
            margin-right: 1em;
        }
        .vacadatestart {
            position: absolute;
            left: 260px;
            top: 245px;
        }
        .vacadateend {
            position: absolute;
            left: 465px;
            top: 245px;
        }
        .startdate {
            position: absolute;
            left: 170px;
            top: 230px;
        }
        .enddate {
            position: absolute;
            left: 300px;
            top: 230px;
        }
        .approvesick{
            position: absolute;
            bottom: 365px;
            right: 140px;
        }
        .approveva{
            position: absolute;
            bottom: 380px;
            right: 140px;
        }
    </style>
</head>


{{ $slot }}


</html>
