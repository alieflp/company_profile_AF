/**
 * Advanced Image Upload Handler
 * Features:
 * - Multiple file selection
 * - Individual file preview
 * - Remove files before save
 * - Keep existing files when uploading new ones
 */

class AdvancedImageUpload {
    constructor(config) {
        this.inputId = config.inputId;
        this.previewContainerId = config.previewContainerId;
        this.existingImagesContainerId = config.existingImagesContainerId || null;
        this.maxFiles = config.maxFiles || 10;
        this.allowedTypes = config.allowedTypes || ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];
        this.maxSizeMB = config.maxSizeMB || 2;
        
        this.selectedFiles = new Map(); // Store files with unique IDs
        this.existingImages = new Set(); // Track existing images
        this.fileCounter = 0;
        
        this.init();
    }
    
    init() {
        const input = document.getElementById(this.inputId);
        const previewContainer = document.getElementById(this.previewContainerId);
        
        if (!input || !previewContainer) {
            console.error('Image upload elements not found');
            return;
        }
        
        // Load existing images if container exists
        if (this.existingImagesContainerId) {
            this.loadExistingImages();
        }
        
        // Handle file selection
        input.addEventListener('change', (e) => this.handleFileSelect(e));
        
        // Support drag and drop
        previewContainer.addEventListener('dragover', (e) => {
            e.preventDefault();
            previewContainer.classList.add('border-blue-500', 'bg-blue-50');
        });
        
        previewContainer.addEventListener('dragleave', (e) => {
            e.preventDefault();
            previewContainer.classList.remove('border-blue-500', 'bg-blue-50');
        });
        
        previewContainer.addEventListener('drop', (e) => {
            e.preventDefault();
            previewContainer.classList.remove('border-blue-500', 'bg-blue-50');
            const files = Array.from(e.dataTransfer.files);
            this.addFiles(files);
        });
    }
    
    loadExistingImages() {
        const container = document.getElementById(this.existingImagesContainerId);
        if (!container) return;
        
        const images = container.querySelectorAll('[data-image-path]');
        images.forEach(img => {
            const path = img.getAttribute('data-image-path');
            this.existingImages.add(path);
        });
    }
    
    handleFileSelect(event) {
        const files = Array.from(event.target.files);
        this.addFiles(files);
        
        // Don't reset input to allow multiple selections
        // event.target.value = '';
    }
    
    addFiles(files) {
        files.forEach(file => {
            // Validate file
            if (!this.validateFile(file)) return;
            
            // Check max files limit
            if (this.selectedFiles.size >= this.maxFiles) {
                alert(`Maximum ${this.maxFiles} files allowed`);
                return;
            }
            
            // Add file with unique ID
            const fileId = `file_${this.fileCounter++}_${Date.now()}`;
            this.selectedFiles.set(fileId, file);
            
            // Create preview
            this.createPreview(fileId, file);
        });
        
        // Update hidden input with file data
        this.updateFileInput();
    }
    
    validateFile(file) {
        // Check file type
        if (!this.allowedTypes.includes(file.type)) {
            alert(`File type not allowed: ${file.name}\nAllowed: JPG, PNG, WEBP`);
            return false;
        }
        
        // Check file size
        const sizeMB = file.size / (1024 * 1024);
        if (sizeMB > this.maxSizeMB) {
            alert(`File too large: ${file.name}\nMax size: ${this.maxSizeMB}MB`);
            return false;
        }
        
        return true;
    }
    
    createPreview(fileId, file) {
        const previewContainer = document.getElementById(this.previewContainerId);
        const reader = new FileReader();
        
        reader.onload = (e) => {
            const previewItem = document.createElement('div');
            previewItem.className = 'relative group';
            previewItem.setAttribute('data-file-id', fileId);
            
            previewItem.innerHTML = `
                <img src="${e.target.result}" alt="${file.name}" 
                     class="w-full h-32 object-cover rounded-lg border-2 border-slate-200">
                <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity rounded-lg flex items-center justify-center">
                    <button type="button" onclick="window.imageUploader_${this.inputId}.removeFile('${fileId}')" 
                            class="p-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                    </button>
                </div>
                <p class="text-xs text-slate-600 mt-1 truncate">${file.name}</p>
            `;
            
            previewContainer.appendChild(previewItem);
            previewContainer.classList.remove('hidden');
        };
        
        reader.readAsDataURL(file);
    }
    
    removeFile(fileId) {
        // Remove from map
        this.selectedFiles.delete(fileId);
        
        // Remove preview
        const previewContainer = document.getElementById(this.previewContainerId);
        const previewItem = previewContainer.querySelector(`[data-file-id="${fileId}"]`);
        if (previewItem) {
            previewItem.remove();
        }
        
        // Hide container if empty
        if (this.selectedFiles.size === 0) {
            previewContainer.classList.add('hidden');
        }
        
        // Update hidden input
        this.updateFileInput();
    }
    
    removeExistingImage(imagePath, element) {
        if (!confirm('Are you sure you want to remove this image?')) {
            return false;
        }
        
        this.existingImages.delete(imagePath);
        
        // Add to removed images list BEFORE removing element (for backend processing)
        const form = element.closest('form');
        if (form) {
            const removedInput = document.createElement('input');
            removedInput.type = 'hidden';
            removedInput.name = 'removed_images[]';
            removedInput.value = imagePath;
            removedInput.className = 'removed-image-marker';
            form.appendChild(removedInput);
        }
        
        // Remove the element from DOM
        element.remove();
        
        return true;
    }
    
    updateFileInput() {
        const input = document.getElementById(this.inputId);
        
        // Create a new DataTransfer object
        const dataTransfer = new DataTransfer();
        
        // Add all selected files
        this.selectedFiles.forEach(file => {
            dataTransfer.items.add(file);
        });
        
        // Update input files
        input.files = dataTransfer.files;
    }
    
    getSelectedFiles() {
        return Array.from(this.selectedFiles.values());
    }
    
    getFileCount() {
        return this.selectedFiles.size;
    }
}

// Global helper for existing images removal
function removeExistingImage(imagePath, buttonElement, uploaderId) {
    const uploader = window[uploaderId];
    if (uploader) {
        uploader.removeExistingImage(imagePath, buttonElement.closest('.existing-image-item'));
    }
}
