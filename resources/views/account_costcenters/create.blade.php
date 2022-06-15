<div class="modal-dialog" role="document">
    <div class="modal-content">

        {!! Form::open(['url' => action('CostCenterController@store'), 'method' => 'post', 'id' => 'cost_center_form' ]) !!}

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">@lang( 'account.Add cost center' )</h4>
        </div>

        <div class="modal-body">


            <div class="row">
                <div class="col-lg-6">
                    {!! Form::label('ar_name', __( 'lang_v1.ar_name' ) .":*") !!}
                    {!! Form::text('ar_name', null, ['class' => 'form-control', 'required','placeholder' => __( 'lang_v1.name' ) ]); !!}
                </div>

                <div class="col-lg-6">
                    {!! Form::label('en_name', __( 'lang_v1.en_name' ) .":*") !!}
                    {!! Form::text('en_name', null, ['class' => 'form-control', 'required','placeholder' => __( 'lang_v1.en_name' ) ]); !!}
                </div>
            </div>

            <br/>
            <div class="form-group">
                {!! Form::label('account_center_number', __( 'account.Account center number' ) .":*") !!}
                {!! Form::text('account_center_number', null, ['class' => 'form-control', 'required','placeholder' => __( 'account.Account center number' ) ]); !!}
            </div>
            <br/>

            <div class="form-group">
                {!! Form::label('parent_account', __( 'lang_v1.Parent account' ) .":", ['for' => 'parent_id']) !!}
                <select id="parent_id" name="parent_id" class="form-control select2">
                    <option></option>
                    @foreach($costCenters as $costCenter)
                        <option value="{{$costCenter->id}}">{{app()->getLocale() === 'ar' ? $costCenter->name : $costCenter->en_name}}</option>
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