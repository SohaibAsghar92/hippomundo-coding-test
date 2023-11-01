<template>
<div @click="createPhase" class="w-[300px] h-[500px] bg-[rgba(8,47,73,0.91)] shadow-lg shadow-[#aaaaaa] rounded-lg shadow-lg hover:cursor-pointer">
    <PlusIcon class="h-12 w-12 text-white mt-56 ml-32" aria-hidden="true" />
</div>
<div>
    <Teleport to="body">
        <generic-modal :show="creatingPhase" @close="creatingPhase = false" key="createPhase">
            <div>
                <div class="mt-3 sm:mt-2">
                    <DialogTitle as="h3" class="mb-6 text-base font-semibold leading-6 text-gray-900">Create a new Phase</DialogTitle>
                    <div>
                        <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Phase Name</label>
                        <div class="relative mt-2">
                            <input type="text" v-model="phase_name" id="name"
                                   class="peer block w-full border-0 bg-gray-50 py-1.5 text-gray-900 focus:ring-0 sm:text-sm sm:leading-6"
                                   placeholder="Make it productive, but also fun!" />
                            <div class="absolute inset-x-0 bottom-0 border-t border-gray-300 peer-focus:border-t-2 peer-focus:border-blue-600"
                                 aria-hidden="true" />
                        </div>
                    </div>

                </div>

                <div class="mt-5 sm:mt-6">
                    <button type="button"
                            class="inline-flex w-full justify-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600"
                            @click="addPhase">Add the Phase!</button>
                </div>
            </div>
        </generic-modal>
    </Teleport>
</div>
</template>

<script setup>
// get the props
import { useKanbanStore } from '../stores/kanban'
import { PlusIcon } from '@heroicons/vue/20/solid'
import {ref} from "vue";
const emit = defineEmits(['refreshKanban'])

const kanban = useKanbanStore()
let creatingPhase = ref(false)
let phase_name = ref('')

const createTask = function () {
    kanban.creatingTask = true;
    kanban.creatingTaskProps.phase_id = props.phase_id;
}

const createPhase = function () {
    creatingPhase.value = true;
}


const addPhase = async function () {
    let name = phase_name.value;
    const response = await axios.post('/api/phases', {name});
    creatingPhase.value = false;
    if (response.status === 201) {
        alert('Phase created successfully!')
        emit('refreshKanban', name)
        phase_name.value = ''
    }
}

</script>


<style>
/* Hide scrollbar for Chrome, Safari, and Opera */
.no-scrollbar::-webkit-scrollbar {
    display: none;
}

/* Hide scrollbar for IE, Edge, and Firefox */
.no-scrollbar {
    -ms-overflow-style: none; /* IE and Edge */
    scrollbar-width: none; /* Firefox */
}
</style>
