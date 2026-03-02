{{-- <aside>
    <h1>Cavelli Atilier</h1>
    <h2>Overview</h2>
    <div>
        <h2>Products</h2>
        <div>
            <h3>New Product</h3>
            <h3>Edit Product</h3>
        </div>
        <h2>Attribut</h2>
        <div>
            <h3>Colors</h3>
            <h3>Materials</h3>
            <h3>Rooms</h3>
        </div>

    </div>
    
    <h3></h3>
</aside> --}}

<main>
    <section class="search">
        <form method="get" action="/products">
            @csrf
            <h1>Products</h1>
            <div>
                <div>
                    <span>
                        <i class="fa fa-search"></i>
                    </span>
                    <input type="text" name="search" placeholder="Search" />
                </div>
                <div>
                    <select name="status">
                        <option>Show: All products</option>
                        <option value="active">Active only</option>
                        <option value="inactive">Inactive only</option>
                    </select>
                    <div>
                        <i class="fa fa-chevron-down"></i>
                    </div>
                </div>
                <div>
                    <select name="sort">
                        <option>Sort by: Defaulf</option>
                        <option value="newest">Newest First</option>
                        <option value="oldest">Oldest First</option>
                    </select>
                    <div>
                        <i class="fa fa-chevron-down"></i>
                    </div>
                </div>

                <a href="{{ route('products.create') }}">
                    <span class="text-xl">+</span> Add new product
                </a>
                <hr>
            </div>
            <div>
                <label class="font-bold">Product type</label>
                <div>
                    <select name="type">
                        <option>Show: All products</option>
                        @foreach ($types as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                    </select>
                    <div>
                        <i class="fa fa-chevron-down"></i>
                    </div>
                </div>

                <label class="font-bold">Price</label>
                <div>
                    <select name="price">
                        <option>Show by: Defaulf</option>
                        <option value="low">Low to High</option>
                        <option value="high">High to Low</option>
                    </select>
                    <div>
                        <i class="fa fa-chevron-down"></i>
                    </div>
                </div>

                <label class="font-bold">Material</label>
                <div>
                    <select name="material">
                        <option>Show by: Defaulf</option>
                        @foreach ($materials as $material)
                            <option value="{{ $material->id }}">{{ $material->name }}</option>
                        @endforeach
                    </select>
                    <div>
                        <i class="fa fa-chevron-down"></i>
                </div>
            </div>
            </form>
    </section>

    <section>
        @forelse ($products as $product)
            <x-product-card :product="$product" />
        @empty
            <div>
                <p>No furniture matches your search. Try adjusting the filters!</p>
            </div>
        @endforelse

        <div>
            {{ $products->links() }}
        </div>
    </section>
</main>
