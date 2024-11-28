document.addEventListener("DOMContentLoaded", function () {
  const toggleButton = document.getElementById("toggle-tables");
  const buttonContainerContainer = document.querySelector(
    ".button-container-container"
  );

  //initializare si ascundere container butoane
  buttonContainerContainer.style.display = "none";

  toggleButton.addEventListener("click", function (event) {
    event.stopPropagation();
    //verificare container daca este afisat sau nu
    if (
      buttonContainerContainer.style.display === "none" ||
      buttonContainerContainer.style.display === ""
    ) {
      buttonContainerContainer.style.display = "block";
    } else {
      buttonContainerContainer.style.display = "none";
    }
  });

  document.addEventListener("click", function (event) {
    if (
      !buttonContainerContainer.contains(event.target) &&
      event.target !== toggleButton
    ) {
      buttonContainerContainer.style.display = "none";
    }
  });

  buttonContainerContainer.addEventListener("click", function (event) {
    event.stopPropagation();
  });
});
