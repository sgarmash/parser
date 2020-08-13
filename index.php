<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parser site</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>
    <?php 
        require_once 'app/parser.php';

        $query ="SELECT * FROM site_info";

        $link = mysqli_connect($servername, $username, $password, $dbname) or die("Ошибка " . mysqli_error($link));

        $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));

    ?>
    <div class="container-fluid">
        <?php
        
            if($result)
            {   
                echo "<table class='table table-striped' style='margin-top: 5%;'>";
                    echo "<thead>";
                        echo "<tr>";
                            echo  "<th scope='col'>Номер</th>";
                            echo  "<th scope='col'>Дата</th>";
                            echo  "<th scope='col'>Доменное имя</th>";
                            echo  "<th scope='col'>Страница сайта</th>";
                            echo  "<th scope='col'>Цена</th>";
                            echo  "<th scope='col'>Cкидка</th>";
                            echo  "<th scope='col'>Цена со скидкой</th>";
                        echo "</tr>";
                    echo "</thead>";
                    echo "<tbody>";
                    foreach ( $result as $value ) {

                        echo '<tr>';
                      
                        foreach ( $value as $key => $value ) {
                      
                          echo "<th>$value</th>";
                      
                        }
                      
                        echo '</tr>';
                      
                      }
                    echo "</tbody>";
                echo "</table>";
                mysqli_free_result($result);
            }

        ?>
    </div>
</body>
</html>
    