@extends('admin.index')
@push('custom-css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .progress_switch{
            transform: rotate(90deg);
            display: flex;
            width: 105px;
        }
        .day_name{
            width: 130px;
            position: relative;
            transform: rotate(90deg);
            right: 33px;
            top: 56px;
        }
    </style>
@endpush
@section('content')
 <div class="content-page">
<div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                @include('admin.partials.breadcrumb', ['currentRoute' => route('products.index'), 'newRoute' => null])
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body row">
                        <div class="col-lg-8 row">
                            <div class="col-lg-3">5 star </div>
                        <div class="col-lg-7">
                        <div class="progress mb-3 mt-2">
                            <div class="progress-bar" role="progressbar" style="width: {{count($product_reviews->where('star',5))}}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                         </div> </div><div class="col-lg-2">{{count($product_reviews->where('star',5))}}</div>

                            <div class="col-lg-3">4 star </div>
                         <div class="col-lg-7">
                         <div class="progress mb-3 mt-2">
                            <div class="progress-bar" role="progressbar" style="width: {{count($product_reviews->where('star',4)) }}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div></div>
                         </div><div class="col-lg-2">{{count($product_reviews->where('star',4))}} </div>
                            <div class="col-lg-3">3 star </div>
                         <div class="col-lg-7">
                         <div class="progress mb-3 mt-2">
                            <div class="progress-bar" role="progressbar" style="width: {{count($product_reviews->where('star',3))}}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div></div>
                         </div><div class="col-lg-2">{{count($product_reviews->where('star',3))}} </div>
                            <div class="col-lg-3">2 star </div>
                         <div class="col-lg-7">
                         <div class="progress mb-3 mt-2">
                            <div class="progress-bar" role="progressbar" style="width: {{count($product_reviews->where('star',2))}}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div></div>
                         </div><div class="col-lg-2">{{count($product_reviews->where('star',2))}} </div>
                            <div class="col-lg-3">1 star </div>
                         <div class="col-lg-7">
                         <div class="progress mb-3 mt-2">
                            <div class="progress-bar" role="progressbar" style="width: {{count($product_reviews->where('star',1))}}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div></div>
                         </div><div class="col-lg-2">{{count($product_reviews->where('star',1))}} </div>
                        </div>

                        <div class="col-lg-4" style="border-right: 1px solid;">
                            <div>
                                <div class="mt-4 mb-2" style="font-size:35px;">{{$product_reviews->avg('star')}}
                                <i class="fa fa-star"></i></div>
                                <div>
                                    @lang('main.total reviews') :
                                    <span>{{count($product_reviews)}}</span>
                                </div>
                            </div>
                            <p class="mt-4">@lang('main.All reviews are from genuine customers')</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card" style="height: 242px;">
                    <div class="card-body row">
                        <div class="col-lg-8 row">
                            @for($i=1;$i<=7;$i++)
                            <div class="col-lg-1">
                                <div class="progress progress_switch mb-3 mt-5 me-5">
                                <div class="progress-bar" role="progressbar" style="width:
                                   {{\App\Models\ProductReview::whereDate('created_at', \Carbon\Carbon::now()->subDays($i)->format('Y-m-d'))->count()}}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            <div class="day_name mt-5">{{\Carbon\Carbon::now()->subDays($i)->format('Y-m-d')}}
                            </div>
                            </div>

         
                        @endfor
                        </div>
                        <div class="col-lg-4">
                            <p>@lang('main.Reviews statistics of this week')</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="table-responsive rounded mb-3">
                    @can('product-delete')
                            <div class="btn-group flex-wrap float-left mb-4">
                                @include('admin.partials.button_group', [
                                    'url' => url('admin/product_reviewsDeleteAll'),
                                ])
                            </div>
                            @endcan
                            {{-- search part --}}
                            <div class="float-right mb-4">
                                @include('admin.partials.search_part', ['route' => route('products.index')])
                            </div>
                <table class="data-table table mb-0 tbl-server-info">
                    <thead class="bg-white text-uppercase">
                        <tr class="ligth ligth-data">
                            <th width="50px"><input type="checkbox" id="master"></th>
                            <th>#</th>
                            <th>@lang('main.product_name')</th>
                            <th>@lang('main.product_rating')</th>
                            <th>@lang('main.product_review')</th>
                            <th>@lang('main.status')</th>
                            <th>@lang('main.createdAt')</th>
                            <th>@lang('main.actions')</th>
                        </tr>
                    </thead>
                    <tbody class="ligth-body">
                        @forelse ($product_reviews as $product_review)
                                        <tr>
                                            <td><input type="checkbox" class="sub_chk" data-id="{{ $product_review->id }}"></td>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $product_review->product?->name }}</td>
                                            <td>{{ $product_review->star }} <i class="fa fa-star"></i></td>
                                            <td>{{ $product_review->review }}</td>
                                            <td>          
                                                <form method="post" action="{{route('product_reviews.toggleStatus',$product_review->id)}}"> @csrf
                                                <input type="checkbox" onchange="this.form.submit()" class="cm-toggle" id="customSwitch-{{$product_review->id}}" name="status" @if($product_review->status == 'show') checked="" @endif>
                                                <label class="" for="customSwitch-{{$product_review->id}}">  {{__('main.'.$product_review->status)}}       
                                                </form>  
                                            </td>
                                            <td>{{ $product_review->created_at->diffForHumans() }}</td>
                                            <td width="250px">
                                                @can('product-delete')
                                                    {!! Form::open(['method' => 'DELETE', 'route' => ['product_reviews.destroy',$product_review->id], 'style' => 'display:inline']) !!}
                                                    <button type="submit" class="border-0 badge bg-warning me-2 show_confirm" data-toggle="tooltip" data-placement="top" title="" data-original-title="@lang('main.delete')"><i class="ri-delete-bin-line mr-0"></i></button>
                                                    {!! Form::close() !!}
                                                @endcan

                                            </td>
                                        </tr>
                                    @empty
                                        <td class="text-center text-muted" style="font-size: 25px" colspan="5">
                                            {{ trans('main.Noproduct_reviews') }}
                                        </td>
                                    @endforelse
                    </tbody>
                </table>
                                {{ $product_reviews->links() }}
            </div>
        </div>
    </div>
        <!-- Page end  -->
    </div>
    </div>
@endsection