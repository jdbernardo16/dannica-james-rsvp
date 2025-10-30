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
import { Edit, Eye, Plus, Search, Trash2 } from 'lucide-vue-next';
import { ref, watch } from 'vue';

// Define props interface
interface Group {
    id: number;
    name: string;
    guest_count: number;
    max_attendees: number;
    has_rsvp: boolean;
    created_at: string;
}

interface PaginationLink {
    url: string | null;
    label: string;
    active: boolean;
}

interface Pagination {
    data: Group[];
    current_page: number;
    from: number;
    last_page: number;
    per_page: number;
    to: number;
    total: number;
    links: PaginationLink[];
}

interface Props {
    groups: Pagination;
    filters: {
        search: string;
        status: string;
        per_page: string;
    };
}

const props = defineProps<Props>();

const search = ref(props.filters.search);
const status = ref(props.filters.status);
const perPage = ref(props.filters.per_page);

const breadcrumbItems: BreadcrumbItemType[] = [
    {
        title: 'Dashboard',
        href: '/admin/dashboard',
    },
    {
        title: 'Groups',
        href: '/admin/groups',
    },
];

// Watch for changes and update URL
watch([search, status, perPage], () => {
    router.get(
        '/admin/groups',
        {
            search: search.value,
            status: status.value,
            per_page: perPage.value,
        },
        {
            preserveState: true,
            replace: true,
        },
    );
});

const deleteGroup = (id: number) => {
    if (
        confirm(
            'Are you sure you want to delete this group? This action cannot be undone.',
        )
    ) {
        router.delete(`/admin/groups/${id}`, {
            preserveScroll: true,
        });
    }
};

const getStatusBadge = (hasRsvp: boolean) => {
    return hasRsvp
        ? { variant: 'default', label: 'Responded' }
        : { variant: 'secondary', label: 'Pending' };
};
</script>

<template>
    <Head title="Groups - Admin" />

    <AdminLayout :breadcrumbs="breadcrumbItems">
        <div class="space-y-6 p-6">
            <!-- Page Header -->
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold tracking-tight">Groups</h1>
                    <p class="text-muted-foreground">
                        Manage guest groups for your wedding
                    </p>
                </div>
                <Button as-child>
                    <Link href="/admin/groups/create">
                        <Plus class="mr-2 h-4 w-4" />
                        Add Group
                    </Link>
                </Button>
            </div>

            <!-- Filters Card -->
            <Card>
                <CardHeader>
                    <CardTitle>Filters</CardTitle>
                    <CardDescription>
                        Search and filter groups
                    </CardDescription>
                </CardHeader>
                <CardContent>
                    <div class="grid gap-4 md:grid-cols-4">
                        <div class="relative">
                            <Search
                                class="absolute top-1/2 left-3 h-4 w-4 -translate-y-1/2 text-muted-foreground"
                            />
                            <Input
                                v-model="search"
                                placeholder="Search groups..."
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
                                perPage = '10';
                            "
                        >
                            Reset Filters
                        </Button>
                    </div>
                </CardContent>
            </Card>

            <!-- Groups Table -->
            <Card>
                <CardHeader>
                    <CardTitle>Groups ({{ groups.total }})</CardTitle>
                    <CardDescription>
                        Showing {{ groups.from }} to {{ groups.to }} of
                        {{ groups.total }} groups
                    </CardDescription>
                </CardHeader>
                <CardContent>
                    <div
                        v-if="groups.data.length === 0"
                        class="py-8 text-center"
                    >
                        <p class="text-muted-foreground">No groups found</p>
                        <Button class="mt-4" as-child>
                            <Link href="/admin/groups/create">
                                <Plus class="mr-2 h-4 w-4" />
                                Create your first group
                            </Link>
                        </Button>
                    </div>
                    <Table v-else>
                        <TableHeader>
                            <TableRow>
                                <TableHead>Group Name</TableHead>
                                <TableHead>Guests</TableHead>
                                <TableHead>Status</TableHead>
                                <TableHead>Created</TableHead>
                                <TableHead class="text-right"
                                    >Actions</TableHead
                                >
                            </TableRow>
                        </TableHeader>
                        <TableBody>
                            <TableRow
                                v-for="group in groups.data"
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
                                            getStatusBadge(group.has_rsvp)
                                                .variant as any
                                        "
                                    >
                                        {{
                                            getStatusBadge(group.has_rsvp).label
                                        }}
                                    </Badge>
                                </TableCell>
                                <TableCell>{{
                                    new Date(
                                        group.created_at,
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
                                        <Button
                                            variant="ghost"
                                            size="sm"
                                            @click="deleteGroup(group.id)"
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
                    <div v-if="groups.last_page > 1" class="mt-4">
                        <div class="flex items-center justify-between">
                            <div class="text-sm text-muted-foreground">
                                Page {{ groups.current_page }} of
                                {{ groups.last_page }}
                            </div>
                            <div class="flex items-center gap-2">
                                <Button
                                    v-for="link in groups.links"
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
