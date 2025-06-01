<ul>
    <li>
        <div class="node-box">
            User ID: {{ $node['source_user_id'] }}<br>
            Level: {{ $node['current_level'] }}<br>
            ID: {{ $node['id'] }}
        </div>

        @if (!empty($node['children']))
            @foreach ($node['children'] as $child)
                @include('admin.products._tree_node', ['node' => $child])
            @endforeach
        @endif
    </li>
</ul>
