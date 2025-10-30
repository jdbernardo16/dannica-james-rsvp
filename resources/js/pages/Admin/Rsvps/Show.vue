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
import { Separator } from '@/components/ui/separator';
import AdminLayout from '@/layouts/AdminLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import {
    ArrowLeft,
    Calendar,
    Mail,
    MessageSquare,
    Music,
    Users,
} from 'lucide-vue-next';

interface Guest {
    id: number;
    full_name: string;
    email: string;
}

interface Rsvp {
    id: number;
    group_name: string;
    group_id: number;
    email: string;
    attending_count: number;
    max_attendees: number;
    message: string;
    song_suggestion: string;
    submitted_at: string;
    group: {
        id: number;
        name: string;
        guests: Guest[];
    };
}

interface Props {
    rsvp: Rsvp;
}

const props = defineProps<Props>();

const getAttendanceStatus = (attendingCount: number, maxAttendees: number) => {
    if (attendingCount === 0)
        return { variant: 'destructive', label: 'Not Attending' };
    if (attendingCount >= maxAttendees)
        return { variant: 'default', label: 'Full Group Attending' };
    return { variant: 'secondary', label: 'Partial Attendance' };
};

const formatDate = (dateString: string) => {
    return new Date(dateString).toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit',
    });
};
</script>

<template>
    <Head title="RSVP Details - Admin" />

    <AdminLayout
        :breadcrumbs="[
            { title: 'Dashboard', href: '/admin/dashboard' },
            { title: 'RSVPs', href: '/admin/rsvps' },
            { title: rsvp.group_name, href: `/admin/rsvps/${rsvp.id}` },
        ]"
    >
        <div class="space-y-6 p-6">
            <!-- Page Header -->
            <div class="flex items-center gap-4">
                <Button variant="outline" size="sm" as-child>
                    <Link href="/admin/rsvps">
                        <ArrowLeft class="mr-2 h-4 w-4" />
                        Back to RSVPs
                    </Link>
                </Button>
                <div>
                    <h1 class="text-3xl font-bold tracking-tight">
                        RSVP Details
                    </h1>
                    <p class="text-muted-foreground">
                        Response from {{ rsvp.group_name }}
                    </p>
                </div>
            </div>

            <div class="grid gap-6 lg:grid-cols-3">
                <!-- Main RSVP Details -->
                <div class="space-y-6 lg:col-span-2">
                    <!-- RSVP Information Card -->
                    <Card>
                        <CardHeader>
                            <CardTitle>RSVP Information</CardTitle>
                            <CardDescription>
                                Details of the wedding response
                            </CardDescription>
                        </CardHeader>
                        <CardContent class="space-y-4">
                            <div class="grid gap-4 md:grid-cols-2">
                                <div>
                                    <h4
                                        class="mb-1 text-sm font-medium text-muted-foreground"
                                    >
                                        Group Name
                                    </h4>
                                    <p class="font-medium">
                                        {{ rsvp.group_name }}
                                    </p>
                                </div>
                                <div>
                                    <h4
                                        class="mb-1 text-sm font-medium text-muted-foreground"
                                    >
                                        Email
                                    </h4>
                                    <div class="flex items-center gap-2">
                                        <Mail
                                            class="h-4 w-4 text-muted-foreground"
                                        />
                                        <p>{{ rsvp.email }}</p>
                                    </div>
                                </div>
                                <div>
                                    <h4
                                        class="mb-1 text-sm font-medium text-muted-foreground"
                                    >
                                        Attendance Status
                                    </h4>
                                    <div class="space-y-1">
                                        <Badge
                                            :variant="
                                                getAttendanceStatus(
                                                    rsvp.attending_count,
                                                    rsvp.max_attendees,
                                                ).variant as any
                                            "
                                        >
                                            {{
                                                getAttendanceStatus(
                                                    rsvp.attending_count,
                                                    rsvp.max_attendees,
                                                ).label
                                            }}
                                        </Badge>
                                        <p
                                            class="text-sm text-muted-foreground"
                                        >
                                            {{ rsvp.attending_count }} out of
                                            {{ rsvp.max_attendees }} guests
                                            attending
                                        </p>
                                    </div>
                                </div>
                                <div>
                                    <h4
                                        class="mb-1 text-sm font-medium text-muted-foreground"
                                    >
                                        Submitted
                                    </h4>
                                    <div class="flex items-center gap-2">
                                        <Calendar
                                            class="h-4 w-4 text-muted-foreground"
                                        />
                                        <p>
                                            {{ formatDate(rsvp.submitted_at) }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <Separator />

                            <div v-if="rsvp.message" class="space-y-2">
                                <h4
                                    class="flex items-center gap-2 text-sm font-medium"
                                >
                                    <MessageSquare class="h-4 w-4" />
                                    Message
                                </h4>
                                <div class="rounded-md bg-muted/50 p-4">
                                    <p class="whitespace-pre-wrap">
                                        {{ rsvp.message }}
                                    </p>
                                </div>
                            </div>

                            <div v-if="rsvp.song_suggestion" class="space-y-2">
                                <h4
                                    class="flex items-center gap-2 text-sm font-medium"
                                >
                                    <Music class="h-4 w-4" />
                                    Song Suggestion
                                </h4>
                                <div class="rounded-md bg-muted/50 p-4">
                                    <p>{{ rsvp.song_suggestion }}</p>
                                </div>
                            </div>
                        </CardContent>
                    </Card>

                    <!-- Group Guests Card -->
                    <Card>
                        <CardHeader>
                            <CardTitle
                                >Group Guests ({{
                                    rsvp.group.guests.length
                                }})</CardTitle
                            >
                            <CardDescription>
                                Guests in this group
                            </CardDescription>
                        </CardHeader>
                        <CardContent>
                            <div
                                v-if="rsvp.group.guests.length === 0"
                                class="py-4 text-center text-muted-foreground"
                            >
                                No guests found in this group
                            </div>
                            <div v-else class="space-y-3">
                                <div
                                    v-for="guest in rsvp.group.guests"
                                    :key="guest.id"
                                    class="flex items-center justify-between rounded-md border p-3"
                                >
                                    <div>
                                        <p class="font-medium">
                                            {{ guest.full_name }}
                                        </p>
                                        <p
                                            class="text-sm text-muted-foreground"
                                        >
                                            {{ guest.email }}
                                        </p>
                                    </div>
                                    <div class="flex items-center gap-2">
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
                                    </div>
                                </div>
                            </div>
                        </CardContent>
                    </Card>
                </div>

                <!-- Sidebar -->
                <div class="space-y-6 p-6">
                    <!-- Quick Actions -->
                    <Card>
                        <CardHeader>
                            <CardTitle class="text-lg">Quick Actions</CardTitle>
                        </CardHeader>
                        <CardContent class="space-y-3">
                            <Button class="w-full" variant="outline" as-child>
                                <Link :href="`/admin/groups/${rsvp.group_id}`">
                                    <Users class="mr-2 h-4 w-4" />
                                    View Group
                                </Link>
                            </Button>
                            <Button class="w-full" variant="outline" as-child>
                                <Link
                                    :href="`/admin/guests?group_id=${rsvp.group_id}`"
                                >
                                    <Users class="mr-2 h-4 w-4" />
                                    View All Guests
                                </Link>
                            </Button>
                        </CardContent>
                    </Card>

                    <!-- RSVP Statistics -->
                    <Card>
                        <CardHeader>
                            <CardTitle class="text-lg"
                                >RSVP Statistics</CardTitle
                            >
                        </CardHeader>
                        <CardContent class="space-y-4">
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium"
                                    >Total Guests</span
                                >
                                <Badge variant="outline">{{
                                    rsvp.max_attendees
                                }}</Badge>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium"
                                    >Attending</span
                                >
                                <Badge
                                    :variant="
                                        rsvp.attending_count > 0
                                            ? 'default'
                                            : 'destructive'
                                    "
                                >
                                    {{ rsvp.attending_count }}
                                </Badge>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium"
                                    >Not Attending</span
                                >
                                <Badge variant="secondary">
                                    {{
                                        rsvp.max_attendees -
                                        rsvp.attending_count
                                    }}
                                </Badge>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium"
                                    >Attendance Rate</span
                                >
                                <Badge variant="outline">
                                    {{
                                        Math.round(
                                            (rsvp.attending_count /
                                                rsvp.max_attendees) *
                                                100,
                                        )
                                    }}%
                                </Badge>
                            </div>
                        </CardContent>
                    </Card>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
