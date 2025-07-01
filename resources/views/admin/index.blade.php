@extends('layouts.main')
@vite('resources/css/admin.css')

@section('content')
    <div class="admin-container">
        <h1 class="admin-title">Admin Dashboard</h1>

        <!-- Tabs Navigation -->
        <ul class="nav nav-tabs" id="adminTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="categories-tab" data-bs-toggle="tab" data-bs-target="#categories"
                    type="button" role="tab">Categories</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="menus-tab" data-bs-toggle="tab" data-bs-target="#menus" type="button"
                    role="tab">Menus</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="rewards-tab" data-bs-toggle="tab" data-bs-target="#rewards" type="button"
                    role="tab">Rewards</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="orders-tab" data-bs-toggle="tab" data-bs-target="#orders" type="button"
                    role="tab">Orders</button>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content" id="adminTabsContent">
            <!-- Categories Tab -->
            <div class="tab-pane fade show active" id="categories" role="tabpanel">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>Categories</h2>
                    <button class="nav-btn" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                        <i class="fas fa-plus"></i> Add Category
                    </button>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Menu Count</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ Str::limit($category->deskripsi, 50) }}</td>
                                    <td>{{ $category->menus_count }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-info" data-bs-toggle="modal"
                                            data-bs-target="#editCategoryModal{{ $category->id }}">
                                            <i class="fas fa-edit"></i>Edit
                                        </button>
                                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure?')">
                                                <i class="fas fa-trash"></i>Delete
                                            </button>
                                        </form>
                                        @push('modals')
                                            <div class="modal fade" id="editCategoryModal{{ $category->id }}" tabindex="-1"
                                                aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Edit Category - {{ $category->name }}</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <form action="{{ route('categories.update', $category->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label for="editCategoryName{{ $category->id }}"
                                                                        class="form-label">Name</label>
                                                                    <input type="text" class="form-control"
                                                                        id="editCategoryName{{ $category->id }}" name="name"
                                                                        value="{{ $category->name }}" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="editCategoryDescription{{ $category->id }}"
                                                                        class="form-label">Description</label>
                                                                    <textarea class="form-control" id="editCategoryDescription{{ $category->id }}" name="deskripsi" rows="3">{{ $category->deskripsi }}</textarea>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="nav-btn">Update
                                                                    Category</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @endpush

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Menus Tab -->
            <div class="tab-pane fade" id="menus" role="tabpanel">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>Menus</h2>
                    <button class="nav-btn" data-bs-toggle="modal" data-bs-target="#addMenuModal">
                        <i class="fas fa-plus"></i> Add Menu
                    </button>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Points</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($menus as $menu)
                                <tr>
                                    <td>{{ $menu->id }}</td>
                                    <td>
                                        @if ($menu->image)
                                            <img style="height: 100px; width: 100px;"
                                                src="{{ asset('images/menus/' . $menu->image) }}">
                                        @else
                                            <span class="text-muted">No image</span>
                                        @endif
                                    </td>
                                    <td>{{ $menu->name }}</td>
                                    <td>{{ $menu->category->name }}</td>
                                    <td>{{ number_format($menu->harga, 2) }}</td>
                                    <td>{{ $menu->stock }}</td>
                                    <td>{{ $menu->point }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-info" data-bs-toggle="modal"
                                            data-bs-target="#editMenuModal{{ $menu->id }}">
                                            <i class="fas fa-edit"></i>Edit
                                        </button>
                                        <form action="{{ route('menus.destroy', $menu->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure?')">
                                                <i class="fas fa-trash"></i>Delete
                                            </button>
                                        </form>

                                        @push('modals')
                                            <!-- Edit Menus Modal -->
                                            <div class="modal fade" id="editMenuModal{{ $menu->id }}" tabindex="-1"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Edit Menu - {{ $menu->name }}</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <form action="{{ route('menus.update', $menu->id) }}" method="POST"
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="mb-3">
                                                                            <label for="menuName{{ $menu->id }}"
                                                                                class="form-label">Name</label>
                                                                            <input type="text" class="form-control"
                                                                                id="menuName{{ $menu->id }}"
                                                                                name="name" value="{{ $menu->name }}"
                                                                                required>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="menuCategory{{ $menu->id }}"
                                                                                class="form-label">Category</label>
                                                                            <select class="form-select"
                                                                                id="menuCategory{{ $menu->id }}"
                                                                                name="category_id" required>
                                                                                @foreach ($categories as $category)
                                                                                    <option value="{{ $category->id }}"
                                                                                        {{ $menu->category_id == $category->id ? 'selected' : '' }}>
                                                                                        {{ $category->name }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="menuPrice{{ $menu->id }}"
                                                                                class="form-label">Price</label>
                                                                            <input type="number" step="0.01"
                                                                                class="form-control"
                                                                                id="menuPrice{{ $menu->id }}"
                                                                                name="harga" value="{{ $menu->harga }}"
                                                                                required>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="menuStock{{ $menu->id }}"
                                                                                class="form-label">Stock</label>
                                                                            <input type="number" class="form-control"
                                                                                id="menuStock{{ $menu->id }}"
                                                                                name="stock" value="{{ $menu->stock }}"
                                                                                required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="mb-3">
                                                                            <label for="menuPoints{{ $menu->id }}"
                                                                                class="form-label">Points</label>
                                                                            <input type="number" class="form-control"
                                                                                id="menuPoints{{ $menu->id }}"
                                                                                name="point" value="{{ $menu->point }}"
                                                                                required>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="menuPortion{{ $menu->id }}"
                                                                                class="form-label">Portion</label>
                                                                            <select class="form-select"
                                                                                id="menuPortion{{ $menu->id }}"
                                                                                name="porsi" required>
                                                                                <option value="Small"
                                                                                    {{ $menu->porsi === 'Small' ? 'selected' : '' }}>
                                                                                    Small
                                                                                </option>
                                                                                <option value="Medium"
                                                                                    {{ $menu->porsi === 'Medium' ? 'selected' : '' }}>
                                                                                    Medium
                                                                                </option>
                                                                                <option value="Large"
                                                                                    {{ $menu->porsi === 'Large' ? 'selected' : '' }}>
                                                                                    Large
                                                                                </option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="menuImage{{ $menu->id }}"
                                                                                class="form-label">Image</label>
                                                                            <input type="file" class="form-control"
                                                                                id="menuImage{{ $menu->id }}"
                                                                                name="image">
                                                                            @if ($menu->image)
                                                                                <small class="form-text text-muted">Current
                                                                                    image: {{ $menu->image }}</small>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="menuDescription{{ $menu->id }}"
                                                                        class="form-label">Description</label>
                                                                    <textarea class="form-control" id="menuDescription{{ $menu->id }}" name="deskripsi" rows="3">{{ $menu->deskripsi }}</textarea>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="menuNutrition{{ $menu->id }}"
                                                                        class="form-label">Nutrition Facts (comma
                                                                        separated)</label>
                                                                    <textarea class="form-control" id="menuNutrition{{ $menu->id }}" name="nutrisi" rows="3">{{ $menu->nutrisi }}</textarea>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="nav-btn">Update
                                                                    Menu</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @endpush
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Rewards Tab -->
            <div class="tab-pane fade" id="rewards" role="tabpanel">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>Rewards</h2>
                    <button class="nav-btn" data-bs-toggle="modal" data-bs-target="#addRewardModal">
                        <i class="fas fa-plus"></i> Add Reward
                    </button>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Points</th>
                                <th>Menu Reward</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rewards as $reward)
                                <tr>
                                    <td>{{ $reward->id }}</td>
                                    <td>{{ $reward->name }}</td>
                                    <td>{{ $reward->poin }}</td>
                                    <td>{{ $reward->menu->name ?? 'N/A' }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-info" data-bs-toggle="modal"
                                            data-bs-target="#editRewardModal{{ $reward->id }}">
                                            <i class="fas fa-edit"></i>Edit
                                        </button>
                                        <form action="{{ route('rewards.destroy', $reward->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure?')">
                                                <i class="fas fa-trash"></i>Delete
                                            </button>
                                        </form>

                                        @push('modals')
                                            <div class="modal fade" id="editRewardModal{{ $reward->id }}" tabindex="-1"
                                                aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Edit Reward - {{ $reward->name }}</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <form action="{{ route('rewards.update', $reward->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label for="rewardName" class="form-label">Name</label>
                                                                    <input type="text" class="form-control"
                                                                        id="rewardName" name="name"
                                                                        value="{{ $reward->name }}" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="rewardPoints" class="form-label">Points
                                                                        Required</label>
                                                                    <input type="number" class="form-control"
                                                                        id="rewardPoints" name="poin"
                                                                        value="{{ $reward->poin }}" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="rewardMenu" class="form-label">Menu
                                                                        Reward</label>
                                                                    <select class="form-select" id="rewardMenu"
                                                                        name="menu_id" required>
                                                                        @foreach ($menus as $menu)
                                                                            <option value="{{ $menu->id }}"
                                                                                {{ $reward->menu_id == $menu->id ? 'selected' : '' }}>
                                                                                {{ $menu->name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="nav-btn">Update
                                                                    Reward</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @endpush
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Orders Tab --}}
            <div class="tab-pane fade" id="orders" role="tabpanel">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>Orders</h2>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Status</th>
                                <th>Total</th>
                                <th>User</th>
                                <th>Payment Method</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->status }}</td>
                                    <td>{{ $order->total }}</td>
                                    <td>{{ $order->user->name }}</td>
                                    <td>{{ $order->paymentMethod->name }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-info" data-bs-toggle="modal"
                                            data-bs-target="#editOrderModal{{ $order->id }}">
                                            <i class="fas fa-edit"></i>Finish
                                        </button>

                                        @push('modals')
                                            <div class="modal fade" id="editOrderModal{{ $order->id }}" tabindex="-1"
                                                aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Edit Order Status - {{ $order->id }}
                                                            </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <form action="{{ route('orders.finish') }}" method="POST">
                                                            @csrf
                                                            <div class="modal-body">
                                                                <div class="mb-3 d-flex">
                                                                    <label for="statusName" class="form-label">Status:
                                                                    </label>
                                                                    <div class = "mx-1">
                                                                        <label for="">{{ $order->status }}</label>
                                                                    </div>
                                                                    <input name = "order_id" type="hidden"
                                                                        value="{{ $order->id }}">
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Finish
                                                                    Order</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @endpush
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>



        </div>
    </div>

    <!-- Add Category Modal -->
    <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('categories.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="categoryName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="categoryName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="categoryDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="categoryDescription" name="deskripsi" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="nav-btn">Save Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Add Menu Modal -->
    <div class="modal fade" id="addMenuModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('menus.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="menuName" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="menuName" name="name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="menuCategory" class="form-label">Category</label>
                                    <select class="form-select" id="menuCategory" name="category_id" required>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="menuPrice" class="form-label">Price</label>
                                    <input type="number" step="0.01" class="form-control" id="menuPrice"
                                        name="harga" required>
                                </div>
                                <div class="mb-3">
                                    <label for="menuStock" class="form-label">Stock</label>
                                    <input type="number" class="form-control" id="menuStock" name="stock" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="menuPoints" class="form-label">Points</label>
                                    <input type="number" class="form-control" id="menuPoints" name="point" required>
                                </div>
                               
                                <div class="mb-3">
                                    <label for="menuImage" class="form-label">Image</label>
                                    <input type="file" class="form-control" id="menuImage" name="image">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="menuDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="menuDescription" name="deskripsi" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="menuNutrition" class="form-label">Nutrition Facts (comma separated)</label>
                            <textarea class="form-control" id="menuNutrition" name="nutrisi" rows="3"
                                placeholder="Calories: 200, Protein: 10g, Fat: 5g"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="nav-btn">Save Menu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>




    <!-- Add Reward Modal -->
    <div class="modal fade" id="addRewardModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Reward</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('rewards.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="rewardName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="rewardName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="rewardPoints" class="form-label">Points Required</label>
                            <input type="number" class="form-control" id="rewardPoints" name="poin" required>
                        </div>
                        <div class="mb-3">
                            <label for="rewardMenu" class="form-label">Menu Reward</label>
                            <select class="form-select" id="rewardMenu" name="menu_id" required>
                                @foreach ($menus as $menu)
                                    <option value="{{ $menu->id }}">{{ $menu->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="nav-btn">Save Reward</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Reward Modal -->

    @stack('modals')
@endsection

@section('styles')
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
@endsection
