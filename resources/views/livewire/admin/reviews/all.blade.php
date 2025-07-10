<div>
    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <table class="min-w-full text-left text-sm font-light">
                        <thead class="border-b font-medium dark:border-neutral-500">
                            <tr>
                                <th scope="col" class="px-6 py-4">ID</th>
                                <th scope="col" class="px-6 py-4">User</th>
                                <th scope="col" class="px-6 py-4">Event Package Name</th>
                                <th scope="col" class="px-6 py-4">Rating</th>
                                <th scope="col" class="px-6 py-4">Comment</th>
                                <th scope="col" class="px-6 py-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($reviews as $review)
                                <tr class="border-b dark:border-neutral-500">
                                    <td class="px-6 py-4">{{ $review->id }}</td>
                                    <td class="px-6 py-4">aman</td>
                                    <td class="px-6 py-4">
                                        {{ optional($review->booking->eventPackage)->name ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4">{{ $review->rating }}</td>
                                    <td class="px-6 py-4">{{ $review->comment }}</td>
                                    <td class="px-6 py-4">
                                        <button class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600"
                                                wire:click="">
                                            Approve
                                        </button>
                                        <button class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600"
                                                wire:click="">
                                            Denied
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>