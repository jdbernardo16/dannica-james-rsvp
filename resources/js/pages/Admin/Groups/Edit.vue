<script setup lang="ts">
import { Badge } from '@/components/ui/badge';
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
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from '@/components/ui/table';
import AdminLayout from '@/layouts/AdminLayout.vue';
import type { BreadcrumbItemType } from '@/types';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ArrowLeft, Save, UserPlus, Users } from 'lucide-vue-next';

interface Guest {
    id: number;
    full_name: string;
    email: string;
    created_at: string;
}

interface Group {
    id: number;
    name: string;
    max_attendees: number;
    guest_count: number;
    has_rsvp: boolean;
    created_at: string;
    guests: Guest[];
}

interface Props {
    group: Group;
    errors?: Record<string, string>;
}

const props = defineProps<Props>();

const form = useForm({
    name: props.group.name,
    max_attendees: props.group.max_attendees.toString(),
});

const submit = () => {
    form.put(`/admin/groups/${props.group.id}/update`, {
        preserveScroll: true,
    });
};

const breadcrumbItems: BreadcrumbItemType[] = [
    {
        title: 'Dashboard',
        href: '/admin/dashboard',
    },
    {
        title: 'Groups',
        href: '/admin/groups',
    },
    {
        title: props.group.name,
        href: `/admin/groups/${props.group.id}`,
    },
    {
        title: 'Edit',
        href: `/admin/groups/${props.group.id}/edit`,
    },
];
</script>

<template>
    <Head title="Edit Group - Admin" />

    <AdminLayout :breadcrumbs="breadcrumbItems">
        <div class="space-y-6 p-6">
            <!-- Page Header -->
            <div class="flex items-center gap-4">
                <Button variant="outline" size="sm" as-child>
                    <Link :href="`/admin/groups/${group.id}`">
                        <ArrowLeft class="mr-2 h-4 w-4" />
                        Back to Group
                    </Link>
                </Button>
                <div>
                    <h1 class="text-3xl font-bold tracking-tight">
                        Edit Group
                    </h1>
                    <p class="text-muted-foreground">
                        Update group information for {{ group.name }}
                    </p>
                </div>
            </div>

            <div class="grid gap-6 lg:grid-cols-3">
                <!-- Edit Form -->
                <Card class="lg:col-span-2">
                    <CardHeader>
                        <CardTitle>Group Information</CardTitle>
                        <CardDescription>
                            Update the details for this group
                        </CardDescription>
                    </CardHeader>
                    <CardContent>
                        <form @submit.prevent="submit" class="space-y-6">
                            <div class="space-y-2">
                                <Label for="name">Group Name</Label>
                                <Input
                                    id="name"
                                    v-model="form.name"
                                    placeholder="e.g., Smith Family, College Friends"
                                    :class="{
                                        'border-destructive': form.errors.name,
                                    }"
                                    required
                                />
                                <p
                                    v-if="form.errors.name"
                                    class="text-sm text-destructive"
                                >
                                    {{ form.errors.name }}
                                </p>
                            </div>

                            <div class="space-y-2">
                                <Label for="max_attendees"
                                    >Maximum Attendees</Label
                                >
                                <Input
                                    id="max_attendees"
                                    v-model="form.max_attendees"
                                    type="number"
                                    min="1"
                                    placeholder="e.g., 4"
                                    :class="{
                                        'border-destructive':
                                            form.errors.max_attendees,
                                    }"
                                    required
                                />
                                <p
                                    v-if="form.errors.max_attendees"
                                    class="text-sm text-destructive"
                                >
                                    {{ form.errors.max_attendees }}
                                </p>
                                <p class="text-sm text-muted-foreground">
                                    The maximum number of guests allowed in this
                                    group
                                </p>
                            </div>

                            <div class="flex items-center gap-4 pt-4">
                                <Button
                                    type="submit"
                                    :disabled="form.processing"
                                >
                                    <Save class="mr-2 h-4 w-4" />
                                    Update Group
                                </Button>
                                <Button
                                    type="button"
                                    variant="outline"
                                    as-child
                                >
                                    <Link :href="`/admin/groups/${group.id}`"
                                        >Cancel</Link
                                    >
                                </Button>
                            </div>
                        </form>
                    </CardContent>
                </Card>

                <!-- Group Info Sidebar -->
                <div class="space-y-6 p-6">
                    <!-- Group Stats -->
                    <Card>
                        <CardHeader>
                            <CardTitle class="text-lg"
                                >Group Statistics</CardTitle
                            >
                        </CardHeader>
                        <CardContent class="space-y-4">
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium"
                                    >Guest Count</span
                                >
                                <Badge variant="secondary">{{
                                    group.guest_count
                                }}</Badge>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium"
                                    >Max Attendees</span
                                >
                                <Badge variant="outline">{{
                                    group.max_attendees
                                }}</Badge>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium"
                                    >RSVP Status</span
                                >
                                <Badge
                                    :variant="
                                        group.has_rsvp ? 'default' : 'secondary'
                                    "
                                >
                                    {{
                                        group.has_rsvp ? 'Responded' : 'Pending'
                                    }}
                                </Badge>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium">Created</span>
                                <span class="text-sm text-muted-foreground">
                                    {{
                                        new Date(
                                            group.created_at,
                                        ).toLocaleDateString()
                                    }}
                                </span>
                            </div>
                        </CardContent>
                    </Card>

                    <!-- Quick Actions -->
                    <Card>
                        <CardHeader>
                            <CardTitle class="text-lg">Quick Actions</CardTitle>
                        </CardHeader>
                        <CardContent class="space-y-3">
                            <Button class="w-full" variant="outline" as-child>
                                <Link
                                    :href="`/admin/guests/create?group_id=${group.id}`"
                                >
                                    <UserPlus class="mr-2 h-4 w-4" />
                                    Add Guest
                                </Link>
                            </Button>
                            <Button class="w-full" variant="outline" as-child>
                                <Link
                                    :href="`/admin/guests?group_id=${group.id}`"
                                >
                                    <Users class="mr-2 h-4 w-4" />
                                    View All Guests
                                </Link>
                            </Button>
                        </CardContent>
                    </Card>
                </div>
            </div>

            <!-- Guests Table -->
            <Card>
                <CardHeader>
                    <CardTitle
                        >Group Guests ({{ group.guests.length }})</CardTitle
                    >
                    <CardDescription>
                        Guests assigned to this group
                    </CardDescription>
                </CardHeader>
                <CardContent>
                    <div
                        v-if="group.guests.length === 0"
                        class="py-8 text-center"
                    >
                        <p class="text-muted-foreground">
                            No guests in this group yet
                        </p>
                        <Button class="mt-4" variant="outline" as-child>
                            <Link
                                :href="`/admin/guests/create?group_id=${group.id}`"
                            >
                                <UserPlus class="mr-2 h-4 w-4" />
                                Add First Guest
                            </Link>
                        </Button>
                    </div>
                    <Table v-else>
                        <TableHeader>
                            <TableRow>
                                <TableHead>Name</TableHead>
                                <TableHead>Email</TableHead>
                                <TableHead>Added</TableHead>
                                <TableHead class="text-right"
                                    >Actions</TableHead
                                >
                            </TableRow>
                        </TableHeader>
                        <TableBody>
                            <TableRow
                                v-for="guest in group.guests"
                                :key="guest.id"
                            >
                                <TableCell class="font-medium">{{
                                    guest.full_name
                                }}</TableCell>
                                <TableCell>{{ guest.email }}</TableCell>
                                <TableCell>{{
                                    new Date(
                                        guest.created_at,
                                    ).toLocaleDateString()
                                }}</TableCell>
                                <TableCell class="text-right">
                                    <div
                                        class="flex items-center justify-end gap-2"
                                    >
                                        <Button
                                            variant="ghost"
                                            size="sm"
                                            as-child
                                        >
                                            <Link
                                                :href="`/admin/guests/${guest.id}`"
                                            >
                                                View
                                            </Link>
                                        </Button>
                                        <Button
                                            variant="ghost"
                                            size="sm"
                                            as-child
                                        >
                                            <Link
                                                :href="`/admin/guests/${guest.id}/edit`"
                                            >
                                                Edit
                                            </Link>
                                        </Button>
                                    </div>
                                </TableCell>
                            </TableRow>
                        </TableBody>
                    </Table>
                </CardContent>
            </Card>
        </div>
    </AdminLayout>
</template>
