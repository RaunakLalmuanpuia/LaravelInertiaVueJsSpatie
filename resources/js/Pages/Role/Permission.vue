<template>
    <AppLayout title="Permission">
        <h4>Permissions</h4>

        <div class="flex mb-4" style="align-items: end">
            <q-btn
                label="New Permissions"
                color="primary"
                @click="createPromt()"
            ></q-btn>
        </div>

        <table class="px-20">
            <thead class="px-20">
                <th class="px-20">ID</th>
                <th class="px-20">Name</th>
                <th class="px-20">CreatedAt</th>
                <th class="px-20">Action</th>
            </thead>
            <tbody class="px-20">
                <tr
                    v-for="(permission, index) in permissions"
                    :key="permission.id"
                >
                    <td class="px-20">
                        {{ index + 1 }}
                    </td>
                    <td class="px-20">
                        {{ permission.name }}
                    </td>
                    <td class="px-20">
                        {{ permission.created_at }}
                    </td>
                    <td class="divide-x-2">
                        <div class="">
                            <q-btn
                                label="Edit"
                                color="primary"
                                @click="editPromptModel(permission)"
                            ></q-btn>
                            <q-btn
                                color="red"
                                label="Delete"
                                @click="destroy(permission)"
                            ></q-btn>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>

        <div style="margin-top: 700px;">
            <p>The current time is {{ time }}</p>
            <Link :href="route('permissions')" class="text-blue-500" preserve-scroll>Refresh</Link>
        </div>
        <!-- Create Dialog -->
        <q-dialog v-model="prompt" persistent>
            <q-card style="min-width: 350px">
                <q-card-section>
                    <div class="text-h6">Create Permission</div>
                </q-card-section>
                <q-input v-model="form.name" label="Permission"> </q-input>
                <label class="block text-base font-medium text-gray-700"
                    >Roles</label
                >
                <q-checkbox
                    v-for="role in options"
                    :key="role.value"
                    v-model="form.roles"
                    :val="role.label"
                    :label="role.label"
                />
                <q-card-actions align="right" class="text-primary">
                    <q-btn flat label="cancel" v-close-popup></q-btn>
                    <q-btn
                        flat
                        label="Confirm"
                        v-close-popup
                        @click="onSubmit()"
                    ></q-btn>
                </q-card-actions>
            </q-card>
        </q-dialog>

        <!-- Edit Dialog -->
        <q-dialog v-model="editPrompt" persistent>
            <q-card style="min-width: 350px">
                <q-card-section>
                    <div class="text-h6">Edit Permission</div>
                </q-card-section>
                <q-input v-model="updateForm.name" label="Permission">
                </q-input>
                <label class="block text-base font-medium text-gray-700"
                    >Roles</label
                >
                <q-checkbox
                    v-for="role in options"
                    :key="role.value"
                    v-model="updateForm.roles"
                    :val="role.label"
                    :label="role.label"
                />
                <q-card-actions align="right" class="text-primary">
                    <q-btn flat label="cancel" v-close-popup></q-btn>
                    <q-btn
                        flat
                        label="Confirm"
                        v-close-popup
                        @click="onUpdate()"
                    ></q-btn>
                </q-card-actions>
            </q-card>
        </q-dialog>
    </AppLayout>
</template>

<script setup>
import QuasarLayout from "@/Layouts/QuasarLayout.vue";
import { ref } from "vue";
import { useForm, router } from "@inertiajs/vue3";
import { useQuasar } from "quasar";
import AppLayout from "@/Layouts/AppLayout.vue";
const $q = useQuasar();

const prompt = ref(false);
const editPrompt = ref(false);

const selectedPermission = ref(null);

const props = defineProps({
    permissions: Object,
    roles: Object,
    time:String,
});

const form = useForm({
    name: "",
    roles: [],
});
const updateForm = useForm({
    name: "",
    roles: [],
    selectedPermission: "",
});

const options = Object.entries(props.roles).map(([roleId, roleName]) => ({
    label: roleName,
    value: roleId,
}));

const createPromt = () => {
    prompt.value = true;
};
const onSubmit = () => {
    console.log("Submit");
    if (form.name !== "") {
        form.post(route("createPermission"), {
            onSuccess: () => form.reset("name"),
        });
        $q.notify({
            message: "Permission Created Successfully",
            color: "purple",
            position: "bottom",
            actions: [{ label: "Dismiss", color: "white" }],
        });
    } else if (form.name === "") {
        $q.notify({
            message: "Please Enter a Permission",
            color: "red",
            position: "bottom",
            actions: [{ label: "Dismiss", color: "white" }],
        });
    }
};

const editPromptModel = (permission) => {
    editPrompt.value = true;
    selectedPermission.value = permission;
    updateForm.name = permission.name;
    updateForm.selectedPermission = selectedPermission.value;
    updateForm.roles = permission.roles.map((role) => role.name);
};

const onUpdate = () => {
    console.log("Update Permission");
    if (updateForm.name !== "") {
        updateForm.put(route("updatePermission", selectedPermission.value), {
            onSuccess: () =>
                updateForm.reset(["name", "roles", "selectedPermission"]),
        });
        $q.notify({
            message: "Permission updated Sucessfully",
            color: "positive",
            position: "bottom",
            actions: [{ label: "Dismiss", color: "white" }],
        });
    } else if (updateForm.name === "") {
        $q.notify({
            message: "Please Enter a Role",
            color: "red",
            position: "bottom",
            actions: [{ label: "Dismiss", color: "white" }],
        });
    }
};

function destroy(id) {
    $q.dialog({
        title: "Delete",
        message: "Are you sure you want to detele?",
    }).onOk(() => {
        router.delete(route("destroyPermission", id));
        $q.notify({
            message: "Permission Deleted Successfully",
            color: "red",
            position: "bottom",
            actions: [{ label: "Dismiss", color: "white" }],
        });
    });
}
</script>
