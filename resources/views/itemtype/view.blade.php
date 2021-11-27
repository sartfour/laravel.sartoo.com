<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Item Type Information') }}
        </h2>
    </x-slot>

    <div class="py-12">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			<div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">

				<div class="flex">
					<div class="flex-auto text-2xl mb-4">Item Type:&nbsp; <b>{{$itemType->singular_name}} / {{$itemType->plural_name}}</b></div>
					<div class="text-xs text-gray-500 text-right"><i>created: {{$itemType->created_at}}<br />updated: {{$itemType->updated_at}}</i></div>
				</div>

				<table class="w-full text-md rounded mb-4">
					<thead>
					<tr class="border-b">
						<th class="text-left p-3 px-5">Items</th>
						<th class="text-left p-3 px-5">Actions</th>
						<th></th>
					</tr>
					</thead>
					<tbody>
					@forelse($items as $item)
						<tr class="border-b hover:bg-yellow-100">
							<td class="p-3 px-5">
								<a href="{{ route('items.show', [$item]) }}">{{$item->name}}</a>
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
					@empty
						<tr class="border-b hover:bg-yellow-100">
							<td class="p-3 px-5">
								<i>No items</i>
							</td>
							<td class="p-3 px-5">
							</td>
						</tr>
					@endforelse
					</tbody>
				</table>

				<table class="w-full text-md rounded mb-4">
					<thead>
					<tr class="border-b">
						<th class="text-left p-3 px-5">Lists</th>
						<th class="text-left p-3 px-5">Actions</th>
						<th></th>
					</tr>
					</thead>
					<tbody>
					@forelse($lists as $list)
						<tr class="border-b hover:bg-yellow-100">
							<td class="p-3 px-5">
								{{$list->full_title}}
							</td>

							@if (Auth::check())
							<td class="p-3 px-5">

								<a href="/list/{{$list->id}}" name="edit" class="mr-3 text-sm bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">Edit</a>
								<form action="/list/{{$list->id}}" class="inline-block">
									<button type="submit" name="delete" formmethod="POST" class="text-sm bg-red-500 hover:bg-red-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">Delete</button>
									{{ csrf_field() }}
								</form>
							</td>
							@endif
						</tr>
					@empty
						<tr class="border-b hover:bg-yellow-100">
							<td class="p-3 px-5">
								<i>No lists</i>
							</td>
							<td class="p-3 px-5">
							</td>
						</tr>
					@endforelse
					</tbody>
				</table>

			</div>
		</div>
	</div>
</x-app-layout>
