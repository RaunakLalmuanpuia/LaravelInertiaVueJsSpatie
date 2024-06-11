<template>
    <q-layout view="hHh lpR lFf">
        <q-header elevated class="text-white bg-primary" height-hint="98">
            <q-toolbar>
                <q-btn dense flat round icon="menu" @click="toggleLeftDrawer" />

                <Link :href="route('dashboard')">
                    <q-toolbar-title>
                        <q-avatar>
                            <img
                                src="https://cdn.quasar.dev/logo-v2/svg/logo-mono-white.svg"
                            />
                        </q-avatar>
                        <!-- Title -->
                    </q-toolbar-title>
                </Link>
            </q-toolbar>

            <q-tabs align="left">
                <Link
                    :href="route('usersRole')"
                    as="button"
                    method="get"
                    :class="{  'bg-blue-900 underline': $page.url.startsWith('/usersRole')}"
                    ><q-route-tab  label="User"
                /></Link>
                <Link :href="route('roles')"
                :class="{ 'bg-blue-900 font-bold underline': $page.component === 'Role/Role'}"
                    ><q-route-tab label="Roles"
                /></Link>
                <Link :href="route('permissions')"
                :class="{ 'bg-blue-900 font-bold underline': $page.component === 'Role/Permission' }"
                    ><q-route-tab label="Permissions"
                /></Link>
            </q-tabs>
        </q-header>

        <q-drawer show-if-above v-model="leftDrawerOpen" side="left" bordered>
            <!-- drawer content -->
            <q-scroll-area
                style="
                    height: calc(100% - 150px);
                    margin-top: 150px;
                    border-right: 1px solid #ddd;
                "
            >
                <q-list padding>

                    <Link :href="route('quiz_index')">
                        <q-item clickable v-ripple :class="{ 'bg-blue-500': $page.url.startsWith('/quiz')}">
                            <q-item-section avatar>
                                <q-icon name="quiz" />
                            </q-item-section>

                            <q-item-section> Quiz </q-item-section>
                        </q-item>
                    </Link>
                    
                    <Link :href="route('profile.show')">
                        <q-item clickable v-ripple :class="{ 'bg-blue-500': $page.component === 'Profile/Show'}">
                            <q-item-section avatar>
                                <q-icon name="manage_accounts" />
                            </q-item-section>

                            <q-item-section> Profile </q-item-section>
                        </q-item>
                    </Link>

                    
                    <!-- route("logout") -->
                    <Link :href="route('logout')" as="button" method="post">
                        <q-item clickable v-ripple>
                            <q-item-section avatar>
                                <q-icon name="logout" />
                            </q-item-section>

                            <q-item-section> Logout </q-item-section>
                        </q-item>
                    </Link>

                    <!-- <q-item clickable v-ripple>
                        <q-item-section avatar>
                            <q-icon name="send" />
                        </q-item-section>

                        <q-item-section> Send </q-item-section>
                    </q-item>

                    <q-item clickable v-ripple>
                        <q-item-section avatar>
                            <q-icon name="drafts" />
                        </q-item-section>

                        <q-item-section> Drafts </q-item-section>
                    </q-item> -->
                </q-list>
            </q-scroll-area>

            <q-img
                class="absolute-top"
                src="https://cdn.quasar.dev/img/material.png"
                style="height: 150px"
            >
                <div class="bg-transparent absolute-bottom">
                    <q-avatar size="56px" class="q-mb-sm">
                        <img
                            :src="profilePhoto"
                            :alt="$page.props.auth.user.name"
                        />
                    </q-avatar>
                    <div class="text-weight-bold">
                        {{ $page.props.auth.user.name }}
                    </div>
                    <div>{{ $page.props.auth.user.email }}</div>
                </div>
            </q-img>
        </q-drawer>

        <q-page-container>
            <slot />
        </q-page-container>

        <q-footer elevated class="text-white bg-grey-8">
            <q-toolbar>
                <q-toolbar-title>
                    <q-avatar>
                        <img
                            src="https://cdn.quasar.dev/logo-v2/svg/logo-mono-white.svg"
                        />
                    </q-avatar>
                    <div>
                        <!-- Title -->
                    </div>
                </q-toolbar-title>
            </q-toolbar>
        </q-footer>
    </q-layout>
</template>

<script setup>
// import { Link } from "@inertiajs/vue3";
import { ref, computed } from "vue";
import { router } from "@inertiajs/vue3";
import { usePage } from "@inertiajs/vue3";
import { useQuasar } from "quasar";

const $q = useQuasar();

const { props } = usePage();

const leftDrawerOpen = ref(false);

const toggleLeftDrawer = () => {
    leftDrawerOpen.value = !leftDrawerOpen.value;
};
const profilePhoto = computed(() => {
    if (props.auth.user.profile_photo_path) {
        return `${window.location.origin}/storage/${props.auth.user.profile_photo_path}`;
    }
    return "/images/default-profile.png"; // Default image if profile photo is not available
});
</script>
