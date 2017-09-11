var selection = document.querySelector('#select_article');

selection.onchange = function () {
  var val = selection.options[selection.selectedIndex].value;
  document.querySelector('#form_one_art').submit()
}
