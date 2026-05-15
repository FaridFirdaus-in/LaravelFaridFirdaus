<x-app-layout>
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900 py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">

            {{-- HERO --}}
            <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-2xl border border-gray-200 dark:border-gray-700 p-8">

                <div class="grid lg:grid-cols-2 gap-10 items-start">

                    {{-- INFO SECTION --}}
                    <div class="space-y-6">

                        {{-- BRAND --}}
                        @if($product->brand && $product->brand->logo)
                        <div class="flex items-center gap-4">

                            <div class="w-16 h-16 rounded-2xl overflow-hidden bg-white shadow border border-gray-200 dark:border-gray-700">
                                <img src="{{ asset('logo/' . $product->brand->logo) }}"
                                    class="w-full h-full object-cover">
                            </div>

                            <div>
                                <p class="text-xs uppercase tracking-widest text-gray-500 dark:text-gray-400">
                                    Brand
                                </p>
                                <h2 class="text-xl font-bold text-gray-900 dark:text-white">
                                    {{ $product->brand->name }}
                                </h2>
                            </div>

                        </div>
                        @endif

                        {{-- NAME --}}
                        <h1 class="text-4xl font-black text-gray-900 dark:text-white leading-tight">
                            {{ $product->name }}
                        </h1>

                        {{-- PRICE --}}
                        <div class="flex items-center gap-3">
                            <span class="text-3xl font-bold text-blue-600">
                                Rp {{ number_format($product->base_price, 0, ',', '.') }}
                            </span>

                            <span class="text-xs px-3 py-1 rounded-full bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-300">
                                Available
                            </span>
                        </div>

                        {{-- DESCRIPTION --}}
                        <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                            {{ $product->description }}
                        </p>

                        {{-- CATEGORY + VARIANT COUNT --}}
                        <div class="grid grid-cols-2 gap-4">

                            <div class="p-4 rounded-2xl bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700">
                                <p class="text-xs text-gray-500">Category</p>
                                <p class="font-bold text-gray-900 dark:text-white">
                                    {{ $product->category->name ?? '-' }}
                                </p>
                            </div>

                            <div class="p-4 rounded-2xl bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700">
                                <p class="text-xs text-gray-500">Variants</p>
                                <p class="font-bold text-gray-900 dark:text-white">
                                    {{ $product->variants->count() }}
                                </p>
                            </div>

                        </div>

                        {{-- ACTION --}}
                        <div class="flex flex-wrap gap-3 pt-4">

                            <a href="{{ route('product-variant.create', ['product_id' => $product->id]) }}"
                                class="px-5 py-3 rounded-2xl bg-blue-600 text-white font-semibold hover:bg-blue-700 transition">
                                + Add Variant
                            </a>

                            <a href="{{ route('product-size.create', ['product_id' => $product->id]) }}"
                                class="px-5 py-3 rounded-2xl border border-gray-300 dark:border-gray-700 text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                                + Add Size
                            </a>

                            <a href="{{ route('product-images.create', ['product_id' => $product->id]) }}"
                                class="px-5 py-3 rounded-2xl border border-gray-300 dark:border-gray-700 text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                                + Add Image
                            </a>

                        </div>

                    </div>
                </div>
            </div>

            {{-- DETAILS --}}
            <div class="grid md:grid-cols-2 gap-8">

                {{-- SIZES --}}
                <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-xl border border-gray-200 dark:border-gray-700 p-8">

                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-bold text-gray-900 dark:text-white">
                            Available Sizes
                        </h2>

                        <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-600 font-bold">
                            {{ $product->sizes->count() }}
                        </span>
                    </div>

                    <div class="flex flex-wrap gap-3">
                        @forelse($product->sizes as $size)
                            <div class="px-5 py-3 rounded-2xl bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 font-semibold text-gray-900 dark:text-white">
                                {{ $size->size_name }}
                            </div>
                        @empty
                            <p class="text-gray-500">No sizes available</p>
                        @endforelse
                    </div>

                </div>

                {{-- VARIANTS --}}
                <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-xl border border-gray-200 dark:border-gray-700 p-8">

                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-bold text-gray-900 dark:text-white">
                            Product Variants
                        </h2>

                        <span class="px-3 py-1 rounded-full bg-purple-100 text-purple-600 font-bold">
                            {{ $product->variants->count() }}
                        </span>
                    </div>

                    <div class="grid sm:grid-cols-2 gap-4">
                        @forelse($product->variants as $variant)
                            <div class="p-4 rounded-2xl bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 hover:shadow-lg transition">

                                <div class="flex items-center gap-3">

                                    <div class="w-12 h-12 rounded-xl border-4 border-white shadow"
                                        style="background-color: {{ $variant->color_code ?? '#000' }};">
                                    </div>

                                    <div>
                                        <p class="font-bold text-gray-900 dark:text-white">
                                            {{ $variant->color_name }}
                                        </p>
                                        <p class="text-xs text-gray-500">
                                            {{ $variant->color_code }}
                                        </p>
                                    </div>

                                </div>

                            </div>
                        @empty
                            <p class="text-gray-500">No variants available</p>
                        @endforelse
                    </div>

                </div>

            </div>

        </div>
    </div>
</x-app-layout>