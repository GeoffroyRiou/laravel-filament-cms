@props(['categorie', 'depth'])
<h{{$depth+1}} style="font-size: {{16-$depth}}px" class="{{$depth === 0 ? 'font-bold' : ''}}">{{ str_repeat('--',$depth) }} {{ $categorie->nom }}</h{{$depth+1}}>

@foreach ($categorie->children as $subCategorie)
    <x-admin-categorie-tree :categorie="$subCategorie" :depth="$depth + 1" />
@endforeach
