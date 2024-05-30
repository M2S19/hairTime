@extends('layouts.app')

@section('title', 'Ajouter vos Service')

@section('content')

<div class="container mt-4">
    <h1>Quels services proposez-vous dans votre salon ?</h1>
    <form action="{{route('ajouterServiceStore')}}" method="POST">
        @csrf
        <div id="servicesList" class="row">
            <div class="mb-3">
                <h2>Service</h2>
                <select name="services[0]" class="form-select">
                    <option value="">Sélectionnez un service</option>
                    @foreach($services as $service)
                        <option value="{{ $service->id}}">{{$service->nom}}</option>             
                    @endforeach                                       
                </select>
                <div class="row">
                  {{--   <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="Homme" name="Homme" value="Homme" checked>
                        <label class="form-check-label">Homme</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="Femme" name="Femme" value="Femme" checked>
                        <label class="form-check-label">Femme</label>
                    </div> --}}
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="Homme0" name="Homme[0]" value="Homme" checked>
                        <label class="form-check-label" for="Homme0">Homme</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="Femme0" name="Femme[0]" value="Femme" checked>
                        <label class="form-check-label" for="Femme0">Femme</label>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="duree" class="form-label">Durée :</label>
                        <input type="time" class="form-control" id="duree" placeholder="Durée de la prestation" name="duree[0]" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="prenom" class="form-label">Prix :</label>
                        <input type="float" class="form-control" id="prix"placeholder="Prix de le prestation" name="prix[0]" required>
                    </div>
                </div>
                <label for="description" class="form-label">Description</label>
                <input type="text" class="form-control" id="description" placeholder="Description de votre service" name="description[0]">
            </div>
        </div>
        <button type="button" id="addServiceBtn" class="btn btn-primary mb-3">Ajouter un service</button>
        <button type="submit" class="btn btn-success">Enregistrer les services</button>
    </form>
</div>
<script>
    /*
document.getElementById('addServiceBtn').addEventListener('click', function() {
    const servicesList = document.getElementById('servicesList');
    const newService = servicesList.firstElementChild.cloneNode(true);
    const newIndex = servicesList.children.length; // Get the new index based on the number of current children

    // Update names with the new index to ensure unique array entries
    newService.querySelector('select[name="services[0]"]').setAttribute('name', `services[${newIndex}]`);
    newService.querySelector('input[id="duree"]').setAttribute('name', `duree[${newIndex}]`);
    newService.querySelector('input[id="prix"]').setAttribute('name', `prix[${newIndex}]`);
    newService.querySelector('input[id="description"]').setAttribute('name', `description[${newIndex}]`);
    
    // Reset values for the new fields
    newService.querySelector('select').selectedIndex = 0;
    newService.querySelector('input[name^="duree"]').value = '';
    newService.querySelector('input[name^="prix"]').value = '';
    newService.querySelector('input[name^="description"]').value = '';
    newService.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
        checkbox.checked = false; // Reset checkboxes
    });

    // Append the new service to the list
    servicesList.appendChild(newService); 
}); */

document.getElementById('addServiceBtn').addEventListener('click', function() {
    const servicesList = document.getElementById('servicesList');
    const newService = servicesList.firstElementChild.cloneNode(true);
    const newIndex = servicesList.children.length; // Get the new index based on the number of current children

    // Ensuring we're cloning the correct element
    if (!newService) {
        console.error('No service found to clone.');
        return;
    }

    // Update names with the new index to ensure unique array entries
    newService.querySelectorAll('select, input').forEach(element => {
        if (element.name) {
            element.name = element.name.replace(/\[\d*\]/, `[${newIndex}]`);
        }
        if (element.type === 'checkbox') {
            element.checked = false; // Reset checkboxes
        } else if (element.type === 'text' || element.type === 'time' || element.type === 'number') {
            element.value = ''; // Reset input values
        }
    });

    // Reset checkboxes and update their IDs and corresponding labels
    newService.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
        const baseId = checkbox.id.replace(/\d+$/, '');
        checkbox.id = `${baseId}${newIndex}`;
        const label = newService.querySelector(`label[for="${baseId}"]`);
        if (label) {
            label.setAttribute('for', checkbox.id);
        }
    });

    // Append the new service to the list
    servicesList.appendChild(newService);
});


    </script>
    
@endsection