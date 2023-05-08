<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">

    <style>
        @font-face {
            font-family: "sfProBold";
            src: url("font/SFPRODISPLAYBOLD.OTF");
        }
        @font-face {
            font-family: "sfProMedium";
            src: url("font/SFPRODISPLAYMEDIUM.OTF");
        }
        *{
            font-family: "sfProBold", sans-serif;
        }
        form > div > label,
        form > div > input,
        form > div > .input-group > input{
            font-family: "sfProMedium", sans-serif !important;
        }
    </style>
</head>
<body>