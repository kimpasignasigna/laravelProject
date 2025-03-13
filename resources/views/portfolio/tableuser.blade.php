<div class="row gy-4 justify-content-center">
        <div class="col-lg-4">
        <img src="/icon/img.png" class="img-fluid" alt="" style="width: 200px; height: 200px; object-fit: cover;">
        </div>
            <div class="col-lg-8 content">
                <h2>Display All Users</h2>
                <p class="fst-italic py-3">
                    Below is the table displaying all users with pagination.
                </p>
                <div class="row">
                    <div class="col-lg-12">
                        <!-- User Table -->
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- Pagination Controls -->
                        <nav>
                            <ul class="pagination justify-content-center">
                                <li class="page-item">
                                    {{ $users->links() }} <!-- Pagination links will be displayed here -->
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>