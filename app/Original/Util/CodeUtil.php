<?php

namespace App\Original\Util;

use App\Models\Role;
// codes 共通
use App\Original\Codes\MaruBatsuCodes;
use App\Original\Codes\DispCodes;
// codes TV番組
use App\Original\Codes\TvReserve\CategoryCodes as TvReserveCategoryCodes; // カテゴリー
use App\Original\Codes\TvReserve\ChannelCodes; // 放送チャンネル

// codes TV番組
use App\Original\Codes\Event\CategoryCodes as EventCategoryCodes; // カテゴリー

class CodeUtil {
    
    ######################
    ## 共通
    ######################

    /**
     * 権限を取得
     * @param  [type] $code    [description]
     * @param  string $default [description]
     * @return [type]          [description]
     */
    public static function getRoleName( $code, $default='' ){
        // 権限の一覧を取得
        $roleList = Role::options();
        
        if( isset( $roleList[$code] ) == True ){
            return $roleList[$code];
        }

        return $default;
    }

    /**
     * ○×を取得
     * @param  [type] $code    [description]
     * @param  string $default [description]
     * @return [type]          [description]
     */
    public static function getMaruBatsuType( $code, $default='' ){
        $name = ( new MaruBatsuCodes() )->getValue( $code );
        if( !empty( $code ) == True ){
            return $name;
        }
        
        return $default;
    }
    
    /**
     * 表示か非表示を取得
     * @param  [type] $code    [description]
     * @param  string $default [description]
     * @return [type]          [description]
     */
    public static function getDispType( $code, $default='' ){
        $name = ( new DispCodes() )->getValue( $code );
        if( !empty( $code ) == True ){
            return $name;
        }
        
        return $default;
    }
    
    ######################
    ## TV予約
    ######################

    /**
     * カテゴリーの値を取得
     * @param  [type] $code    [description]
     * @param  string $default [description]
     * @return [type]          [description]
     */
    public static function getCategoryList(){
        // 一覧を取得
        $categoryList = ( new TvReserveCategoryCodes() )->getOptions();

        return $categoryList;
    }

    /**
     * カテゴリーの値を取得
     * @param  [type] $code    [description]
     * @param  string $default [description]
     * @return [type]          [description]
     */
    public static function getCategoryName( $num=0 ){
        // 一覧を取得
        $categoryList = self::getCategoryList();

        if( isset( $categoryList[$num] ) == True ){
            return $categoryList[$num];
        }

        return $num;
    }

    /**
     * 放送チャンネルの値を取得
     * @param  [type] $code    [description]
     * @param  string $default [description]
     * @return [type]          [description]
     */
    public static function getChannelList(){
        // 一覧を取得
        $channelList = ( new ChannelCodes() )->getOptions();

        return $channelList;
    }

    /**
     * 放送チャンネルの値を取得
     * @param  [type] $code    [description]
     * @param  string $default [description]
     * @return [type]          [description]
     */
    public static function getChannelName( $num=0 ){
        // 一覧を取得
        $channelList = self::getChannelList();

        if( isset( $channelList[$num] ) == True ){
            return $channelList[$num];
        }

        return $num;
    }

    ######################
    ## イベント
    ######################

    /**
     * カテゴリーの値を取得
     * @param  [type] $code    [description]
     * @param  string $default [description]
     * @return [type]          [description]
     */
    public static function getEventCategoryList(){
        // 一覧を取得
        $categoryList = ( new EventCategoryCodes() )->getOptions();

        return $categoryList;
    }

    /**
     * カテゴリーの値を取得
     * @param  [type] $code    [description]
     * @param  string $default [description]
     * @return [type]          [description]
     */
    public static function getEventCategoryName( $num=0 ){
        // 一覧を取得
        $categoryList = self::getEventCategoryList();

        if( isset( $categoryList[$num] ) == True ){
            return $categoryList[$num];
        }

        return $num;
    }

 }
