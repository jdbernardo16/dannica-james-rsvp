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
import { Edit, Eye, Mail, Plus, Search, Trash2 } from 'lucide-vue-next';
import { ref, watch } from 'vue';

// Define props interface
interface Guest {
    id: number;
    full_name: string;
    email: string;
    group_name: string;
    group_id: number;
    has_rsvp: boolean;
    created_at: string;
}

interface Group {
    id: number;
    name: string;
}

interface PaginationLink {
    url: string | null;
    label: string;
    active: boolean;
}

interface Pagination {
    data: Guest[];
    current_page: number;
    from: number;
    last_page: number;
    per_page: number;
    to: number;
    total: number;
    links: PaginationLink[];
}

interface Props {
    guests: Pagination;
    groups: Group[];
    filters: {
        search: string;
        status: string;
        group_id: string;
        per_page: string;
    };
}

const props = defineProps<Props>();

const search = ref(props.filters.search);
const status = ref(props.filters.status);
const groupId = ref(props.filters.group_id);
const perPage = ref(props.filters.per_page);

const breadcrumbItems: BreadcrumbItemType[] = [
    {
        title: 'Dashboard',
        href: '/admin/dashboard',
    },
    {
        title: 'Guests',
        href: '/admin/guests',
    },
];

// Watch for changes and update URL
watch([search, status, groupId, perPage], () => {
    router.get(
        '/admin/guests',
        {
            search: search.value,
            status: status.value,
            group_id: groupId.value,
            per_page: perPage.value,
        },
        {
            preserveState: true,
            replace: true,
        },
    );
});

const deleteGuest = (id: number) => {
    if (
        confirm(
            'Are you sure you want to delete this guest? This action cannot be undone.',
        )
    ) {
        router.delete(`/admin/guests/${id}`, {
            preserveScroll: true,
        });
    }
};

const getStatusBadge = (hasRsvp: boolean) => {
    return hasRsvp
        ? { variant: 'default', label: 'Responded' }
        : { variant: 'secondary', label: 'Pending' };
};

const sendRsvpEmail = (guestId: number) => {
    if (confirm('Send RSVP invitation email to this guest?')) {
        router.post(
            `/admin/guests/${guestId}/send-rsvp`,
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
</script>

<template>
    <Head title="Guests - Admin" />

    <AdminLayout :breadcrumbs="breadcrumbItems">
        <div class="space-y-6 p-6">
            <!-- Page Header -->
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold tracking-tight">Guests</h1>
                    <p class="text-muted-foreground">
                        Manage guests for your wedding
                    </p>
                </div>
                <Button as-child>
                    <Link href="/admin/guests/create">
                        <Plus class="mr-2 h-4 w-4" />
                        Add Guest
                    </Link>
                </Button>
            </div>

            <!-- Filters Card -->
            <Card>
                <CardHeader>
                    <CardTitle>Filters</CardTitle>
                    <CardDescription>
                        Search and filter guests
                    </CardDescription>
                </CardHeader>
                <CardContent>
                    <div class="grid gap-4 md:grid-cols-5">
                        <div class="relative">
                            <Search
                                class="absolute top-1/2 left-3 h-4 w-4 -translate-y-1/2 text-muted-foreground"
                            />
                            <Input
                                v-model="search"
                                placeholder="Search guests..."
                                class="pl-10"
                            />
                        </div>
                        <Select v-model="status">
                            <SelectTrigger>
                                <SelectValue placeholder="Filter by status" />
                            </SelectTrigger>
                            <SelectContent>
                                <SelectItem value="all">All Status</SelectItem>
                                <SelectItem value="responded"
                                    >Responded</SelectItem
                                >
                                <SelectItem value="pending">Pending</SelectItem>
                            </SelectContent>
                        </Select>
                        <Select v-model="groupId">
                            <SelectTrigger>
                                <SelectValue placeholder="Filter by group" />
                            </SelectTrigger>
                            <SelectContent>
                                <SelectItem value="all">All Groups</SelectItem>
                                <SelectItem
                                    v-for="group in groups"
                                    :key="group.id"
                                    :value="group.id.toString()"
                                >
                                    {{ group.name }}
                                </SelectItem>
                            </SelectContent>
                        </Select>
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
                                groupId = '';
                                perPage = '10';
                            "
                        >
                            Reset Filters
                        </Button>
                    </div>
                </CardContent>
            </Card>

            <!-- Guests Table -->
            <Card>
                <CardHeader>
                    <CardTitle>Guests ({{ guests.total }})</CardTitle>
                    <CardDescription>
                        Showing {{ guests.from }} to {{ guests.to }} of
                        {{ guests.total }} guests
                    </CardDescription>
                </CardHeader>
                <CardContent>
                    <div
                        v-if="guests.data.length === 0"
                        class="py-8 text-center"
                    >
                        <p class="text-muted-foreground">No guests found</p>
                        <Button class="mt-4" as-child>
                            <Link href="/admin/guests/create">
                                <Plus class="mr-2 h-4 w-4" />
                                Create your first guest
                            </Link>
                        </Button>
                    </div>
                    <Table v-else>
                        <TableHeader>
                            <TableRow>
                                <TableHead>Name</TableHead>
                                <TableHead>Email</TableHead>
                                <TableHead>Group</TableHead>
                                <TableHead>Status</TableHead>
                                <TableHead>Created</TableHead>
                                <TableHead class="text-right"
                                    >Actions</TableHead
                                >
                            </TableRow>
                        </TableHeader>
                        <TableBody>
                            <TableRow
                                v-for="guest in guests.data"
                                :key="guest.id"
                            >
                                <TableCell class="font-medium">{{
                                    guest.full_name
                                }}</TableCell>
                                <TableCell>
                                    <div class="flex items-center gap-2">
                                        <Mail
                                            class="h-4 w-4 text-muted-foreground"
                                        />
                                        {{ guest.email }}
                                    </div>
                                </TableCell>
                                <TableCell>
                                    <Button variant="ghost" size="sm" as-child>
                                        <Link
                                            :href="`/admin/groups/${guest.group_id}`"
                                        >
                                            {{ guest.group_name }}
                                        </Link>
                                    </Button>
                                </TableCell>
                                <TableCell>
                                    <Badge
                                        :variant="
                                            getStatusBadge(guest.has_rsvp)
                                                .variant as any
                                        "
                                    >
                                        {{
                                            getStatusBadge(guest.has_rsvp).label
                                        }}
                                    </Badge>
                                </TableCell>
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
                                                <Eye class="h-4 w-4" />
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
                                                <Edit class="h-4 w-4" />
                                            </Link>
                                        </Button>
                                        <Button
                                            variant="ghost"
                                            size="sm"
                                            @click="sendRsvpEmail(guest.id)"
                                            :disabled="guest.has_rsvp"
                                            title="Send RSVP Email"
                                        >
                                            <Mail class="h-4 w-4" />
                                        </Button>
                                        <Button
                                            variant="ghost"
                                            size="sm"
                                            @click="deleteGuest(guest.id)"
                                            class="text-destructive hover:text-destructive"
                                        >
                                            <Trash2 class="h-4 w-4" />
                                        </Button>
                                    </div>
                                </TableCell>
                            </TableRow>
                        </TableBody>
                    </Table>

                    <!-- Pagination -->
                    <div v-if="guests.last_page > 1" class="mt-4">
                        <div class="flex items-center justify-between">
                            <div class="text-sm text-muted-foreground">
                                Page {{ guests.current_page }} of
                                {{ guests.last_page }}
                            </div>
                            <div class="flex items-center gap-2">
                                <Button
                                    v-for="link in guests.links"
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
