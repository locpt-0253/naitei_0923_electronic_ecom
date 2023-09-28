@props([
    'images' => $images
])

<div id="main-image-carousel" class="carousel slide w-[450px] h-[450px]" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#main-image-carousel" data-bs-slide-to="0" class="active" aria-current="true"></button>
        @for ($i = 1; $i < count($images); $i++)
            <button type="button" data-bs-target="#main-image-carousel" data-bs-slide-to="{{ $i }}"></button>
        @endfor
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="{{ $images->first()->image_url }}" class="d-block w-full h-auto">
        </div>
        @foreach ($images->slice(1) as $image)
            <div class="carousel-item">
                <img src="{{ $image->image_url }}" class="d-block w-full h-auto">
            </div>
        @endforeach
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#main-image-carousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="hidden">{{ __('Previous') }}</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#main-image-carousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="hidden">__{{ __('Next') }}</span>
    </button>
</div>
