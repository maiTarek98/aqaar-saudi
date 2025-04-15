@extends('admin.index')
@section('content')

    <style>
        .permissions-tree {
            list-style-type: none;
            padding-left: 0;
        }
        
        .permissions-tree li {
            margin: 5px 0;
            position: relative;
        }
        
        .permissions-tree .parent {
            font-weight: bold;
            color: var(--main);
            padding-left: 20px;
            cursor: pointer;
            font-size: large;
        }
        
        .permissions-tree .child {
            color: #555;
            padding-left: 30px;
        }
        
        .permissions-tree li > ul {
            padding-left: 20px;
            margin-top: 5px;
            display: none; /* Hide children by default */
        }
        
        .permissions-tree .parent:before {
            content: "\25BC"; /* Down triangle (▼) */
            font-size: 14px;
            color: var(--main);
            margin-inline-end: 6px;
            cursor: pointer;
        }
        
        .permissions-tree .child:before {
            content: "-"; /* (-) */
            margin-inline-end:8px;
        }
        
        .permissions-tree .parent.open > ul {
            display: block; /* Show children when parent is clicked */
        }
        
        .form-check-input {
            width: 1.25rem;
            height: 1.25rem;
            border-radius: 4px !important;
        }
        .form-check-input,
        .accordion-button{
            box-shadow: none !important;
        }
        .form-check-input:checked {
            border-color: var(--main);
            background-color: var(--main);
        }
        .form-check-input:disabled,
        .form-check-input:disabled~.form-check-label, .form-check-input[disabled]~.form-check-label {
            cursor: default;
            opacity: 1 !important;
        }

    </style>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
<div class="content-header">
                {{-- search part --}}
                @include('admin.partials.breadcrumb')
            </div>            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name"> @lang('main.RoleName')</label>
                                    <input type="text" name="name" value="{{ $role->name }}" class="form-control"
                                        id="name" readonly>
                                </div>
                                {{--<div class="form-group">
                                    <label for="roles">@lang('main.Permissions')</label>
                                    <br>
                                    @if (!empty($rolePermissions))
                                    <div class="permissions-tree">
                                        @php
                                            // إنشاء مصفوفة لتخزين الأبناء لكل أب
                                            $parentPermissions = [];
                                        @endphp

                                        @foreach ($rolePermissions as $v)
                                            @php
                                                // تقسيم اسم الإذن إلى parent و child
                                                $permissionParts = explode('-', $v->name);
                                                $parent = $permissionParts[0]; // الأب
                                                $child = $permissionParts[1] ?? null; // الابن (إذا كان موجودًا)
                                                
                                                // إضافة الإذن إلى المصفوفة بناءً على الأب
                                                if ($child) {
                                                    $parentPermissions[$parent][] = $v;
                                                } else {
                                                    $parentPermissions[$parent] = [];
                                                }
                                            @endphp
                                        @endforeach

                                        <!-- عرض الأذونات في شكل شجرة -->
                                        @foreach ($parentPermissions as $parent => $children)
                                            <ul class="my-3">
                                                <li class="parent open"><strong>{{ trans('permission.' . $parent) }}</strong></li>
                                                @if (!empty($children))
                                                    <ul class="ms-4">
                                                        @foreach ($children as $childPermission)
                                                            <li class="child">{{ trans('permission.' . $childPermission->name) }}</li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </ul>
                                        @endforeach
                                    </div>
                                    @endif
                                </div>--}}
                                
                                @php
                                    $parentPermissions = [];
                                
                                    foreach ($rolePermissions as $v) {
                                        $permissionParts = explode('-', $v->name);
                                        $parent = $permissionParts[0];
                                        $child = $permissionParts[1] ?? null;
                                
                                        if ($child) {
                                            $parentPermissions[$parent][] = $v;
                                        } else {
                                            if (!isset($parentPermissions[$parent])) {
                                                $parentPermissions[$parent] = [];
                                            }
                                        }
                                    }
                                
                                    // للحصول على جميع الصلاحيات
                                    $allPermissions = \Spatie\Permission\Models\Permission::all();
                                @endphp

                                <div class="accordion mt-4" id="permissionsAccordion">
                                    @php $i = 0; @endphp
                                    @foreach ($parentPermissions as $parent => $children)
                                        <div class="accordion-item mb-2 border-0">
                                            <h2 class="accordion-header bg-light px-3 d-flex align-items-center" id="heading-{{ $i }}">
                                                <button class="accordion-button bg-transparent pe-0 ps-2 text-dark"
                                                    type="button"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#collapse-{{ $i }}"
                                                    aria-expanded="true"
                                                    aria-controls="collapse-{{ $i }}">
                                                    <i class="fas fa-user-shield me-2"></i>
                                                    {{ trans('permission.' . $parent) }}
                                                </button>
                                            </h2>
                                
                                            <div id="collapse-{{ $i }}" class="accordion-collapse collapse show" aria-labelledby="heading-{{ $i }}">
                                                <div class="accordion-body">
                                                    <!-- Child Permissions -->
                                                    @foreach ($allPermissions as $perm)
                                                        @php
                                                            $permParts = explode('-', $perm->name);
                                                            $permParent = $permParts[0] ?? '';
                                                        @endphp
                                
                                                        @if ($permParent === $parent)
                                                            @php
                                                                $isChecked = in_array($perm->id, $rolePermissions->pluck('id')->toArray());
                                                            @endphp
                                
                                                            <div class="form-check mb-1">
                                                                <input type="checkbox"
                                                                    class="form-check-input position-relative m-0"
                                                                    disabled
                                                                    @if($isChecked) checked @endif>
                                
                                                                <label class="form-check-label ms-2 @if(!$isChecked) text-muted text-decoration-line-through @endif">
                                                                    {{ trans('permission.' . $perm->name) }}
                                                                </label>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        @php $i++; @endphp
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
