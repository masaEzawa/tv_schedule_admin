
/***************************************************************************
 *
 * スライドメッセージボックスブラプグイン
 * 処理後の上部のおしゃれ表示
 *
 *  [使用例]
 *	SliderBox.info(message);  
 *
 *  [オプション]
 *  target : アペンドするタグ（変更しないほうがいいかと）
 *  delay : フェードアウトするまでの時間感覚
 *
 ***************************************************************************/

SliderBox = function() {
	var $infoBox = null;
	var options = null;
	var userOptions = null;

	/*
	 * デフォルトオプション
	 */
	var defaultOption = {
		target 			: 'body',
		delay			: 3000
	};

	var _init = function(opts) {
		userOptions = opts;
		return this;
	}
	
	var _optional = function() {
		var op = $.extend(null, defaultOption);
		return $.extend(op, userOptions);
	}
	
	var _infoBox = function(message) {
		$infoBox = $('<a href="#" class="infoBox"></a>');
		var op = _optional();
		_display(op, $infoBox, message);

		// クリックでフェードアウト
		//$(document).on('click', '.infoBox', function(){
		//	_fadeOut();
		//});
	}
	
	var _errorBox = function(message) {
		$infoBox = $('<a href="#" class="errorBox"></a>');
		var op = _optional();
		_display(op, $infoBox, message);
	}
	
	var _display = function(options, element, message) {
		window.scrollTo(0 ,0);
		element
			.clone(true)
			.text(message)
			.hide().appendTo(options.target).slideDown()
			.delay(options.delay).fadeOut();
		
		setTimeout(
			function(){ _remove(); }
			, options.delay + 1000
			);
	}
	
	var _remove =  function() {
		$('.infoBox').remove();
		$('.errorBox').remove();
	}
	
	var _fadeOut = function() {
		$infoBox.stop(true).fadeOut();
	}

	return {
		init : _init
		, info : _infoBox
		, error : _errorBox
		, fadeOut : _fadeOut
	}
	
}();
