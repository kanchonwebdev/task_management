<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 mx-auto" style="margin-top: 12%;">
                <div class="container-fluid bg-light p-4">
                    <div class="row g-4">
                        <div class="col-md-12">
                            <h1 class="text-center">Register Page</h1>
                        </div>
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <form class="row g-3 needs-validation" @submit.prevent="registerNow" novalidate>
                                        <div class="col-md-12">
                                            <label for="name" class="form-label">Full Name</label>
                                            <input type="text" class="form-control" id="name" v-model="name" required>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="email" v-model="email"
                                                required>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="pass" class="form-label">Password</label>
                                            <input type="password" class="form-control" id="pass" v-model="password"
                                                required>
                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-primary" type="submit">Register</button>
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
    name: 'RegisterPage',
    data() {
        return {
            name: '',
            email: '',
            password: '',
            error: null
        }
    },
    methods: {
        async registerNow() {
            this.error = null;

            const response = await fetch('http://localhost:8000/api/register', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    name: this.name,
                    email: this.email,
                    password: this.password
                })
            });

            if (response.ok) {
                const data = await response.json();
                localStorage.setItem('auth_token', data.token);
                localStorage.setItem('isAuthenticated', 'true');
                localStorage.setItem('email', this.email);
                localStorage.setItem('name', this.email);
                alert('Registration successful');
                this.$router.push('/');
            } else {
                const errorData = await response.json();
                this.error = errorData.message || 'Failed to register';
                console.error('Failed to register', errorData);
            }
        }
    }
};
</script>

<style></style>
