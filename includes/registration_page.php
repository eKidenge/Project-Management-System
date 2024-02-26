<?php
session_start();
include 'includes/header2.php';

if(isset($_SESSION['UID'])) {
    header('location:pages/index.php');
}

?>
<style>
    #title1 {
        display: block;
        width:50%;
        height:90px;
        background-color: white;
        padding:1px;
        border-radius:5px;
        position:fixed;
        top:30%;
        z-index: 1000px;
    }
    #main-bod {
        background: url(images/1930875.jpg);
        background-repeat: no-repeat;
        background-size: cover;
        display:flex;
        height:calc(100%);
        width:calc(100%);
        align-items:center;
        justify-content:center;
        top: 0;
        margin:unset
    }
</style>

<body id="main-bod">
    <div class="col-lg-4">
        
        <div class="panel panel-info" style="">
            <div class="panel-heading">
                Registration
            </div>
            <div class="panel-body">
                <div class="container-fluid">
                    <form class="form-horizontal" method="POST" id="registration_form">
                        <div class="form-group">
                            <label for="reg_user" class="control-label">Username</label>
                            <input class="form-control" id="reg_user" name="reg_user" type="text" required>
                        </div>
                        <div class="form-group">
                            <label for="reg_pass" class="control-label">Password</label>
                            <input type="password" name="reg_pass" id="reg_pass" class="form-control" required>
                        </div>
                        <div class="form-group" id="reg_msg">
                            <div class="col-sm-8 col-sm-offset-8">
                                <button type="submit" class="btn btn-success">Register</button>
                                <a href="login_page.php" class="btn btn-info">Login</a>
                            </div>
                            <div class="col-sm-12">
                                <div class="alert alert-success" id="reg_success">Successfully registered!</div>
                                <div class="alert alert-danger" id="reg_error">Error registering</div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

<script>
    jQuery(document).ready(function(){
        $("#reg_success").hide();
        $("#reg_error").hide();
        jQuery("#registration_form").submit(function(e){
            e.preventDefault();
            var formData = jQuery(this).serialize();
            $.ajax({
                type: "POST",
                url: "includes/register.php", // Specify the path to your registration handling script
                data: formData,
                success: function(html){
                    if(html=='registered' )
                    {
                        $('#reg_error').hide();
                        $("#reg_success").slideDown();
                        var delay = 2000;
                        setTimeout(function(){ window.location = 'pages/index.php?page=home'; }, delay);  
                    } else {
                        $('#reg_success').hide();
                        $('#reg_error').slideDown();    
                        var delay = 2000;
                        setTimeout(function(){ $('#reg_error').slideUp(); }, delay);  
                    }
                }
            });
            return false;
        });
    });
</script>
