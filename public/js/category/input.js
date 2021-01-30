/*
 * フォームの入力画面用のJS
 */

// 入力部分のidの番号を振りなおす
function attr_num_head() {

    $(".tbl-num").each(function( i ){

        $(this).html( String( i ) );
        
        // 入力項目のidを格納する
        add_input_id( i );
        
    });
    
    
    // 入力項目の登録する個数を格納する
    $("input[name='input_item_count']").val( $(".tbl-num").length );
    
    // 観戦者の入力部分が2個以下のとき
    if( $(".tbl-num").length <= 2 ){
        // 削除ボタンを非表示にする
        $(".btn-del").hide();
    }else{
        // 削除ボタンを表示する
        $(".btn-del").show();
    }
}

// 入力項目のidを格納する
function add_input_id( id ){
    $("input[name='result_day[]']").eq( id ).attr( 'id', 'result_day_' + id );
    $("input[name='result_time[]']").eq( id ).attr( 'id', 'result_time_' + id );
    
    // 日付のカレンダー入力UIの削除
    $( '#result_day_' + id ).datepicker( 'destroy' );
    
    // 時刻の入力UIの削除
    //$( '#result_time_' + id ).clockpicker( 'remove' );

}

// 入力項目の追加
function add_input_box( elements ){

    /* 現在は使っていない
        
    // レポート画像の入力部分が25個以上あるとき
    if( $(".tbl-num").length > 25 ){
        // アラートを表示して複製できないようにする
        alert("25個以上は追加できません。");
        return;
    }
    */

    // フォームを複製
    $("#wrap-inp-box > .inp-box").eq(0).clone(true).insertAfter( elements.parents('#add_btm-item').prev( "#wrap-inp-box" ).children( ".inp-box" ).last() ).hide().fadeIn();

    // 入力部分のidの番号を振りなおす
    attr_num_head();
}