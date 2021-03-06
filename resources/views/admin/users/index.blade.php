@extends('admin.users.layout')

@section('main')

    <a href="{{ route('admin.users.create') }}" class="btn btn-primary mb-3">Create</a>

    <div class="single-table p-2 mb-2">

        <form action="?" method="GET">
            <div class="row">
                <div class="col-sm-1">
                    <div class="form-group">
                        <label for="id" class="col-form-label">ID</label>
                        <input id="id" class="form-control" name="id" value="{{ request('id') }}">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label for="name" class="col-form-label">Name</label>
                        <input id="name" class="form-control" name="name" value="{{ request('name') }}">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="email" class="col-form-label">Email</label>
                        <input id="email" class="form-control" name="email"
                               value="{{ request('email') }}">
                    </div>
                </div>

                <div class="col-sm-2">
                    <div class="form-group">
                        <label for="role" class="col-form-label">Role</label>
                        <select id="role" class="form-control" name="role">
                            <option value=""></option>
                            @foreach ($roles as $value => $label)
                                <option value="{{ $value }}"{{ $value == request('role') ? ' selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="col-form-label">&nbsp;</label><br/>
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </div>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table text-center">
                <thead class="text-uppercase bg-light">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">email</th>
                    <th scope="col">date</th>
                    <th scope="col">Role</th>
                    <th scope="col">verified</th>
                    <th scope="col">action</th>
                </tr>
                </thead>
                <tbody>

                @foreach($users as $user)
                    <tr>
                        <th scope="row">{{ $user->id }}</th>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at->diffForHumans() }}</td>
                        <td>{{ $user->role_name }}</td>
                        <td>
                            @if(! empty($user->email_verified_at))
                                <i class="fas fa-check"></i>
                            @else
                                <i class="fas fa-times"></i>
                            @endif
                        </td>
                        <td>
                            <ul class="d-flex justify-content-center list-unstyled">
                                <li class="mr-3">
                                    <a href="{{ route('admin.users.edit', $user) }}"
                                       class="text-success">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </li>
                                <li>
                                    <form action="{{ route('admin.users.destroy', $user) }}"
                                          method="post">
                                        @csrf
                                        @method('DELETE')
                                        <label class="text-danger cursor-pointer fas fa-trash">
                                            <input type="submit" class="d-none">
                                        </label>
                                    </form>
                                </li>
                            </ul>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>

    {{ $users->links() }}


@endsection

