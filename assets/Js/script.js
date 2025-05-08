function toggleIcon(button) {
  const icon = button.querySelector(".navbar-toggler-ico");
  const expanded = button.getAttribute("aria-expanded") === "true";
  if (expanded) {
    icon.innerHTML = '<i class="fa fa-times"></i>'; // Change to close icon
    button.setAttribute("aria-expanded", "false");
  } else {
    icon.innerHTML = '<i class="fa fa-bars"></i>'; // Change to menu icon
    button.setAttribute("aria-expanded", "true");
  }
}


