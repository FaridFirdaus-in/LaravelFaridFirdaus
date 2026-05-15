<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                    Add Product Image
                </h2>

                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                    Upload and manage product images
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

                {{-- LEFT SIDE --}}
                <div class="space-y-6">

                    {{-- HEADER CARD --}}
                    <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-xl border border-gray-200 dark:border-gray-700 p-8">

                        <span class="px-4 py-2 rounded-full bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 text-sm font-semibold">
                            Product Image
                        </span>

                        <h1 class="text-4xl font-black text-gray-900 dark:text-white mt-4">
                            Upload Image
                        </h1>

                        <p class="text-gray-600 dark:text-gray-300 mt-3 leading-relaxed">
                            Add high-quality images to make your product more attractive and professional.
                        </p>

                    </div>

                    {{-- PREVIEW CARD --}}
                    <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-xl border border-gray-200 dark:border-gray-700 p-6">

                        <p class="text-sm font-semibold text-gray-500 dark:text-gray-400 mb-4">
                            Image Preview
                        </p>

                        <div class="relative overflow-hidden rounded-3xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 h-[320px]">

                            <img id="preview-image"
                                src="https://placehold.co/600x400?text=Preview"
                                class="w-full h-full object-cover hidden transition-all duration-300">

                            <div id="preview-placeholder"
                                class="absolute inset-0 flex flex-col items-center justify-center text-center space-y-3">

                                <div class="w-20 h-20 rounded-3xl bg-gray-100 dark:bg-gray-700 flex items-center justify-center text-4xl">
                                    🖼️
                                </div>

                                <div>
                                    <p class="font-semibold text-gray-700 dark:text-gray-200">
                                        No Image Selected
                                    </p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        Upload image to preview
                                    </p>
                                </div>

                            </div>

                        </div>
                    </div>

                    {{-- PRODUCT INFO --}}
                    <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 p-5">
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">
                            Product
                        </p>
                        <p class="font-bold text-gray-900 dark:text-white">
                            {{ $product->name }}
                        </p>
                    </div>

                </div>

                {{-- RIGHT SIDE (FORM) --}}
                <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-xl border border-gray-200 dark:border-gray-700 p-8">

                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white">
                        Upload Image
                    </h3>

                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-2 mb-6">
                        Choose an image file to upload
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

                    <form action="{{ route('product-images.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf

                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        {{-- UPLOAD --}}
                        <div>
                            <label class="text-sm font-semibold text-gray-700 dark:text-gray-200">
                                Upload Image
                            </label>

                            <label class="mt-3 flex flex-col items-center justify-center w-full h-64 border-2 border-dashed border-gray-300 dark:border-gray-700 rounded-3xl cursor-pointer bg-gray-50 dark:bg-gray-900 hover:bg-gray-100 dark:hover:bg-gray-800 transition">

                                <div class="text-center space-y-3">

                                    <div class="w-20 h-20 mx-auto rounded-3xl bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center text-4xl">
                                        ⬆️
                                    </div>

                                    <p class="text-sm text-gray-600 dark:text-gray-300">
                                        <span class="font-semibold">Click to upload</span> or drag & drop
                                    </p>

                                    <p class="text-xs text-gray-500 dark:text-gray-400">
                                        PNG, JPG, JPEG
                                    </p>

                                </div>

                                <input id="image-input" type="file" name="image" accept="image/*" class="hidden">

                            </label>
                        </div>

                        {{-- BUTTON --}}
                        <div class="flex gap-4 pt-4">

                            <button type="submit"
                                class="px-6 py-4 rounded-2xl bg-blue-600 text-white font-semibold hover:bg-blue-700 transition hover:scale-105">
                                ⬆️ Upload Image
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

    {{-- PREVIEW SCRIPT (FIXED + CLEAN) --}}
    <script>
        const imageInput = document.getElementById('image-input');
        const previewImage = document.getElementById('preview-image');
        const previewPlaceholder = document.getElementById('preview-placeholder');

        imageInput.addEventListener('change', (e) => {
            const file = e.target.files[0];

            if (!file) return;

            const reader = new FileReader();

            reader.onload = (event) => {
                previewImage.src = event.target.result;
                previewImage.classList.remove('hidden');
                previewPlaceholder.classList.add('hidden');
            };

            reader.readAsDataURL(file);
        });
    </script>
</x-app-layout>