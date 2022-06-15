<div class="modal-dialog" role="document">
    <div class="modal-content">

        {!! Form::open(['url' => action('CostCenterController@update', ['id' => $costCenter->id]), 'method' => 'put', 'id' => 'cost_center_form' ]) !!}
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">@lang( 'account.Edit cost center' )</h4>
        </div>
        <div class="modal-body">
{{--            <div class="form-group">--}}
{{--                {!! Form::label('name', __( 'account.Name' ) .":*") !!}--}}
{{--                {!! Form::text('name', $costCenter->name, ['class' => 'form-control', 'required','placeholder' => __( 'account.Name' ) ]); !!}--}}
{{--            </div>--}}

            <div class="row">
                <div class="col-lg-6">
                    {!! Form::label('ar_name', __( 'lang_v1.ar_name' ) .":*") !!}
                    {!! Form::text('ar_name', $costCenter->ar_name, ['class' => 'form-control', 'required','placeholder' => __( 'lang_v1.name' ) ]); !!}
                </div>

                <div class="col-lg-6">
                    {!! Form::label('en_name', __( 'lang_v1.en_name' ) .":*") !!}
                    {!! Form::text('en_name', $costCenter->en_name, ['class' => 'form-control', 'required','placeholder' => __( 'lang_v1.en_name' ) ]); !!}
                </div>
            </div>
            <br/>


            <div class="form-group">
                {!! Form::label('parent_account', __( 'lang_v1.Parent account' ) .":", ['for' => 'parent_id']) !!}
                <select id="parent_id" name="parent_id" class="form-control select2">
                    <option></option>
                    @foreach($costCenters as $cost)
                        <option {{$costCenter->parent_id === $cost->id ? 'selected' : ''}} value="{{$cost->id}}">{{app()->getLocale() === 'ar' ? $cost->name : $cost->en_name}}</option>
                    @endforeach
                </select>
            </div>

        </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">@lang( 'messages.save' )</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">@lang( 'messages.close' )</button>
        </div>

        {!! Form::close() !!}

    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->