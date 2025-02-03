@props(['blocks' => []])

<div class="cms-wrapper">
    @foreach ($blocks as $block)
        @if (!view()->exists('components.' . $block['type']))
            <!-- /!\ Composant {{ $block['type'] }} non trouvé /!\ -->
            @continue
        @endif      
        
        <x-dynamic-component :component="$block['type']" :data="$block['data']" />
    @endforeach

</div>
