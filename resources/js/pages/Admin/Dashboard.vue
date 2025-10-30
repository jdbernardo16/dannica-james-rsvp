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
import { Head, Link } from '@inertiajs/vue3';
import {
    Calendar,
    Edit,
    Eye,
    MailCheck,
    TrendingUp,
    UserCheck,
    Users,
} from 'lucide-vue-next';

// Define props interface
interface DashboardStats {
    totalGroups: number;
    totalGuests: number;
    totalRsvps: number;
    totalAttending: number;
}

interface RecentRsvp {
    id: number;
    group_name: string;
    email: string;
    attending_count: number;
    submitted_at: string;
}

interface GroupWithRsvp {
    id: number;
    name: string;
    guest_count: number;
    max_attendees: number;
    has_rsvp: boolean;
}

interface Props {
    stats: DashboardStats;
    recentRsvps: RecentRsvp[];
    groupsWithRsvp: GroupWithRsvp[];
}

defineProps<Props>();

const breadcrumbItems: BreadcrumbItemType[] = [
    {
        title: 'Dashboard',
        href: '/admin/dashboard',
    },
];
</script>

<template>
    <Head title="Admin Dashboard" />

    <AdminLayout :breadcrumbs="breadcrumbItems">
        <div class="space-y-6 p-6">
            <!-- Page Header -->
            <div>
                <h1 class="text-3xl font-bold tracking-tight">Dashboard</h1>
                <p class="text-muted-foreground">
                    Overview of your wedding RSVP system
                </p>
            </div>

            <!-- Stats Cards -->
            <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-4">
                <Card>
                    <CardHeader
                        class="flex flex-row items-center justify-between space-y-0 pb-2"
                    >
                        <CardTitle class="text-sm font-medium"
                            >Total Groups</CardTitle
                        >
                        <Users class="h-4 w-4 text-muted-foreground" />
                    </CardHeader>
                    <CardContent>
                        <div class="text-2xl font-bold">
                            {{ stats.totalGroups }}
                        </div>
                        <p class="text-xs text-muted-foreground">
                            Registered groups
                        </p>
                    </CardContent>
                </Card>

                <Card>
                    <CardHeader
                        class="flex flex-row items-center justify-between space-y-0 pb-2"
                    >
                        <CardTitle class="text-sm font-medium"
                            >Total Guests</CardTitle
                        >
                        <UserCheck class="h-4 w-4 text-muted-foreground" />
                    </CardHeader>
                    <CardContent>
                        <div class="text-2xl font-bold">
                            {{ stats.totalGuests }}
                        </div>
                        <p class="text-xs text-muted-foreground">
                            Registered guests
                        </p>
                    </CardContent>
                </Card>

                <Card>
                    <CardHeader
                        class="flex flex-row items-center justify-between space-y-0 pb-2"
                    >
                        <CardTitle class="text-sm font-medium"
                            >Total RSVPs</CardTitle
                        >
                        <MailCheck class="h-4 w-4 text-muted-foreground" />
                    </CardHeader>
                    <CardContent>
                        <div class="text-2xl font-bold">
                            {{ stats.totalRsvps }}
                        </div>
                        <p class="text-xs text-muted-foreground">
                            Responses received
                        </p>
                    </CardContent>
                </Card>

                <Card>
                    <CardHeader
                        class="flex flex-row items-center justify-between space-y-0 pb-2"
                    >
                        <CardTitle class="text-sm font-medium"
                            >Attending</CardTitle
                        >
                        <TrendingUp class="h-4 w-4 text-muted-foreground" />
                    </CardHeader>
                    <CardContent>
                        <div class="text-2xl font-bold">
                            {{ stats.totalAttending }}
                        </div>
                        <p class="text-xs text-muted-foreground">
                            Confirmed attendees
                        </p>
                    </CardContent>
                </Card>
            </div>

            <!-- Recent RSVPs and Groups with RSVP -->
            <div class="grid gap-6 md:grid-cols-2">
                <!-- Recent RSVPs -->
                <Card>
                    <CardHeader>
                        <CardTitle>Recent RSVPs</CardTitle>
                        <CardDescription>
                            Latest responses from your guests
                        </CardDescription>
                    </CardHeader>
                    <CardContent>
                        <div class="space-y-4">
                            <div
                                v-if="recentRsvps.length === 0"
                                class="py-4 text-center text-muted-foreground"
                            >
                                No RSVPs yet
                            </div>
                            <div v-else class="space-y-3">
                                <div
                                    v-for="rsvp in recentRsvps"
                                    :key="rsvp.id"
                                    class="flex items-center justify-between rounded-lg border p-3"
                                >
                                    <div class="space-y-1">
                                        <p class="font-medium">
                                            {{ rsvp.group_name }}
                                        </p>
                                        <p
                                            class="text-sm text-muted-foreground"
                                        >
                                            {{ rsvp.email }}
                                        </p>
                                        <div class="flex items-center gap-2">
                                            <Badge variant="secondary"
                                                >{{
                                                    rsvp.attending_count
                                                }}
                                                attending</Badge
                                            >
                                            <span
                                                class="flex items-center gap-1 text-xs text-muted-foreground"
                                            >
                                                <Calendar class="h-3 w-3" />
                                                {{
                                                    new Date(
                                                        rsvp.submitted_at,
                                                    ).toLocaleDateString()
                                                }}
                                            </span>
                                        </div>
                                    </div>
                                    <Button variant="ghost" size="sm" as-child>
                                        <Link :href="`/admin/rsvps/${rsvp.id}`">
                                            <Eye class="h-4 w-4" />
                                        </Link>
                                    </Button>
                                </div>
                            </div>
                        </div>
                        <div v-if="recentRsvps.length > 0" class="mt-4">
                            <Button variant="outline" class="w-full" as-child>
                                <Link href="/admin/rsvps">View All RSVPs</Link>
                            </Button>
                        </div>
                    </CardContent>
                </Card>

                <!-- Groups with RSVP Status -->
                <Card>
                    <CardHeader>
                        <CardTitle>Groups RSVP Status</CardTitle>
                        <CardDescription>
                            Overview of groups and their RSVP status
                        </CardDescription>
                    </CardHeader>
                    <CardContent>
                        <Table>
                            <TableHeader>
                                <TableRow>
                                    <TableHead>Group Name</TableHead>
                                    <TableHead>Guests</TableHead>
                                    <TableHead>Status</TableHead>
                                    <TableHead>Actions</TableHead>
                                </TableRow>
                            </TableHeader>
                            <TableBody>
                                <TableRow v-if="groupsWithRsvp.length === 0">
                                    <TableCell
                                        colspan="4"
                                        class="py-4 text-center text-muted-foreground"
                                    >
                                        No groups found
                                    </TableCell>
                                </TableRow>
                                <TableRow
                                    v-for="group in groupsWithRsvp"
                                    :key="group.id"
                                >
                                    <TableCell class="font-medium">{{
                                        group.name
                                    }}</TableCell>
                                    <TableCell
                                        >{{ group.guest_count }} /
                                        {{ group.max_attendees }}</TableCell
                                    >
                                    <TableCell>
                                        <Badge
                                            :variant="
                                                group.has_rsvp
                                                    ? 'default'
                                                    : 'secondary'
                                            "
                                        >
                                            {{
                                                group.has_rsvp
                                                    ? 'Responded'
                                                    : 'Pending'
                                            }}
                                        </Badge>
                                    </TableCell>
                                    <TableCell>
                                        <div class="flex items-center gap-2">
                                            <Button
                                                variant="ghost"
                                                size="sm"
                                                as-child
                                            >
                                                <Link
                                                    :href="`/admin/groups/${group.id}`"
                                                >
                                                    <Eye class="h-4 w-4" />
                                                </Link>
                                            </Button>
                                            <Button
                                                variant="ghost"
                                                size="sm"
                                                as-child
                                            >
                                                <Link
                                                    :href="`/admin/groups/${group.id}/edit`"
                                                >
                                                    <Edit class="h-4 w-4" />
                                                </Link>
                                            </Button>
                                        </div>
                                    </TableCell>
                                </TableRow>
                            </TableBody>
                        </Table>
                        <div v-if="groupsWithRsvp.length > 0" class="mt-4">
                            <Button variant="outline" class="w-full" as-child>
                                <Link href="/admin/groups"
                                    >View All Groups</Link
                                >
                            </Button>
                        </div>
                    </CardContent>
                </Card>
            </div>
        </div>
    </AdminLayout>
</template>
