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
                                <h1 class="card-header">Create Task</h1>
                                <div class="card-body">
                                    <span>
                                        <RouterLink to="/" class="btn btn-primary">Dashboard</RouterLink>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <form class="row g-4" @submit.prevent="createTask">
                                        <div class="col-md-6">
                                            <label for="title" class="form-label">Title</label>
                                            <input type="text" class="form-control" id="title" v-model="title" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="status" class="form-label">Status</label>
                                            <select class="form-control" id="status" v-model="status" required>
                                                <option value="pending">Pending</option>
                                                <option value="in progress">In Progress</option>
                                                <option value="completed">Completed</option>
                                            </select>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="description" class="form-label">Description</label>
                                            <textarea class="form-control" id="description" v-model="description" required></textarea>
                                        </div>
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-success d-lock">Create Task</button>
                                        </div>
                                    </form>
                                    <div v-if="error" class="alert alert-danger mt-3">{{ error }}</div>
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
    name: 'TaskcreatePage',
    data: function () {
        return {
            email: localStorage.getItem('email'),
            title: '',
            status: '',
            description: '',
            error: null
        }
    },
    methods: {
        async createTask() {
            if (this.title === "" || this.status === "") {
                alert('Please fill all fields');
                return;
            }

            const token = localStorage.getItem('auth_token');
            const response = await fetch('http://localhost:8000/api/task/store', {
                method: 'POST',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    title: this.title,
                    status: this.status,
                    description: this.description
                })
            });

            if (response.ok) {
                alert('Task created successfully');
                this.$router.push('/');
            } else {
                const errorData = await response.json();
                this.error = errorData.message || 'Failed to create task';
                console.error('Failed to create task', errorData);
            }
        }
    }
};
</script>

<style>
</style>