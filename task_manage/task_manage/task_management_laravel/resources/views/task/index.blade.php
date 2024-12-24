<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.14.1/themes/base/jquery-ui.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>Hello, world!</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            {{-- Sidebar Start --}}
            @include('extend.sidebar')
            {{-- Sidebar End --}}

            <div class="col-md-9">
                <div class="container-fluid bg-light p-4">
                    {{-- Employee Start --}}
                    @include('extend.header')
                    {{-- Employee END --}}

                    <div class="row g-4">
                        <div class="col-md-12">
                            <div class="card">
                                <h1 class="card-header">View Task</h1>
                                <div class="card-body">
                                    <a href="{{ route('task.create') }}" class="btn btn-primary">Add Task</a>
                                </div>
                            </div>
                        </div>

                        @if (session('success'))
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="bg-danger rounded p-3 text-white">
                                            <div>{{ session('success') }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="{{ route('task.index') }}" method="GET"
                                        class="bg-secondary rounded p-3 text-white">
                                        <div class="row g-2">
                                            <div class="col-md-3">
                                                <label for="type" class="form-label">Column Type</label>
                                                <select name="type" class="form-control" id="type">
                                                    <option>Select column type</option>
                                                    <option value="id" {{ request('type') == 'id' ? 'selected' : '' }}>
                                                        ID
                                                    </option>
                                                    <option value="title" {{ request('type') == 'title' ? 'selected' : '' }}>
                                                        Task Title
                                                    </option>
                                                    <option value="status" {{ request('type') == 'status' ? 'selected' : '' }}>
                                                        Task Status
                                                    </option>
                                                    <option value="description" {{ request('type') == 'description' ? 'selected' : '' }}>
                                                        Description
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="name" class="form-label">Filter Value</label>
                                                <input type="text" name="name" class="form-control" id="name" value="{{ request('name') }}">
                                            </div>
                                            <div class="col-md-3">
                                                <label for="start_date" class="form-label">Start Date</label>
                                                <input type="text" name="start_date" class="form-control task_date" id="start_date" value="{{ request('start_date') }}">
                                            </div>
                                            <div class="col-md-3">
                                                <label for="end_date" class="form-label">End Date</label>
                                                <input type="text" name="end_date" class="form-control task_date" id="end_date" value="{{ request('end_date') }}">
                                            </div>
                                            <div class="col-md-6">
                                                <a href="{{ route('task.index') }}"
                                                    class="btn-info text-center form-control">Reset</a>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="submit" name="submit" value="Filter" class="btn-success form-control">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @foreach ($collection as $index => $item)
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <h2 class="card-title" style="font-size: 25px">{{$item->title}}</h2>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"><b>Status:</b> {{$item->status}}</li>
                                    <li class="list-group-item"><b>Created At:</b> {{$item->created_at}}</li>
                                </ul>
                                <div class="card-body">
                                    <a href="{{ route('task.view', $item->id) }}" class="btn btn-info text-white">View</a>
                                    <a href="{{ route('task.edit', $item->id) }}" class="btn btn-success">Update</a>
                                    <form action="{{ route('task.destroy', $item->id) }}"
                                        method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <div class="col-md-12">
                            {{ $collection->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://code.jquery.com/ui/1.14.1/jquery-ui.js"></script>
    <script>
        $(function() {
            $(".task_date").datepicker({
                dateFormat: 'yy-mm-dd'
            });
        });
    </script>
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>
</body>

</html>
