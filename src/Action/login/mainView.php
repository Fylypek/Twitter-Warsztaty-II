Tweets:

<form action="<?php echo Router::$baseUrl ?>/login/sendTwitter" method="post">
    <textarea name='text'></textarea>
    <input type="submit" value="Wyślij" name='send'/>
</form>

<form action='' method='POST'>
    <input type="submit" value="Więcej Tweetow" name='moreTweets'/>
    <input type="text" value="<?php echo $this->limit ?>" name='limit' hidden="true"/>
</form>

<div style="width: 50%; float: left;">
    <table>
    <?php 
        foreach($this->tweets as $tweet) { 
            echo "<tr>";
            echo "  <td> {$tweet->getText()} </td>";
            echo "  <td> {$tweet->author->getLogin()} </td>";
            echo "  <td> {$tweet->getCreationDate()} </td>";
            echo "  <td> "
                    . "<form action='' method='POST'> "
                        . "<input type='submit' value='komentuj' name='comment'/>"
                        . "<input type='text' value='{$tweet->getId()}' name='tweetId' hidden='true'/>"
                    . "</form>"
                . "</td>";
            echo "</tr>";
        }
    ?>
    </table>
</div>
<div style="width: 50%; float: right;">
<?php echo $this->comment ?>
</div>
<?php // die(var_dump($this->tweets)); ?>