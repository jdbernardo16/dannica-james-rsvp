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
    UserPlus,
    Users,
} from 'lucide-vue-next';
import { computed } from 'vue';

interface Guest {
    id: number;
    full_name: string;
    email: string;
}

interface Rsvp {
    id: number;
    attending_count: number;
    message: string;
    song_suggestion: string;
    submitted_at: string;
    email: string;
}

interface Group {
    id: number;
    name: string;
    max_attendees: number;
    guests: Guest[];
    rsvps: Rsvp[];
}

interface Props {
    group: Group;
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
    return props.group.rsvps && props.group.rsvps.length > 0;
});

const latestRsvp = computed(() => {
    return hasRsvp.value ? props.group.rsvps[0] : null;
});

const attendanceRate = computed(() => {
    if (!hasRsvp.value) return 0;
    return Math.round(
        (latestRsvp.value!.attending_count / props.group.max_attendees) * 100,
    );
});
</script>

<template>
    <Head title="Group Details - Admin" />

    <AdminLayout
        :breadcrumbs="[
            { title: 'Dashboard', href: '/admin/dashboard' },
            { title: 'Groups', href: '/admin/groups' },
            { title: group.name, href: `/admin/groups/${group.id}` },
        ]"
    >
        <div class="space-y-6 p-6">
            <!-- Page Header -->
            <div class="flex items-center justify-between gap-4">
                <div class="flex items-center gap-4">
                    <Button variant="outline" size="sm" as-child>
                        <Link href="/admin/groups">
                            <ArrowLeft class="mr-2 h-4 w-4" />
                            Back to Groups
                        </Link>
                    </Button>
                    <div>
                        <h1 class="text-3xl font-bold tracking-tight">
                            Group Details
                        </h1>
                        <p class="text-muted-foreground">
                            Information for {{ group.name }}
                        </p>
                    </div>
                </div>
                <div class="flex gap-2">
                    <Button variant="outline" as-child>
                        <Link
                            :href="`/admin/guests/create?group_id=${group.id}`"
                        >
                            <UserPlus class="mr-2 h-4 w-4" />
                            Add Guest
                        </Link>
                    </Button>
                    <Button as-child>
                        <Link :href="`/admin/groups/${group.id}/edit`">
                            <Edit class="mr-2 h-4 w-4" />
                            Edit Group
                        </Link>
                    </Button>
                </div>
            </div>

            <div class="grid gap-6 lg:grid-cols-3">
                <!-- Main Group Details -->
                <div class="space-y-6 lg:col-span-2">
                    <!-- Group Information Card -->
                    <Card>
                        <CardHeader>
                            <CardTitle>Group Information</CardTitle>
                            <CardDescription>
                                Details about the group
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
                                    <p class="text-lg font-medium">
                                        {{ group.name }}
                                    </p>
                                </div>
                                <div>
                                    <h4
                                        class="mb-1 text-sm font-medium text-muted-foreground"
                                    >
                                        Maximum Attendees
                                    </h4>
                                    <p class="font-medium">
                                        {{ group.max_attendees }} guests
                                    </p>
                                </div>
                            </div>
                        </CardContent>
                    </Card>

                    <!-- Group Guests Card -->
                    <Card>
                        <CardHeader>
                            <CardTitle
                                >Group Guests ({{
                                    group.guests.length
                                }})</CardTitle
                            >
                            <CardDescription>
                                People in this group
                            </CardDescription>
                        </CardHeader>
                        <CardContent>
                            <div
                                v-if="group.guests.length === 0"
                                class="py-8 text-center text-muted-foreground"
                            >
                                <Users
                                    class="mx-auto mb-4 h-12 w-12 opacity-50"
                                />
                                <h3 class="mb-2 text-lg font-medium">
                                    No Guests Found
                                </h3>
                                <p>This group doesn't have any guests yet.</p>
                                <Button class="mt-4" variant="outline" as-child>
                                    <Link
                                        :href="`/admin/guests/create?group_id=${group.id}`"
                                    >
                                        <UserPlus class="mr-2 h-4 w-4" />
                                        Add First Guest
                                    </Link>
                                </Button>
                            </div>
                            <div v-else class="space-y-3">
                                <div
                                    v-for="guest in group.guests"
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
                                            {{
                                                guest.email ||
                                                'No email provided'
                                            }}
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
                                                <User class="mr-2 h-4 w-4" />
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
                                                <Edit class="mr-2 h-4 w-4" />
                                                Edit
                                            </Link>
                                        </Button>
                                    </div>
                                </div>
                            </div>
                        </CardContent>
                    </Card>

                    <!-- RSVP History Card -->
                    <Card>
                        <CardHeader>
                            <CardTitle>RSVP History</CardTitle>
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
                                    This group has not submitted any RSVPs yet.
                                </p>
                            </div>
                            <div v-else class="space-y-4">
                                <div
                                    v-for="(rsvp, index) in group.rsvps"
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
                                                        group.max_attendees,
                                                    ).variant as any
                                                "
                                                class="mb-2"
                                            >
                                                {{
                                                    getAttendanceStatus(
                                                        rsvp.attending_count,
                                                        group.max_attendees,
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
                                        <div class="flex gap-2">
                                            <Badge
                                                v-if="index === 0"
                                                variant="outline"
                                                >Latest</Badge
                                            >
                                            <Button
                                                variant="outline"
                                                size="sm"
                                                as-child
                                            >
                                                <Link
                                                    :href="`/admin/rsvps/${rsvp.id}`"
                                                >
                                                    View Details
                                                </Link>
                                            </Button>
                                        </div>
                                    </div>

                                    <div class="mb-3 grid gap-3 md:grid-cols-2">
                                        <div>
                                            <span class="text-sm font-medium"
                                                >Attending:</span
                                            >
                                            <span class="ml-2"
                                                >{{ rsvp.attending_count }} out
                                                of
                                                {{ group.max_attendees }}</span
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
                                                            group.max_attendees) *
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

                    <!-- Group Statistics -->
                    <Card>
                        <CardHeader>
                            <CardTitle class="text-lg"
                                >Group Statistics</CardTitle
                            >
                        </CardHeader>
                        <CardContent class="space-y-4">
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium"
                                    >Total Guests</span
                                >
                                <Badge variant="outline">{{
                                    group.guests.length
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
                                        group.max_attendees -
                                        latestRsvp.attending_count
                                    }}
                                </Badge>
                            </div>
                            <div
                                v-if="hasRsvp"
                                class="flex items-center justify-between"
                            >
                                <span class="text-sm font-medium"
                                    >Attendance Rate</span
                                >
                                <Badge variant="outline"
                                    >{{ attendanceRate }}%</Badge
                                >
                            </div>
                            <Separator />
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium"
                                    >Total RSVPs</span
                                >
                                <Badge variant="outline">{{
                                    group.rsvps.length
                                }}</Badge>
                            </div>
                        </CardContent>
                    </Card>

                    <!-- Email Summary -->
                    <Card>
                        <CardHeader>
                            <CardTitle class="text-lg">Email Summary</CardTitle>
                        </CardHeader>
                        <CardContent class="space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium"
                                    >Guests with Email</span
                                >
                                <Badge variant="outline">
                                    {{
                                        group.guests.filter((g) => g.email)
                                            .length
                                    }}
                                </Badge>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium"
                                    >Guests without Email</span
                                >
                                <Badge variant="outline">
                                    {{
                                        group.guests.filter((g) => !g.email)
                                            .length
                                    }}
                                </Badge>
                            </div>
                            <div
                                v-if="hasRsvp && latestRsvp && latestRsvp.email"
                                class="mt-3"
                            >
                                <span class="text-sm font-medium"
                                    >RSVP Email:</span
                                >
                                <div class="mt-1 flex items-center gap-2">
                                    <Mail
                                        class="h-4 w-4 text-muted-foreground"
                                    />
                                    <a
                                        :href="`mailto:${latestRsvp.email}`"
                                        class="text-sm text-primary hover:underline"
                                    >
                                        {{ latestRsvp.email }}
                                    </a>
                                </div>
                            </div>
                        </CardContent>
                    </Card>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
