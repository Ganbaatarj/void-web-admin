<div>
    <x-slot name="title">Ангилал</x-slot>

    @if (session('success'))
        <div class="mb-4 rounded bg-green-100 text-green-800 px-4 py-2">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex items-center justify-between gap-3 mb-4">
        <div class="flex items-center gap-2">
            <input
                type="text"
                wire:model.live.debounce.300ms="search"
                placeholder="Хайх..."
                class="border rounded px-3 py-2"
            />
            <select wire:model.live="perPage" class="border rounded px-2 py-2">
                <option value="5">5/хуудас</option>
                <option value="10">10/хуудас</option>
                <option value="25">25/хуудас</option>
            </select>
        </div>
        <button
            wire:click="openCreate"
            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
        >+ Нэмэх</button>
    </div>

    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="min-w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="text-left p-3">#</th>
                    <th class="text-left p-3">Нэр</th>
                    <th class="text-left p-3">Slug</th>
                    <th class="text-left p-3">Идэвхтэй</th>
                    <th class="text-left p-3">Төлөв</th>
                    <th class="text-right p-3">Үйлдэл</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $i => $cat)
                    <tr class="border-t">
                        <td class="p-3">{{ $categories->firstItem() + $i }}</td>
                        <td class="p-3 font-medium">{{ $cat->name }}</td>
                        <td class="p-3 text-gray-600">{{ $cat->slug }}</td>
                        <td class="p-3">
                            @if($cat->is_active)
                                <span class="px-2 py-1 text-xs rounded bg-green-100 text-green-700">Тийм</span>
                            @else
                                <span class="px-2 py-1 text-xs rounded bg-gray-200 text-gray-700">Үгүй</span>
                            @endif
                        </td>
                        <td class="p-3">
                            @if($cat->deleted_at)
                                <span class="px-2 py-1 text-xs rounded bg-red-100 text-red-700">Устгасан</span>
                            @else
                                <span class="px-2 py-1 text-xs rounded bg-blue-100 text-blue-700">Идэвхтэй</span>
                            @endif
                        </td>
                        <td class="p-3 text-right">
                            <div class="inline-flex gap-2">
                                <button
                                    wire:click="openEdit({{ $cat->id }})"
                                    class="px-3 py-1 rounded border hover:bg-gray-50"
                                >Засах</button>

                                @if($cat->deleted_at)
                                    <button
                                        wire:click="restore({{ $cat->id }})"
                                        class="px-3 py-1 rounded border text-green-700 hover:bg-green-50"
                                    >Сэргээх</button>
                                @else
                                    <button
                                        wire:click="confirmDelete({{ $cat->id }})"
                                        class="px-3 py-1 rounded border text-red-700 hover:bg-red-50"
                                    >Устгах</button>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach

                @if($categories->isEmpty())
                    <tr><td class="p-6 text-center text-gray-500" colspan="6">Мэдээлэл алга.</td></tr>
                @endif
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $categories->links() }}
    </div>

    {{-- Create/Edit Modal --}}
    @if($showModal)
        <div class="fixed inset-0 bg-black/40 flex items-center justify-center z-50">
            <div class="bg-white rounded-xl w-full max-w-lg p-6">
                <h3 class="text-lg font-semibold mb-4">
                    {{ $editingId ? 'Ангилал засах' : 'Ангилал нэмэх' }}
                </h3>

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm mb-1">Нэр <span class="text-red-500">*</span></label>
                        <input type="text" wire:model.defer="name" class="w-full border rounded px-3 py-2">
                        @error('name') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <label class="block text-sm mb-1">Тайлбар</label>
                        <textarea wire:model.defer="description" rows="3" class="w-full border rounded px-3 py-2"></textarea>
                        @error('description') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
                    </div>

                    <label class="inline-flex items-center gap-2">
                        <input type="checkbox" wire:model.defer="is_active" class="h-4 w-4">
                        <span>Идэвхтэй</span>
                    </label>
                </div>

                <div class="mt-6 flex items-center justify-end gap-2">
                    <button wire:click="$set('showModal', false)" class="px-4 py-2 rounded border">Болих</button>
                    <button wire:click="save" class="px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700">
                        Хадгалах
                    </button>
                </div>
            </div>
        </div>
    @endif

    {{-- Delete confirm --}}
    @if($confirmingDelete)
        <div class="fixed inset-0 bg-black/40 flex items-center justify-center z-50">
            <div class="bg-white rounded-xl w-full max-w-md p-6">
                <h3 class="text-lg font-semibold mb-3">Устгах уу?</h3>
                <p class="text-gray-600 mb-6">Энэ үйлдэл <b>soft delete</b> хийнэ. Дараа нь сэргээж болно.</p>
                <div class="flex justify-end gap-2">
                    <button wire:click="$set('confirmingDelete', false)" class="px-4 py-2 rounded border">Болих</button>
                    <button wire:click="delete" class="px-4 py-2 rounded bg-red-600 text-white hover:bg-red-700">
                        Устгах
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
