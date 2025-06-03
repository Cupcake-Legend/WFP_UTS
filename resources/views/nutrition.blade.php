@extends('layouts.main')
@vite('resources/css/nutrition.css')

@section('content')
<div class="nutrition-container">
    <div class="nutrition-header">
        <h2 class="nutrition-title">Nutrition Facts</h2>
        <p class="nutrition-subtitle">Discover the nutritional value of our delicious menu items</p>
    </div>

    @foreach ($categories as $category)
        <div class="nutrition-category">
            <div class="category-header">
                <h3 class="category-title">
                    <i class="fas fa-utensils"></i>{{ $category->name }}
                </h3>
                <span class="category-badge">{{ count($category->menus) }} items</span>
            </div>
            
            <div class="category-divider"></div>
            
            @if(count($category->menus) > 0)
            <div class="menu-grid">
                @foreach ($category->menus as $menu)
                    <div class="menu-item">
                        <div class="nutrition-card">
                            <div class="card-image">
                                @if ($menu->img ?? false)
                                    <img src="{{ asset('storage/' . $menu->img) }}" class="menu-image" alt="{{ $menu->name }}" loading="lazy">
                                @else
                                    <img src="https://source.unsplash.com/random/300x300/?food,{{ $category->name }}" class="menu-image" alt="Food Image" loading="lazy">
                                @endif
                            </div>
                            <div class="card-content">
                                <h5 class="menu-name">{{ $menu->name }}</h5>
                                <div class="nutrition-details">
                                    <ul class="nutrition-list">
                                        @foreach (explode(',', $menu->nutrisi) as $nutrient)
                                            <li class="nutrition-item">
                                                <i class="fas fa-circle nutrition-bullet"></i>
                                                <span>{{ trim($nutrient) }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @else
            <div class="empty-category">
                <i class="fas fa-utensil-spoon empty-icon"></i>
                <p class="empty-message">No menu available in this category yet.</p>
                <a href="#" class="empty-action">Suggest an item</a>
            </div>
            @endif
        </div>
    @endforeach

    <div class="nutrition-disclaimer">
        <div class="disclaimer-content">
            <i class="fas fa-info-circle disclaimer-icon"></i>
            Nutritional values are approximate and may vary based on preparation methods.
        </div>
    </div>
</div>
@endsection