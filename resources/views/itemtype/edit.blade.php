<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Item Type') }}
        </h2>
    </x-slot>

    <div class="py-12">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			<div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">

				<form method="POST" action="{{ route('item-types.update', [$itemType]) }}">
					{{ method_field('PUT') }}

					<div class="mb-4">
						<label class="block text-gray-700 text-sm font-bold mb-2" for="singular_name">Singular Name</label>
						<input type="text" id="singular_name" name="singular_name" value="{{ old('singular_name', $itemType->singular_name) }}" class="bg-gray-100 rounded border border-gray-400 leading-normal resize-none w-6/12 py-2 px-3 font-medium placeholder-gray-700 focus:outline-none focus:bg-white @error('singular_name') border-red-600 @enderror" />
						@error('singular_name')
							<span class="text-red-600">{{ $message }}</span>
						@enderror
					</div>
					<div class="mb-6">
						<label class="block text-gray-700 text-sm font-bold mb-2" for="plural_name">Plural Name</label>
						<input type="text" id="plural_name" name="plural_name" value="{{ old('plural_name', $itemType->plural_name) }}" class="bg-gray-100 rounded border border-gray-400 leading-normal resize-none w-6/12 py-2 px-3 font-medium placeholder-gray-700 focus:outline-none focus:bg-white @error('plural_name') border-red-600 @enderror" />
						@error('plural_name')
							<span class="text-red-600">{{ $message }}</span>
						@enderror
					</div>

					<div class="form-group">
						<button type="submit" name="update" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update Item Type</button>
					</div>
				{{ csrf_field() }}
				</form>
			</div>
		</div>
	</div>
</x-app-layout>
