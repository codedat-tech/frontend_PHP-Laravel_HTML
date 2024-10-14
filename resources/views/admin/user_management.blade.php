<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Management</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <h1>User Management</h1>
        <a href="{{ route('admin.designers.index') }}">Designer List</a>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->status }}</td>
                        <td>

                                @if($user->status === 'active')
                                    <form action="{{ route('admin.users.ban', $user->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Ban</button>
                                    </form>
                                @else
                                    <form action="{{ route('admin.users.unban', $user->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-success">Unban</button>
                                    </form>
                                @endif
                            </td>


                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
