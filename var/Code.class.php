<?php
/**
 *
 * @author YanYuXing URL:sbnb.net QQ:43368896
 * @name  验证码类
 * @version 1.0, 13/4/17
 *
 */
class Code {

    private $width; // 验证码显示宽度
    private $height; // 验证码显示高度
    private $charNum; // 验证码字符数
    private $image; // 图像资源
    public $CheckCode; // 验证码字符串

    public function __construct($width=80, $height=40, $charNum=4) {
        $this->width = $width;
        $this->height = $height;
        $this->charNum = $charNum;
        $this->CheckCode = '';
    }

    public function ShowImage() {
        // 第一步，创建背景图像
        $this->createImage();
        // 第二步，设置干扰元素
        $this->setDisturb();
        // 第三步，随机绘制文本
        //$this->outputText();// 使用系统默认字体
        $this->outputTtfText("../admin/font/ADDLG.TTF"); // 自定义字体输出
        // 第四步，输出图像
        $this->outputImage();
    }

    private function createImage() {
        // 创建图像资源
        $this->image = imagecreatetruecolor($this->width, $this->height);
        // 分配背景颜色,随机rand(0,255)则有可能背景颜色是深色，则改为rand(225,255)
        $backcolor = imagecolorallocate($this->image, rand(180, 225), rand(180, 225), rand(180, 225));
        // 填充图片背景色
        imagefill($this->image, 0, 0, $backcolor);
        // 边框颜色(黑色：RGB值都为0)
        $bordercolor = imagecolorallocate($this->image, 0, 0, 0);
        // 画边框
        imagerectangle($this->image, 0, 0, $this->width - 1, $this->height - 1, $bordercolor);
    }

    private function setDisturb() {
        // 将干扰元素像素点的数目由图片面积自动确定，则
        $disturbNum = floor($this->width * $this->height / 15);
        // 像素点干扰
        for ($i = 0; $i < $disturbNum; $i++) {
            $color = imagecolorallocate($this->image, rand(0, 255), rand(0, 255), rand(0, 255));
            imagesetpixel($this->image, rand(1, $this->width - 2), rand(1, $this->height - 2), $color);
        }
        // 弧线干扰
        for ($i = 0; $i < 5; $i++) {
            $color = imagecolorallocate($this->image, rand(0, 255), rand(0, 255), rand(0, 255));
            imagearc($this->image, rand(-10, $this->width), rand(-10, $this->height), rand(30, 300), rand(20, 200), 55, 44, $color);
        }
    }

        private function outputText() {
      // 去掉不容易区分的字符，比如0和O，1和l
      $chars = '123456789abcdefghijkmnpqrstuvwxyzABCDEFGHIJKMNPQRSTUVWXYZ';

      // 随机生成要输出的验证码文本字符串
      for ($i = 0; $i < $this->charNum; $i++) {
          $char = $chars[rand(0, strlen($chars) - 1)];
          $this->checkCode.=$char;
         // 每个字符的颜色随机,将颜色设深一些
          $fontcolor = imagecolorallocate($this->image, rand(0, 100), rand(0, 100), rand(0, 100));
         // 每个字符字体大小随机
          $fontsize = rand(3, 5);
      // 每个字符位置随机
          $x = floor($this->width / $this->charNum) * $i + 3;
          $y = rand(0, $this->height - 15);

      // 输出该字符
         imagechar($this->image, $fontsize, $x, $y, $char, $fontcolor);
      }
      } 

    // 自定义字体输出文本
    private function outputTtfText($fontfile) {
        // 去掉不容易区分的字符，比如0和O，1和l
        $chars = '123456789abcdefghijkmnpqrstuvwxyzABCDEFGHIJKMNPQRSTUVWXYZ';


        // 随机生成要输出的验证码文本字符串
        for ($i = 0; $i < $this->charNum; $i++) {
            $char = $chars[rand(0, strlen($chars) - 1)];
            $this->CheckCode.=$char;

            // 每个字符的颜色随机,将颜色设深一些
            $fontcolor = imagecolorallocate($this->image, rand(0, 100), rand(0, 100), rand(0, 100));
            // 每个字符字体大小随机
            $fontsize = rand(10, 12);
            // 每个字符位置随机
            $x = floor(($this->width - 8) / $this->charNum) * $i + 8;
            $y = rand($fontsize, $this->height - 4);

            // 输出该字符
            imagettftext($this->image, $fontsize, rand(-30, 30),$x, $y, $fontcolor, $fontfile, $char);  // 旋转角度-30到+30度的随机值
        }
    }

    private function outputImage() {
        if (imagetypes() & IMG_GIF) {
            header("Content-Type:image/gif");
        } else if (imagetypes() & IMG_JPG) {
            header("Content-Type:image/jpeg");
        } else {
            header("Content-Type:image/png");
        }
        //header("Content-Type:image/png");
        imagepng($this->image);
    }

    public function __destruct() {
        imagedestroy($this->image);
    }

}

?>
