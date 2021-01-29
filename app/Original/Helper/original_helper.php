<?php

/**
 * オリジナルisset
 * @param  value $checkVal 値が存在するかを調べる値
 * @param  string $setValue 値が存在しない時の値
 * @return 成功：$checkValue 失敗：setValue
 */
function testm( $checkValue, $setValue="" ){
    if( isset( $checkValue ) ){
        if( !empty( $checkValue ) ){
            return $checkValue;
        }
    }
    return $setValue;
}

?>