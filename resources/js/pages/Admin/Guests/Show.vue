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
    Edit,
    Mail,
    MessageSquare,
    Music,
    User,
    Users,
} from 'lucide-vue-next';
import { computed } from 'vue';

interface Rsvp {
    id: number;
    attending_count: number;
    message: string;
    song_suggestion: string;
    submitted_at: string;
}

interface Group {
    id: number;
    name: string;
    max_attendees: number;
    rsvps: Rsvp[];
}

interface Guest {
    id: number;
    full_name: string;
    email: string;
    group: Group;
}

interface Props {
    guest: Guest;
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

const hasRsvp = computed(() => {
    return props.guest.group.rsvps && props.guest.group.rsvps.length > 0;
});

const latestRsvp = computed(() => {
    return hasRsvp.value ? props.guest.group.rsvps[0] : null;
});
</script>

<template>
    <Head title="Guest Details - Admin" />

    <AdminLayout
        :breadcrumbs="[
            { title: 'Dashboard', href: '/admin/dashboard' },
            { title: 'Guests', href: '/admin/guests' },
            { title: guest.full_name, href: `/admin/guests/${guest.id}` },
        ]"
    >
        <div class="space-y-6 p-6">
            <!-- Page Header -->
            <div class="flex items-center justify-between gap-4">
                <div class="flex items-center gap-4">
                    <Button variant="outline" size="sm" as-child>
                        <Link href="/admin/guests">
                            <ArrowLeft class="mr-2 h-4 w-4" />
                            Back to Guests
                        </Link>
                    </Button>
                    <div>
                        <h1 class="text-3xl font-bold tracking-tight">
                            Guest Details
                        </h1>
                        <p class="text-muted-foreground">
                            Information for {{ guest.full_name }}
                        </p>
                    </div>
                </div>
                <Button as-child>
                    <Link :href="`/admin/guests/${guest.id}/edit`">
                        <Edit class="mr-2 h-4 w-4" />
                        Edit Guest
                    </Link>
                </Button>
            </div>

            <div class="grid gap-6 lg:grid-cols-3">
                <!-- Main Guest Details -->
                <div class="space-y-6 lg:col-span-2">
                    <!-- Guest Information Card -->
                    <Card>
                        <CardHeader>
                            <CardTitle>Guest Information</CardTitle>
                            <CardDescription>
                                Personal details of the guest
                            </CardDescription>
                        </CardHeader>
                        <CardContent class="space-y-4">
                            <div class="grid gap-4 md:grid-cols-2">
                                <div>
                                    <h4
                                        class="mb-1 text-sm font-medium text-muted-foreground"
                                    >
                                        Full Name
                                    </h4>
                                    <div class="flex items-center gap-2">
                                        <User
                                            class="h-4 w-4 text-muted-foreground"
                                        />
                                        <p class="font-medium">
                                            {{ guest.full_name }}
                                        </p>
                                    </div>
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
                                        <p>
                                            {{
                                                guest.email ||
                                                'No email provided'
                                            }}
                                        </p>
                                    </div>
                                </div>
                                <div>
                                    <h4
                                        class="mb-1 text-sm font-medium text-muted-foreground"
                                    >
                                        Group
                                    </h4>
                                    <div class="flex items-center gap-2">
                                        <Users
                                            class="h-4 w-4 text-muted-foreground"
                                        />
                                        <Button
                                            variant="link"
                                            as-child
                                            class="h-auto p-0 font-medium"
                                        >
                                            <Link
                                                :href="`/admin/groups/${guest.group.id}`"
                                            >
                                                {{ guest.group.name }}
                                            </Link>
                                        </Button>
                                    </div>
                                </div>
                                <div>
                                    <h4
                                        class="mb-1 text-sm font-medium text-muted-foreground"
                                    >
                                        Max Attendees in Group
                                    </h4>
                                    <p>
                                        {{ guest.group.max_attendees }} guests
                                    </p>
                                </div>
                            </div>
                        </CardContent>
                    </Card>

                    <!-- RSVP History Card -->
                    <Card>
                        <CardHeader>
                            <CardTitle>Group RSVP History</CardTitle>
                            <CardDescription>
                                Recent RSVP submissions from this group
                            </CardDescription>
                        </CardHeader>
                        <CardContent>
                            <div
                                v-if="!hasRsvp"
                                class="py-8 text-center text-muted-foreground"
                            >
                                <Calendar
                                    class="mx-auto mb-4 h-12 w-12 opacity-50"
                                />
                                <h3 class="mb-2 text-lg font-medium">
                                    No RSVPs Found
                                </h3>
                                <p>
                                    This guest's group has not submitted any
                                    RSVPs yet.
                                </p>
                            </div>
                            <div v-else class="space-y-4">
                                <div
                                    v-for="(rsvp, index) in guest.group.rsvps"
                                    :key="rsvp.id"
                                    class="rounded-md border p-4"
                                    :class="{ 'border-primary': index === 0 }"
                                >
                                    <div
                                        class="mb-3 flex items-start justify-between"
                                    >
                                        <div>
                                            <Badge
                                                :variant="
                                                    getAttendanceStatus(
                                                        rsvp.attending_count,
                                                        guest.group
                                                            .max_attendees,
                                                    ).variant as any
                                                "
                                                class="mb-2"
                                            >
                                                {{
                                                    getAttendanceStatus(
                                                        rsvp.attending_count,
                                                        guest.group
                                                            .max_attendees,
                                                    ).label
                                                }}
                                            </Badge>
                                            <p
                                                class="flex items-center gap-2 text-sm text-muted-foreground"
                                            >
                                                <Calendar class="h-4 w-4" />
                                                {{
                                                    formatDate(
                                                        rsvp.submitted_at,
                                                    )
                                                }}
                                            </p>
                                        </div>
                                        <Badge
                                            v-if="index === 0"
                                            variant="outline"
                                            >Latest</Badge
                                        >
                                    </div>

                                    <div class="mb-3 grid gap-3 md:grid-cols-2">
                                        <div>
                                            <span class="text-sm font-medium"
                                                >Attending:</span
                                            >
                                            <span class="ml-2"
                                                >{{ rsvp.attending_count }} out
                                                of
                                                {{
                                                    guest.group.max_attendees
                                                }}</span
                                            >
                                        </div>
                                        <div>
                                            <span class="text-sm font-medium"
                                                >Attendance Rate:</span
                                            >
                                            <span class="ml-2">
                                                {{
                                                    Math.round(
                                                        (rsvp.attending_count /
                                                            guest.group
                                                                .max_attendees) *
                                                            100,
                                                    )
                                                }}%
                                            </span>
                                        </div>
                                    </div>

                                    <div v-if="rsvp.message" class="mb-3">
                                        <h4
                                            class="mb-2 flex items-center gap-2 text-sm font-medium"
                                        >
                                            <MessageSquare class="h-4 w-4" />
                                            Message
                                        </h4>
                                        <div class="rounded-md bg-muted/50 p-3">
                                            <p
                                                class="text-sm whitespace-pre-wrap"
                                            >
                                                {{ rsvp.message }}
                                            </p>
                                        </div>
                                    </div>

                                    <div v-if="rsvp.song_suggestion">
                                        <h4
                                            class="mb-2 flex items-center gap-2 text-sm font-medium"
                                        >
                                            <Music class="h-4 w-4" />
                                            Song Suggestion
                                        </h4>
                                        <div class="rounded-md bg-muted/50 p-3">
                                            <p class="text-sm">
                                                {{ rsvp.song_suggestion }}
                                            </p>
                                        </div>
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
                                <Link :href="`/admin/groups/${guest.group.id}`">
                                    <Users class="mr-2 h-4 w-4" />
                                    View Group
                                </Link>
                            </Button>
                            <Button class="w-full" variant="outline" as-child>
                                <Link
                                    :href="`/admin/guests?group_id=${guest.group.id}`"
                                >
                                    <Users class="mr-2 h-4 w-4" />
                                    View All Group Guests
                                </Link>
                            </Button>
                            <Button
                                v-if="hasRsvp && latestRsvp"
                                class="w-full"
                                variant="outline"
                                as-child
                            >
                                <Link :href="`/admin/rsvps/${latestRsvp.id}`">
                                    <Calendar class="mr-2 h-4 w-4" />
                                    View Latest RSVP
                                </Link>
                            </Button>
                        </CardContent>
                    </Card>

                    <!-- Guest Statistics -->
                    <Card>
                        <CardHeader>
                            <CardTitle class="text-lg"
                                >Group Statistics</CardTitle
                            >
                        </CardHeader>
                        <CardContent class="space-y-4">
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium"
                                    >Max Attendees</span
                                >
                                <Badge variant="outline">{{
                                    guest.group.max_attendees
                                }}</Badge>
                            </div>
                            <div
                                v-if="hasRsvp && latestRsvp"
                                class="flex items-center justify-between"
                            >
                                <span class="text-sm font-medium"
                                    >Attending</span
                                >
                                <Badge
                                    :variant="
                                        latestRsvp.attending_count > 0
                                            ? 'default'
                                            : 'destructive'
                                    "
                                >
                                    {{ latestRsvp.attending_count }}
                                </Badge>
                            </div>
                            <div
                                v-if="hasRsvp && latestRsvp"
                                class="flex items-center justify-between"
                            >
                                <span class="text-sm font-medium"
                                    >Not Attending</span
                                >
                                <Badge variant="secondary">
                                    {{
                                        guest.group.max_attendees -
                                        latestRsvp.attending_count
                                    }}
                                </Badge>
                            </div>
                            <div
                                v-if="hasRsvp && latestRsvp"
                                class="flex items-center justify-between"
                            >
                                <span class="text-sm font-medium"
                                    >Attendance Rate</span
                                >
                                <Badge variant="outline">
                                    {{
                                        Math.round(
                                            (latestRsvp.attending_count /
                                                guest.group.max_attendees) *
                                                100,
                                        )
                                    }}%
                                </Badge>
                            </div>
                            <Separator />
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium"
                                    >Total RSVPs</span
                                >
                                <Badge variant="outline">{{
                                    guest.group.rsvps.length
                                }}</Badge>
                            </div>
                        </CardContent>
                    </Card>

                    <!-- Contact Information -->
                    <Card>
                        <CardHeader>
                            <CardTitle class="text-lg"
                                >Contact Information</CardTitle
                            >
                        </CardHeader>
                        <CardContent class="space-y-3">
                            <div
                                v-if="guest.email"
                                class="flex items-center gap-2"
                            >
                                <Mail class="h-4 w-4 text-muted-foreground" />
                                <a
                                    :href="`mailto:${guest.email}`"
                                    class="text-sm text-primary hover:underline"
                                >
                                    {{ guest.email }}
                                </a>
                            </div>
                            <div v-else class="text-sm text-muted-foreground">
                                No email address provided
                            </div>
                        </CardContent>
                    </Card>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
