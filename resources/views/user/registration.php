<h1>Регестрация</h1>

<?php if (isset($errors) && is_array($errors)) : ?>
    <ul>
        <?php  foreach ($errors as $error) : ?>
            <li><?= $error ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<form action="" method="POST">
    <table>
        <tbody>
            <tr>
                <td>email:</td>
                <td><input type="email" name="email"></td>
            </tr>
            <tr>
                <td>Пароль:</td>
                <td><input type="password" name="password"></td>
            </tr>
            <tr>
                <td>
                    <input type="submit" name="submit" value="Регестрация">
                </td>
            </tr>
        </tbody>
    </table>
</form>
