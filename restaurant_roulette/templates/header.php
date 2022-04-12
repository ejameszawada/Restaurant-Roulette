<head>
    <title>Restaurant Roulette</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <style type="text/css">
        .brand {
            background: #8d6e63 !important;
        }

        .brand-text {
            color: #8d6e63 !important;
        }

        .rr {
            margin-left: 15%;
        }

        .highlight {
            background: #8d6e63 !important;
        }

        .adminForm {
            max-width: 460px;
            margin: 20px auto;
            padding: 20px;
        }

        nav {
            border-bottom: 5px solid #8d6e63;
        }

        table {
            border: 2px solid black;
            table-layout: fixed;
            width: 200px;
        }

        th,
        td {
            border: 1px solid #f5f5f5;
            width: 150px;
            overflow: hidden;
        }

        #loader {
            border: 16px solid white;
            border-top: 16px solid #8d6e63;
            border-radius: 50%;
            position: relative;
            margin-right: auto;
            margin-left: auto;
            margin-top: 15%;
            display: block;
            width: 120px;
            height: 120px;
            animation: spin 2s linear infinite;
        }

        @keyframes spin {
            100% {
                transform: rotate(360deg);
            }
        }

        .animate-bottom {
            position: relative;
            -webkit-animation: animatebottom;
            -webkit-animation-duration: 1s;
            animation-name: animatebottom;
            animation-duration: 1s;
        }

        @keyframes animatebottom {
            from {
                bottom: -100px;
                opacity: 0
            }

            to {
                bottom: 0;
                opacity: 1
            }
        }

        select {
            display: block;
            width: 25%;
        }

        .checkbox-brown[type="checkbox"].filled-in:checked+span:not(.lever):after {
            border: 2px solid #8d6e63;
            background-color: #8d6e63;
        }

        .avatar {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            margin: 10px;
            background-color: white;
            border: #8d6e63 3px solid;
        }

        .restOrFF {
            position: absolute;
            top: 15px;
            right: 20px;
            font-size: medium;
        }

        ::-webkit-input-placeholder {
            color: grey;
            opacity: 75%;
        }

        :-moz-placeholder {
            color: grey;
            opacity: 75%;
        }

        ::-moz-placeholder {
            color: grey;

            opacity: 75%;
        }

        :-ms-input-placeholder {
            color: grey;
            opacity: 75%;
        }

        .searchBar {
            padding-top: 5px;
            padding-bottom: 5px;
        }
    </style>
</head>

<body class="grey lighten-4">
    <div class="navbar-fixed">
        <nav class="white z-depth-0">
            <div class="nav-wrapper">
                <a onclick="openNav()" class="sidenav-trigger brand-text"><i class="material-icons">menu</i></a>
                <div class="rr"><a href="index.php" class="brand-logo brand-text"><i class="material-icons left">restaurant</i> Restaurant Roulette</a></div>
                <ul id="nav-mobile" class="brand right hide-on-med-and-down">
                    <li><a href="index.php"><i class="material-icons left">map</i> Restaurants</a></li>
                    <li><a href="roulette.php"><i class="material-icons left">play_arrow</i> Roulette</a></li>
                    <li><a href="profile.php"><i class="material-icons left">person</i> Profile</a></li>
                    <li><a href="admin.php"><i class="material-icons left">assignment</i> Admin</a></li>
                    <li><a href="logout.php"><i class="material-icons left">exit_to_app</i> Log Out</a></li>
                </ul>
            </div>
        </nav>
    </div>