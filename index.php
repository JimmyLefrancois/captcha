<?php
    require __DIR__ . '/captcha.php';
    $captcha = new Captcha;
    $image   = $captcha->getCaptcha();
    $string  = $captcha->getString();
 ?>
<html>
<head>
    <meta charset="UTF-8">
    <title>CAPTCHA</title>
</head>
<body>
<img src="<?php echo htmlspecialchars($image) ?> " alt="">
</body>
</html>
