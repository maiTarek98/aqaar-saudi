                <!--card for owner of aqaar-->
                <div class="card user-card mt-4 mx-0 border-0 {{$property->feature?->represented_by}}">
                    <div class="card-body py-4 gap-3">
                        <div class="row align-items-center py-3 gy-3">
                            <div class="col-12">
                                <h6 class="user-name text-center">
                                    <b>رقم العرض {{$property->listing_number}}</b>
                                    <b style="float:inline-end;">{{$property->admin?->access_link?->current_level}}</b>
                                </h6>
                            </div>
                            <div class="col-4">
                                <b class="d-block">
                                    الاسم/ {{explode(' ', trim($property->admin?->name))[0] }}
                                </b>
                                <b class="d-block">
                                    @if($property->feature?->represented_by == 'owner')
                                    {{__('main.users.sak_number')}}
                                    <br/>
                                    {{$property->feature?->sak_number}}
                                    @elseif($property->feature?->represented_by == 'agent')
                                    {{__('main.users.agency_number')}}
                                    <br/>
                                    {{$property->feature?->agency_number}}
                                    @else
                                    {{__('main.users.val_number')}}
                                    <br/>
                                    {{$property->feature?->val_number}}
                                    @endif
                                </b>
                            </div>
                            
                            <div class="col-4">
                                <div class="user-img">
                                    @if($property->access_links->where('source_user_id', auth('web')->user()->id)->isNotEmpty())
                                        @php $link = $property->access_links->where('source_user_id', auth('web')->user()->id)->first(); 
                                                $url = url('verify-property/'.$link->token.'?source=external&ref='.$link->current_level);
                                                $qrCode_v = \SimpleSoftwareIO\QrCode\Facades\QrCode::size(200)->generate($url);
                                        @endphp
                                        {!! $qrCode_v !!}
                                    @endif
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="d-flex align-items-center gap-2">
                                    <b> الصفة </b>
                                    <span> {{__('main.products.'.$property->feature?->represented_by)}}</span>
                                </div>
                                <div class="d-flex align-items-center gap-2">
                                    <b> نوع العرض </b>
                                    <span>{{__('main.products.'.$property->type)}}</span>
                                </div>
                                @if($property->start_date)
                                <div class="d-flex align-items-center gap-2">
                                    <b> من تاريخ </b>
                                    <span>{{$property->start_date}}</span>
                                </div>
                                @endif
                                @if($property->end_date)
                                <div class="d-flex align-items-center gap-2">
                                    <b> الى تاريخ </b>
                                    <span>{{$property->end_date}}</span>
                                </div>
                                @endif
                            </div>
                            {{--
                            <div class="copy-text">
                                <input type="text" class="text" value="{{$url}}">
                                <button><i class="fa fa-clone"></i></button>
                            </div>
                             --}}
                        </div>
                        {{--
                        <div class="row align-items-center justify-content-between py-3 gy-2">
                            <div class="col-12">
                                <h6 class="user-name text-center">
                                    رقم العرض {{$property->listing_number}}
                                </h6>
                            </div>
                            <div class="col-6">
                                <div class="d-flex align-items-center gap-2">
                                  <b> الاسم</b>
                                  <span> {{explode(' ', trim($property->admin?->name))[0] }} </span>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="d-flex align-items-center gap-2">
                                  <b> الصفة </b>
                                  <span>{{__('main.products.'.$property->feature?->represented_by)}}</span>
                                </div>
                            </div>
                            <div class="col-4">
                                <b class="d-block mb-4">
                                    رخصة  رقم
                                    {{$property->admin?->val_license?? 'لا يوجد رخصة'}}
                                </b>
                                @if($property->start_date)
                                <div class="d-flex align-items-center gap-2">
                                  <b> من تاريخ </b>
                                  <span>{{$property->start_date}}</span>
                                </div>
                                @endif
                            </div>
                            <div class="col-4">
                                <div class="user-img">
                                    @php $link = $property->access_links->where('source_user_id', auth('web')->user()->id)->first(); 
                                            $url = url('verify-property/'.$link->token.'?source=external&ref='.$link->current_level);
                                            $qrCode = \SimpleSoftwareIO\QrCode\Facades\QrCode::size(200)->generate($url);
                                    @endphp
                                    <div class="copy-text flex-column">
                                          <input type="text" class="text" value="{{$url}}" style="opacity: 0;margin-bottom: -18px;">
                                          <button>
                                            <div class="user-img">
                                                {!! $qrCode !!}
                                            </div>
                                          </button>
                                    </div>
                                </div>
                            </div>    
                            <div class="col-4">
                                <b class="d-block mb-4">
                                    نوع العرض 
                                    {{__('main.products.'.$property->type)}}
                                </b>
                                @if($property->end_date)
                                <div class="d-flex align-items-center gap-2">
                                  <b> الى تاريخ </b>
                                  <span>{{$property->end_date}}</span>
                                </div>
                                @endif
                            </div>
                        </div>
                        --}}
                    </div>
                </div>
                
                    @if(auth('web')->user()->id != $property->added_by || auth('web')->user()->delegatedForProduct($property->id)->exists())
                    @if($property->access_links->where('source_user_id', auth('web')->user()->id)->isNotEmpty())
                    @php $link = $property->access_links->where('source_user_id', auth('web')->user()->id)->first(); 
                    @endphp
                    @else
                    @php $link = null;
                    @endphp
                    @endif
                <!--card for verified of aqaar-->
                <div class="card user-card mt-4 mx-0 border-0 {{auth('web')->user()->user_type}}">
                    <div class="card-body py-4 gap-3">
                        
                        <div class="row align-items-center justify-content-between py-3 gy-2">
                            <div class="col-12">
                                @if($link)
                                <h6 style="direction:ltr">
                                    {{$link->current_level}}
                                </h6>
                                @endif
                                <h6 class="user-name text-center">
                                    رقم العرض {{$property->listing_number}}
                                </h6>
                            </div>
                            <div class="col-6">
                                <div class="d-flex align-items-center gap-2">
                                  <b> الاسم</b>
                                  <span> {{explode(' ', trim(auth('web')->user()->name))[0] }} </span>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="d-flex align-items-center gap-2">
                                  <b> الصفة </b>
                                  <span>{{__('main.products.'.auth('web')->user()->user_type)}}</span>
                                </div>
                            </div>
                            <div class="col-4">
                                <b class="d-block mb-4">
                                    رخصة  رقم
                                    {{$property->admin?->val_license?? 'لا يوجد رخصة'}}
                                </b>
                                @if($property->start_date)
                                <div class="d-flex align-items-center gap-2">
                                  <b> من تاريخ </b>
                                  <span>{{$property->start_date}}</span>
                                </div>
                                @endif
                            </div>
                            <div class="col-4">
                                <div class="user-img">
                                    @if($property->access_links->where('source_user_id', auth('web')->user()->id)->isNotEmpty())
                                    @php $link = $property->access_links->where('source_user_id', auth('web')->user()->id)->first(); 
                                            $url = url('verify-property/'.$link->token.'?source=external&ref='.$link->current_level);
                                            $qrCode = \SimpleSoftwareIO\QrCode\Facades\QrCode::size(200)->generate($url);
                                    @endphp
                                        {{--<input type="text" class="text" value="{{url('verify-property/'.$link->token.'?source=external&ref='.$link->current_level)}}">--}}
                                    <div class="copy-text flex-column">
                                          <input type="text" class="text" value="{{$url}}" style="opacity: 0;margin-bottom: -18px;">
                                          <button>
                                            <div class="user-img">
                                                {!! $qrCode !!}
                                            </div>
                                          </button>
                                        </div>
                                    @elseif($property->private_links)
                                    @foreach($property->private_links as $key => $val)
                                    <div class="private-link col-md-10">
                                     @php $numbers = json_decode($property->phone_numbers, true); 
                                      $url = url('private-property/'.$val->token.'?source=external');
                                            $qrCode = \SimpleSoftwareIO\QrCode\Facades\QrCode::size(200)->generate($url);
                                    @endphp
                                      {{$numbers[$key]}}
                                        {{--<input type="text" class="text" value="{{url('private-property/'.$val->token.'?source=external')}}">--}}
                                        {!! $qrCode !!}
                                    @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="col-4">
                                <b class="d-block mb-4">
                                    نوع العرض 
                                     {{__('main.products.'.$property->type)}}
                                </b>
                                @if($property->end_date)
                                <div class="d-flex align-items-center gap-2">
                                  <b> الى تاريخ </b>
                                  <span>{{$property->end_date}}</span>
                                </div>
                                @endif
                            </div>
                        </div>
                        
                        
                        {{--<p class="card-title fw-bold px-3 fs-4">
                          معلومات عن مالك العقار
                        </p>
                        <table class="table bg-transparent m-0">
                          <tbody>
                            <tr>
                              <td>
                                <div class="d-flex align-items-center gap-4">
                                  <b> نشر العقار بواسطة </b>
                                  <span>{{__('main.products.'.$property->feature?->represented_by)}}</span>
                                </div>
                              </td>
                              <td>
                                <div class="d-flex align-items-center gap-4">
                                  <b> رقم العرض </b>
                                  <span>{{$property->listing_number}}</span>
                                </div>
    
                              </td>
                            </tr>
                          </tbody>
                        </table>
                        @if($property->access_links->where('source_user_id', auth('web')->user()->id)->isNotEmpty())
                        @php $link = $property->access_links->where('source_user_id', auth('web')->user()->id)->first(); @endphp
    
                        <div class="private-link col-md-10">
                          <div class="copy-text">
                            <input type="text" class="text" value="{{url('verify-property/'.$link->token.'?source=external&ref='.$link->current_level)}}">
                            <button><i class="fa fa-clone"></i></button>
                          </div>
                        </div>
                        <div class="estate-qr col-lg-2 col-md-3 col-4 m-auto">
                          <img src="{{ asset('storage/qr_codes/qr_' . $property->id . '.png') }}" alt="QR Code for Product {{ $property->id }}" class="w-100">
                        </div>
                        @elseif($property->private_links)
                        @foreach($property->private_links as $key => $val)
                        <div class="private-link col-md-10">
                         @php $numbers = json_decode($property->phone_numbers, true); @endphp
                          {{$numbers[$key]}}
                          <div class="copy-text">
                            <input type="text" class="text" value="{{url('private-property/'.$val->token.'?source=external')}}">
                            <button><i class="fa fa-clone"></i></button>
                          </div>
                        </div>
                        <div class="estate-qr col-lg-2 col-md-3 col-4 m-auto">
                          <img src="{{ asset('storage/qr_codes/qr_' . $property->id .'_'. $key.'.png') }}" alt="QR Code for Product {{ $property->id }}" class="w-100">
                        </div>
                        @endforeach
                        @endif
                        <div class="qr-screens">
                          <div class="row row-cols-lg-6">
                            <div class="col text-center">
                              <img src="images/qr.png" alt="" />
                            </div>
                            <div class="col text-center">
                              <img src="images/qr.png" alt="" />
                            </div>
                          </div>
                        </div>--}}
                    </div>
                </div>
                @endif

                
                
                
                
              </div>
