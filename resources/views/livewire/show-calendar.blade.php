{{-- <!-- dump($days); --> --}}
@php
  use Carbon\Carbon;
  
  function dayColor($dateString, $today)
  {
      $targetDate = Carbon::createFromFormat('Y-m-d', $dateString);
  
      if ($targetDate->format('j') != $today->format('j')) {
          return false;
      }

      if ($targetDate->format('m') != $today->format('m')) {
          return false;
      }
  
      if ($targetDate->format('Y') != $today->format('Y')) {
          return false;
      }
  
      return true;
  }

  function cellColor($dateString, $currentDate)
  {
      $targetDate = Carbon::createFromFormat('Y-m-d', $dateString);
  
      if ($targetDate->format('m') != $currentDate->format('m')) {
          return false;
      }
  
      if ($targetDate->format('Y') != $currentDate->format('Y')) {
          return false;
      }
  
      return true;
  }

  function getHour($dateTime)
  {
    $hour_exploded = explode(':', explode(' ', $dateTime)[1]);

    $hour = intval($hour_exploded[0]); 
    $suffix = $hour > 12 ? ' PM' : ' AM'; 
    $hour = $hour > 12 ? $hour-12 : $hour; 

    $custom_date = $hour . ':' . $hour_exploded[1] . $suffix; 

    return $custom_date;
  }
@endphp

{{-- <!-- Knowing others is intelligence; knowing yourself is true wisdom. --> --}}

<div class="lg:flex lg:h-full lg:flex-col">
  <div class="flex items-center justify-between border-b border-gray-200 px-6 py-4 lg:flex-none">
    <h1 class="text-base font-semibold leading-6 text-gray-900">
      <time datetime="2022-01">{{ $currentDate->format('F Y') }}</time>
    </h1>
    <div class="flex items-center">
      <div class="relative flex items-center rounded-md bg-white shadow-sm md:items-stretch">
        <div class="pointer-events-none absolute inset-0 rounded-md ring-1 ring-inset ring-gray-300" aria-hidden="true"></div>
        <button wire:click="goPreviousMonth" type="button" class="flex items-center justify-center rounded-l-md py-2 pl-3 pr-4 text-gray-400 hover:text-gray-500 focus:relative md:w-9 md:px-2 md:hover:bg-gray-50">
          <span class="sr-only">Previous month</span>
          <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
            <path fill-rule="evenodd" d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z" clip-rule="evenodd" />
          </svg>
        </button>
        <button type="button" class="hidden px-3.5 text-sm font-semibold text-gray-900 hover:bg-gray-50 focus:relative md:block">{{ $currentDate->format('M') }}</button>
        <span class="relative -mx-px h-5 w-px bg-gray-300 md:hidden"></span>
        <button wire:click="goNextMonth" type="button" class="flex items-center justify-center rounded-r-md py-2 pl-4 pr-3 text-gray-400 hover:text-gray-500 focus:relative md:w-9 md:px-2 md:hover:bg-gray-50">
          <span class="sr-only">Next month</span>
          <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
            <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
          </svg>
        </button>
      </div>
      <div class="hidden md:ml-4 md:flex md:items-center">
        {{-- <!-- <div class="ml-6 h-6 w-px bg-gray-300"></div> --> --}}
        <a href="{{ route('tasks.create') }}" type="button" class="ml-6 rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Add Task</a>
      </div>
      <div class="relative ml-6 md:hidden">
        <button type="button" class="-mx-2 flex items-center rounded-full border border-transparent p-2 text-gray-400 hover:text-gray-500" id="menu-0-button" aria-expanded="false" aria-haspopup="true">
          <span class="sr-only">Open menu</span>
          <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
            <path d="M3 10a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zM8.5 10a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zM15.5 8.5a1.5 1.5 0 100 3 1.5 1.5 0 000-3z" />
          </svg>
        </button>

        <!--
          Dropdown menu, show/hide based on menu state.

          Entering: "transition ease-out duration-100"
            From: "transform opacity-0 scale-95"
            To: "transform opacity-100 scale-100"
          Leaving: "transition ease-in duration-75"
            From: "transform opacity-100 scale-100"
            To: "transform opacity-0 scale-95"
        -->
        <div class="absolute right-0 z-10 mt-3 w-36 origin-top-right divide-y divide-gray-100 overflow-hidden rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-0-button" tabindex="-1">
          <div class="py-1" role="none">
            <!-- Active: "bg-gray-100 text-gray-900", Not Active: "text-gray-700" -->
            <a href="#" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-0-item-0">Create event</a>
          </div>
          <div class="py-1" role="none">
            <a href="#" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-0-item-1">Go to today</a>
          </div>
          <div class="py-1" role="none">
            <a href="#" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-0-item-2">Day view</a>
            <a href="#" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-0-item-3">Week view</a>
            <a href="#" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-0-item-4">Month view</a>
            <a href="#" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-0-item-5">Year view</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="shadow ring-1 ring-black ring-opacity-5 lg:flex lg:flex-auto lg:flex-col">
    <div class="grid grid-cols-7 gap-px border-b border-gray-300 bg-gray-200 text-center text-xs font-semibold leading-6 text-gray-700 lg:flex-none">
      <div class="flex justify-center bg-white py-2">
        <span>M</span>
        <span class="sr-only sm:not-sr-only">on</span>
      </div>
      <div class="flex justify-center bg-white py-2">
        <span>T</span>
        <span class="sr-only sm:not-sr-only">ue</span>
      </div>
      <div class="flex justify-center bg-white py-2">
        <span>W</span>
        <span class="sr-only sm:not-sr-only">ed</span>
      </div>
      <div class="flex justify-center bg-white py-2">
        <span>T</span>
        <span class="sr-only sm:not-sr-only">hu</span>
      </div>
      <div class="flex justify-center bg-white py-2">
        <span>F</span>
        <span class="sr-only sm:not-sr-only">ri</span>
      </div>
      <div class="flex justify-center bg-white py-2">
        <span>S</span>
        <span class="sr-only sm:not-sr-only">at</span>
      </div>
      <div class="flex justify-center bg-white py-2">
        <span>S</span>
        <span class="sr-only sm:not-sr-only">un</span>
      </div>
    </div>
    <div class="flex bg-gray-200 text-xs leading-6 text-gray-700 lg:flex-auto">
      <div class="hidden w-full lg:grid lg:grid-cols-7 lg:grid-rows-6 lg:gap-px">
        @foreach ($days as $day)
          {{-- <!-- <div class="relative bg-gray-50 px-3 py-2 text-gray-500"> --> --}}
          <div class="relative px-3 py-2 @if (cellColor($day['toDateString'], $currentDate)) bg-white @else bg-gray-100 text-gray-500 @endif  ">
            <time datetime="{{ $day['toDateString'] }}" class="flex h-6 w-6 items-center justify-center rounded-full font-semibold text-lg @if (dayColor($day['toDateString'], $today)) bg-indigo-600 text-white @endif">{{ $day['number'] }}</time>
            <ol class="mt-2">
              @foreach ($day['tasks'] as $task)
                <li>
                  <a href="{{ route('tasks.edit', ['task' => $task]) }}" class="group flex">
                    <p class="flex-auto truncate font-medium text-gray-900 group-hover:text-indigo-600">{{ $task->action }}</p>
                    <time datetime="{{ $task->scheduled }}" class="ml-3 flex-none text-gray-500 group-hover:text-indigo-600 xl:block">{{ getHour($task->scheduled) }}</time>
                  </a>
                </li>
              @endforeach
            </ol>
          </div>
        @endforeach
      </div>
    </div>
  </div>
  <div class="px-4 py-10 sm:px-6 lg:hidden">
    <ol class="divide-y divide-gray-100 overflow-hidden rounded-lg bg-white text-sm shadow ring-1 ring-black ring-opacity-5">
      <li class="group flex p-4 pr-6 focus-within:bg-gray-50 hover:bg-gray-50">
        <div class="flex-auto">
          <p class="font-semibold text-gray-900">Maple syrup museum</p>
          <time datetime="2022-01-15T09:00" class="mt-2 flex items-center text-gray-700">
            <svg class="mr-2 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.75-13a.75.75 0 00-1.5 0v5c0 .414.336.75.75.75h4a.75.75 0 000-1.5h-3.25V5z" clip-rule="evenodd" />
            </svg>
            3PM
          </time>
        </div>
        <a href="#" class="ml-6 flex-none self-center rounded-md bg-white px-3 py-2 font-semibold text-gray-900 opacity-0 shadow-sm ring-1 ring-inset ring-gray-300 hover:ring-gray-400 focus:opacity-100 group-hover:opacity-100">Edit<span class="sr-only">, Maple syrup museum</span></a>
      </li>
      <li class="group flex p-4 pr-6 focus-within:bg-gray-50 hover:bg-gray-50">
        <div class="flex-auto">
          <p class="font-semibold text-gray-900">Hockey game</p>
          <time datetime="2022-01-22T19:00" class="mt-2 flex items-center text-gray-700">
            <svg class="mr-2 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.75-13a.75.75 0 00-1.5 0v5c0 .414.336.75.75.75h4a.75.75 0 000-1.5h-3.25V5z" clip-rule="evenodd" />
            </svg>
            7PM
          </time>
        </div>
        <a href="#" class="ml-6 flex-none self-center rounded-md bg-white px-3 py-2 font-semibold text-gray-900 opacity-0 shadow-sm ring-1 ring-inset ring-gray-300 hover:ring-gray-400 focus:opacity-100 group-hover:opacity-100">Edit<span class="sr-only">, Hockey game</span></a>
      </li>
    </ol>
  </div>
</div>


