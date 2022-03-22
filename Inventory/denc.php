<!DOCTYPE html>
<html>

<body>
    <h1> Encryption </h1>
    <form method="GET"> <input type="text" name="enc">
        <input type="submit" name="encrypt" value="encrypt_string" maxlength="10000">
    </form>


    <?php
    if (isset($_GET['encrypt'])) {
        $str = $_GET['enc'];
        echo "<h1>Encrypted text:- " . md5($str) .  "</h1>";
    }

    ?>

    <h1> Decryption </h1>

    <form method="GET"> <input type="text" name="dec">
        <input type="submit" name="decrypt" value="decrypt_string" maxlength="10000">
    </form>

    <?php
    if (isset($_GET['decrypt'])) {
        $str2 = $_GET['dec'];
        $response = file_get_contents("https://www.nitrxgen.net/md5db/" . $str2);
        echo "<h1>Decrypted string is: " . $response . "</h1>";
    }
    $date1 = new DateTime('2022-03-19 00:00:00');
    $date2 = new DateTime('now');
    $interval = $date1->diff($date2);
    $int_date = abs($interval->days);
    echo "interval:<br>" . $int_date;

    ?>
</body>

</html>