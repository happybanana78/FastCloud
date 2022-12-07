const modalBg = document.getElementById('modal-back');  // Modal Background
const uploadModal = document.getElementById('upload-modal');    // Upload modal
const mainUploadBtn = document.getElementById('upload-btn');    // Main upload button on navbar
const uploadBtn = document.getElementById('upload');    // File upload button
const createFolderBtn = document.getElementById('create-folder');   // Create new folder button
const uploadForm = document.getElementById('upload-form');  // File upload form
const createForm = document.getElementById('create-form');  // Create folder form
const uploadButtons = document.getElementById('upload-buttons');    // Buttons wrapper
const uploadBackBtn = document.getElementById('upload-back');   // Back from upload button
const createBackBtn = document.getElementById('create-back');   // Back from create folder button

// Handle upload modal
mainUploadBtn.addEventListener('click', () => {
    modalBg.classList.remove('hidden');
    uploadModal.classList.remove('hidden');
});

modalBg.addEventListener('click', () => {
    modalBg.classList.add('hidden');
    uploadModal.classList.add('hidden');
});

// Handle upload file ui
uploadBtn.addEventListener('click', () => {
    uploadForm.classList.remove('hidden');
    uploadButtons.classList.add('hidden');
});

uploadBackBtn.addEventListener('click', () => {
    uploadForm.classList.add('hidden');
    uploadButtons.classList.remove('hidden');
});

// Handle create folder ui
createFolderBtn.addEventListener('click', () => {
    createForm.classList.remove('hidden');
    uploadButtons.classList.add('hidden');
});

createBackBtn.addEventListener('click', () => {
    createForm.classList.add('hidden');
    uploadButtons.classList.remove('hidden');
});