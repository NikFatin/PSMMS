<div class="overflow-auto w-screen-p-6-sm:px-20-bg-white-border-b-border-gray-200">
<div class="pl-6 mt-8 text-2xl flex justify-between">
    <div></div>
    <div class="pr-6 mr-2">
        <x-button wire:click="confirmExpertiseAdd" class="bg-blue-700 text-white font-bold py-2 px-4 rounded">
            {{ __('Add New Expertise') }}
        </x-button>
    </div>
</div>

<div class="flex justify-center p-6 mt-6">
    <div class="w-full">
        <table class="table-auto w-full">
            <thead>
                <tr>
                    <th class="px-4 py-2">
                        <div class="flex-expertises-center">NO.</div>
                    </th>
                    <th class="px-4 py-2">
                        <div class="flex-expertises-center">EXPERTISE</div>
                    </th>
                    <th class="px-2 py-2">
                        <div class="flex-expertises-center">DESCRIPTION</div>
                    </th>
                    <th class="px-4 py-2">
                        <div class="flex-expertises-center">LEVEL</div>
                    </th>
                    <th class="px-4 py-2">
                        <div class="flex-expertises-center">ACTION</div>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($expertises as $index => $expertise)
                    <tr>
                        <td class="border px-4 py-2">{{ $index + 1 }}</td>
                        <td class="border px-4 py-2">{{ $expertise->expertise }}</td>
                        <td class="border px-2 py-2">{{ $expertise->description }}</td>
                        <td class="border px-4 py-2">{{ $expertise->level }}</td>
                        <td class="border px-4 py-2">
                            <x-button wire:click="confirmExpertiseEdit({{ $expertise->id }})" class="bg-green-500 hover:bg-green-500">
                                Edit
                            </x-button>
                            <x-danger-button wire:click="confirmExpertiseDeletion({{ $expertise->id }})" wire:loading.attr="disabled">
                                Delete
                            </x-danger-button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


    <div class="mt-4">
        {{ $expertises->links() }}
    </div>

    <x-dialog-modal wire:model.live="confirmingExpertiseDeletion">
            <x-slot name="title">
                {{ __('Delete') }}
            </x-slot>

            <x-slot name="content">
                {{ __('Are you sure you want to delete your expertise? Once your expertise is deleted, all of its resources and data will be permanently deleted.') }}
            </x-slot>

            <x-slot name="footer">
                <x-secondary-button wire:click="$set('confirmingExpertiseDeletion', false)" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="ms-3" wire:click="deleteExpertise({{$confirmingExpertiseDeletion}})" wire:loading.attr="disabled">
                    {{ __('Delete') }}
                </x-danger-button>
            </x-slot>
    </x-dialog-modal>

    <x-dialog-modal wire:model="confirmingExpertiseAdd">
            <x-slot name="title">
            @if($selectedExpertise)
                {{ __('Edit Expertise') }}
            @else
                {{ __('Add Expertise') }}
            @endif
            </x-slot>

            <x-slot name="content">
            <div class="col-span-6 sm:col-span-4">
                <x-label for="expertise" value="{{ __('Expertise') }}" />
                <x-input id="expertise" type="text" class="mt-1 block w-full" wire:model.defer="expertise" />
                <x-input-error for="expertise" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <x-label for="description" value="{{ __('Description') }}" />
                <x-input id="description" type="text" class="mt-1 block w-full" wire:model.defer="description" />
                <x-input-error for="description" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <x-label for="level" value="{{ __('Level')}}"/>
                <select id="level" class="mt-1 block w-full" wire:model.defer="level">
                    <option selected>...</option>
                    <option value="beginner">Beginner</option>
                    <option value="intermediate">Intermediate</option>
                    <option value="advanced">Advanced</option>
                </select>
                <x-input-error for="level" class="mt-2"/>
            </div>

            </x-slot>

            <x-slot name="footer">
            <x-secondary-button wire:click="$set('confirmingExpertiseAdd', false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-danger-button class="ms-3" wire:click="saveExpertise()" wire:loading.attr="disabled">
                @if($selectedExpertise)
                    {{ __('Update') }}
                @else
                    {{ __('Save') }}
                @endif
            </x-danger-button>

            </x-slot>
        </x-dialog-modal>
</div>