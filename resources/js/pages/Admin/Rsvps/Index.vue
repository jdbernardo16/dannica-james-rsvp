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
import {
    Select,
    SelectContent,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from '@/components/ui/select';
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
import { Head, Link, router } from '@inertiajs/vue3';
import { Calendar, Download, Eye, Filter, Search } from 'lucide-vue-next';
import { ref, watch } from 'vue';

// Define props interface
interface Rsvp {
    id: number;
    group_name: string;
    email: string;
    attending_count: number;
    max_attendees: number;
    message: string;
    song_suggestion: string;
    submitted_at: string;
}

interface PaginationLink {
    url: string | null;
    label: string;
    active: boolean;
}

interface Pagination {
    data: Rsvp[];
    current_page: number;
    from: number;
    last_page: number;
    per_page: number;
    to: number;
    total: number;
    links: PaginationLink[];
}

interface Props {
    rsvps: Pagination;
    filters: {
        search: string;
        status: string;
        date_from: string;
        date_to: string;
        per_page: string;
    };
}

const props = defineProps<Props>();

const search = ref(props.filters.search);
const status = ref(props.filters.status);
const dateFrom = ref(props.filters.date_from);
const dateTo = ref(props.filters.date_to);
const perPage = ref(props.filters.per_page);

const breadcrumbItems: BreadcrumbItemType[] = [
    {
        title: 'Dashboard',
        href: '/admin/dashboard',
    },
    {
        title: 'RSVPs',
        href: '/admin/rsvps',
    },
];

// Watch for changes and update URL
watch([search, status, dateFrom, dateTo, perPage], () => {
    router.get(
        '/admin/rsvps',
        {
            search: search.value,
            status: status.value,
            date_from: dateFrom.value,
            date_to: dateTo.value,
            per_page: perPage.value,
        },
        {
            preserveState: true,
            replace: true,
        },
    );
});

const exportRsvps = () => {
    const params = new URLSearchParams();
    if (search.value) params.append('search', search.value);
    if (status.value) params.append('status', status.value);
    if (dateFrom.value) params.append('date_from', dateFrom.value);
    if (dateTo.value) params.append('date_to', dateTo.value);

    window.location.href = `/admin/rsvps/export?${params.toString()}`;
};

const getAttendanceStatus = (attendingCount: number, maxAttendees: number) => {
    if (attendingCount === 0)
        return { variant: 'destructive', label: 'Not Attending' };
    if (attendingCount >= maxAttendees)
        return { variant: 'default', label: 'Full Group Attending' };
    return { variant: 'secondary', label: 'Partial Attendance' };
};

const formatDate = (dateString: string) => {
    return new Date(dateString).toLocaleDateString();
};
</script>

<template>
    <Head title="RSVPs - Admin" />

    <AdminLayout :breadcrumbs="breadcrumbItems">
        <div class="space-y-6 p-6">
            <!-- Page Header -->
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold tracking-tight">RSVPs</h1>
                    <p class="text-muted-foreground">
                        Manage wedding RSVP responses
                    </p>
                </div>
                <Button @click="exportRsvps">
                    <Download class="mr-2 h-4 w-4" />
                    Export RSVPs
                </Button>
            </div>

            <!-- Filters Card -->
            <Card>
                <CardHeader>
                    <CardTitle>Filters</CardTitle>
                    <CardDescription>
                        Search and filter RSVP responses
                    </CardDescription>
                </CardHeader>
                <CardContent>
                    <div class="grid gap-4 md:grid-cols-6">
                        <div class="relative">
                            <Search
                                class="absolute top-1/2 left-3 h-4 w-4 -translate-y-1/2 text-muted-foreground"
                            />
                            <Input
                                v-model="search"
                                placeholder="Search RSVPs..."
                                class="pl-10"
                            />
                        </div>
                        <Select v-model="status">
                            <SelectTrigger>
                                <SelectValue
                                    placeholder="Filter by attendance"
                                />
                            </SelectTrigger>
                            <SelectContent>
                                <SelectItem value="all">All Status</SelectItem>
                                <SelectItem value="attending"
                                    >Attending</SelectItem
                                >
                                <SelectItem value="not-attending"
                                    >Not Attending</SelectItem
                                >
                                <SelectItem value="partial">Partial</SelectItem>
                            </SelectContent>
                        </Select>
                        <div class="relative">
                            <Calendar
                                class="absolute top-1/2 left-3 h-4 w-4 -translate-y-1/2 text-muted-foreground"
                            />
                            <Input
                                v-model="dateFrom"
                                type="date"
                                placeholder="From date"
                                class="pl-10"
                            />
                        </div>
                        <div class="relative">
                            <Calendar
                                class="absolute top-1/2 left-3 h-4 w-4 -translate-y-1/2 text-muted-foreground"
                            />
                            <Input
                                v-model="dateTo"
                                type="date"
                                placeholder="To date"
                                class="pl-10"
                            />
                        </div>
                        <Select v-model="perPage">
                            <SelectTrigger>
                                <SelectValue placeholder="Per page" />
                            </SelectTrigger>
                            <SelectContent>
                                <SelectItem value="10">10 per page</SelectItem>
                                <SelectItem value="25">25 per page</SelectItem>
                                <SelectItem value="50">50 per page</SelectItem>
                                <SelectItem value="100"
                                    >100 per page</SelectItem
                                >
                            </SelectContent>
                        </Select>
                        <Button
                            variant="outline"
                            @click="
                                search = '';
                                status = '';
                                dateFrom = '';
                                dateTo = '';
                                perPage = '10';
                            "
                        >
                            <Filter class="mr-2 h-4 w-4" />
                            Reset Filters
                        </Button>
                    </div>
                </CardContent>
            </Card>

            <!-- RSVPs Table -->
            <Card>
                <CardHeader>
                    <CardTitle>RSVP Responses ({{ rsvps.total }})</CardTitle>
                    <CardDescription>
                        Showing {{ rsvps.from }} to {{ rsvps.to }} of
                        {{ rsvps.total }} RSVP responses
                    </CardDescription>
                </CardHeader>
                <CardContent>
                    <div
                        v-if="rsvps.data.length === 0"
                        class="py-8 text-center"
                    >
                        <p class="text-muted-foreground">
                            No RSVP responses found
                        </p>
                    </div>
                    <Table v-else>
                        <TableHeader>
                            <TableRow>
                                <TableHead>Group</TableHead>
                                <TableHead>Email</TableHead>
                                <TableHead>Attendance</TableHead>
                                <TableHead>Date Submitted</TableHead>
                                <TableHead>Message</TableHead>
                                <TableHead>Song</TableHead>
                                <TableHead class="text-right"
                                    >Actions</TableHead
                                >
                            </TableRow>
                        </TableHeader>
                        <TableBody>
                            <TableRow v-for="rsvp in rsvps.data" :key="rsvp.id">
                                <TableCell class="font-medium">{{
                                    rsvp.group_name
                                }}</TableCell>
                                <TableCell>{{ rsvp.email }}</TableCell>
                                <TableCell>
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
                                            class="text-xs text-muted-foreground"
                                        >
                                            {{ rsvp.attending_count }} /
                                            {{ rsvp.max_attendees }} attending
                                        </p>
                                    </div>
                                </TableCell>
                                <TableCell>{{
                                    formatDate(rsvp.submitted_at)
                                }}</TableCell>
                                <TableCell>
                                    <p class="max-w-xs truncate text-sm">
                                        {{ rsvp.message || 'No message' }}
                                    </p>
                                </TableCell>
                                <TableCell>
                                    <p class="max-w-xs truncate text-sm">
                                        {{
                                            rsvp.song_suggestion ||
                                            'No song suggestion'
                                        }}
                                    </p>
                                </TableCell>
                                <TableCell class="text-right">
                                    <Button variant="ghost" size="sm" as-child>
                                        <Link :href="`/admin/rsvps/${rsvp.id}`">
                                            <Eye class="h-4 w-4" />
                                        </Link>
                                    </Button>
                                </TableCell>
                            </TableRow>
                        </TableBody>
                    </Table>

                    <!-- Pagination -->
                    <div v-if="rsvps.last_page > 1" class="mt-4">
                        <div class="flex items-center justify-between">
                            <div class="text-sm text-muted-foreground">
                                Page {{ rsvps.current_page }} of
                                {{ rsvps.last_page }}
                            </div>
                            <div class="flex items-center gap-2">
                                <Button
                                    v-for="link in rsvps.links"
                                    :key="link.label"
                                    :variant="
                                        link.active ? 'default' : 'outline'
                                    "
                                    :disabled="!link.url"
                                    size="sm"
                                    as-child
                                >
                                    <Link v-if="link.url" :href="link.url">
                                        {{ link.label }}
                                    </Link>
                                    <span v-else>{{ link.label }}</span>
                                </Button>
                            </div>
                        </div>
                    </div>
                </CardContent>
            </Card>
        </div>
    </AdminLayout>
</template>
