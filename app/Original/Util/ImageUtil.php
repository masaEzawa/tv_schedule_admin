<?php

namespace App\Original\Util;

class ImageUtil {


	// 画像の横サイズを定義
	const MAX_IMAGE_WIDTH = 800;

	/**
	 * 画像ファイルを調整する
	 * @param $filie 画像ファイル名
	 * @param $path 格納先パス
	 */
	public static function adjustImage( $file, $path ){
		// ファイル名を取得する。
        $filename = $file->getClientOriginalName();

        if(strpos($filename, '.') == 0){
            $info = pathinfo($filename);
            if (!in_array(strtolower($info['extension']), ['jpg', 'jpeg', 'gif', 'png'])) {
                // 拡張子なし
                return 'err/' . $filename . '.' . ' ';
            }
        }

        $ext = substr($filename, strrpos($filename, '.') + 1); // 拡張子

        $msStr = explode(".", (microtime(true)))[1];//ミリ秒
        // 画像ファイル名を生成
        $inFileName = date("Ymd_His") . '_' . $msStr . '_tmp.' . $ext;

        // 保存する画像ファイル名を生成
        $outFileName = date("Ymd_His") . '_' . $msStr . '.' . $ext;

        // フォルダチェック、なければフォルダ作成
        if(!file_exists($path)){
            mkdir($path,0777);
        }

        // ファイル取り込み
        $file->move($path, $inFileName);
        
        $inFile = $path . '/' . $inFileName;
        $outFile = $path . '/' . $outFileName;

        // 画像をリサイズして、自動的に回転
        self::resizeAndFixOrientation($inFile, $outFile);

        // テンポラリー画像を削除
        @unlink( $inFile );

        return $outFile;

	}

	/**
     * 
     * @param string $inFile 画像のソース
     * @param string $outFile 保存先
     */
    public static function resizeAndFixOrientation($inFile, $outFile)
    {
        $imageInfo = getimagesize($inFile);
        $imageType = $imageInfo[2];
        
        // Orientation
        $orientation = null;
        if ($imageType == IMAGETYPE_JPEG) {
            // EXIF情報がエラー時、スキップ
            try {
                $exif = exif_read_data($inFile);
            } catch (\Exception $ex) {
            }
            // EXIF情報にオリエンテーション値がある場合
            if (isset($exif['Orientation'])) {
                $orientation = $exif['Orientation'];
            }
        }
        
        // Get new dimensions
        list($width_orig, $height_orig) = $imageInfo;
        $height = (int) ((self::MAX_IMAGE_WIDTH / $width_orig) * $height_orig);
        // Resample
        $image_p = imagecreatetruecolor(self::MAX_IMAGE_WIDTH, $height);
        
        //　元画像ファイル読み込み
        switch ($imageType){
            case IMAGETYPE_JPEG:
                $image = imagecreatefromjpeg($inFile); 

                break;
            case IMAGETYPE_GIF:
                $image = imagecreatefromgif($inFile);
                
                break;
            case IMAGETYPE_PNG:
                imagealphablending($image_p, false);
                imagesavealpha($image_p, true);
                $image = imagecreatefrompng($inFile);

                break;
        }
        
        imagecopyresampled($image_p, $image, 0, 0, 0, 0, self::MAX_IMAGE_WIDTH, $height, $width_orig, $height_orig);
        
        // Fix Orientation
        if ($orientation !== null) {
            switch($orientation) {
                case 3:
                case 4:
                    $image_p = imagerotate($image_p, 180, 0);
                    break;
                case 6:
                case 5:
                    $image_p = imagerotate($image_p, -90, 0);
                    break;
                case 8:
                case 7:
                    $image_p = imagerotate($image_p, 90, 0);
                    break;
            }
        }
        
        //　画像保存
        switch ($imageType){
            case IMAGETYPE_JPEG:
                imagejpeg($image_p, $outFile);
                
                break;
            case IMAGETYPE_GIF:
                $bgcolor = imagecolorallocatealpha($image, 0, 0, 0, 127);
                imagefill($image_p, 0, 0, $bgcolor);
                imagecolortransparent($image_p, $bgcolor);
                imagegif($image_p, $outFile);
                
                break;
            case IMAGETYPE_PNG:
                imagepng($image_p, $outFile);
                
                break;
        }
        
        imagedestroy($image_p);
        imagedestroy($image);
    }
}

?>