<div class="overflow-auto w-screen-p-6-sm:px-20-bg-white-border-b-border-gray-200">
    <div class="pl-6 mt-8 text-2xl flex justify-between">
        <div></div>
        <div class="pr-6 mr-2">
            <x-button wire:click="confirmTitleAdd" class="bg-blue-700 text-white font-bold py-2 px-4 rounded">
                {{ __('Add New Title') }}
            </x-button>
        </div>
    </div>

    <div class="flex justify-center p-6 mt-6">
        <div class="w-full">
            <table class="table-auto w-full">
                <thead>
                    <tr>
                        <th class="px-4 py-2">
                            <div class="flex-expertises-center">NO</div>
                        </th>
                        <th class="px-4 py-2">
                            <div class="flex-expertises-center">TITLE</div>
                        </th>
                        <th class="px-4 py-2">
                            <div class="flex-expertises-center">DESCRIPTION</div>
                        </th>
                        <th class="px-4 py-2">
                            <div class="flex-expertises-center">ACTION</div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($titles as $index => $title )
                        <tr>
                            <td class="border px-4 py-2">{{ $index + 1}}</td>
                            <td class="border px-4 py-2">{{ $title->title }}</td>
                            <td class="border px-4 py-2">{{ $title->description}}</td>
                            <td class="border px-4 py-2">
                                <x-button wire:click="confirmTitleEdit({{ $title->id }})" class="bg-green-500 hover:bg-green-500">Edit</x-button>
                                <x-danger-button wire:click="confirmTitleDeletion({{ $title->id }})" wire:loading.attr="disabled">Delete</x-danger-button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


<x-dialog-modal wire:model="confirmingTitleAdd">
    <x-slot name="title">
    @if($selectedTitle)
        {{ __('Edit Project Title') }}
    @else
        {{ __('Project Title Form') }}
    @endif
    </x-slot>

    <x-slot name="content">
        <div class="col-span-6 sm:col-span-4">
            <x-label for="title" value="{{ __('Title') }}" />
            <x-input id="title" type="text" class="mt-1 block w-full" wire:model.defer="title" />
            <x-input-error for="title" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="description" value="{{ __('Description') }}" />
            <x-input id="description" type="text" class="mt-1 block w-full" wire:model.defer="description" />
            <x-input-error for="description" class="mt-2" />
        </div>

        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('confirmingTitleAdd', false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-danger-button class="ms-3" wire:click="saveTitle()" wire:loading.attr="disabled">
                @if($selectedTitle)
                    {{ __('Update') }}
                @else
                    {{ __('Save') }}
                @endif
            </x-danger-button>
        </x-slot>
    </x-dialog-modal>

<div x-show="showModal" x-cloak>
    <div class="fixed inset-0 overflow-y-auto">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            
            <div class="p-6">
                <p>{{ $fullDescription }}</p>
            </div>
            <div class="bg-gray-100 p-4">
                <button @click="showModal = false" class="px-4 py-2 bg-blue-500 text-white rounded">Close</button>
            </div>
            </div>
        </div>
    </div>
</div>
</div>