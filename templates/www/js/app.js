// import dependances
import {
  removeCocktail, showAddAlcohol, showAddIngredient, addAlcohol, addIngredient
} from "./callback/dashboard.js";

document.addEventListener('DOMContentLoaded', function () {
  // Notifs globals
  const $notifs = document.querySelectorAll('.alert')

  // Hide notif after 3 sec
  $notifs.forEach(notif => {
    setTimeout(e => notif.classList.add('hide'), 3000)
  })

  // DashBoard
  const $dashBtnDel = document.querySelectorAll('[id^=del_]')
  const $dashBtnAdd = document.querySelectorAll('[id^=add_]')
  const $dashFormAdd = document.querySelectorAll('form[id^=form_]')

  // Listen Remove cocktail
  if ($dashBtnDel.length !== 0) {
    $dashBtnDel.forEach(btnDel => {
      // Optimize for all delBtn => dispatch switch cocktail/ingredient/alcohol
      // Listen One by One
      btnDel.addEventListener('click', removeCocktail)
    })
  }
  // Display Forms
  if ($dashBtnAdd.length !== 0) {
    $dashBtnAdd.forEach(btnAdd => {
      // Optimize for all delBtn => dispatch switch cocktail/ingredient/alcohol
      const callMethod = btnAdd.id
      if (callMethod == 'add_alcohol') {
        // Listen One by One
        btnAdd.addEventListener('click', showAddAlcohol)
      } else if (callMethod == 'add_ingredient') {
        // Listen One by One
        btnAdd.addEventListener('click', showAddIngredient)
      }
    })
  }
  // Submit forms
  if ($dashFormAdd.length !== 0) {
    $dashFormAdd.forEach(formAdd => {
      // Optimize for all delBtn => dispatch switch cocktail/ingredient/alcohol
      const callMethod = formAdd.id
      if (callMethod == 'form_alcohol') {
        // Listen One by One
        formAdd.addEventListener('submit', addAlcohol)
      } else if (callMethod == 'form_ingredient') {
        // Listen One by One
        formAdd.addEventListener('submit', addIngredient)
      }
    })
  }
})