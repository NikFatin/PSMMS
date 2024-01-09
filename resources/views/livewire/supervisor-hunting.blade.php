<div class="overflow-auto w-screen-p-6-sm:px-20-bg-white-border-b-border-gray-200" x-data="supervisorsComponent()">
    <div class="pl-6 mt-5 text-2xl flex justify-between">
        <div class="pr-4 mr-2">
            <x-label for="supervisor_group" value="{{ __('Group') }}"/>
            <select name="supervisor_group" x-model="supervisor_group" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                <option value="" selected>...</option>
                <option value="CNRG">CNRG</option>
                <option value="CSRG">CSRG</option>
                <option value="Cy-SIG">Cy-SIG</option>
                <option value="DBIS">DBIS</option>
                <option value="DSSIM">DSSim</option>
                <option value="EDUTECH">EDU-TECH</option>
                <option value="ISP">ISP</option>
                <option value="KECL">KECL</option>
                <option value="MIRG">MIRG</option>
                <option value="SCORE">SCORE</option>
                <option value="SERG">SERG</option>
                <option value="VISIC">VISIC</option>
            </select>
        </div>
    </div>

    <div class="flex justify-center p-6 mt-6">
        <table class="table-auto w-full max-w-[60%]">
            <thead>
                <tr>
                    <th class="px-2 py-2">
                        <div class="flex-expertises-center text-sm">NO</div>
                    </th>
                    <th class="px-2 py-2">
                        <div class="flex-expertises-center text-sm">SUPERVISOR</div>
                    </th>
                    <th class="px-2 py-2">
                        <div class="flex-expertises-center text-sm">QUOTA</div>
                    </th>
                    <th class="px-2 py-2">
                        <div class="flex-expertises-center text-sm">ACTION</div>
                    </th>
                </tr>
            </thead>
            <tbody id="supervisorTableBody" x-show="filteredSupervisors.length > 0">
                <template x-for="(supervisor, index) in filteredSupervisors" :key="index">
                    <tr>
                        <td class="border px-2 py-2 text-sm" x-text="index + 1"></td>
                        <td class="border px-2 py-2 text-sm" x-text="supervisor.user.name"></td>
                        <td class="border px-2 py-2 text-sm" x-text="supervisor.quota"></td>
                        <td class="border px-4 py-2">
                            <x-button wire:click="requestSupervisor()" class="bg-blue-500 hover:bg-blue-600">Save</x-button>
                        </td>
                    </tr>
                </template>
            </tbody>
            <tbody x-show="filteredSupervisors.length === 0">
                <tr>
                    <td colspan="3" class="border px-2 py-2 text-sm">No supervisors found for the selected group.</td>
                </tr>
            </tbody>
        </table>
    </div>

    <script>
    function supervisorsComponent() {
        return {
            supervisor_group: '',
            supervisors: @json($supervisors),

            get filteredSupervisors() {
                return this.supervisors.filter(supervisor => {
                    return this.supervisor_group === '' || supervisor.group === this.supervisor_group;
                });
            },
        };
    }
</script>

</div>
