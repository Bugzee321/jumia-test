@if ($paginator->hasPages())
    <nav>
        <ul class="pagination">
            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                    @endforeach
                @endif
            @endforeach
        </ul>
    </nav>
@endif
