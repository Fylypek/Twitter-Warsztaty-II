
        
<h2>
    Wiadomości
</h2>

<form id="usersForm" action="" method="POST">
    <select name="userId">
        <option value="">Wybierz osobę</option>
        <?php 
        foreach ($this->users as $user){
            
            $selected = "";
            if($user->getId() == $this->recipientId){
                $selected = "selected";
            }
            
            echo "<option value='{$user->getId()}' $selected>";
            echo "  {$user->getLogin()}";
            echo "</option>";
        }
        ?>
    </select>
    <input type="submit" name='submitUser' value="Wybierz"/>
</form>

    <?php 
    if(!empty($this->recipientId)){
        $baseUrl = Router::$baseUrl;
        echo "  
        <form method='POST' action='{$baseUrl}/login/sendMessage'>
            <textarea name='text' placeholder='Wpisz Wiadomość'></textarea>
            <input type='text' name='recipientId' value='{$this->recipientId}' hidden/>
            <input type='submit' name='send' value='Wyślij' />
        </form>
        
        <form action='' method='POST'>
            <input type='submit' value='Więcej Wiadomości' name='moreMessages'/>
            <input type='text' value='{$this->limit}' name='limit' hidden='true'/>
        </form>


        ";
        
        echo "<div style='width: 50%'>";
        foreach($this->messages as $message){
            
            $float = "left";
            if($message->getAuthorId() != $this->recipientId){
                $float = "right";
            }
            
            echo "
            <div style='float: $float'>
                {$message->getText()} {$message->getCreationDate()}
            </div>
            <br>
            <br>


            ";
        }
        echo "</div>";
            
            
            
            
            
    }
    ?>
    


<!--<form action="" method="POST">
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
</form>-->