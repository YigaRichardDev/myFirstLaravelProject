<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Clients Mgt</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body{
            font-family: 'Poppins', sans-serif;
        
        }
        .btn{
            border-radius: 0px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-7 mx-auto">
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                    <p>{{ session('success') }}</p>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <h5 class="text-center text-muted my-5">Clients Management</h5>
                <div class="my-3">
                    <a href={{route('client.add')}} class="btn btn-primary btn-sm">Add Client</a>
                </div>
                <table class="table-bordered table-hover table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Client's Pic</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $count =1;
                        @endphp
                        @foreach ($clients as $client)
                        <tr>
                            <td>{{ $count++ }}</td>
                            <td>{{ $client->username }}</td>
                            <td>{{ $client->email }}</td>
                            <td>
                                <img src={{ asset('images/'.$client->userImg )}} alt="" width="100" height="100" style="object-fit:cover;">
                            </td>
                            <td class="d-flex g-3">
                                <a href={{route('client.edit', $client->id)}} class="btn btn-warning btn-sm me-3">Edit</a>

                                <form action={{route('client.destroy', $client->id)}} method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return(confirm('Are you want to delete this client!'))" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

</html>