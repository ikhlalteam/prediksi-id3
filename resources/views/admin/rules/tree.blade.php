<ul class="list-disc ml-6 text-gray-800">
    @foreach ($node as $key => $value)
        @if (is_array($value))
            <li class="mb-1">
                <span class="font-semibold">{{ $key }}:</span>
                @include('admin.rules.tree', ['node' => $value])
            </li>
        @else
            <li><span class="font-semibold">{{ $key }}:</span> <span class="text-blue-700">{{ $value }}</span></li>
        @endif
    @endforeach
</ul>
