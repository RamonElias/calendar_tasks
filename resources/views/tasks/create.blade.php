<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      Create a new task !
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="p-6 bg-white overflow-hidden shadow-xl sm:rounded-lg">
        @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
                <li class="block mb-2 text-sm font-medium">{{ $error }}</li>
              @endforeach
            </ul>
          </div>

          <hr />
          <br />
        @endif

        <form method="POST" action="{{ route('tasks.store') }}">
          @csrf

          <div class="mb-6">
            <label for="action" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Describe your task</label>
            <input type="text" id="action" name="action" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
          </div>

          <div class="mb-6">
            <label for="day" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your task date</label>
            <input type="date" id="day" name="day" class="block text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
          </div>

          <div class="mb-6">
            <label for="hour" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your task hour</label>
            <input type="time" id="hour" name="hour" class="block text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
          </div>

          <x-button class="ml-4">
            {{ __('Submit') }}
          </x-button>
        </form>
      </div>
    </div>
  </div>
</x-app-layout>
