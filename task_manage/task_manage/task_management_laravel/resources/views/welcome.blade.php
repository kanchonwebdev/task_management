<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Hello, world!</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        .btn {
            display: block;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            {{-- sidebar Start --}}
            @include('extend.sidebar')
            {{-- sidebar End --}}

            <div class="col-md-9">
                <div class="container-fluid bg-light p-4">
                    {{-- header Start --}}
                    @include('extend.header')
                    {{-- header End --}}

                    <div class="row g-4">
                        <div class="col-md-4">
                            <div class="card">
                                <h5 class="card-header">Task</h5>
                                <div class="card-body">
                                    <h5 class="card-title">Pending Task</h5>
                                    <p class="card-text">
                                    <h1>01</h1>
                                    </p>
                                    <a href="#" class="btn btn-primary">View All</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <h5 class="card-header">Task</h5>
                                <div class="card-body">
                                    <h5 class="card-title">In Process</h5>
                                    <p class="card-text">
                                    <h1>01</h1>
                                    </p>
                                    <a href="#" class="btn btn-primary">View All</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <h5 class="card-header">Task</h5>
                                <div class="card-body">
                                    <h5 class="card-title">Complete Task</h5>
                                    <p class="card-text">
                                    <h1>01</h1>
                                    </p>
                                    <a href="#" class="btn btn-primary">View All</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>
