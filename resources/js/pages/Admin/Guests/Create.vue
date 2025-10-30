<script setup lang="ts">
import { Button } from '@/components/ui/button';
import {
    Card,
    CardContent,
    CardDescription,
    CardHeader,
    CardTitle,
} from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import {
    Select,
    SelectContent,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from '@/components/ui/select';
import AdminLayout from '@/layouts/AdminLayout.vue';
import type { BreadcrumbItemType } from '@/types';
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
import { ArrowLeft, Save, Users } from 'lucide-vue-next';

interface Group {
    id: number;
    name: string;
}

interface Props {
    groups: Group[];
    errors?: Record<string, string>;
}

const props = defineProps<Props>();

const page = usePage();
const urlParams = new URLSearchParams(page.url.split('?')[1] || '');
const preselectedGroupId = urlParams.get('group_id') || '';

const form = useForm({
    full_name: '',
    email: '',
    group_id: preselectedGroupId,
});

const submit = () => {
    form.post('/admin/guests/store', {
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
        },
    });
};

const breadcrumbItems: BreadcrumbItemType[] = [
    {
        title: 'Dashboard',
        href: '/admin/dashboard',
    },
    {
        title: 'Guests',
        href: '/admin/guests',
    },
    {
        title: 'Create Guest',
        href: '/admin/guests/create',
    },
];
</script>

<template>
    <Head title="Create Guest - Admin" />

    <AdminLayout :breadcrumbs="breadcrumbItems">
        <div class="space-y-6 p-6">
            <!-- Page Header -->
            <div class="flex items-center gap-4">
                <Button variant="outline" size="sm" as-child>
                    <Link href="/admin/guests">
                        <ArrowLeft class="mr-2 h-4 w-4" />
                        Back to Guests
                    </Link>
                </Button>
                <div>
                    <h1 class="text-3xl font-bold tracking-tight">
                        Create Guest
                    </h1>
                    <p class="text-muted-foreground">
                        Add a new guest to your wedding list
                    </p>
                </div>
            </div>

            <!-- Create Form -->
            <Card class="max-w-2xl">
                <CardHeader>
                    <CardTitle>Guest Information</CardTitle>
                    <CardDescription>
                        Enter the details for the new guest
                    </CardDescription>
                </CardHeader>
                <CardContent>
                    <form @submit.prevent="submit" class="space-y-6">
                        <div class="space-y-2">
                            <Label for="full_name">Full Name</Label>
                            <Input
                                id="full_name"
                                v-model="form.full_name"
                                placeholder="e.g., John Smith"
                                :class="{
                                    'border-destructive': form.errors.full_name,
                                }"
                                required
                            />
                            <p
                                v-if="form.errors.full_name"
                                class="text-sm text-destructive"
                            >
                                {{ form.errors.full_name }}
                            </p>
                        </div>

                        <div class="space-y-2">
                            <Label for="email">Email Address</Label>
                            <Input
                                id="email"
                                v-model="form.email"
                                type="email"
                                placeholder="e.g., john.smith@example.com"
                                :class="{
                                    'border-destructive': form.errors.email,
                                }"
                                required
                            />
                            <p
                                v-if="form.errors.email"
                                class="text-sm text-destructive"
                            >
                                {{ form.errors.email }}
                            </p>
                            <p class="text-sm text-muted-foreground">
                                This email will be used to send RSVP invitations
                            </p>
                        </div>

                        <div class="space-y-2">
                            <Label for="group_id">Group</Label>
                            <Select v-model="form.group_id" required>
                                <SelectTrigger
                                    :class="{
                                        'border-destructive':
                                            form.errors.group_id,
                                    }"
                                >
                                    <SelectValue placeholder="Select a group" />
                                </SelectTrigger>
                                <SelectContent>
                                    <SelectItem
                                        v-for="group in groups"
                                        :key="group.id"
                                        :value="group.id.toString()"
                                    >
                                        {{ group.name }}
                                    </SelectItem>
                                </SelectContent>
                            </Select>
                            <p
                                v-if="form.errors.group_id"
                                class="text-sm text-destructive"
                            >
                                {{ form.errors.group_id }}
                            </p>
                            <p class="text-sm text-muted-foreground">
                                Assign this guest to a group for organization
                            </p>
                        </div>

                        <div class="flex items-center gap-4 pt-4">
                            <Button type="submit" :disabled="form.processing">
                                <Save class="mr-2 h-4 w-4" />
                                Create Guest
                            </Button>
                            <Button type="button" variant="outline" as-child>
                                <Link href="/admin/guests">Cancel</Link>
                            </Button>
                        </div>
                    </form>
                </CardContent>
            </Card>

            <!-- Quick Actions -->
            <Card v-if="!preselectedGroupId" class="max-w-2xl">
                <CardHeader>
                    <CardTitle class="text-lg">Quick Actions</CardTitle>
                    <CardDescription>
                        Need to create a group first?
                    </CardDescription>
                </CardHeader>
                <CardContent>
                    <Button variant="outline" as-child>
                        <Link href="/admin/groups/create">
                            <Users class="mr-2 h-4 w-4" />
                            Create New Group
                        </Link>
                    </Button>
                </CardContent>
            </Card>
        </div>
    </AdminLayout>
</template>
