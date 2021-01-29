<?php

namespace App\Commands\Csv;

use App\Lib\Csv\CsvImport;
use App\Lib\CsvData\MedleyData;

use App\Lib\Util\UploadFileUtil;
use App\Original\Codes\CsvDirCodes;
use App\Events\UploadedEvent;
use App\Http\Requests\CsvUploadRequest;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;
use Input;

/**
 * csvアップロード
 *
 * @author 江澤
 */
class CsvUploadCommand extends Command{
    
    /**
     * コンストラクタ
     * @param CsvUploadRequest $requestObj 検索オブジェクト
     */
    public function __construct( CsvUploadRequest $requestObj ){
        $this->requestObj = $requestObj;
    }

    /**
     * メインの処理
     */
    public function handle(){
        // どのcsvファイルかを判定する数値を取得
        $fileType = $this->requestObj->file_type;
        
        // アップロードのディレクトリの名を取得
        $uploadDir = storage_path() . '/upload/';

        // ファイルを格納するディレクトリ名を取得
        $csvDirName = ( new CsvDirCodes() )->getValue( $fileType );
        
        // CSVアップロードしたファイルのパスを取得
        $csvFilePath = UploadFileUtil::save( $uploadDir . $csvDirName );
        
        // CSVの取り込みを行うオブジェクトを取得
        $csvImportObj = $this->getInstance( $fileType, $csvFilePath );
        
        // CSVファイルの取り込み処理
        // CsvImportのメソッドを実行
        $csvImportObj->execute();
        
        \Event::fire(
            new UploadedEvent(
                Auth::user(),
                $csvImportObj->result,
                $fileType
            )
        );
        
        return $csvImportObj;
        
    }

    /**
     * CSVの取り込みを行うオブジェクトを取得
     * @param  [type] $file_type [description]
     * @param  [type] $filePath  [description]
     * @return [type]            [description]
     */
    public function getInstance( $file_type, $filePath ){

        // メドフェスデータ
        if( CsvDirCodes::isMedley( $file_type ) ){
            
            // csvを取り込む
            $csvImportObj = CsvImport::getInstance(
                new MedleyData(),
                $filePath, // ファイルパス
                Input::all(), // 検索条件を取得
                1 // 読み飛ばす列数
            );
            
            return $csvImportObj;
        }
    }

}
