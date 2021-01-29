{{-- 選択する値がなければNULLで初期化 --}}
@if( isset( $value ) != True )
    <?php $value = null; ?>
@endif

@foreach( $radio->getOptions() as $radioKey => $radioValue )

    <div class="radio-inline">
        <label>
            {!! Form::radio( $id, $radioKey, $radioKey == $value ) !!}
            {{ $radioValue }}
        </label>
    </div>
@endforeach