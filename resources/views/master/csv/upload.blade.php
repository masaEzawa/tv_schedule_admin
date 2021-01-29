
{{-- csvファイルのパスの指定とアップロード --}}
<form action="{{ action( $displayObj->ctl . '@postUpload') }}" method="POST" id="mainForm" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    {{-- どのcsvファイルになるか名前sを格納する --}}
    <input type="hidden" name="file_type" value="{{ isset( $file_type ) ? $file_type : '' }}">
    <input type="hidden" name="base_code" value="{{ isset( $base_code ) ? $base_code : '' }}">

    <div class="panel panel-default">
        <table class="table table-bordered tbl-pdg">
            <tbody>
                {{-- 年度表示を行う時に表示 --}}
                @if( isset( $yearFlg ) == True )
                    <tr>
                        <th class="bg-primary" style="vertical-align: middle; text-align: center; width: 150px;">
                            年度指定
                        </th>
                        <td>
                            <div class="form-inline">
                                {{-- 年度指定 --}}
                                <?php
                                // 当月の年を格納
                                $currentYear = date("Y");
                                ?>
                                
                                {{-- 1,2,3月の時だけ、次の年度の選択が可能 --}}
                                @if( in_array( date("m"), ["01", "02","03"] ) == True )
                                    <select name="year" class="form-control" style="width: 10%;">
                                        <option value="<?php echo $currentYear; ?>"><?php echo $currentYear; ?>年度</option>
                                        <option value="<?php echo date('Y', strtotime( date('Y') . ' -1 year ' ) ); ?>" selected><?php echo date('Y', strtotime( date('Y') . ' -1 year ' ) ); ?>年度</option>
                                    </select>

                                @else
                                    <select name="year" class="form-control" style="width: 10%;">
                                        <option value="<?php echo $currentYear; ?>" selected><?php echo $currentYear; ?>年度</option>
                                    </select>

                                @endif

                            </div>
                        </td>
                    </tr>
                @endif

                <tr>
                    {{-- CSVデータ --}}
                    <th class="bg-primary" style="vertical-align: middle; text-align: center; width: 150px;">
                        CSVデータ
                    </th>
                    <td>
                        {{-- CSVデータアップロード --}}
                        <div class="form-inline">
                            <div class="input-group col-md-12 siz">
                                {{-- ファイルのパスを格納 --}}
                                <input id="lefile" type="file" name="csv_file">											
                            </div>

                            <p class="help-block">● CSVファイルを選択ください</p>

                            <input type="submit" class="btn btn-success" value="アップロード">
                        </div>
                    </td>
                </tr>

                {{-- CSVサンプル --}}
                <tr>
                    <td colspan="2">
                        <small><a href="{{ $sampleUrl }}">{{ $sampleText }}</a></small>
                    </td>
                </tr>

            </tbody>

        </table>
    </div>

</form>
