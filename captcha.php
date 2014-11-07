<?php

class Captcha
{
    protected $alphas;
    protected $shuffle;
    protected $randomString;
    protected $captcha;
    protected $string;
    protected $angle;
    protected $randomAngle;
    protected $randomLine;
    protected $randomBackground;

    function __construct() {
        $this->alphas  = array_merge(range('A', 'Z'), range('a', 'z'));
        $this->shuffle = array_rand($this->alphas, 5);
        $this->randomString  = array();
        $this->setRandomString();
    }

    function setRandomBackground() {
        $color1 = '50, 180, 120';
        $color2 = '180, 120, 50';
        $color3 = '120, 50, 180';
        $arrayColor = array($color1, $color2, $color3);
        $index      = array_rand($arrayColor);
        $this->randomBackground = $arrayColor[$index];
        $this->randomBackground = explode(", ", $this->randomBackground);
    }

    function getRandomLine($index) {
        $y1 = rand(0, 70);
        $y2 = rand(0, 70);
        $y3 = rand(0, 70);
        $this->randomLine = array($y1, $y2, $y3);
        return $this->randomLine[$index];
    }

    function setRandomString() {
        foreach ($this->shuffle as $index) {
            $this->randomString[] = $this->alphas[$index];
        }
        $this->string = implode($this->randomString);
    }

    function getRandomString() {
        return $this->randomString;
    }

    function getString() {
        return $this->string;
    }

    function setAngle() {
        $this->randomAngle = rand(-45, 45);
        return $this->randomAngle;
    }

    function getCaptcha() {
        $image = imagecreate(120,70);
        $this->setRandomBackground();
        $color = imagecolorallocate($image, $this->randomBackground[0], $this->randomBackground[1], $this->randomBackground[2]);
        $bleu  = imagecolorallocate($image, 255, 255, 255);

        $y = 0;
        while ($y <= 2) {
            imageline($image , 0 , $this->getRandomLine(0) , 140 , $this->getRandomLine(1) , $bleu );
            $y++;
        }

        $posX = 20;
        foreach ($this->shuffle as $index) {
            imagettftext ($image,'20',$this->setAngle(),$posX,'40',$bleu,__DIR__ . '/arial.ttf',$this->alphas[$index]);
            $posX += 20;
        }

        ob_start();
        imagepng($image);
        $image = ob_get_clean();
        return 'data:image/png;base64,' . base64_encode($image);
    }

}
