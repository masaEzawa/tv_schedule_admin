$( function() {
    // 日付のカレンダー入力UIの設定
    $( '.datepicker' ).datepicker({
        dateFormat:'yy-mm-dd', // 日付のフォーマット
        autoclose: true, // 入力後自動で閉じる。
        language: 'ja' // 日本語
    });
    
    // 時刻の入力UIの設定
    $('.clockpicker').clockpicker({
        autoclose: true, // 入力後自動で閉じる
    });

    // 年月の入力UIの設定
    $('.ympicker').ympicker({
        autoclose: true, // 入力後自動で閉じる
        // closeText: '閉じる',
		prevText: '&#x3c;前',
		nextText: '次&#x3e;',
		currentText: '今日',
		monthNames: ['1月','2月','3月','4月','5月','6月','7月','8月','9月','10月','11月','12月'],
		monthNamesShort: ['1月','2月','3月','4月','5月','6月','7月','8月','9月','10月','11月','12月'],
		dateFormat: 'yy-mm',
		yearSuffix: '年'
    });
});