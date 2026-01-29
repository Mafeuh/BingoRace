@props([
    'value' => '',
    'name',
    'required' => null,
    'message' => ''
])

<div class="relative" x-cloak>
	<div id="error_cache" class="hidden rounded-xl absolute bg-red-500/30 w-full h-full p-5 flex items-center justify-center">
		<div class="text-white font-bold align-middle text-xl">
			{{ __('form.input.image.error') }}
		</div>
	</div>
	<div {{ $attributes->except(array_keys($attributes->whereStartsWith('wire:')->getAttributes()))
			->merge(['class' => 'border-2 dark:text-white dark:bg-black/20 dark:border-black/30 border-dashed border-gray-400 rounded-xl bg-white p-6 text-center cursor-pointer transition hover:border-blue-500']) }}
		id="dropZone-{{$name}}">
		<input 
			{{ $attributes->whereStartsWith('wire:') }}
			onchange="checkFileSize(this)"
			type="file" 
			accept="image/*"
			name="{{ $name }}" 
			id="{{ $name }}"
			@required($required != null)
			class="hidden" />
		<p class="text-gray-500">
			{{ __('form.input.image.text') }}
		</p>
		<p class="text-gray-500 text-sm">{{ $message }}</p>
		<div id="preview" class="mt-4"></div>
	</div>
	<script>
		const dropzone = document.getElementById('dropZone-{{$name}}');
		const fileInput = document.getElementById('{{ $name }}');
		const preview = document.getElementById('preview');
		const error_cache = document.getElementById('error_cache');
	
		// Click ouvre le sélecteur
		dropzone.addEventListener('click', () => fileInput.click());
	
		// Drag events
		dropzone.addEventListener('dragover', (e) => {
		e.preventDefault();
		dropzone.classList.add('border-blue-500');
		});
	
		dropzone.addEventListener('dragleave', () => {
		dropzone.classList.remove('border-blue-500');
		});
	
		dropzone.addEventListener('drop', (e) => {
			e.preventDefault();
			showCache();
			// dropzone.classList.remove('border-blue-500');
			// handleFiles(e.dataTransfer.files);
		});
	
		fileInput.addEventListener('change', () => {
		handleFiles(fileInput.files);
		});

		function showCache() {
			error_cache.classList.toggle('hidden');
			setTimeout(() => {
				error_cache.classList.toggle('hidden');
			}, 3000);
		}
	
		function handleFiles(files) {
		preview.innerHTML = '';
		if (files.length > 0) {
			const file = files[0];
			if (file.type.startsWith('image/')) {
			const reader = new FileReader();
			reader.onload = (e) => {
				const img = document.createElement('img');
				img.src = e.target.result;
				img.className = "mx-auto mt-2 max-h-48 rounded-lg shadow";
				preview.appendChild(img);
			};
			reader.readAsDataURL(file);
			} else {
			preview.innerText = 'Fichier non supporté.';
			}
		}
		}

		function checkFileSize(input) {
		const maxSize = 2 * 1024 * 1024; // 2 MB
		if (input.files[0].size > maxSize) {
			alert("Le fichier est trop lourd (max 2 Mo).");
			input.value = ""; // réinitialise
		}
		}

	</script>
</div>