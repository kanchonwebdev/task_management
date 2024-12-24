<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 position-sticky">
                <!-- Sidebar Component -->
                <SidebarCom />
                <!-- Sidebar Component end -->
            </div>
            <div class="col-md-9">
                <div class="container-fluid bg-light p-4">
                    <!-- header component -->
                    <HeaderCom />
                    <!-- header component end -->
                    <div class="row g-4">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <form @submit.prevent="filterTasks" class="bg-secondary rounded p-3 text-white">
                                        <div class="row g-2">
                                            <div class="col-md-3">
                                                <label for="type" class="form-label">Column Type</label>
                                                <select v-model="filter.type" class="form-control" id="type">
                                                    <option value="">Select column type</option>
                                                    <option value="id">ID</option>
                                                    <option value="title">Task Title</option>
                                                    <option value="status">Task Status</option>
                                                    <option value="description">Description</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="name" class="form-label">Filter Value</label>
                                                <input v-model="filter.value" type="text" class="form-control"
                                                    id="name">
                                            </div>
                                            <div class="col-md-3">
                                                <label for="start_date" class="form-label">Start Date</label>
                                                <input v-model="filter.start_date" type="date" class="form-control"
                                                    id="start_date">
                                            </div>
                                            <div class="col-md-3">
                                                <label for="end_date" class="form-label">End Date</label>
                                                <input v-model="filter.end_date" type="date" class="form-control"
                                                    id="end_date">
                                            </div>
                                            <div class="col-md-6">
                                                <button @click="resetFilter"
                                                    class="btn-info text-center form-control">Reset</button>
                                            </div>
                                            <div class="col-md-6">
                                                <button type="submit" class="btn-success form-control">Filter</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div v-if="tasks.length > 0">
                            <div class="row g-4">
                                <div class="col-md-4" v-for="task in tasks" :key="task.id">
                                    <div class="card">
                                        <div class="card-body">
                                            <h2 class="card-title" style="font-size: 25px">{{ task.title }}</h2>
                                        </div>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item"><b>Status:</b> {{ task.status }}</li>
                                            <li class="list-group-item"><b>Created At:</b> {{ task.created_at }}</li>
                                        </ul>
                                        <div class="card-body">
                                            <a :href="`/task/view/${task.id}`" class="btn btn-info text-white">View</a>
                                            &nbsp;
                                            <a :href="`/task/update/${task.id}`" class="btn btn-success">Update</a>
                                            &nbsp;
                                            <button @click="deleteTask(task.id)" class="btn btn-danger">Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 row">
                                <div class="col-md-6">Total Results: {{ pagination.total }}</div>
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center justify-content-end">Results Per Page: {{
                                        pagination.per_page }}</div>
                                </div>
                            </div>
                            <nav aria-label="Page navigation" class="d-flex align-items-center justify-content-center">
                                <ul class="pagination">
                                    <li class="page-item" :class="{ disabled: !pagination.prev_page_url }">
                                        <a class="page-link" href="#"
                                            @click.prevent="fetchTasks(pagination.prev_page_url)">Previous</a>
                                    </li>
                                    <li class="page-item" v-for="page in pagination.last_page" :key="page"
                                        :class="{ active: page === pagination.current_page }">
                                        <a class="page-link" href="#"
                                            @click.prevent="fetchTasks(pagination.path + '?page=' + page + filterQueryParams)">{{
                                            page }}</a>
                                    </li>
                                    <li class="page-item" :class="{ disabled: !pagination.next_page_url }">
                                        <a class="page-link" href="#"
                                            @click.prevent="fetchTasks(pagination.next_page_url)">Next</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <div v-else>
                            <p>Data Loading.....</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'TaskPage',
    data() {
        return {
            tasks: [],
            pagination: {},
            filter: {
                type: '',
                value: '',
                start_date: '',
                end_date: ''
            }
        };
    },
    mounted() {
        this.fetchTasks();
    },
    computed: {
        filterQueryParams() {
            const params = new URLSearchParams();
            if (this.filter.type) params.append('type', this.filter.type);
            if (this.filter.value) params.append('name', this.filter.value);
            if (this.filter.start_date) params.append('start_date', this.filter.start_date);
            if (this.filter.end_date) params.append('end_date', this.filter.end_date);
            return params.toString() ? '&' + params.toString() : '';
        }
    },
    methods: {
        fetchTasks(url = 'http://localhost:8000/api/task/index') {
            const token = localStorage.getItem('auth_token');
            fetch(url, {
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                }
            })
                .then(response => response.json())
                .then(data => {
                    this.tasks = data.data;
                    this.pagination = {
                        current_page: data.current_page,
                        last_page: data.last_page,
                        next_page_url: data.next_page_url,
                        prev_page_url: data.prev_page_url,
                        path: data.path,
                        total: data.total,
                        per_page: data.per_page
                    };
                })
                .catch(error => {
                    console.error('Error fetching tasks:', error);
                });
        },
        filterTasks() {
            const url = `http://localhost:8000/api/task/index?${this.filterQueryParams}`;
            this.fetchTasks(url);
        },
        resetFilter() {
            this.filter = {
                type: '',
                value: '',
                start_date: '',
                end_date: ''
            };
            this.fetchTasks();
        },
        deleteTask(taskId) {
            const token = localStorage.getItem('auth_token');
            fetch(`http://localhost:8000/api/task/destroy/${taskId}`, {
                method: 'DELETE',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                }
            })
                .then(response => {
                    if (response.ok) {
                        this.tasks = this.tasks.filter(task => task.id !== taskId);
                    } else {
                        console.error('Failed to delete task');
                    }
                })
                .catch(error => {
                    console.error('Error deleting task:', error);
                });
        }
    }
}
</script>

<style>
</style>