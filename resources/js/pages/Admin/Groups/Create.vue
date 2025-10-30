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
import AdminLayout from '@/layouts/AdminLayout.vue';
import type { BreadcrumbItemType } from '@/types';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ArrowLeft, Save } from 'lucide-vue-next';

interface Props {
    errors?: Record<string, string>;
}

defineProps<Props>();

const form = useForm({
    name: '',
    max_attendees: '',
});

const submit = () => {
    form.post('/admin/groups/store', {
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
        title: 'Groups',
        href: '/admin/groups',
    },
    {
        title: 'Create Group',
        href: '/admin/groups/create',
    },
];
</script>

<template>
    <Head title="Create Group - Admin" />

    <AdminLayout :breadcrumbs="breadcrumbItems">
        <div class="space-y-6 p-6">
            <!-- Page Header -->
            <div class="flex items-center gap-4">
                <Button variant="outline" size="sm" as-child>
                    <Link href="/admin/groups">
                        <ArrowLeft class="mr-2 h-4 w-4" />
                        Back to Groups
                    </Link>
                </Button>
                <div>
                    <h1 class="text-3xl font-bold tracking-tight">
                        Create Group
                    </h1>
                    <p class="text-muted-foreground">
                        Add a new guest group for your wedding
                    </p>
                </div>
            </div>

            <!-- Create Form -->
            <Card class="max-w-2xl">
                <CardHeader>
                    <CardTitle>Group Information</CardTitle>
                    <CardDescription>
                        Enter the details for the new group
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
                            <Label for="max_attendees">Maximum Attendees</Label>
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
                            <Button type="submit" :disabled="form.processing">
                                <Save class="mr-2 h-4 w-4" />
                                Create Group
                            </Button>
                            <Button type="button" variant="outline" as-child>
                                <Link href="/admin/groups">Cancel</Link>
                            </Button>
                        </div>
                    </form>
                </CardContent>
            </Card>
        </div>
    </AdminLayout>
</template>
