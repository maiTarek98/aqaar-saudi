@if(count($sales) > 0)
<div class="card">
    <div class="card-header">
        <p class="m-0">
            <span>
                {{__('main.'.$period)}}
            </span>
        </p>
    </div>
    <div class="card-body">
        <table class="table mb-0 tbl-server-info text-center">
                    <thead>
                        <tr>
                            <th class="py-3 px-4 border">اسم العميل</th>
                            @foreach ($categories as $category)
                                <th class="py-3 px-4 border">{{ \App\Models\Category::where('id',$category)->first()->value('title_'.\App::getLocale() ) }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sales as $item)
                        <tr>
                            <td class="py-3 px-4 border">{{ $item['name'] }}</td>
                            @foreach ($categories as $category)
                                <td class="py-3 px-4 border">{{ $item['categories'][$category] }}</td>
                            @endforeach
                        </tr>
                        @endforeach
                    </tbody>
                </table>
    </div>
</div>
@else
    <img>
    @lang('main.no recent result')
@endif