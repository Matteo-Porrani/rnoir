
const verifs = document.getElementsByClassName('book-activation-verif');
const switches = document.getElementsByClassName('book-activation-switch');
const alertSection = document.getElementById('bookActivationAlert');

let unregisteredChanges = false;

const getStates = () => {
  for (const item of verifs) {
    const toggle = document.getElementById('switch-' + item.name);
    // console.log(item.name + " / " + toggle.checked);

    if (toggle.checked) {
      item.value = 'ACT';
    } else {
      item.value = 'DEA';
    }
  }

  if (unregisteredChanges) {
    alertSection.classList.remove('d-none');
  }
}

getStates();


for (const item of switches) {
  item.addEventListener('change', () => {
    unregisteredChanges = true;

    getStates();
  });
}







