<?php

class Tool
{
    public function map($dir = '/catalog')
    {
        $directors = array_diff(scandir($dir), array('..', '.'));

        array_walk($directors, function ($obj) use ($dir) {
            $data = pathinfo($obj);
            $path = $dir . $data['basename'];
            $realpath = realpath($path);

            if (isset($data['extension'])) {
                if (in_array(strtolower($data['extension']), ['jpg', 'png', 'jpeg'])) {
                    echo "\n" . $realpath;
                    $this->compress($realpath, 'image/' . strtolower($data['extension']));
                }
            } elseif (is_dir($realpath)) {
                echo "\n" . $path . '/';
                $this->map($path . '/');
            }
        });
    }

    public function compress($path, $type = 'image/jpeg')
    {
        $image = false;
        switch ($type) {
            case 'image/jpeg':
            case 'image/jpg':
                $image = $this->compresJpg($path);
                break;
            case 'image/png':
                $image = $this->compresPng($path);
                break;
        }
    }

    private function compresJpg($file, $quality = 80)
    {
        try {
            $source = @imagecreatefromjpeg($file);

            @imagejpeg($source, str_replace(['.jpg', '.jpeg'], ['_compressed.jpg', '_compressed.jpeg'], $file), $quality);
        } catch (\Exception $e) {
            var_dump($e);
        }
    }

    private function compresPng($file, $quality = 9)
    {
        try {
            $source = @imagecreatefrompng($file);
            @imagealphablending($source, false);
            @imagesavealpha($source, true);

            @imagepng($source, str_replace('.png', '_compressed.png', $file), $quality, -1);
        } catch (\Exception $e) {
            var_dump($e);
        }
    }
}

$compress = new Tool();
$compress->compress('example-orig.png', 'image/png');
// $compress->map('image/');
