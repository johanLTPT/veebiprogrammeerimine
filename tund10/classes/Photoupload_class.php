<?php
class Photoupload
{
    private $photoinput;
    private $photofiletype;
    private $mytempimage;
    private $mynewtempimage;
    public $filename;
    private $filesizelimit;
    private $filenameprefixM;
    private $targetorig;
    function __construct($photoinput, $filesizelimit, $filenameprefix, $targetorig)
    {
        $this->photoinput = $photoinput;
        $this->filesizelimit = $filesizelimit;
        $this->filenameprefix = $filenameprefix;
        $this->targetorig = $targetorig;
        $this->testImage();
        //var_dump($this->photoinput);
        $this->createImageFromFile();
    }
    function __destruct()
    {
        if (isset($this->mynewtempimage)){imagedestroy($this->mytempimage);}
        
    }

    private function createImageFromFile()
    {
        //muudame suurust
        //loome pikslikogumi, pildi objekti
        if ($this->photofiletype == "jpg") {
            $this->mytempimage = imagecreatefromjpeg($this->photoinput["tmp_name"]);
        }
        if ($this->photofiletype == "png") {
            $this->mytempimage = imagecreatefrompng($this->photoinput["tmp_name"]);
        }
        if ($this->photofiletype == "gif") {
            $this->mytempimage = imagecreatefromgif($this->photoinput["tmp_name"]);
        }
    }
    public function testImage()
    {
        $filename = null;
        $inputerror = null;
        //kas on pilt ja mis tüüpi
        $check = getimagesize($this->photoinput["tmp_name"]);
        if ($check !== false) {
            //var_dump($check);
            if ($check["mime"] == "image/jpeg") {
                $this->photofiletype = "jpg";
            }
            if ($check["mime"] == "image/png") {
                $this->photofiletype = "png";
            }
            if ($check["mime"] == "image/gif") {
                $this->photofiletype = "gif";
            }
        } else {
            $inputerror = "Valitud fail ei ole pilt! ";
        }

        //kas on sobiva failisuurusega
        if (empty($inputerror) and $this->photoinput["size"] > $this->filesizelimit) {
            $inputerror = "Liiga suur fail!";
        }

        //loome uue failinime
        $timestamp = microtime(1) * 10000;
        $filename = $this->filenameprefix . $timestamp . "." . $this->photofiletype;
        $this->filename = $filename;

        //ega fail äkki olemas pole
        if (file_exists($this->targetorig. $filename)) {
            $inputerror = "Selle nimega fail on juba olemas!";
        }
        return $inputerror;
    }
    public function resizePhoto($w, $h, $keeporigproportion = true)
    {
        $imagew = imagesx($this->mytempimage);
        $imageh = imagesy($this->mytempimage);
        $neww = $w;
        $newh = $h;
        $cutx = 0;
        $cuty = 0;
        $cutsizew = $imagew;
        $cutsizeh = $imageh;

        if ($w == $h) {
            if ($imagew > $imageh) {
                $cutsizew = $imageh;
                $cutx = round(($imagew - $cutsizew) / 2);
            } else {
                $cutsizeh = $imagew;
                $cuty = round(($imageh - $cutsizeh) / 2);
            }
        } elseif ($keeporigproportion) { //kui tuleb originaaproportsioone säilitada
            if ($imagew / $w > $imageh / $h) {
                $newh = round($imageh / ($imagew / $w));
            } else {
                $neww = round($imagew / ($imageh / $h));
            }
        } else { //kui on vaja kindlasti etteantud suurust, ehk pisut ka kärpida
            if ($imagew / $w < $imageh / $h) {
                $cutsizeh = round($imagew / $w * $h);
                $cuty = round(($imageh - $cutsizeh) / 2);
            } else {
                $cutsizew = round($imageh / $h * $w);
                $cutx = round(($imagew - $cutsizew) / 2);
            }
        }

        //loome uue ajutise pildiobjekti
        $this->mynewtempimage = imagecreatetruecolor($neww, $newh);
        //kui on läbipaistvusega png pildid, siis on vaja säilitada läbipaistvusega
        imagesavealpha($this->mynewtempimage, true);
        $transcolor = imagecolorallocatealpha($this->mynewtempimage, 0, 0, 0, 127);
        imagefill($this->mynewtempimage, 0, 0, $transcolor);
        imagecopyresampled($this->mynewtempimage, $this->mytempimage, 0, 0, $cutx, $cuty, $neww, $newh, $cutsizew, $cutsizeh);
    }
    public function addWatermark($wmfile)
    {
        if (isset($this->mynewtempimage)) {
            $watermark = imagecreatefrompng($wmfile);
            $wmw = imagesx($watermark);
            $wmh = imagesy($watermark);
            $wmx = imagesx($this->mynewtempimage) - $wmw - 10;
            $wmy = imagesy($this->mynewtempimage) - $wmh - 10;
            //kopeerimie vesimärgi vähendatud pildile
            imagecopy($this->mynewtempimage, $watermark, $wmx, $wmy, 0, 0, $wmw, $wmh);
            imagedestroy($watermark);
        }
    }
    public function saveOrig($target)
    {
        $notice = null;
        if (move_uploaded_file($this->photoinput["tmp_name"], $target.$this->filename)) {
            $notice = 1;
        } else {
            $notice = 0;
        }
        return $notice;
    }
    public function saveimage($target)
    {
        $notice = null;
        if ($this->photofiletype == "jpg") {
            if (imagejpeg($this->mynewtempimage, $target.$this->filename, 90)) {
                $notice = 1;
            } else {
                $notice = 0;
            }
        }
        if ($this->photofiletype == "png") {
            if (imagepng($this->mynewtempimage, $target.$this->filename, 6)) {
                $notice = 1;
            } else {
                $notice = 0;
            }
        }
        if ($this->photofiletype == "gif") {
            if (imagegif($this->mynewtempimage, $target.$this->filename)) {
                $notice = 1;
            } else {
                $notice = 0;
            }
        }
        imagedestroy($this->mynewtempimage);
        return $notice;
    }
}//classi lõpp
