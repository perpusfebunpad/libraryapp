<div class="flex justify-center my-6">
  <ul class="inline-flex -space-x-px text-sm">
    @if($current_page - 1 > 0)
    <li>
      <a href="?page={{ $current_page - 1 }}" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700"> << </a>
    </li>
    @endif

    @for($i = $first_link; $i <= $last_link; $i++)
    @if($i == $current_page)
    <li>
      <a href="?page={{$i}}" aria-current="page" class="flex items-center justify-center px-3 h-8 text-blue-600 border border-gray-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700">{{ $i }}</a>
    </li>
    @else
    <li>
      <a href="?page={{$i}}" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700">{{ $i }}</a>
    </li>
    @endif
    @endfor

    @if($current_page + 1 <= $total_pages)
    <li>
      <a href="?page={{ $current_page + 1 }}" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700"> >> </a>
    </li>
    @endif
  </ul>
</div>