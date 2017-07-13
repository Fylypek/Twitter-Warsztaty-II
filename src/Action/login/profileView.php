
        
<h2>
    Profil użytkownika
</h2>


<form action="" method="POST">
    <table>
        <tr>
            <th> Login </th>
            <td> <input type="text" required="true" name="login" value="<?php echo $this->user->getLogin(); ?>"/> </td>
        </tr>
        <tr>
            <th> Hasło </th>
            <td> <input type="password" required="true" name="password" value=""> </td>
        </tr>
        <tr>
            <th> Email </th>
            <td> <input type="email" required="true" name="email" value="<?php echo $this->user->getEmail(); ?>"/> </td>
        </tr>
    </table>
    <input type="submit" name='save' value="Zapisz"/>    
</form>