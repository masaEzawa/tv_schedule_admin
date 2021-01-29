/**
	 * jquery.ui.ympicker.jsのrapモジュール
	 *
	 */

	/**
	 * ympicker・月初末
	 * 年月選択により月初日、月末日らのテキストボックスを連動させる。
	 *
	 * @param tb_ym_id 年月テキストボックスのID
	 * @param tb_m_start_id 月初日テキストボックスのID
	 * @param tb_m_ent_id 月末日テキストボックスのID
	 *
	 */
	function ympicker_tukishomatu(tb_ym_id,tb_m_start_id,tb_m_ent_id){



		//年月入力
		var op = {
			closeText: '閉じる',
			prevText: '&#x3c;前',
			nextText: '次&#x3e;',
			currentText: '今日',
			monthNames: ['1月','2月','3月','4月','5月','6月','7月','8月','9月','10月','11月','12月'],
			monthNamesShort: ['1月','2月','3月','4月','5月','6月','7月','8月','9月','10月','11月','12月'],
			dateFormat: 'yy/mm',
			yearSuffix: '年',
			onSelect:function(ym, instance) {


		    	  //月初日と月末日を算出し、入力フォームに表示
		    	  ympickerShowStartLast(ym,tb_m_start_id,tb_m_ent_id);


			}
		};

		//年月ダイアログを適用
		$('#' + tb_ym_id).ympicker(op);


		//年月をクリアしたら月初、月末もクリアする。
		$('#' + tb_ym_id).change(function () {
		      var v = $('#' + tb_ym_id).val();
		      if(v =='' || v==null){
		    	  $('#' + tb_m_start_id).val('');
		    	  $('#' + tb_m_ent_id).val('');
		      }else{

		    	  //年月チェック
		    	  if(ympickerIsYM(v)==true){

			    	  //月初日と月末日を算出し、入力フォームに表示
			    	  ympickerShowStartLast(v,tb_m_start_id,tb_m_ent_id);
		    	  }else{
			    	  $('#' + tb_m_start_id).val('');
			    	  $('#' + tb_m_ent_id).val('');
		    	  }


		      }
		}).change();

	}

	//月初日と月末日を算出し、入力フォームに表示
	function ympickerShowStartLast(ym,tb_m_start_id,tb_m_ent_id){
		var d1=ym + '/1';
		$('#' + tb_m_start_id).val(d1);

		//月末日の算出と出力
		var dt=new Date(d1);
		var last_d=new Date(dt.getFullYear(), dt.getMonth() + 1, 0);
		var last_d=DateFormat(last_d, 'yyyy/mm/dd'); // 01月23日
		$('#' + tb_m_ent_id).val(last_d);
	}


	/**
	 * 年月チェック
	 * yyyy/mm形式とyyyy-mm形式に対応
	 * ※注意 onchangeイベントと全角入力では正しく検知できない。
	 * @param value 年月
	 * @returns true:入力OK    false:入力エラー
	 */
	function ympickerIsYM(value){

		var ary=value.split("/");
		if(ary.length != 2){
			ary=value.split("-");
			if(ary.length != 2){
				return false;;
			}
		}

		var y=parseInt(ary[0]);
		var m=parseInt(ary[1]);

		var dt=new Date(y,m-1,1);
		if(dt.getFullYear()!=y || dt.getMonth()!=m-1 ){
			return false;
		}
		return true;
	}