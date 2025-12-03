{{-- Full Screen Gallery Modal --}}
<div id="galleryModal" class="hidden fixed inset-0 bg-black/95 z-50 backdrop-blur-sm" style="display: none;">
    <div class="h-full flex flex-col">
        {{-- Header --}}
        <div class="flex items-center justify-between p-6 bg-black/50">
            <div class="text-white">
                <h3 id="modalTitle" class="text-xl font-bold"></h3>
                <p id="modalCounter" class="text-sm text-slate-300"></p>
            </div>
            <div class="flex items-center gap-4">
                <button onclick="downloadImage()" class="p-2 rounded-lg bg-white/10 hover:bg-white/20 text-white transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                </button>
                <button onclick="closeGalleryModal()" class="p-2 rounded-lg bg-white/10 hover:bg-white/20 text-white transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
        </div>

        {{-- Main Image --}}
        <div class="flex-1 flex items-center justify-center p-6">
            <div class="relative max-w-7xl max-h-full">
                {{-- Previous Button --}}
                <button onclick="previousImage()" class="absolute left-4 top-1/2 -translate-y-1/2 p-3 rounded-full bg-white/10 hover:bg-white/20 text-white backdrop-blur-sm transition z-10">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                </button>

                {{-- Image --}}
                <img id="modalImage" src="" alt="Gallery Image" class="max-w-full max-h-[calc(100vh-300px)] w-auto h-auto object-contain mx-auto rounded-lg shadow-2xl">

                {{-- Next Button --}}
                <button onclick="nextImage()" class="absolute right-4 top-1/2 -translate-y-1/2 p-3 rounded-full bg-white/10 hover:bg-white/20 text-white backdrop-blur-sm transition z-10">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </button>
            </div>
        </div>

        {{-- Thumbnails --}}
        <div class="p-6 bg-black/50">
            <div id="thumbnailContainer" class="flex gap-3 overflow-x-auto pb-2"></div>
        </div>
    </div>
</div>

<script>
let currentImageIndex = 0;
let galleryImages = [];
let portfolioTitle = '';

function openGalleryModal(index, images, title) {
    currentImageIndex = index;
    galleryImages = images;
    portfolioTitle = title;
    
    const modal = document.getElementById('galleryModal');
    modal.style.display = 'block';
    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
    
    updateGalleryModal();
    renderThumbnails();
}

function closeGalleryModal() {
    const modal = document.getElementById('galleryModal');
    modal.style.display = 'none';
    modal.classList.add('hidden');
    document.body.style.overflow = 'auto';
}

function updateGalleryModal() {
    const modalImage = document.getElementById('modalImage');
    const modalTitle = document.getElementById('modalTitle');
    const modalCounter = document.getElementById('modalCounter');
    
    modalImage.src = galleryImages[currentImageIndex];
    modalTitle.textContent = portfolioTitle;
    modalCounter.textContent = `Image ${currentImageIndex + 1} of ${galleryImages.length}`;
}

function previousImage() {
    currentImageIndex = (currentImageIndex - 1 + galleryImages.length) % galleryImages.length;
    updateGalleryModal();
    highlightThumbnail();
}

function nextImage() {
    currentImageIndex = (currentImageIndex + 1) % galleryImages.length;
    updateGalleryModal();
    highlightThumbnail();
}

function renderThumbnails() {
    const container = document.getElementById('thumbnailContainer');
    container.innerHTML = '';
    
    galleryImages.forEach((img, index) => {
        const thumb = document.createElement('div');
        thumb.className = `flex-shrink-0 w-24 h-16 rounded-lg overflow-hidden cursor-pointer border-2 transition ${index === currentImageIndex ? 'border-blue-500 scale-110' : 'border-transparent hover:border-white/50'}`;
        thumb.onclick = () => {
            currentImageIndex = index;
            updateGalleryModal();
            highlightThumbnail();
        };
        
        const thumbImg = document.createElement('img');
        thumbImg.src = img;
        thumbImg.className = 'w-full h-full object-cover';
        thumb.appendChild(thumbImg);
        
        container.appendChild(thumb);
    });
}

function highlightThumbnail() {
    const thumbnails = document.getElementById('thumbnailContainer').children;
    Array.from(thumbnails).forEach((thumb, index) => {
        if (index === currentImageIndex) {
            thumb.className = 'flex-shrink-0 w-24 h-16 rounded-lg overflow-hidden cursor-pointer border-2 border-blue-500 scale-110 transition';
        } else {
            thumb.className = 'flex-shrink-0 w-24 h-16 rounded-lg overflow-hidden cursor-pointer border-2 border-transparent hover:border-white/50 transition';
        }
    });
}

function downloadImage() {
    const img = galleryImages[currentImageIndex];
    const link = document.createElement('a');
    link.href = img;
    link.download = `${portfolioTitle}-${currentImageIndex + 1}.jpg`;
    link.click();
}

// Keyboard navigation
document.addEventListener('keydown', function(e) {
    const modal = document.getElementById('galleryModal');
    if (modal.style.display !== 'none') {
        if (e.key === 'ArrowLeft') previousImage();
        if (e.key === 'ArrowRight') nextImage();
        if (e.key === 'Escape') closeGalleryModal();
    }
});

// Close on background click
document.getElementById('galleryModal')?.addEventListener('click', function(e) {
    if (e.target === this) {
        closeGalleryModal();
    }
});
</script>
