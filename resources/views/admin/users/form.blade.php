
@if(request()->route()->getName() == 'users.edit')
<input type="number" name="user_id" value="{{ $user->id }}" class="form-control" hidden>
@endif
<input type="hidden" name="account_type" value="{{request('account_type')}}">
<input type="hidden" name="added_by" value="{{auth('admin')->user()->id}}">
<div class="card">
            <div class="card-header">
                <h4 class="card-title">المعلومات الشخصية</h4>
            </div> 
            <div class="card-body">
                <div class="row gy-3">
        
                    @if(! request('pending_vendor'))
                    <div class="col-7 col-lg-auto">
                        <div class="box-wrapper">
                            <label for="photo_profile" class="form-label">@lang('main.users.photo_profile')</label>
                            <div class="box">
                                <div class="js--image-preview">
                                    @if($user->getFirstMediaUrl('photo_profile','thumb'))
                                        <img src="{{$user->getFirstMediaUrl('photo_profile','thumb')}}">
                                    @endif
                                </div>
                                <div class="upload-options">
                                    <label>
                                        <input type="file" id="photo_profile" name="photo_profile" class="image-upload" accept="image/*" />
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="m-0 col-lg-6"></div>
                    @endif
                    <div class="col-md-6">
                        <label for="name"> @lang('main.'.request('account_type').'.name')</label><span class="text-danger">*</span>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}"
                            class="form-control  @error('name') is-invalid @enderror" id="name" placeholder="@lang('main.users.name')">
                    </div>
                    <div class="col-md-6">
                        <label for="mobile"> @lang('main.'.request('account_type').'.mobile')</label><span class="text-danger">*</span>
                        <input type="text" maxlength="10" name ="mobile" value="{{ old('mobile', $user->mobile) }}"
                            class="form-control  @error('mobile') is-invalid @enderror" id="mobile" placeholder="@lang('main.users.mobile')">
                    </div>
                    @if(request('account_type') == 'admins')
                    <div class="col-md-6">
                        <label for="email"> @lang('main.'.request('account_type').'.email')</label>
                        @if(request('account_type') != 'users')
                        <span class="text-danger">*</span>
                        @endif
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control @error('email') is-invalid @enderror"
                            id="email" placeholder="@lang('main.users.email')">
                    </div>
                    @endif
        
                
                    @if(request('account_type') == 'admins')
                    @if($user->id != 1)
                        <div class="col-md-6">
                            <label for="roles_name">@lang('main.AdminRole')</label><span class="text-danger">*</span>
                            <select name="roles_name[0]" class="form-control @error('roles_name') is-invalid @enderror" required>
                                <option value="">@lang('main.SelecteAdminRole')</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}"
                                        {{ isset($userRole) && $role->name == $userRole ? 'selected' : '' }}>{{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @endif
                    
        
                    @elseif(request('account_type') == 'users')
                    <input type="hidden" name="roles_name[0]" value="user"/>
                    @elseif(request('account_type') == 'vendors')
                    <input type="hidden" name="roles_name[0]" value="vendor"/>
                    @elseif(request('account_type') == 'subadmins')
                    <input type="hidden" name="roles_name[0]" value="subadmin"/>
                    <input type="hidden" readonly name="parent_id" value="{{auth('admin')->user()->id}}"/>
        
                    @endif
        
                    @if(!(request('account_type') == 'admins' && isset($user) && $user->id == 1))
                    <div class="col-md-6">
                        <label for="password"> @lang('main.password')</label><span class="text-danger">*</span>
                        <div class="input-group">
                            <input type="password" name="password" value=""
                                class="form-control @error('password') is-invalid @enderror" id="password"
                                placeholder="@lang('main.users.password')">
                            <button type="button" class="pass input-group-text" toggle="#password">
                                <i class="bi bi-lock"></i>
                            </button>
                        </div>
                    </div>
                    @endif
                    {{--@if(request('account_type') == 'users')
                    <div class="col-md-6">
                        <label for="user_type">@lang('main.users.user_type')</label><span class="text-danger">*</span>
                        <select name="user_type" class="form-select @error('user_type') is-invalid @enderror" required>
                            <option value="">@lang('main.users.SelectUser_type')</option>
                            <option value="owner"
                            {{ $user->user_type == 'owner' ? 'selected' : '' }}>
                            @lang('main.products.owner')
                            </option>
                            <option value="agent"
                            {{ $user->user_type == 'agent' ? 'selected' : '' }}>
                            @lang('main.products.agent')
                            </option>
                            <option value="co-owner"
                            {{ $user->user_type == 'co-owner' ? 'selected' : '' }}>
                            @lang('main.products.co-owner')
                            </option>
                            <option value="other"
                            {{ $user->user_type == 'other' ? 'selected' : '' }}>
                            @lang('main.products.other')
                            </option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="id_number"> @lang('main.users.id_number')</label><span class="text-danger">*</span>
                        <div class="input-group">
                            <input type="number" maxlength="10" pattern="[1-2][0-9]{9}" name="id_number" value=""
                                class="form-control @error('id_number') is-invalid @enderror" id="id_number"
                                placeholder="@lang('main.users.id_number')">
                        </div>
                    </div>

                    <div class="col-md-6" id="agency_number_wrapper" style="display: {{ $user->user_type == 'agent' ? 'block' : 'none' }}">
                        <label for="agency_number"> @lang('main.users.agency_number')</label><span class="text-danger">*</span>
                        <div class="input-group">
                            <input type="number" maxlength="10" pattern="[1-2][0-9]{9}" name="agency_number" value=""
                                class="form-control @error('agency_number') is-invalid @enderror" id="agency_number"
                                placeholder="@lang('main.users.agency_number')">
                        </div>
                    </div>
                    @endif --}}
                    
                    
                </div>
        
                <div class="order-action mt-3 d-flex gap-3">                
                    <button type="submit" class="btn btn-primary px-5 shadow-sm"><i class="fa-regular fa-floppy-disk"></i> @lang('main.save')</button>
                </div>
            </div>
        </div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        let userTypeSelect = document.querySelector('[name="user_type"]');
        let agencyWrapper = document.getElementById('agency_number_wrapper');
        function toggleAgencyField() {
            if (userTypeSelect.value === 'agent') {
                agencyWrapper.style.display = 'block';
            } else {
                agencyWrapper.style.display = 'none';
            }
        }
        toggleAgencyField();
        userTypeSelect.addEventListener('change', toggleAgencyField);
    });
</script>

