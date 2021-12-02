<x-casteaching-layout>
    <div class="flex flex-col h-screen">
        <iframe
                class="md:p-3 lg:p-5 xl:p-10 xl:py-5 2xl:p-20 2xl:p-10 h-4/5"
                height="600"
                src="https://www.youtube.com/embed/qK311dtQr_4"
                title="YouTube video player" frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen>
        </iframe>
        <div class="p-4 lg:p-5 xl:p-10 xl:py-5 2xl:p-20 2xl:py-20">
            {{$video->title}}
        </div>
        <div class="p-4 lg:p-5 xl:p-10 2xl:p-20">
          {{ $video->description }}
        </div>
    </div>
</x-casteaching-layout>
