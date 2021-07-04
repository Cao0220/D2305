<?php
// error_reporting(0);
/*d2305-mainpage with 学考倒计时*/
/*使用库GDText*/

function check_str($str)
{
    $m = mb_strlen($str, 'UTF-8');
    $s = strlen($str);
    if ($s == $m) {
        return false;
    }
    return true;
}

if (date("H") == 21 && date("i") >= 0 && date("i") <= 8) {
    $img = imagecreatefromjpeg("Cherry.JPG");
    header('Content-Type: image/jpeg');
    imagejpeg($img);
    die(0);
}

require __DIR__ . './vendor/autoload.php';

use GDText\Box;
use GDText\Color;

//获取图片
$img_str = file_get_contents('http://cn.bing.com/HPImageArchive.aspx?format=js&idx=0&n=1');
$img_arr = json_decode($img_str);
$img_url = 'http://cn.bing.com' . $img_arr->{"images"}[0]->{"urlbase"} . '_' . "1080" . 'x' . "1920" . '.jpg';
$img = imagecreatefromjpeg($img_url);
$sign1 = imagecreatefrompng('D2305.png');
$sign2 = imagecreatefrompng('sign.png');
$img2 = imagecreatefrompng('rili.png');

//获取文字
$word_str = file_get_contents("https://v1.hitokoto.cn/");
$word_arr = json_decode($word_str);
$word = $word_arr->{"hitokoto"};
$word_uuid = $word_arr->{"uuid"};

/*
$type = $word_arr->{"type"};
if ($type == "i")
{
    $word_from_who = "\n——" . $word_arr->{"from_who"};
    $word_from = "《" . $word_arr->{"from"} . "》";
}
*/
$font = realpath('XINGKXDXWZ.TTF');
// $word = "一二三四五六七八九十，一二三四五六七八九十。\n \n一二三四五六七八九十，一二三四五六七八九十。" ;
// $word = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Cumque fugiat ea sunt.";

//将文字写入日志
$time = date('Y-m-d(l) H:i:s');
$day = date('y-m-d');
$myfile = fopen("word/" . $day . ".txt", "a");
fwrite($myfile, "==" . $time . "==\n" . "####################################\n" . "# " . $word . "\n# " . $word_uuid . "\n\n");
fclose($myfile);

//图像处理
imagecopy($img, $sign1, 405, 120, 0, 0, 270, 250);
imagecopy($img, $sign2, 415, 1875, 0, 0, 250, 45);
imagecopy($img, $img2, 284, 1200, 0, 0, 512, 660);

//文字写入
$box = new Box($img);

//显示的文字
// $text = "A class drawing multiline and aligned text on pictures";
$box->setFontFace($font);
$box->setFontColor(new Color(255, 255, 255)); //字体颜色
$box->setFontSize(120); //字体大小
$box->setLineHeight(1.2); //行高

//下面为关键函数：画一个文本框：
$box->setBox(60, 480, 960, 800); //文本框起始点（x,y），长宽
//第一个参数设置水平：靠左-left，居中-center，靠右-right；第二个参数设置垂直：靠左-left，居中-center，靠右-right
$box->setTextAlign('center', 'top');
$box->draw($word, check_str($word));
// $box->draw($word . $word_from_who . $word_from, true);

$r = rand(80, 200);
$g = rand(80, 200);
$b = rand(80, 200);

$font = realpath('HYShangWeiShouShuW.ttf');
$box->setFontFace($font);
$box->setFontColor(new Color($r, $g, $b)); //字体颜色
$box->setFontSize(360); //字体大小
$box->setLineHeight(1); //行高
$box->setBox(0, 1500, 1080, 320); //文本框起始点（x,y），长宽
//第一个参数设置水平：靠左-left，居中-center，靠右-right；第二个参数设置垂直：靠左-left，居中-center，靠右-right
$word = 183 - date("z");
//$word = "加油";
$box->setTextAlign('center', 'bottom');
$box->draw($word, true);

//返回图像
header('Content-Type: image/jpeg');
imagejpeg($img);

//释放内存
imagedestroy($img);
imagedestroy($sign1);
imagedestroy($sign2);
imagedestroy($img2);
