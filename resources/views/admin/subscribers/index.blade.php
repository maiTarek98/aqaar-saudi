@extends('admin.index')
@push('custom-css')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endpush
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                {{-- search part --}}
                @include('admin.partials.breadcrumb')
                
            </div>
            <div class="content">
                @include('admin.partials.search_part', ['route' => route($model.'.index')])
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            النشرة البريدية
                            <b>({{$result->total()}})</b>
                        </h3>
                        @can($model.'-delete')
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-outline-primary send_email_all" data-bs-toggle="modal" data-bs-target="#exampleModalSend">
                              @lang('main.subscribers.send email for all subscribers')
                            </button>
                            @include('admin.partials.button_group', [
                            'url' => route($model.'.deleteAll'),
                            ])
                        </div>
                        @endcan
                    </div>
                    <div class="card-body px-0">
                        <div id="crud-table-container">
                            <x-crud-table :result="$result" :fields="$fields" :model="$model" :queryParameters="$queryParameters"/>
                        </div>         
                    </div>         
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="exampleModalSend" tabindex="-1" aria-labelledby="exampleModalSendLabel" role="dialog">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <form method="post" action="{{route('sendSubscriberEmail')}}">
                      @csrf
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalSendLabel">@lang('main.subscribers.send email for all subscribers')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <input type="hidden" class="selected_val" name="ids" value="">
                      <label for="ckeditor">@lang('main.send message')</label>
                      <textarea class="summernote" required name="message" id="ckeditor"></textarea>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                  </div>
                  </form>
                </div>
              </div>
            </div>
        </div>
    </div>
@endsection