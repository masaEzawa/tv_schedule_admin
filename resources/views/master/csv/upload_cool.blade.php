
{{-- 綺麗だったんだけど、うまくいかないからコメントアウト --}}
<div class="panel panel-default">
    <table class="table table-bordered tbl-pdg">
        <tbody>

            <tr>
                {{- CSVデータ -}}
                <th class="" style="vertical-align: middle; text-align: center;">
                    CSVデータ
                </th>
                <td>
                    {{- CSVデータアップロード -}}
                    <div class="form-inline">
                        <div class="input-group col-md-12 siz">
                            <input id="lefile" type="file" style="display:none">
                            <input type="text" id="file" name="upload" class="form-control csvup" placeholder="CSVファイルを選択してください。">
                            <span class="input-group-btn">
                                <button type="button" class="btn primary csvup" style="height: 36px;" onclick="$('input[id=lefile]').click();">
                                    <span class="glyphicon glyphicon-file" aria-hidden="true"></span>
                                </button>
                            </span>
                        </div>
                        <p class="help-block">● CSVファイルを選択ください</p>
                        <input class="btn btn-success" type="submit" value="アップロード">
                    </div>
                </td>
            </tr>

            {{- CSVサンプル -}}
            <tr>
                <td colspan="2">
                    <small><a href="{{ asset('csv/edealer.csv') }}">e-DealerサンプルCSV</a></small>
                </td>
            </tr>

        </tbody>

    </table>
</div>
