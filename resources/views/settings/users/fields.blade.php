@if($customFields)
    <h5 class="col-12 pb-4">{!! trans('lang.main_fields') !!}</h5>
@endif
<div style="padding: 0 4px;" class="column col-lg-6 col-sm-12">
    <!-- Name Field -->
    <div class="form-group row ">
        {!! Form::label('name', trans("lang.user_name"), ['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::text('name', null,  ['class' => 'form-control','placeholder'=>  trans("lang.user_name_placeholder")]) !!}
            <div class="form-text text-muted">
                {{ trans("lang.user_name_help") }}
            </div>
        </div>
    </div>

    <!-- Email Field -->
    <div class="form-group row ">
        {!! Form::label('email', trans("lang.user_email"), ['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::text('email', null,  ['class' => 'form-control','placeholder'=>  trans("lang.user_email_placeholder")]) !!}
            <div class="form-text text-muted">
                {{ trans("lang.user_email_help") }}
            </div>
        </div>
    </div>

    <!-- Password Field -->
    <div class="form-group row ">
        {!! Form::label('password', trans("lang.user_password"), ['class' => 'col-3 control-label text-right','style' => 'font-size:14px;']) !!}
        <div class="col-9">
            {!! Form::password('password', ['class' => 'form-control','placeholder'=>  trans("lang.user_password_placeholder")]) !!}
            <div class="form-text text-muted">
                {{ trans("lang.user_password_help") }}
            </div>
        </div>
    </div>
</div>
<div style="padding: 0 4px;" class="column col-lg-6 col-sm-12">
    <!-- $FIELD_NAME_TITLE$ Field -->
    <div class="form-group row">
        {!! Form::label('avatar', trans("lang.user_avatar"), ['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            <div style="width: 100%" class="dropzone avatar" id="avatar" data-field="avatar">
                <input type="hidden" name="avatar">
            </div>
            <a href="#loadMediaModal" data-dropzone="avatar" data-toggle="modal" data-target="#mediaModal" class="btn btn-outline-{{setting('theme_color','primary')}} btn-sm float-right mt-1">{{ trans('lang.media_select')}}</a>
            <div class="form-text text-muted w-50">
                {{ trans("lang.user_avatar_help") }}
            </div>
        </div>
    </div>
    @prepend('scripts')
    <script type="text/javascript">
        var user_avatar = '';
        @if(isset($user) && $user->hasMedia('avatar'))
            user_avatar = {
            name: "{!! $user->getFirstMedia('avatar')->name !!}",
            size: "{!! $user->getFirstMedia('avatar')->size !!}",
            type: "{!! $user->getFirstMedia('avatar')->mime_type !!}",
            collection_name: "{!! $user->getFirstMedia('avatar')->collection_name !!}"
        };
                @endif
        var dz_user_avatar = $(".dropzone.avatar").dropzone({
                url: "{!!url('uploads/store')!!}",
                addRemoveLinks: true,
                maxFiles: 1,
                init: function () {
                    @if(isset($user) && $user->hasMedia('avatar'))
                    dzInit(this, user_avatar, '{!! url($user->getFirstMediaUrl('avatar','thumb')) !!}')
                    @endif
                },
                accept: function (file, done) {
                    dzAccept(file, done, this.element, "{!!config('medialibrary.icons_folder')!!}");
                },
                sending: function (file, xhr, formData) {
                    dzSending(this, file, formData, '{!! csrf_token() !!}');
                },
                maxfilesexceeded: function (file) {
                    dz_user_avatar[0].mockFile = '';
                    dzMaxfile(this, file);
                },
                complete: function (file) {
                    dzComplete(this, file, user_avatar, dz_user_avatar[0].mockFile);
                    dz_user_avatar[0].mockFile = file;
                },
                removedfile: function (file) {
                    dzRemoveFile(
                        file, user_avatar, '{!! url("users/remove-media") !!}',
                        'avatar', '{!! isset($user) ? $user->id : 0 !!}', '{!! url("uplaods/clear") !!}', '{!! csrf_token() !!}'
                    );
                }
            });
        dz_user_avatar[0].mockFile = user_avatar;
        dropzoneFields['avatar'] = dz_user_avatar;
    </script>
@endprepend
    @can('permissions.index')
<!-- Roles Field -->
    <div class="form-group row ">
        {!! Form::label('roles[]', trans("lang.user_role_id"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::select('roles[]', $role, $rolesSelected, ['class' => 'select2 form-control' , 'multiple'=>'multiple']) !!}
            <div class="form-text text-muted">{{ trans("lang.user_role_id_help") }}</div>
        </div>
    </div>
    @endcan

</div>
@if($customFields)
    {{--TODO generate custom field--}}
    <div class="clearfix"></div>
    <div class="col-12 custom-field-container row">
        <h5 class="col-12 pb-4">{!! trans('lang.custom_field_plural') !!}</h5>
        {!! $customFields !!}
    </div>
@endif

@hasanyrole('admin')
@if(isset($user))
@if($user->getRoleNames()[0] == 'manager')
<div class="form-group row ">
    {!! Form::label('coins', trans("lang.app_setting_coins"), ['class' => 'col-3 control-label text-right']) !!}
    <div class="col-9">
        {!! Form::text('coins', null,  ['class' => 'form-control','placeholder'=>  trans("lang.app_setting_coins")]) !!}
        <div class="form-text text-muted">
            {{ trans("lang.app_setting_coins") }}
        </div>
    </div>
</div>
@endif
@endif
@endhasanyrole

@hasanyrole('manager')
<div class="form-group row ">
    {!! Form::label('coins', trans("lang.app_setting_coins"), ['class' => 'col-3 control-label text-right']) !!}
    <div class="col-9">
        {!! Form::text('coins', null,  ['class' => 'form-control','placeholder'=>  trans("lang.app_setting_coins"), 'readonly']) !!}
        <div class="form-text text-muted">
            {{ trans("lang.app_setting_coins") }}
        </div>
    </div>
</div>
@endhasanyrole

@hasanyrole('admin')
@if(isset($user))
@if($user->getRoleNames()[0] == 'manager')
<div class="form-group row ">
    {!! Form::label('commissions', trans("lang.app_setting_commissions"), ['class' => 'col-3 control-label text-right']) !!}
    <div class="col-9">
        {!! Form::text('commissions', null,  ['class' => 'form-control','placeholder'=>  trans("lang.app_setting_commissions")]) !!}
        <div class="form-text text-muted">
            {{ trans("lang.app_setting_commissions") }} %
        </div>
    </div>
</div>
@endif
@endif
@endhasanyrole

@hasanyrole('manager')
<div class="form-group row ">
    {!! Form::label('commissions', trans("lang.app_setting_commissions"), ['class' => 'col-3 control-label text-right']) !!}
    <div class="col-9">
        {!! Form::text('commissions', null,  ['class' => 'form-control','placeholder'=>  trans("lang.app_setting_commissions"), 'readonly']) !!}
        <div class="form-text text-muted">
            {{ trans("lang.app_setting_commissions") }} %
        </div>
    </div>
</div>
@endhasanyrole

<!-- Submit Field -->
<div class="form-group col-12 text-right">
    <button type="submit" class="btn btn-{{setting('theme_color')}}"><i class="fa fa-save"></i> {{trans('lang.save')}} {{trans('lang.user')}}</button>
    <a href="{!! route('users.index') !!}" class="btn btn-default"><i class="fa fa-undo"></i> {{trans('lang.cancel')}}</a>
</div>
