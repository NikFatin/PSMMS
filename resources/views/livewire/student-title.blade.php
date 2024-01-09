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
                                <div class="flex-expertises-center text-sm">TITLE</div>
                            </th>
                            <th class="px-4 py-2">
                                <div class="flex-expertises-center text-sm">DESCRIPTION</div>
                            </th>
                            <th class="px-4 py-2">
                                <div class="flex-expertises-center">ACTION</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($titles as $index => $title)
                            <tr>
                                <td class="border px-4 py-2 text-sm">{{ $index + 1}}</td>
                                <td class="border px-4 py-2 text-sm">{{ $title->title }}</td>
                                <td class="border px-4 py-2 text-sm">
                                    @php
                                        $limitedDescription = Str::words($title->description, 20);
                                    @endphp
                                    {{ $limitedDescription }}

                                    @if (str_word_count($title->description) > 20)
                                        <a class="text-blue-500 hover:underline ml-2 text-sm" wire:click="showFullDescription('{{ $title->id }}')">See More</a>
                                    @endif
                                </td>

                                <td class="border px-4 py-2">
                                <x-button wire:click="requestTitle({{ $title->id }})" class="bg-blue-500 hover:bg-blue-600">Request</x-button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <x-dialog-modal wire:model.live="confirmingShowFullDescription">
        <x-slot name="title" class="text-sm">
            {{ $selectedTitle }}
        </x-slot>

        <x-slot name="content" class="text-sm">
            {{ $selectedDescription }}
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('confirmingShowFullDescription', false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>
        </x-slot>
    </x-dialog-modal>
</div>
