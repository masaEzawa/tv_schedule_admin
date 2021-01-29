<?php

namespace App\Providers;

use App\Lib\Util\DateUtil; // 日付の便利関数
use App\Original\Util\ViewUtil; // 表示用の便利関数
use App\Original\Util\CodeUtil; // プルダウン用の便利関数
// codes 共通
use App\Original\Codes\CheckAriCodes;
use App\Original\Codes\DispCodes;
use App\Original\Codes\MaruBatsuCodes;
use App\Original\Codes\RowNumCodes;

// Models 共通
use App\Models\Role;

use Illuminate\Support\ServiceProvider;
use View;

/**
 * Viewに値を埋め込むサービスプロバイダー
 *
 * @author 江澤
 *
 */
class ViewComposerServiceProvider extends ServiceProvider {

    /**
     * サービスプロバイダーを定義する時のルールです
     *
     */
    public function boot()
    {
        // ログインユーザー情報の埋め込み
        View::composer( ['*'], 'App\Http\ViewComposers\LoginAccountComposer' );

        // Utilクラスを使う為の埋め込み
        View::composer( ['*'], 'App\Http\ViewComposers\UtilComposer' );

        // Codeクラスを使う為の埋め込み
        View::composer( ['*'], 'App\Http\ViewComposers\CodeComposer' );

        // 機能権限
        View::composer( 'elements.tag.role_select', function( $view ){
            $view->select = ViewUtil::genSelectTag(
                Role::options(),
                true // 空の値のフラグ
            );
        });

        ######################
        ## 日付の項目
        ######################

        // 連絡日
        View::composer( 'elements.tag.contact_select_ym', function( $view ){
            $view->select = ViewUtil::genSelectTag(
                ViewUtil::defaultYmOptions(),
                true // 空の値のフラグ
            );
        });

        // 年月（From）のSelect
        View::composer( 'elements.date.ym_select_from', function( $view ){
            $view->select = ViewUtil::genSelectTag(
                ViewUtil::defaultYmOptions(),
                true // 空の値のフラグ
            );
        });

        // 年月（To）のSelect
        View::composer( 'elements.date.ym_select_to', function( $view ){
            $view->select = ViewUtil::genSelectTag(
                ViewUtil::defaultYmOptions(),
                true // 空の値のフラグ
            );
        });

        // 年月（過去日なし）
        View::composer( 'elements.date.ym_select', function( $view ){
            $view->select = ViewUtil::genSelectTag(
                ViewUtil::ymOptions( DateUtil::toYm( DateUtil::now(), '-' ), 6 ),
                false
            );
        });

        // 対象月の範囲（現在の月から半年前の月を初月とし、そこから1年分）
        View::composer( 'elements.date.target_select_ym', function( $view ){
            $view->select = ViewUtil::genSelectTag(
                ViewUtil::ymOptions( DateUtil::nowMonthAgo(6), 12 ),
                false
            );
        });
        
        // 年のみのセレクト
        View::composer( 'elements.date.year_select', function( $view ){
            $view->select = ViewUtil::genSelectTag(
                DateUtil::optionYear(),
                true // 空の値のフラグ
            );
        });

        // 月のみのセレクト
        View::composer( 'elements.date.month_select', function( $view ){
            $view->select = ViewUtil::genSelectTag(
                DateUtil::optionMonth(),
                true // 空の値のフラグ
            );
        });

        // 曜日ののセレクト
        View::composer( 'elements.date.week_select', function( $view ){
            $view->select = ViewUtil::genSelectTag(
                DateUtil::getWeekjpList(),
                true // 空の値のフラグ
            );
        });

        ######################
        ## 共通の項目
        ######################

        // 行数のSelect
        View::composer( 'elements.tag.row_num_select', function( $view ){
            $view->select = ViewUtil::genSelectTag(
                (new RowNumCodes())->getOptions(),
                false
            );
        });

        // 表示/非表示
        View::composer( 'elements.tag.disp_select', function( $view ){
            $view->select = ViewUtil::genSelectTag(
                (new DispCodes())->getOptions(),
                true // 空の値のフラグ
            );
        });
        
        // 有
        View::composer( 'elements.tag.check_ari_select', function( $view ){
            $view->select = ViewUtil::genSelectTag(
                (new CheckAriCodes())->getOptions(),
                true // 空の値のフラグ
            );
        });

        // ○/×
        View::composer( 'elements.tag.marubatsu_select', function( $view ){
            $view->select = ViewUtil::genSelectTag(
                (new MaruBatsuCodes())->getOptions(),
                true // 空の値のフラグ
            );
        });

        ######################
        ## TV予約
        ######################
        
        // カテゴリーのセレクトボックス
        View::composer( 'elements.tv_reserve.category_select', function( $view ){
            $view->select = ViewUtil::genSelectTag(
                CodeUtil::getCategoryList(),
                true // 空の値のフラグ
            );
        });

        // 放送チャンネルのセレクトボックス
        View::composer( 'elements.tv_reserve.channel_select', function( $view ){
            $view->select = ViewUtil::genSelectTag(
                CodeUtil::getChannelList(),
                true // 空の値のフラグ
            );
        });

        ######################
        ## イベント
        ######################
        // カテゴリーのセレクトボックス
        View::composer( 'elements.event.category_select', function( $view ){
            $view->select = ViewUtil::genSelectTag(
                CodeUtil::getEventCategoryList(),
                true // 空の値のフラグ
            );
        });
    
    }
    
    // 
    public function register(){}

}
