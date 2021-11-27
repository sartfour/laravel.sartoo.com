<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Item List') }}
        </h2>
    </x-slot>

    <div class="py-12">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			<div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
				@if (session('success'))
					<div class="mb-3">
						<span class="bg-green-400 text-left text-white py-2 px-4 rounded">{{ session('success') }}</span>
					</div>
				@endif

				<div class="flex">
					<div class="flex-auto text-2xl mb-4">Items</div>

					@if (Auth::check())
					<div class="flex-auto text-right mt-2">
						<a href="{{ route('items.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create new Item</a>
					</div>
					@endif
				</div>
				<table class="w-full text-md rounded mb-4">
					<thead>
					<tr class="border-b">
						<th class="text-left p-3 px-5">Item Type</th>
						<th class="text-left p-3 px-5">Item</th>
						<th class="text-left p-3 px-5">Actions</th>
						<th></th>
					</tr>
					</thead>
					<tbody>
					@foreach($items as $item)
						<tr class="border-b hover:bg-yellow-100">
							<td class="p-3 px-5">
								{{$item->itemType->singular_name}}
							</td>

							<td class="p-3 px-5">
								<a href="{{ route('items.show', [$item]) }}" class="text-blue-600 hover:text-pink-600">{{$item->name}}</a>
							</td>


							@if (Auth::check())
							<td class="p-3 px-5">

								<a href="{{ route('items.edit', [$item]) }}" name="edit" class="mr-3 text-sm bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">Edit</a>
								<form action="{{ route('items.destroy', [$item]) }}" class="inline-block">
									<button type="submit" name="delete" formmethod="POST" class="text-sm bg-red-500 hover:bg-red-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">Delete</button>
									{{ method_field('DELETE') }}
									{{ csrf_field() }}
								</form>
							</td>
							@endif
						</tr>
					@endforeach
					</tbody>
				</table>

			</div>
		</div>
	</div>
</x-app-layout>
