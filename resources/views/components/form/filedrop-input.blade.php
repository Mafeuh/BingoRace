@props([
    'value' => '',
    'name',
    'required' => null,
    'message' => '',
    'wire_model' => null
])

<div 
	id="dropZone-{{$name}}"
    class="border-2 border-dashed border-gray-400 rounded-xl bg-white p-6 text-center cursor-pointer transition hover:border-blue-500">
    <input 
        @if($wire_model != null)
		wire:model="{{$wire_model}}"
		@endif
        type="file" 
        accept="image/*"
        name="{{ $name }}" 
        id="{{ $name }}"
        @required($required != null)
        class="hidden" />
    <p class="text-gray-500">{{ __('form.input.image.text') }}</p>
    <p class="text-gray-500 text-sm">{{ $message }}</p>
    <div id="preview" class="mt-4"></div>
</div>
<script>
    const dropzone = document.getElementById('dropZone-{{$name}}');
    const fileInput = document.getElementById('{{ $name }}');
    const preview = document.getElementById('preview');
  
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
      dropzone.classList.remove('border-blue-500');
      handleFiles(e.dataTransfer.files);
    });
  
    fileInput.addEventListener('change', () => {
      handleFiles(fileInput.files);
    });
  
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
  </script>