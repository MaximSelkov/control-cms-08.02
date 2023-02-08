<?php
        printf('<div id="content">
                        <h2>
                        <a href="#" rel="bookmark" title="Регистрация">Регистрация</a>
                        </h2>   
                        <form enctype="multipart/form-data" action="" method="POST">
                        <p>Имя:<br />
                        <input type="text" name="name">
                        </p>
                        <p>Логин:<br />
                        <input type="text" name="login">
                        </p>
                        <p>Пароль:<br />
                        <input type="password" name="password">
                        </p>
                        <p><input type="submit" name="button" value="Сохранить"  style="margin-bottom:120px;"></p></form>
                                </div>
                                    <div class="clear"></div>
                                        <div id="browse">
                                            <h2 class="subhead">&nbsp;</h2>
                                        </div>');

            $id_user;
            @$name = $_POST['name'];
            @$login = $_POST['login'];
            @$password = $_POST['password'];
            @$role = 'user';
            $conn = new mysqli("localhost", "root", "", "kontr_php_mysql");
            if($conn->connect_error){
                die("Ошибка: " . $conn->connect_error);
            }
            $sql = "INSERT INTO user (name, login, password, role) VALUES ('$name', '$login','$password', '$role')";
            if($conn->query($sql)){
                echo "Данные успешно добавлены";
            } else{
                echo "Ошибка: " . $conn->error;
            }
            $conn->close();
?>
