<template>
    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Task APP</h1>
        </div>
    </div>
    <div class="card">
        <ul class="list-group list-group-flush">
            <li class="list-group-item">
                <a href="">
                    <RouterLink to="/">Dashboard</RouterLink>
                </a>
            </li>
            <li class="list-group-item">
                <a href="">
                    <RouterLink to="/task/index">All Task</RouterLink>
                </a>
            </li>
            <li class="list-group-item">
                <a href="">
                    <RouterLink to="/task/create">Task Create</RouterLink>
                </a>
            </li>
            <li class="list-group-item">
                <a href="">
                    <RouterLink to="/logout">Log Out</RouterLink>
                </a>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        name: "SidebarCom"
    }
</script>

<style>
</style>