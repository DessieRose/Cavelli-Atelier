@props([
    'items'   => [],      // array of items to display
    'mode'    => 'material', // 'material' or 'color'
    'columns' => 2,       // number of grid columns (1–3)
    'columns2' => 2,      // number of columns for text section (1–3)
])

@php
    $gridCols = [
        1 => 'grid-cols-1',
        2 => 'grid-cols-2',
        3 => 'grid-cols-3',
    ][$columns] ?? 'grid-cols-2';

    $gridCols2 = [
        1 => 'grid-cols-1',
        2 => 'grid-cols-2',
        3 => 'grid-cols-3',
    ][$columns2] ?? 'grid-cols-2';

    $routeName = \Illuminate\Support\Str::plural($mode) . '.destroy';
@endphp

<div class="px-10 py-6">
    <div class="grid grid-col-1 lg:{{ $gridCols }} gap-6">
        @forelse ($items as $item)
            <div class="relative flex items-center bg-gray-100 border border-gray-200 rounded-2xl shadow-sm mb-4 p-6 gap-6">

                {{-- Thumbnail --}}
                @if ($mode === 'color')
                <div class="w-16 h-16 rounded-xl border border-gray-100 shadow-inner" 
                    style="{{ $mode === 'color' ? "background-color: {$item->hex_code};" : '#eee'}}">
                </div>
                
                @else
                <div class="w-16 h-16 rounded-xl border border-gray-100 shadow-inner" 
                    style="background-img: {{ $material->image ?? 'N/A' }}">
                </div>
                @endif

                <div class="h-12 border-l border-gray-100"></div>

                <div class="grid {{ $gridCols2 }} flex-grow gap-8">
                    
                    {{-- Name --}}
                    <div>
                        <p class="text-[10px] text-gray-400 uppercase font-black tracking-widest mb-1">
                            {{ $mode === 'color' ? 'Color Name' : 'Material Name' }}
                        </p>
                        <h1 class="font-bold text-gray-800 text-lg">{{ $item->name }}</h1>
                    </div>

                    {{-- Hex code (color mode only) --}}
                    @if ($mode === 'color')
                    <div>
                        <p class="text-[10px] text-gray-400 uppercase font-black tracking-widest mb-1">Hex Code</p>
                        <p class="text-gray-500 font-mono">{{ $item->hex_code }}</p>
                    </div>
                    @endif

                    {{-- Actions --}}
                    <div class="flex items-center justify-end gap-4">
                        <button href="" class="text-gray-400 hover:text-[#8eb88e] transition-colors cursor-pointer">
                            <p class="text-[10px] text-gray-400 uppercase font-black tracking-widest mb-1">Edit</p>
                            <i class="fa fa-edit text-3xl"></i>
                        </button>
                        <form action="{{ route($routeName, $item['id']) }}" method="POST" onsubmit="return confirm('Delete this {{ $mode }}?')">
                            @csrf
                            @method('DELETE')
                            <button class="text-gray-400 hover:text-red-500 transition-colors cursor-pointer">
                                <p class="text-[10px] text-gray-400 uppercase font-black tracking-widest mb-1">Delete</p>
                                <i class="fa fa-trash text-3xl"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center p-20 bg-white rounded-2xl border border-gray-200 col-span-full">
                <p class="text-gray-500 italic">No {{$mode}}s found. Start by adding a new one!</p>
            </div>
        @endforelse
    </div>

    {{-- <div class="mt-6">
        {{ $mode->links() }}
    </div> --}}
</div>