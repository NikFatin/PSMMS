<div wire:ignore.self class="modal fade" id="addExpertiseModal" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
<div>
    <form>
        <div class="mb-6">
            <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Expertises</label>
            <input wire:model="expertise" type="text" id="expertise" placeholder="Your expertise" class="bg-gray-100  text-gray-900 text-sm rounded block w-full p-2.5">
                 @error('expertise')
                    <span class="text-red-500 text-xs mt-3 block ">{{ $message }}</span>
                 @enderror
        </div>

        <div class="mb-6">
            <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Description</label>
            <input wire:model="description" type="text" id="description" placeholder="Describe" class="bg-gray-100  text-gray-900 text-sm rounded block w-full p-2.5">
                @error('description')
                    <span class="text-red-500 text-xs mt-3 block ">{{ $message }}</span>
                @enderror
        </div>

        <div class="mb-6">
            <label for="level" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Level</label>
                <select wire:model="level" id="level" class="bg-gray-100 text-gray-900 text-sm rounded block w-full p-2.5">
                    <option>Select Level...</option>
                    <option value="beginner">Beginner</option>
                    <option value="intermediate">Intermediate</option>
                    <option value="advanced">Advanced</option>
                </select>
                @error('level')
                    <span class="text-red-500 text-xs mt-3 block">{{ $message }}</span>
                @enderror
        </div>

        <button wire:click.prevent="create" type="submit"
            class="px-4 py-2 bg-blue-500 text-white font-semibold rounded hover:bg-blue-600">Save</button>
                @if (session('success'))
                    <span class="text-green-500 text-xs">{{ (session('success')) }}</span>
                @endif
    </form>
</div>
</div>