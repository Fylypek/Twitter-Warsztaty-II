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
    
<?php 
if(!empty(Session::get('showComments'))){
//    echo $this->comment;
    $baseUrl = Router::$baseUrl;
    echo "
        <form method='POST' action='{$baseUrl}/login/sendComment'>
            <textarea name='comment' placeholder='Wpisz komentarz'></textarea>
            <input type='text' name='tweetId' value='{$this->tweetId}' hidden/>
            <input type='submit' name='send' value='Wyślij' />
        </form>
        <form method='POST' action=''>
            <input name='hidden' value='Ukryj komentarze' type='submit' />
        </form>
    ";
            
    echo "<table>";
    
        foreach($this->comments as $comment) { 
            echo "<tr>";
            echo "  <td> {$comment->getText()} </td>";
//            echo "  <td> {$tweet->author->getLogin()} </td>";
            echo "  <td> {$comment->getCreationDate()} </td>";
//            echo "  <td> "
//                    . "<form action='' method='POST'> "
//                        . "<input type='submit' value='komentuj' name='comment'/>"
//                        . "<input type='text' value='{$tweet->getId()}' name='tweetId' hidden='true'/>"
//                    . "</form>"
//                . "</td>";
            echo "</tr>";
        }
    
    echo "</table>";
            
            
}
?>