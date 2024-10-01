<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Client</title>
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
        <div class="col-md-6 mx-auto mt-5">
            <form action={{route('client.store')}} enctype="multipart/form-data" class="border p-5" method="POST">
                @csrf 
                @method('POST')
                <div class="my-3 text-center text-muted">Add Client Form</div>
                <div class="form-group">
                    <label for="" class="form-label">Username</label>
                    <input type="text" class="form-control" name="username" required>
                </div>
                <div class="form-group">
                    <label for="" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" required>
                </div>
                <div class="form-group">
                    <label for="" class="form-label">Profile Pic</label>
                    <input type="file" class="form-control" name="userImg">
                </div>
                <div class="my-3">
                    <button type="submit" class="btn btn-primary form-control">Submit</button>
                </div>
                <div class="mt-3">
                    <a href={{route('home')}} class="nav-link text-primary">Back to Home page</a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>