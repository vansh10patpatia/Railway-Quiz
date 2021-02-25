<?php
  require_once "./lib/core.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Quiz</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="./admin/plugins/fontawesome-free/css/all.min.css">
  <!-- IonIcons -->
  <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="./admin/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
  <style>
        .close 
        {
            cursor: pointer;
            position: absolute;
            top: 50%;
            right: 0%;
            padding: 12px 16px;
            transform: translate(0%, -50%);
        }

        .close:hover {color: red;}
    
        .typewriter-text 
        {
            display: inline-block;
            overflow: hidden;
            letter-spacing: 2px;
            animation: typing 5s steps(30, end), blink .75s step-end infinite;
            white-space: nowrap;
            font-size: 30px;
            font-weight: 700;
            border-right: 4px solid orange;
            box-sizing: border-box;
        }

        @keyframes typing 
        {
            from { 
                width: 0% 
            }
            to { 
                width: 100% 
            }
        }

        @keyframes blink 
        {
            from, to { 
                border-color: transparent 
            }
            50% { 
                border-color: orange; 
            }
        }

        #dotred {
              height: 10px;
              width: 10px;
              background-color: red;
              border-radius: 50%;
              display: inline-block;
            }
        #dotgreen {
          height: 10px;
          width: 10px;
          background-color: green;
          border-radius: 50%;
          display: inline-block;
        }    
        #dotblue {
          height: 10px;
          width: 10px;
          background-color: #0066FF;
          border-radius: 50%;
          display: inline-block;
        }    
    </style>
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to to the body tag
to get the desired effect
|---------------------------------------------------------|
|LAYOUT OPTIONS | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition sidebar-mini">
    <div class="wrapper">