<?php
    require __DIR__ . '/captcha.php';
    require __DIR__ . '/crypt.php';

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $crypt    = $_POST["value"];
        $captcha  = $_POST["captcha"];
        $original = decryptData($crypt);

        if ($captcha === $original) {
            echo "CAPTCHA OK";
            // CONTINUER TRAITEMENT ICI
            exit;
        }

    }

    $captcha = new Captcha;
    $image   = $captcha->getCaptcha();
    $string  = $captcha->getString();
    $crypt   = cryptData($string);

 ?>
<html>
<head>
    <meta charset="UTF-8">
    <title>CAPTCHA</title>
</head>
<body>
<img src="<?php echo htmlspecialchars($image) ?> " alt="">
<form method="post">
    <label for="captcha">Recopier le texte suivant : </label>
    <input type="text" name="captcha" id="captcha">
    <input type="hidden" name="value" value="<?php echo htmlspecialchars($crypt) ?>">
    <input type="submit" value="submit">
</form>
</body>
</html>
