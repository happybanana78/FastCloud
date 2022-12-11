<nav class="flex justify-between items-center px-20 mt-10">
    <a href="/">
      <img alt="logo" src="{{asset('images/logo.png')}}" class="w-60">
    </a>
    <div class="text-white font-semibold text-2xl space-x-5">
      <a href="" class="space-x-4 hover:text-red-600">
        <i class="fa-regular fa-folder-open"></i>
        FILES
      </a>
      <a href="" class="space-x-4 hover:text-red-600">
        <i class="fa-solid fa-gear"></i>
        SETTINGS
      </a>
    </div>
    <button id="upload-btn" class="px-4 py-4 bg-red-900 text-white rounded-full font-semibold
    hover:bg-red-800 flex justify-center space-x-4 items-center text-3xl">
      <i class="fa-solid fa-cloud-arrow-up"></i>
      <span>Upload File</span>
    </button>
</nav>