        @php
            if(\App\Models\User::find($node['source_user_id'])->name  == 'admin'){
                $user = 'موقع الساعي';
            }else{
                $user = \App\Models\User::find($node['source_user_id'])->name ;
            }
        @endphp
@if($user == 'موقع الساعي')
    <div class="node-box winner">
        <span class="node-level">
            <!--رقم الجهه: -->
            {{ $node['current_level'] }}
        </span>
        <span>
            {{ $user ?? 'غير معروف' }} 
        </span>
    </div>
@else
<li>
    <div class="node-box">
        <span class="node-level">
            <!--رقم الجهه: -->
            {{ $node['current_level'] }}
        </span>
        <span>
            {{ $user ?? 'غير معروف' }} 
        </span>
    <!--ساعي: -->
    
    {{--@if(auth('admin')->user() && $node['current_level'] > 1)
        @lang('main.products.method') : {{__('main.products.'.$node['method'])}}
    @endif--}}
    </div>

    @if (!empty($node['children']))
        <ul>
            @foreach ($node['children'] as $child)
                @include('site.includes.delegation-node', ['node' => $child])
            @endforeach
        </ul>
    @endif
</li>
@endif