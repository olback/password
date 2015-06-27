<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" type="image/vnd.microsoft.icon"  href="./resources/media/32.ico"/>
        <link href="./css/bootstrap.min.css" rel="stylesheet">
        <link href="./css/cover.css" rel="stylesheet">
        <script src="./js/bootstrap.file-input.js"></script>
        <title>Carl Passwords</title>
    </head>
    <body>
        <a href="https://github.com/Carlgo11/password"><img class="github" style="float:right;position: absolute;top:0;right: 0;" src="./resources/media/GitHub-Mark-64px.png" alt="github"></a>
        <h1 style="margin-left: 50px">Need a Carl Password?</h1>
        <?php

        function generateStrongPassword() {

            if (isset($_POST['length'])) {
                $length = $_POST['length'];
            } else {
                $length = 20;
            }
            $sets = array();
            if (isset($_POST['l'])) {
                $sets[] = 'abcdefghjkmnpqrstuvwxyz';
            }
            if (isset($_POST['u'])) {
                $sets[] = 'ABCDEFGHJKMNPQRSTUVWXYZ';
            }
            if (isset($_POST['d'])) {
                $sets[] = '123456789';
            }
            if (isset($_POST['s'])) {
                $sets[] = '!@#$%&*?{[()]}|<>^\'\\/~-_^+.,:;=~';
            }
            if (isset($_POST['sp'])) {
                $sets[] = ' ';
            }

            $all = '';
            $password = '';
            foreach ($sets as $set) {
                $password .= $set[array_rand(str_split($set))];
                $all .= $set;
            }

            $all = str_split($all);
            for ($i = 0; $i < $length - count($sets); $i++) {
                $password .= $all[array_rand($all)];
            }

            $password = str_shuffle($password);
            return $password;
        }

        function value($id) {
            if (isset($_POST[$id])) {
                return "checked";
            } else {
                return "";
            }
            echo $_POST[$id];
        }
        ?>

        <div class="site-wrapper">
            <div class="site-wrapper-inner">
                <div class="cover-container">
                    <div style="float: left">
                        <form role="form" action="" method="POST">

                            <label><input type="checkbox" name="l" <?php echo value('l'); ?>>Lowercase letters</label><br>
                            <label><input type="checkbox" name="u" <?php echo value('u'); ?>>Uppercase letters</label><br>
                            <label><input type="checkbox" name="d" <?php echo value('d'); ?>>Numbers</label><br>
                            <label><input type="checkbox" name="s" <?php echo value('s'); ?>>Special characters</label><br>
                            <label><input type="checkbox" name="sp" <?php echo value('sp'); ?>>Spaces</label><br>

                            <label>Length: <input type="number" name="length" id="length" value="
                                <?php
                                if (isset($_POST['length'])) {
                                    echo $_POST['length'];
                                } else {
                                    echo "20";
                                }
                                ?>" style="margin-top: 10p;width: 60px"></label><br>
                            <button class="btn btn-success " type="submit" name="login" style="margin-top: 5px" onclick="generateStrongPassword()">Generate</button>
                        </form>
                    </div>
                    <div style="float: end;margin-left: 200px">
                        <p>New password:</p>
                        <input type="text" value="<?php echo generateStrongPassword() ?>" style="width: max-content" >
                    </div>
                </div>
                <div id='footer' style='position: fixed; bottom: 0px;margin-left: auto;margin-right: auto;text-align: center;width: 100%'>For a better security turn on <a href="https://twofactorauth.org/">TFA</a> when available!<div style="margin-top: 40px">&copy; <?php echo date("Y"); ?> <a href="https://carlgo11.com/">Carlgo11</a></div></div>
            </div>
        </div>
    </body>
</html>