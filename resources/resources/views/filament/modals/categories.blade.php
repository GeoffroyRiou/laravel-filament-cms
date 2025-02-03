@foreach ($categories as $categorie)
    <x-admin-categorie-tree :categorie="$categorie" :depth="0" />
@endforeach
