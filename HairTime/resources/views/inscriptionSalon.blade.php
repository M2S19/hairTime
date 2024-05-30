@extends('layouts.app')

@section('title', 'Ajouter un salon')

@section('content')

    <form action="{{route('inscriptionSalonStore')}}" method="POST" enctype="multipart/form-data">
        @csrf


            <label for="nom" class="form-label">Nom de votre salon</label>
            <input type="text" class="form-control" id="nom" placeholder="Entrer le nom de votre salon" name="nom" required>
        
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="nom" class="form-label">Adresse :</label>
                <input type="text" class="form-control" id="adresse" placeholder="Adresse du salon" name="adresse" required>
            </div>
            @if ($errors->has('adresse'))
            <div class="alert alert-danger">
            {{ $errors->first('adresse') }}
            </div>
            @endif
            <div class="col-md-6 mb-3">
                <label for="prenom" class="form-label">Ville :</label>
                <input type="text" class="form-control" id="ville" placeholder="Ville du salon" name="ville" required>
            </div>
        </div>
        <div id="file-inputs">
            <div>
                <label for="photos" class="form-label">Inserer une photo de votre salon</label>
                <input type="file" class="form-control" id="photos" placeholder="Inserer une photo de votre salon" name="photos[]" multiple onchange="addNewFileInput();"><br>
            </div>
        </div>
        <div>
            <h3>Ajouter une description à votre salon</h3>
            <div class="col-md-6 mb-3">
                <textarea name="description" class="form-control" rows="5" placeholder="Décrivez vous, le salon, l'ambiance de votre salon etc."></textarea>
            </div>  
        </div>

        <button type="submit" class="btn btn-primary">Suivant</button>
    </form>

</div>

<script>
    let fileInputCount = 1;

    function addNewFileInput() {
        const lastInput = document.querySelector('#file-inputs input[type="file"]:last-of-type');
        if (lastInput && lastInput.value === "") {
            return; // Ne rien faire si le dernier champ de fichier est vide
        }

        const newInput = document.createElement('input');
        newInput.type = 'file';
        newInput.className = 'form-control';
        newInput.name = 'photos[]';
        newInput.id = 'photos' + fileInputCount;
        fileInputCount++;

        const newDiv = document.createElement('div');
        newDiv.appendChild(newInput);
        document.getElementById('file-inputs').appendChild(newDiv);
    }
</script>

@endsection