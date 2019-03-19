<?php
    //Input File
    $myfile = fopen("./includes/users.txt", "r") or die("Unable to open file!");
        
    while(!feof($myfile)) 
    {
        $login = explode("||>><<||",fgets($myfile));
    }
    fclose($myfile);
    //Break down the values of each data into username and passoword
    $allValues=[];
    foreach($login as $values)
    {
        if(sizeof($allValues) == null)
        {
            $allValues = explode(",",$values);
        }
        else
        {
            $allValues = array_merge($allValues,explode(",",$values));
        }    
    }
    //Create an associative array
    $keyValuePair[$allValues[0]] = $allValues[1];
    $keyValuePair[$allValues[2]] = $allValues[3];
    $keyValuePair[$allValues[4]] = $allValues[5];
    $keyValuePair[$allValues[6]] = $allValues[7];
?>

<?php
    
    $ecvalues = 0;
    //Submission Handling
    $validusername = 0;
    $validpassword = 0;
    $username;
    $password;
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/style.css">
    <title>Insecure</title>
</head>
<body>
    <?php
        if($_SERVER['REQUEST_METHOD']!='POST')
        {
            echo '<div class="loginbox">';
            echo '<img src="./img/avatar.png" class="avatar" alt="">';
                echo '<h1>Login Here</h1>';
                echo '<form action="index.php" method="POST">';
                    echo '<p>Username</p>';
                    echo '<input type="text" name="userName" placeholder="Enter Username here">';
                    echo '<p>Password</p>';
                    echo '<input type="password" name="passWord" placeholder="Enter Password">';
                    echo '<input type="submit" name="submitBtn" value="Login">';
                    echo '<input type="reset" name="resetBtn" value="Reset">';
                echo '</form>';
            echo '</div>';
        }
        else
        {
            if(isset($_POST['userName']))
            {
                $username = $_POST['userName'];
                if(array_key_exists($username,$keyValuePair))
                {
                    $validusername = $username;
                    //Check Password
                    if(isset($_POST['passWord']))
                    {
                        $password = $_POST['passWord'];
                        if((array_search($password,$keyValuePair))==$validusername)
                        {
                            $validpassword = $password;
                        }
                        else
                        {
                            $ecvalues +=2;
                        }
                    }
                    else
                    {
                        $ecvalues +=2;
                    }
                }
                else
                {
                    $ecvalues +=1;
                }
            }
            else
            {
                $ecvalues += 1;
            }
        }
        if($ecvalues == 0 && $validusername && $validpassword)
        {
            echo '<div class="loginbox">';
                echo '<p id="granted">';
                    echo("Access Granted");
                echo '</p>';
            echo '</div>';
        }
    ?>
    <?php
    if ($ecvalues != 0)
    {
        echo '<div id="alert">';
            switch($ecvalues)
            {
                case 2: echo '<p>Please enter a valid password</p>';break;
                case 1: echo '<p>Please enter a valid Username</p>';break;
            }
        echo '</div>';
        echo '<div class="loginbox">';
            echo '<img src="./img/avatar.png" class="avatar" alt="">';
                echo '<h1>Login Here</h1>';
                echo '<form action="index.php" method="POST">';
                    echo '<p>Username</p>';
                    echo '<input type="text" name="userName" placeholder="Enter Username here">';
                    echo '<p>Password</p>';
                    echo '<input type="password" name="passWord" placeholder="Enter Password">';
                    echo '<input type="submit" name="submitBtn" value="Login">';
                    echo '<input type="reset" name="resetBtn" value="Reset">';
                echo '</form>';
            echo '</div>';
    }
    ?>
</body>
</html>

