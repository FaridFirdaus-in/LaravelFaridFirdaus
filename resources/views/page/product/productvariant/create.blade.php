<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                    Add Variant
                </h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                    Add new product color variant
                </p>
            </div>

            <a href="{{ route('products.show', $product->id) }}"
                class="px-5 py-3 rounded-2xl border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm font-semibold text-gray-700 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                ← Back
            </a>
        </div>
    </x-slot>

    <div class="min-h-screen bg-gray-100 dark:bg-gray-900 py-10">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="grid lg:grid-cols-2 gap-10">

                {{-- LEFT PANEL --}}
                <div class="space-y-6">

                    <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-xl border border-gray-200 dark:border-gray-700 p-8">

                        <span class="px-4 py-2 rounded-full bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-300 text-sm font-semibold">
                            Product Variant
                        </span>

                        <h1 class="text-4xl font-black text-gray-900 dark:text-white mt-4">
                            Create Variant
                        </h1>

                        <p class="text-gray-600 dark:text-gray-300 mt-3">
                            Define a new color variant for your product.
                        </p>

                    </div>

                    {{-- LIVE PREVIEW --}}
                    <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-xl border border-gray-200 dark:border-gray-700 p-8">

                        <p class="text-sm font-semibold text-gray-500 dark:text-gray-400 mb-5">
                            Live Preview
                        </p>

                        <div class="flex items-center gap-5">

                            <div id="preview-box"
                                class="w-24 h-24 rounded-3xl border-4 border-white shadow-xl bg-black transition-all duration-300">
                            </div>

                            <div>
                                <h3 id="preview-name" class="text-2xl font-bold text-gray-900 dark:text-white">
                                    BLACK
                                </h3>

                                <p id="preview-code" class="text-gray-500 dark:text-gray-400">
                                    #000000
                                </p>
                            </div>

                        </div>
                    </div>

                    {{-- PRODUCT INFO --}}
                    <div class="grid grid-cols-2 gap-4">

                        <div class="bg-white dark:bg-gray-800 rounded-2xl p-5 border border-gray-200 dark:border-gray-700">
                            <p class="text-sm text-gray-500">Product</p>
                            <p class="font-bold text-gray-900 dark:text-white">
                                {{ $product->name }}
                            </p>
                        </div>

                        <div class="bg-white dark:bg-gray-800 rounded-2xl p-5 border border-gray-200 dark:border-gray-700">
                            <p class="text-sm text-gray-500">Total Variants</p>
                            <p class="font-bold text-gray-900 dark:text-white">
                                {{ $product->variants->count() }}
                            </p>
                        </div>

                    </div>

                </div>

                {{-- FORM --}}
                <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-xl border border-gray-200 dark:border-gray-700 p-8">

                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">
                        Variant Information
                    </h3>

                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-6">
                        Fill in color details below
                    </p>

                    {{-- ERROR --}}
                    @if ($errors->any())
                        <div class="mb-6 p-5 rounded-2xl bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800">
                            <p class="font-semibold text-red-600 dark:text-red-300 mb-2">
                                Validation Error
                            </p>

                            <ul class="text-sm text-red-600 dark:text-red-300 space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>• {{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('product-variant.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        {{-- COLOR NAME --}}
                        <div>
                            <label class="text-sm font-semibold text-gray-700 dark:text-gray-200">
                                Color Name
                            </label>

                            <input type="text" id="color-name" name="color"
                                placeholder="BLACK / WHITE / RED"
                                class="mt-2 w-full px-5 py-4 rounded-2xl border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white focus:ring-4 focus:ring-blue-100 dark:focus:ring-blue-900 outline-none transition">
                        </div>

                        {{-- COLOR CODE --}}
                        <div>
                            <label class="text-sm font-semibold text-gray-700 dark:text-gray-200">
                                Color Code
                            </label>

                            <div class="flex gap-4 mt-2">

                                <input type="color" id="color-picker" value="#000000"
                                    class="w-20 h-16 rounded-2xl border border-gray-300 dark:border-gray-700 cursor-pointer">

                                <input type="text" id="color-code" name="color_code" value="#000000"
                                    placeholder="#000000"
                                    class="flex-1 px-5 py-4 rounded-2xl border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white focus:ring-4 focus:ring-blue-100 dark:focus:ring-blue-900 outline-none transition">

                            </div>
                        </div>

                        <input type="hidden" name="stock" value="0">

                        {{-- BUTTON --}}
                        <div class="flex gap-4 pt-4">

                            <button type="submit"
                                class="px-6 py-4 rounded-2xl bg-blue-600 text-white font-semibold hover:bg-blue-700 transition hover:scale-105">
                                💾 Save Variant
                            </button>

                            <a href="{{ route('products.show', $product->id) }}"
                                class="px-6 py-4 rounded-2xl border border-gray-300 dark:border-gray-700 text-gray-700 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                                Cancel
                            </a>

                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>

    {{-- LIVE PREVIEW SCRIPT (FIXED) --}}
    <script>
        const colorName = document.getElementById('color-name');
        const colorCode = document.getElementById('color-code');
        const colorPicker = document.getElementById('color-picker');

        const previewBox = document.getElementById('preview-box');
        const previewName = document.getElementById('preview-name');
        const previewCode = document.getElementById('preview-code');

        function updatePreview() {
            const name = colorName.value || 'BLACK';
            const code = colorCode.value || '#000000';

            previewName.innerText = name.toUpperCase();
            previewCode.innerText = code;
            previewBox.style.backgroundColor = code;
        }

        colorName.addEventListener('input', updatePreview);

        colorCode.addEventListener('input', () => {
            colorPicker.value = colorCode.value;
            updatePreview();
        });

        colorPicker.addEventListener('input', () => {
            colorCode.value = colorPicker.value;
            updatePreview();
        });
    </script>
</x-app-layout>