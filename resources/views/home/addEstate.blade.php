<!DOCTYPE html>
<html lang="en">
<head>
  @include('home.head')

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  </head>
<style>
  /*  choice selector style
   .choices__inner {
    border-radius: 5px;
    border: 1px solid #ced4da;
    padding: 5px;
  }
  .choices__item {
    background-color: #007bff;
    color: #fff;
    border-radius: 15px;
    padding: 5px 10px;
    font-size: 14px;
  }
  .choices__item--remove {
    color: #fff;
  } */
  .tab-content .tab-pane {
  display: none; /* Hide all tab panes by default */
}

.tab-content .tab-pane.show.active {
  display: block; /* Show only the active tab pane */
}

 #image-upload-form{
  text-align: center;
 }
#upload-icon {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  gap: 10px;
  border: 2px dashed #ccc;
  border-radius: 5px;
  transition: background-color 0.3s, border-color 0.3s;
  width: 400px;
  height: 200px;
}

#upload-icon:hover {
  background-color: #f0f0f0;
  border-color: #888;
}
#upload-icon:hover i{
  position: relative;
  scale: 1.4;
  transition: all .3s ease-in-out !important;
}

#upload-icon span{
  font-size: 16px;
  color: #555;
}

#image-preview {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin-top: 20px;
}

.img-container {
  position: relative;
  display: inline-block;
}

#image-preview img {
  max-width: 220px;
  max-height: 200px;
  border: 1px solid #ccc;
  padding: 5px;
  border-radius: 5px;
}

.remove-button {
  position: absolute;
  top: 5px;
  right: 5px;
  background-color: rgba(255, 0, 0, 0.57);
  color: white;
  border: none;
  border-radius: 50%;
  padding: 5px 10px;
  cursor: pointer;
  font-size: 12px;
}

.remove-button:hover {
  background-color: darkred;
}

</style>
<body>

@include('home.navbar')

@if(session()->has('message'))

<div class="alert alert-warning alert-dismissible fade show" role="alert">
  {{session()->get('message')}}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

@endif

<div class="title ml-3" style="margin-top: 140px !important;">
  <h2>Ajouter un immobilier</h2>
</div>

<div class="container mt-3">

  <!-- Form -->
  <div class="tab-content">
    <form id="multiStepForm" action="{{ route('store-estate') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <!-- Step 1 -->
      <div class="tab-pane fade show active" id="step1">
        <div class="row mb-5">
          <div class="col-md-6">
            <label>Type</label>
            <select class="form-control" name="type" required>
              <option value="vente">vente</option>
              <option value="location">location</option>
            </select>
          </div>
          <div class="col-md-6">
            <label>Category</label>
            <select name="category" class="form-control" required>
              <option disabled selected hidden>Selectionner category</option>
              @foreach($data as $item)
                <option value="{{$item->id}}">{{$item->name}}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="row mb-5">
          <div class="col-md-6">
            <label for="">Etage</label>
            <input type="number" class="form-control" name="floor" id="" placeholder="etage">
          </div>
          <div class="col-md-6">
            <label for="">Nombre de pieces</label>
            <input type="number" class="form-control" name="pieces" id="" placeholder="nombre de pieces">
          </div>
        </div>

        <div class="row mb-5">
          <div class="input-group col-md-6 mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text">m2</span>
            </div>
            <input type="number" class="form-control" name="surface" placeholder="superficie">
          </div>
          
          <div class="col-md-6 form-group" style="height: 38px !important;">
            
            <select id="choices-multiple-select" name="specification[]" multiple style="height: 38px !important;">
              <option value="Electrcité">Electrcité</option>
              <option value="Eau">Eau</option>
              <option value="Gaz">Gaz </option>
              <option value="Meublé">Meublé</option>
              <option value="Garage">Garage</option>
              <option value="Jardin">Jardin</option>
            </select>
          </div>  
        </div>
        <div>
          <button type="button" class="btn btn-primary next-step" data-target="#step2">Suivant</button>
        </div>
      </div>

      <!-- Step 2 -->
      <div class="tab-pane fade" id="step2">
      <div class="row">
          <div class="input-group col-md-6 mb-3">
            <input type="number" class="form-control" name="price" placeholder="prix" required>
            <div class="input-group-append">
              <select class="form-control" name="price_unit" required>
                <option>millions</option>
                <option>millions/m2</option>
                <option>milliards</option>
              </select>
            </div>
          </div>
          <div class="col-md-6 mb-3">
            <select id="state" name="state" class="form-control" required>
              <option disabled selected hidden>Selectionner wilaya</option>
            </select>
          </div>
        </div>

        <div class="row">
          
          <div class="col-md-6 mb-3">
            <label for="">Commune</label>
            <input type="text" class="form-control" name="town" placeholder="commune/البلدية" required>
          </div>
          <div class="col-md-6 mb-3">
          <label for="">City</label>
            <input type="text" class="form-control" name="city" id="" placeholder="city">
          </div>
        </div>

        <div class="row mt-2">
          <div class="col-md-12">
            <textarea class="col-md-12" name="description" id="" placeholder="ajouter une description (optionel)"></textarea>
          </div>
        </div>

        <!------ image upload form -------> 
        <div class="mt-5" id="image-upload-form">
          <label for="image-input" id="upload-icon">
            <span><i class="fa-solid fa-cloud-arrow-up" style="font-size: 22px;"></i></span> <br>
            <span>Charger les images</span>
          </label>
          <input type="file" id="image-input" name="images[]" accept="image/*" multiple hidden required>
          <div id="image-preview"></div>
        </div>  


        <button type="button" class="btn btn-secondary prev-step" data-target="#step1">Retour</button>
        <button type="button" class="btn btn-primary next-step" data-target="#step3">Suivant</button>
      </div>

      <!-- Step 3 -->
      <div class="tab-pane fade" id="step3">
        <div class="form-group">
          <label for="tel"><i class="text-success fa-solid fa-phone"></i> Telephone</label>
          <input type="tel" class="form-control" name="phone" pattern="[0-9]+"  placeholder="votre numéro (0555 66 55 66)" required >
        </div>
        <button type="button" class="btn btn-secondary prev-step" data-target="#step2">Retour</button>
        <button type="submit" class="btn btn-success">Confirmer l'annonce</button>
      </div>
    </form>
  </div>
</div>


<footer>
  <div class="container" style="position: sticky; bottom: 0 ;">
    <div class="row">
      <div class="col-md-12">          
        <div class="copyright-footer">
          <p class="copyright color-text-a">
            &copy; Copyright
            <span class="color-a">EstateAgency</span> All Rights Reserved.
          </p>
        </div>
        <div class="credits">
          <!--
            All the links in the footer should remain intact.
            You can delete the links only if you purchased the pro version.
            Licensing information: https://bootstrapmade.com/license/
            Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=EstateAgency
          -->
          Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
      </div>
    </div>
  </div>
</footer>
  <!--/ Footer End /-->

  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
  <div id="preloader"></div>

  <!-- JavaScript Libraries -->
  <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/jquery/jquery-migrate.min.js"></script>
  <script src="lib/popper/popper.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.min.js"></script>
  <script src="lib/easing/easing.min.js"></script>
  <script src="lib/owlcarousel/owl.carousel.min.js"></script>
  <script src="lib/scrollreveal/scrollreveal.min.js"></script>
  <!-- Contact Form JavaScript File -->
  <script src="contactform/contactform.js"></script>

  <!-- Template Main Javascript File -->
  <script src="js/main.js"></script>

  
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>


<script>
 /* -- input select multiple script ------ */
  document.addEventListener('DOMContentLoaded', function () {
    const element = document.getElementById('choices-multiple-select');
    new Choices(element, {
      removeItemButton: true, // Adds an 'X' button to remove a selected item
      placeholder: true,
      placeholderValue: 'Selectioner',
      searchPlaceholderValue: 'Search...',
    });
  });

/* --- stepper script ---*/
  document.addEventListener('DOMContentLoaded', function () {
  const form = document.getElementById('multiStepForm');

  form.addEventListener('click', function (e) {
    // Handle Next Step
    if (e.target.classList.contains('next-step')) {
      e.preventDefault();
      const nextTab = document.querySelector(e.target.getAttribute('data-target'));
      if (nextTab) {
        document.querySelector('.tab-pane.show.active').classList.remove('show', 'active');
        nextTab.classList.add('show', 'active');
      }
    }

    // --- Handle Previous Step ---
    if (e.target.classList.contains('prev-step')) {
      e.preventDefault();
      const prevTab = document.querySelector(e.target.getAttribute('data-target'));
      if (prevTab) {
        document.querySelector('.tab-pane.show.active').classList.remove('show', 'active');
        prevTab.classList.add('show', 'active');
      }
    }
  });
});

/* ----- load and preview images ----*/

document.getElementById("image-input").addEventListener("change", function (event) {
  const previewContainer = document.getElementById("image-preview");

  const files = event.target.files;

  Array.from(files).forEach((file) => {
    if (file && file.type.startsWith("image/")) {
      const reader = new FileReader();

      reader.onload = function (e) {
        // Create a container for each image and its remove button
        const imgContainer = document.createElement("div");
        imgContainer.classList.add("img-container");

        const imgElement = document.createElement("img");
        imgElement.src = e.target.result;

        const removeButton = document.createElement("button");
        removeButton.textContent = "X";
        removeButton.classList.add("remove-button");

        // Add click event to remove the image
        removeButton.addEventListener("click", () => {
          imgContainer.remove();
        });

        // Append image and button to the container
        imgContainer.appendChild(imgElement);
        imgContainer.appendChild(removeButton);

        // Append the container to the preview area
        previewContainer.appendChild(imgContainer);
      };

      reader.readAsDataURL(file); // Read file as Data URL
    } else {
      alert("Please select a valid image file.");
    }
  });
});

// ------- load states
document.addEventListener('DOMContentLoaded', function () {
  // List of states
  const states = [
    "Adrar", "Chlef", "Laghouat", "Oum El Bouaghi", "Batna", "Béjaïa",
    "Biskra", "Béchar", "Blida", "Bouira", "Tamanrasset", "Tébessa",
    "Tlemcen", "Tiaret", "Tizi Ouzou", "Alger", "Djelfa", "Jijel",
    "Sétif", "Saïda", "Skikda", "Sidi Bel Abbès", "Annaba", "Guelma",
    "Constantine", "Médéa", "Mostaganem", "M'Sila", "Mascara", "Ouargla",
    "Oran", "El Bayadh", "Illizi", "Bordj Bou Arréridj", "Boumerdès",
    "El Tarf", "Tindouf", "Tissemsilt", "El Oued", "Khenchela",
    "Souk Ahras", "Tipaza", "Mila", "Aïn Defla", "Naâma", "Aïn Témouchent",
    "Ghardaïa", "Relizane", "Timimoun", "Bordj Badji Mokhtar",
    "Ouled Djellal", "Béni Abbès", "In Salah", "In Guezzam",
    "Touggourt", "Djanet", "El M'Ghair", "El Menia"
   ]; 

  const stateSelect = document.getElementById('state');

  // Populate the dropdown
  states.forEach(state => {
    const option = document.createElement('option');
    option.value = state;
    option.textContent = state;
    stateSelect.appendChild(option);
  });
});

</script>

</body>
</html>
