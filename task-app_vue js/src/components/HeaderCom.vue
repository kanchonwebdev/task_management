<template>
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="padding-top: 0px; padding-bottom: 0px;">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="pt-2 pb-2">Dashboard</div>
                        <div class="dropdown">
                            <div class="dropdown-toggle pt-2 pb-2" type="button" id="dropdownMenuButton1"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                welcome {{email}}
                            </div>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <RouterLink to="/logout">Log Out</RouterLink>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "HeaderCom",
    data: function() {
        return {
            name: localStorage.getItem('email'),
        }
    },
}
</script>

<style></style>