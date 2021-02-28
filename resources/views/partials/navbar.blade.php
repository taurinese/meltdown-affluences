<div class="relative bg-white overflow-hidden">
  <div class="max-w-7xl mx-auto">
    <div class="relative z-10 pb-8 bg-white sm:pb-8 md:pb-10 lg:max-w-2xl lg:w-full lg:pb-14 xl:pb-16">
      <svg class="hidden lg:block absolute right-0 inset-y-0 h-full w-48 text-white transform translate-x-1/2" fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none" aria-hidden="true">
        <polygon points="50,0 100,0 50,100 0,100" />
      </svg>

      <div class="relative pt-6 px-4 sm:px-6 lg:px-8">
        <nav class="relative flex items-center justify-between sm:h-10 lg:justify-start" aria-label="Global">
          <div class="flex items-center flex-grow flex-shrink-0 lg:flex-grow-0">
            <div class="flex items-center justify-between w-full md:w-auto">
              <a href="{{ route('index') }}">
                <span class="sr-only">Accueil</span>
                <img class="h-8 w-auto sm:h-10" src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/09/Blue_computer_icon.svg/1024px-Blue_computer_icon.svg.png">
              </a>
            </div>
          </div>
          <div class="hidden md:block md:ml-10 md:pr-4 md:space-x-8">
            <a href="{{ route('index') }}" class="font-medium text-gray-500 hover:text-gray-900">Accueil</a>
            <a href="{{ route('booking.form') }}" class="font-medium text-indigo-500 hover:text-gray-900">Réservation</a>
          </div>
        </nav>
      </div>
    </div>
  </div>
</div>