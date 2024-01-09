<div class="overflow-auto w-screen-p-6-sm:px-20-bg-white-border-b-border-gray-200">
    <div class="pl-6 mt-8 text-2xl flex justify-between">
        <div class="pr-6 mr-2">
            <div class="flex justify-center p-6 mt-6">
                <table class="table-auto w-full">
                <thead>
                    <tr>
                        <th class="px-4 py-2">
                            <div class="flex-expertises-center text-sm">NO</div>
                        </th>
                        <th class="px-4 py-2">
                            <div class="flex-expertises-center text-sm">NAME</div>
                        </th>
                        <th class="px-4 py-2">
                            <div class="flex-expertises-center text-sm">EXPERTISE</div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($expertises as $index => $expertise)
                        @unless ($index > 0 && $expertise->supervisor->id === $expertises[$index - 1]->supervisor->id)
                            <tr>
                                <td class="border px-4 py-2 text-sm">{{ $index + 1 }}</td>
                                <td class="border px-4 py-2 text-sm">{{ $expertise->supervisor->user->name }}</td>
                                <td class="border px-4 py-2 text-sm">
                                    {{ implode(', ', $expertise->supervisor->expertises->pluck('expertise')->toArray()) }}
                                </td>
                                <!-- <td class="border px-4 py-2">
                                    <x-button wire:click="confirmBookSupervisor" class="bg-green-500 hover:bg-green-600">Book</x-button>
                                </td> -->
                            </tr>
                        @endunless
                    @endforeach
                </tbody>
            </table>
        </div>
        </div>
    </div>

    <x-dialog-modal wire:model.live="confirmingExpertiseView">
        <x-slot name="title">
            {{ __('Expertise Detail') }}
        </x-slot>

        <x-slot name="content">
            <table class="table-auto w-full">
                <thead>
                    <tr>
                        <th class="px-4 py-2">
                            <div class="flex-expertises-center text-sm">NO</div>
                        </th>
                        <th class="px-4 py-2">
                            <div class="flex-expertises-center text-sm">NAME</div>
                        </th>
                        <th class="px-4 py-2">
                            <div class="flex-expertises-center text-sm">EXPERTISE</div>
                        </th>
                        <th class="px-4 py-2">
                            <div class="flex-expertises-center text-sm">LEVEL</div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($expertises as $index => $expertise)
                        <tr>
                            <td class="border px-4 py-2 text-sm">{{ $index + 1 }}</td>
                            <td class="border px-4 py-2 text-sm">{{ $expertise->expertise }}</td>
                            <td class="border px-4 py-2 text-sm">{{ $expertise->description }}</td>
                            <td class="border px-4 py-2 text-sm">{{ $expertise->level }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('confirmingExpertiseView', false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>
        </x-slot>
    </x-dialog-modal>
</div>
