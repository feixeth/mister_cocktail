// Import dept
import { capitalize } from '../utils/functions.js'

// Action Remove Dashboard
function removeCocktail(e) {
  // On récupère depuis l'Event, l'objet HTML qui a déclenché le click
  // Sur lequel on récupère la valeur de son data-attribut (data-id)
  const id = e.currentTarget.dataset.id
  // Test if int
  if (!isNaN(id)) {
    // Test de confirmation
    const isValid = confirm('Voulez-vous vraiment supprimer le cocktail ?')
    if (isValid) {
      fetch(`index.php?page=del_cocktail&id=${id}`)
        .then(response => response.json())
        .then(data => {
          // Display notif OK <=> KO
          if (data.hasOwnProperty('success')) {
            // Update crud cocktail
            const $table = document.querySelector('#cocktail_crud tbody')
            // Empty table
            $table.innerHTML = ''
            // Refill
            data.cocktails.map(cocktail => {
              $table.insertAdjacentHTML('afterbegin', `
                <tr>
                    <td class="text-center text-muted">${cocktail.id}</td>
                    <td>
                        <div class="widget-content p-0">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left flex2">
                                    <div class="">${cocktail.name}</div>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="text-center">
                        <div class="text-muted">${capitalize(cocktail.alcool)}</div>
                    </td>
                    <td class="text-center">
                        <a href="index.php?page=edit_cocktail?id=${cocktail.id}" class="btn btn-primary btn-sm">Edit</a>
                        <a href="#" id='del_${cocktail.id}' data-id='${cocktail.id}' class="btn btn-danger btn-sm">Del</a>
                    </td>
                </tr>
              `)
            })
            // Update total recipes
            document.getElementById('recipes_count').innerHTML = data.cocktails.length
          } else {
            // Afficher le message d'erreur
            console.error(data.error);
          }
        })
    }
  }
}

function showAddAlcohol() {
  document.querySelector('#form_alcohol').classList.remove('hide')
}

function showAddIngredient() {
  document.querySelector('#form_ingredient').classList.remove('hide')
}

function addAlcohol(e) {
  // Block auto refresh
  e.preventDefault()

  const form = new FormData(this)
  // fetch add_alcohol
  fetch('index.php?page=add_alcohol', {
    method: 'POST',
    body: form
  })
    .then(response => response.json())
    .then(data => {
      if (data.hasOwnProperty('success')) {
        // Update nb alcohol
        document.querySelector('#alcohols_count').innerHTML = data.alcohols.length
        // Update crud alcohol
        const $table = document.querySelector('#alcohol_crud tbody')
        // Empty table
        $table.innerHTML = ''
        // Refill
        data.alcohols.map(alcohol => {
          // Empty old list
          $table.insertAdjacentHTML('afterend',
            `
          <tr>
              <td class="text-center text-muted">${alcohol.id}</td>
              <td>
                  <div class="widget-content p-0">
                      <div class="widget-content-wrapper">
                          <div class="widget-content-left flex2">
                              <div class="">${capitalize(alcohol.name)}</div>
                          </div>
                      </div>
                  </div>
              </td>
              <td class="text-center">
                  <a href="index.php?page=edit_alcohol?id=<${alcohol.id}" class="btn btn-primary btn-sm">Edit</a>
                  <a href="#" id='del_<${alcohol.id}' data-id='<${alcohol.id}' class="btn btn-danger btn-sm">Del</a>
              </td>
          </tr>
        `)
        })
      } else {
        console.error('error', data.error);
      }
    })
}

function addIngredient(e) {
  e.preventDefault()
  const form = new FormData(this)
  // fetch add_Ingredient
  fetch('index.php?page=add_ingredient', {
    method: 'POST',
    body: form
  })
    .then(response => response.json())
    .then(data => {
      if (data.hasOwnProperty('success')) {
        // Update nb alcohol
        document.querySelector('#ingredients_count').innerHTML = data.ingredients.length
        // Update crud ingredient
        const $table = document.querySelector('#ingredient_crud tbody')
        // Empty table
        $table.innerHTML = ''
        console.log('les ingredients:', data.ingredients);
        // Refill
        data.ingredients.forEach(ingredient => {
          console.log('Ingredient', ingredient);
          // Empty old list
          $table.insertAdjacentHTML('afterend',
            `<tr>
                <td class="text-center text-muted">${ingredient.id}</td>
                <td>
                    <div class="widget-content p-0">
                        <div class="widget-content-wrapper">
                            <div class="widget-content-left flex2">
                                <div class="">${capitalize(ingredient.name)}</div>
                            </div>
                        </div>
                    </div>
                </td>
                <td class="text-center">
                    <a href="index.php?page=edit_ingredient?id=<${ingredient.id}" class="btn btn-primary btn-sm">Edit</a>
                    <a href="#" id='del_<${ingredient.id}' data-id='<${ingredient.id}' class="btn btn-danger btn-sm">Del</a>
                </td>
            </tr>`
          )
        })
      } else {
        console.error('error', data.error);
      }
    })
}

export {
  removeCocktail, showAddAlcohol, showAddIngredient, addAlcohol, addIngredient
}