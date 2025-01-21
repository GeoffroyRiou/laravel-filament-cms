<form wire:submit="send">

    <div>

        @if ($sendingError || $formSent)
            <div>
                {{ !$formSent ? 'Une erreur est survenue' : 'Votre message a bien été envoyé' }}
            </div>
        @endif

        @foreach ($form->champs as $blockIndex => $block)
            <div 
                {{ $block['data']['large'] ? '-large' : '' }}">
                @switch($block['type'])
                    @case('bloc_texte')
                        <label for="{{ $block['data']['slug'] }}"
                            class="label">{{ $block['data']['label'] }}{{ $block['data']['requis'] ? '*' : '' }}</label>
                        <textarea id="{{ $block['data']['slug'] }}" wire:model="formData.{{ $block['data']['slug'] }}" class="field -area"></textarea>
                    @break

                    @case('optin')
                        <div class=" @error('formData.' . $block['data']['slug']) -error @enderror">
                            <input id="field_{{ $block['data']['slug'] }}" wire:model="formData.{{ $block['data']['slug'] }}"
                                type="checkbox" value="1" class="field">
                            <label for="field_{{ $block['data']['slug'] }}" class="label">{!! $block['data']['texte'] !!}</label>
                        </div>
                    @break

                    @case('choix')
                        <label class="label" for="field_{{ $block['data']['slug'] }}">{{ $block['data']['label'] }}</label>

                        @switch($block['data']['type'])
                            @case('checkbox')
                            @case('radio')
                                @foreach ($block['data']['valeurs'] as $cle => $valeur)
                                    @php($uniqid = md5(time()) . rand(0, 9999))
                                    <input id="field_{{ $uniqid }}" wire:model="formData.{{ $block['data']['slug'] }}"
                                        type="{{ $block['data']['type'] ?? 'checkbox' }}" class="border" value="{{ $cle }}">
                                    <label
                                        for="field_{{ $uniqid }}">{{ $valeur }}{{ $block['data']['requis'] ? '*' : '' }}</label>
                                @endforeach
                            @break

                            @case('select')
                                <select wire:model="formData.{{ $block['data']['slug'] }}" class="field -select"
                                    id="field_{{ $block['data']['slug'] }}">
                                    @foreach ($block['data']['valeurs'] as $cle => $valeur)
                                        <option value="{{ $cle }}">{{ $valeur }}</option>
                                    @endforeach
                                </select>
                            @break

                            @default
                        @endswitch
                    @break

                    @case('fichier')
                        <label for="{{ $block['data']['slug'] }}"
                            class="label">{{ $block['data']['label'] }}{{ $block['data']['requis'] ? '*' : '' }}</label>
                        <input id="{{ $block['data']['slug'] }}" wire:model="formData.{{ $block['data']['slug'] }}"
                            type="file" class="field">
                    @break

                    @default
                        <label for="{{ $block['data']['slug'] }}"
                            class="label">{{ $block['data']['label'] }}{{ $block['data']['requis'] ? '*' : '' }}</label>
                        <input id="{{ $block['data']['slug'] }}" wire:model="formData.{{ $block['data']['slug'] }}"
                            type="{{ $block['data']['type'] ?? 'text' }}" class="field">
                    @break
                @endswitch

                @error('formData.' . $block['data']['slug']) 
                <p>{{ $message }}</p>
                @enderror
            </div>
        @endforeach
        <div>
            <button type="submit">
                Envoyer
            </button>
        </div>
    </div>


</form>
