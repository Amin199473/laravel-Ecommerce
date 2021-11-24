<div class="col-md-3">
    <h4 class="">Categories</h4>
    <ul class="list-group list-group-flush">
        @foreach ($categories as $category )
        <li class="list-group-item"><a href="{{ route('category',[$category->id,$category->name]) }}">{{ $category->name }}</a><span class="badge badge-success ml-5">({{ $category->products->count() }})</span></li>
        @endforeach
        <li class="list-group-item"><a href="{{ route('onSales') }}">On Sales</a><span class="badge badge-success ml-5">
                (
                @if($timerSales)
                    @if($getSales->count() > 0 && $timerSales->status===1 && $timerSales->sale_date > Carbon\Carbon::now())
                        {{ $getSales->count() }}
                    @else
                    0
                    @endif
                @else
                0
                @endif
                )
            </span>
        </li>
    </ul>
    <div class="brnds">
        <h4 class="mt-4">Brands</h4>
        <ul class="list-group list-group-flush">
            @foreach ($brands as $brand )
            <li class="list-group-item"><a href="{{ route('brand',[$brand->id,$brand->name]) }}">{{ $brand->name }}</a><span class="badge badge-success ml-5">({{ $brand->products->count() }})</span></li>

            @endforeach
        </ul>
    </div>
    <div class="range-price">
        <h5 class="mt-4">Price Range: <span>${{ round($minPrice) }} </span> - <span> ${{ round($maxPrice) }}</span></h5>
        </h5>
    </div>
    <div id="slider"></div>
    <div class="row mt-5">
        <form action="{{ route('filterByPrice') }}" method="GET" class="form-row align-items-center">
            @csrf
            <div class="col-md-5">
                <input type="text" class="form-control" id="min" name="minPrice" placeholder="min">
            </div>
            <div class="col-md-5">
                <input type="text" class="form-control" id="max" name="maxPrice" placeholder="max">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-dark">Go</button>
            </div>
        </form>
    </div>
    <div>
        <input type="hidden" name="min-price" value="{{ $minPrice }}" id="min-price">
        <input type="hidden" name="max-price" value="{{ $maxPrice }}" id="max-price">
    </div>
</div>
