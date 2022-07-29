<x-head-start/>
<x-app-layout>
    <x-slot name="header">
</x-slot> 
<br>
<br>
<br>
<br>
<br>
<section class="text-gray-600 body-font">
    <div class="container px-5 py-24 mx-auto">
      <div class="xl:w-1/2 lg:w-3/4 w-full mx-auto text-center">
            <button onclick="location.href='{{ route('users.blogs.unsubscribe') }}'" class="leading-relaxed text-lg">退会する</button>
      </div>
    </div>
  </section>
</x-app-layout>
<x-head-end/>