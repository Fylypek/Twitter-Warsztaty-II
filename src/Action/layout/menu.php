<form action="<?php echo Router::$baseUrl ?>/login/logout" method="POST">
    <input type="submit" name="wyloguj" value="Wyloguj">
</form>
<br>
Menu:
<ul>
    <li>
        <a href="<?php echo Router::$baseUrl ?>/"> Strona główna </a>
    </li>    
    <li>
        <a href="<?php echo Router::$baseUrl ?>/login/profile"> Profil użytkownika </a>
    </li>
    <li>
        <a href="<?php echo Router::$baseUrl ?>/login/message"> Wiadomości </a>
    </li>    
</ul>