<?php

namespace App\Original\Util;

use Session;

class SessionUtil {

    public static $systemName = "_hansha_api";

    ######################
    ## user_info
    ######################
    
    /**
     * ユーザー情報を登録(セッション)
     * @param  [type] $value [description]
     * @return [type]        [description]
     */
    public static function putUser( $value ) {
        Session::put('user_info' . self::$systemName, $value);
    }

    /**
     * ユーザー情報を取得(セッション)
     * @return [type] [description]
     */
    public static function getUser() {
        return Session::get('user_info' . self::$systemName);
    }

    /**
     * ユーザー情報を削除(セッション)
     * @return [type] [description]
     */
    public static function removeUser() {
        Session::forget('user_info' . self::$systemName);
    }

    ######################
    ## sort
    ######################

    /**
     * 並び順を登録(セッション)
     * @param  [type] $value [description]
     * @return [type]        [description]
     */
    public static function putSort( $value ) {
        Session::put('sort' . self::$systemName, $value);
    }
    
    /**
     * 並び順を取得(セッション)
     * @return [type] [description]
     */
    public static function getSort() {
        return Session::get('sort' . self::$systemName);
    }

    /**
     * 並び順を削除(セッション)
     * @return [type] [description]
     */
    public static function removeSort() {
        Session::forget('sort' . self::$systemName);
    }

    ######################
    ## search
    ######################
    
    /**
     * 検索値を登録(セッション)
     * @param  [type] $value [description]
     * @return [type]        [description]
     */
    public static function putSearch( $array ) {
        Session::put('search' . self::$systemName, $array);
    }

    /**
     * 検索値を取得(セッション)
     * @return [type] [description]
     */
    public static function getList() {
        return Session::get('search' . self::$systemName);
    }

    /**
     * 検索値を削除(セッション)
     * @return [type] [description]
     */
    public static function removeSearch() {
        Session::forget('search' . self::$systemName);
    }

    /**
     * 検索値のセッションを保持するかを調べる
     * @return boolean [description]
     */
    public static function hasSearch(){
        if ( Session::has('search' . self::$systemName) ) {
            return true;
        } else {
            return false;
        }
    }
    
    ######################
    ## remove
    ######################
    
    /**
     * 検索情報と並び替え情報を削除
     * @return [type] [description]
     */
    public static function removeSession() {
        // 検索情報を初期化
        Session::forget('search' . self::$systemName);
        // 並び替え情報を初期化
        Session::forget('sort' . self::$systemName);
    }

    ######################
    ## 販社情報の保持
    ## （主にスライドで使用）
    ######################

    /**
     * 販社コードの登録（セッション）
     * @return [type] [description]
     */
    public static function putHanshaCd( $hansha_cd ){
        Session::put( 'hansha_cd' . self::$systemName, $hansha_cd );
    }

    /**
     * 販社コードを取得(セッション)
     * @return [type] [description]
     */
    public static function getHanshaCd(){
        return Session::get( 'hansha_cd' . self::$systemName );
    }

}
