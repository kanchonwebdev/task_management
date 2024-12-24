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
                                <h1 class="card-header">Update Task</h1>
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
                                    <form class="row g-4" @submit.prevent="updateTask">
                                        <div class="col-md-6">
                                            <label for="title" class="form-label">Title</label>
                                            <input type="text" class="form-control" id="title" v-model="task.title"
                                                required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="status" class="form-label">Status</label>
                                            <select class="form-control" id="status" v-model="task.status" required>
                                                <option value="pending">Pending</option>
                                                <option value="in progress">In Progress</option>
                                                <option value="completed">Completed</option>
                                            </select>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="description" class="form-label">Description</label>
                                            <textarea class="form-control" id="description" rows="5" v-model="task.description"
                                                required></textarea>
                                        </div>
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-success d-lock">Update Task</button>
                                        </div>
                                    </form>
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
    name: 'UpdatePage',
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
        },
        async updateTask() {
            const taskId = this.$route.params.id; // Assuming you're using Vue Router
            const token = localStorage.getItem('auth_token');
            const response = await fetch(`http://localhost:8000/api/task/update/${taskId}`, {
                method: 'PUT',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(this.task)
            });
            if (response.ok) {
                alert('Task updated successfully');
                this.$router.push(`/task/view/${taskId}`);
            } else {
                console.error('Failed to update task');
            }
        }
    }
};
</script>

<style></style>