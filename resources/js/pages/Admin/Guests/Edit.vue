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
    Select,
    SelectContent,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from '@/components/ui/select';
import AdminLayout from '@/layouts/AdminLayout.vue';
import type { BreadcrumbItemType } from '@/types';
import { Head, Link, router, useForm } from '@inertiajs/vue3';
import { ArrowLeft, Calendar, Mail, Save, Users } from 'lucide-vue-next';

interface Group {
    id: number;
    name: string;
}

interface Rsvp {
    id: number;
    attending_count: number;
    message: string;
    song_suggestion: string;
    submitted_at: string;
}

interface Guest {
    id: number;
    full_name: string;
    email: string;
    group_id: number;
    group_name: string;
    has_rsvp: boolean;
    created_at: string;
    rsvp?: Rsvp;
}

interface Props {
    guest: Guest;
    groups: Group[];
    errors?: Record<string, string>;
}

const props = defineProps<Props>();

const form = useForm({
    full_name: props.guest.full_name,
    email: props.guest.email,
    group_id: props.guest.group_id?.toString() || '',
});

const submit = () => {
    form.put(`/admin/guests/${props.guest.id}/update`, {
        preserveScroll: true,
    });
};

const sendRsvpEmail = () => {
    if (confirm('Send RSVP invitation email to this guest?')) {
        router.post(
            `/admin/guests/${props.guest.id}/send-rsvp`,
            {},
            {
                preserveScroll: true,
                onSuccess: () => {
                    // Show success message
                },
            },
        );
    }
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
        title: props.guest.full_name,
        href: `/admin/guests/${props.guest.id}`,
    },
    {
        title: 'Edit',
        href: `/admin/guests/${props.guest.id}/edit`,
    },
];
</script>

<template>
    <Head title="Edit Guest - Admin" />

    <AdminLayout :breadcrumbs="breadcrumbItems">
        <div class="space-y-6 p-6">
            <!-- Page Header -->
            <div class="flex items-center gap-4">
                <Button variant="outline" size="sm" as-child>
                    <Link :href="`/admin/guests/${guest.id}`">
                        <ArrowLeft class="mr-2 h-4 w-4" />
                        Back to Guest
                    </Link>
                </Button>
                <div>
                    <h1 class="text-3xl font-bold tracking-tight">
                        Edit Guest
                    </h1>
                    <p class="text-muted-foreground">
                        Update information for {{ guest.full_name }}
                    </p>
                </div>
            </div>

            <div class="grid gap-6 lg:grid-cols-3">
                <!-- Edit Form -->
                <Card class="lg:col-span-2">
                    <CardHeader>
                        <CardTitle>Guest Information</CardTitle>
                        <CardDescription>
                            Update the details for this guest
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
                                        'border-destructive':
                                            form.errors.full_name,
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
                                    This email will be used to send RSVP
                                    invitations
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
                                        <SelectValue
                                            placeholder="Select a group"
                                        />
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
                                    Assign this guest to a group for
                                    organization
                                </p>
                            </div>

                            <div class="flex items-center gap-4 pt-4">
                                <Button
                                    type="submit"
                                    :disabled="form.processing"
                                >
                                    <Save class="mr-2 h-4 w-4" />
                                    Update Guest
                                </Button>
                                <Button
                                    type="button"
                                    variant="outline"
                                    as-child
                                >
                                    <Link :href="`/admin/guests/${guest.id}`"
                                        >Cancel</Link
                                    >
                                </Button>
                            </div>
                        </form>
                    </CardContent>
                </Card>

                <!-- Guest Info Sidebar -->
                <div class="space-y-6 p-6">
                    <!-- Guest Stats -->
                    <Card>
                        <CardHeader>
                            <CardTitle class="text-lg"
                                >Guest Information</CardTitle
                            >
                        </CardHeader>
                        <CardContent class="space-y-4">
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium"
                                    >RSVP Status</span
                                >
                                <Badge
                                    :variant="
                                        guest.has_rsvp ? 'default' : 'secondary'
                                    "
                                >
                                    {{
                                        guest.has_rsvp ? 'Responded' : 'Pending'
                                    }}
                                </Badge>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium">Group</span>
                                <Button variant="ghost" size="sm" as-child>
                                    <Link
                                        :href="`/admin/groups/${guest.group_id}`"
                                    >
                                        {{
                                            guest.group_name ||
                                            'No group assigned'
                                        }}
                                    </Link>
                                </Button>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium">Created</span>
                                <span
                                    class="flex items-center gap-1 text-sm text-muted-foreground"
                                >
                                    <Calendar class="h-3 w-3" />
                                    {{
                                        new Date(
                                            guest.created_at,
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
                            <Button
                                class="w-full"
                                variant="outline"
                                @click="sendRsvpEmail"
                                :disabled="guest.has_rsvp"
                            >
                                <Mail class="mr-2 h-4 w-4" />
                                Send RSVP Email
                            </Button>
                            <Button class="w-full" variant="outline" as-child>
                                <Link :href="`/admin/groups/${guest.group_id}`">
                                    <Users class="mr-2 h-4 w-4" />
                                    View Group
                                </Link>
                            </Button>
                        </CardContent>
                    </Card>

                    <!-- RSVP Information (if exists) -->
                    <Card v-if="guest.rsvp">
                        <CardHeader>
                            <CardTitle class="text-lg">RSVP Details</CardTitle>
                        </CardHeader>
                        <CardContent class="space-y-4">
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium"
                                    >Attending Count</span
                                >
                                <Badge variant="secondary">{{
                                    guest.rsvp.attending_count
                                }}</Badge>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium"
                                    >Submitted</span
                                >
                                <span
                                    class="flex items-center gap-1 text-sm text-muted-foreground"
                                >
                                    <Calendar class="h-3 w-3" />
                                    {{
                                        new Date(
                                            guest.rsvp.submitted_at,
                                        ).toLocaleDateString()
                                    }}
                                </span>
                            </div>
                            <div v-if="guest.rsvp.message" class="space-y-2">
                                <span class="text-sm font-medium">Message</span>
                                <p class="text-sm text-muted-foreground">
                                    {{ guest.rsvp.message }}
                                </p>
                            </div>
                            <div
                                v-if="guest.rsvp.song_suggestion"
                                class="space-y-2"
                            >
                                <span class="text-sm font-medium"
                                    >Song Suggestion</span
                                >
                                <p class="text-sm text-muted-foreground">
                                    {{ guest.rsvp.song_suggestion }}
                                </p>
                            </div>
                            <Button
                                class="mt-4 w-full"
                                variant="outline"
                                as-child
                            >
                                <Link :href="`/admin/rsvps/${guest.rsvp.id}`">
                                    View Full RSVP
                                </Link>
                            </Button>
                        </CardContent>
                    </Card>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
