<?php
session_start();
include 'includes/header2.php';

if (isset($_SESSION['UID'])) {
    header('location:pages/index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN PAGE</title>
    <style>
        #title1 {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            background-color: green;
            padding: 1px;
            border-radius: 5px;
            position: fixed;
            top: 0;
            z-index: 1000;
            text-align: center;
        }

        #title1 h1 {
            margin: 0;
            padding: 20px;
            font-family: 'Algerian', sans-serif;
            font-size: 24px;
            font-weight: bold;
            color: red;
        }

        #nav-buttons {
            display: flex;
        }

        .nav-button {
            background-color: #3498db;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin: 0 10px;
        }

        .nav-button:hover {
            background-color: #2980b9;
        }

        #main-bod {
            background: url(images/1930875.jpg);
            background-repeat: no-repeat;
            background-size: cover;
            display: flex;
            align-items: center;
            height: 100vh;
            justify-content: center;
            flex-direction: column;
            margin-top: 90px;
        }

        .panels-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            width: 100%;
            max-width: 1200px;
            margin-top: 20px;
        }

        .mission-panel,
        .vision-panel,
        .custom-panel {
            width: 100%;
            max-width: 400px;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .custom-panel {
            max-width: 100%;
            margin-bottom: 40px;
        }

        #login_form {
            max-width: 100%;
        }

        #msg {
            display: flex;
            justify-content: space-around;
        }
    </style>
</head>
<body>
    <div id="title1">
        <h1>IMARISHA BARABARA PROGRAMME 2023/2024 - 2025/2026</h1>
        <div id="nav-buttons">
            <button class="nav-button" onclick="loadPage('about.php')">About</button>
            <button class="nav-button" onclick="loadPage('core_values.php')">Core Values</button>
            <button class="nav-button" onclick="loadPage('functions.php')">Functions</button>
            <button class="nav-button" onclick="loadPage('objectives.php')">Objectives</button>
        </div>
    </div>

    <div id="main-bod">
        <div class="panels-container">
            <div class="mission-panel">
                <h2>Mission:</h2>
                <p>To provide a safely designed, efficient, cost-effective transport system, develop public infrastructure, and rapid response to disaster.</p>
            </div>

            <div class="vision-panel">
                <h2>Vision:</h2>
                <p>The leading department in the delivery of safe, integrated and sustainable transport and public infrastructure</p>
            </div>

            <div class="custom-panel">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        Login
                    </div>
                    <div class="panel-body">
                        <div class="container-fluid">
                            <form class="form-horizontal" method="POST" id="login_form">
                                <!-- Placeholder login form -->
                                <div class="form-group">
                                    <label for="user" class="control-label">Username</label>
                                    <input class="form-control" id="user" name="user" type="text">
                                </div>
                                <div class="form-group">
                                    <label for="pass" class="control-label">Password</label>
                                    <input type="password" name="pass" id="pass" class="form-control">
                                </div>
                                <div class="form-group" id="msg">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-info">Login</button>
                                        <a href="#" class="btn btn-success">Register</a>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="alert alert-success" id="correct"> Successfully Log in!</div>
                                        <div class="alert alert-danger" id="error"> Error Log in </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        jQuery(document).ready(function(){
            $("#correct").hide();
            $("#error").hide();
            $("#login_form").submit(function(e){
                e.preventDefault();
                var formData = $("#login_form").serialize();
                $.ajax({
                    type: "POST",
                    url: "includes/login.php",
                    data: formData,
                    success: function(response){
                        if(response.trim() == 'true') {
                            $('#error').hide();
                            $("#correct").slideDown();
                            var delay = 2000;
                            setTimeout(function(){ window.location = 'pages/index.php?page=home'; }, delay);  
                        } else {
                            $('#error').slideDown();    
                            var delay = 2000;
                            setTimeout(function(){ $('#error').slideUp(); }, delay);  
                        }
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        $('#error').slideDown();
                        var delay = 2000;
                        setTimeout(function(){ $('#error').slideUp(); }, delay);  
                        console.log("AJAX Error:", errorThrown);
                    }
                });
                return false;
            });
        });

        function loadPage(page) {
            // You can customize this function to load the respective pages dynamically.
            // For now, it's just a placeholder.
            alert('Loading ' + page);
        }
    </script>
</body>
</html>
