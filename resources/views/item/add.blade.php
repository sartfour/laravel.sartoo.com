<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Item') }}
        </h2>
    </x-slot>

    <div class="py-12">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			<div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">

				<form method="POST" action="{{ route('items.store') }}">

				<div class="mb-4">
						<label class="block text-gray-700 text-sm font-bold mb-2" for="name">Name</label>
						<input type="text" id="name" name="name" value="{{ old('name') }}" class="bg-gray-100 rounded border border-gray-400 leading-normal resize-none w-6/12 py-2 px-3 font-medium placeholder-gray-700 focus:outline-none focus:bg-white @error('singular_name') border-red-600 @enderror" />
						@error('name')
							<span class="text-red-600">{{ $message }}</span>
						@enderror
					</div>
					<div class="mb-6">
						<label class="block text-gray-700 text-sm font-bold mb-2" for="item_type">Item Type</label>
						<select class="form-control" name="item_type_id">
							<option value=""@if (old('item_type_id') == null) selected="selected" @endif></option>
						@foreach($itemTypes as $itemType)
							<option value="{{$itemType->id}}"@if (old('item_type_id') == $itemType->id) selected="selected" @endif>{{$itemType->singular_name}}</option>
						@endforeach
						</select>
						@error('item_type_id')
							<span class="text-red-600">{{ $message }}</span>
						@enderror
					</div>

					<div class="form-group">
						<button type="submit" name="update" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create Item</button>
					</div>
				{{ csrf_field() }}
				</form>
			</div>
		</div>
	</div>
</x-app-layout>
