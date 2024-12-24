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
                            <div class="card">
                                <h1 class="card-header">Task Details</h1>
                                <div class="card-body">
                                    <span>
                                        <RouterLink to="/" class="btn btn-primary">Dashboard</RouterLink>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12" v-if="task">
                            <div class="card">
                                <div class="card-body">
                                    <h2 class="card-title">{{ task.title }}</h2>
                                    <p class="card-text"><b>Status</b>: {{ task.status }}</p>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"><b>Description:</b> {{ task.description }}</li>
                                    <li class="list-group-item"><b>Created At:</b> {{ task.created_at }}</li>
                                    <li class="list-group-item"><b>Updated At:</b> {{ task.updated_at }}</li>
                                </ul>
                                <div class="card-body">
                                    <a :href="`/task/update/${task.id}`" class="card-link btn btn-success">Update</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12" v-else>
                            <div class="card">
                                <div class="card-body">
                                    <p>Loading task details...</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'TaskviewPage',
    data: function () {
        return {
            email: localStorage.getItem('email'),
            task: null
        }
    },
    mounted() {
        this.fetchTaskDetails();
    },
    methods: {
        async fetchTaskDetails() {
            const taskId = this.$route.params.id; // Assuming you're using Vue Router
            const token = localStorage.getItem('auth_token');
            const response = await fetch(`http://localhost:8000/api/task/view/${taskId}`, {
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                }
            });
            if (response.ok) {
                const data = await response.json();
                this.task = data;
            } else {
                console.error('Failed to fetch task details');
            }
        }
    }
};
</script>

<style>
</style>