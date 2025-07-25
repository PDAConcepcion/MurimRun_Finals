/**
 * Handles showing and hiding tables based on the selected category.
 * Also hides/disables checkboxes by default when switching categories.
 */
function showCategory(category) {
  const userTable = document.getElementById("users");
  const deliveryTable = document.getElementById("deliveries");
  const sectCouriersTable = document.getElementById("sectcouriers");

  if (userTable) userTable.style.display = "none";
  if (deliveryTable) deliveryTable.style.display = "none";
  if (sectCouriersTable) sectCouriersTable.style.display = "none";
  
  // Show the selected table
  if (category === "users" && userTable) {
    userTable.style.display = "table";
  } else if (category === "deliveries" && deliveryTable) {
    deliveryTable.style.display = "table";
  } else if (category === "sectcouriers" && sectCouriersTable) {
    sectCouriersTable.style.display = "table";
  }
}

// For add/delete button function and single selection logic
document.addEventListener("DOMContentLoaded", function () {
  const addBtn = document.getElementById("addBtn");
  const deleteBtn = document.getElementById("deleteBtn");
  const selectAll = document.getElementById("selectAll");
  const userTable = document.getElementById("users");

  /**
   * Shows or hides the user checkboxes and enables/disables them.
   * @param {boolean} show - Whether to show and enable checkboxes.
   */
  function toggleCheckboxes(show) {
    const headers = userTable.querySelectorAll(".select-header");
    const cells = userTable.querySelectorAll(".select-cell");
    const checkboxes = userTable.querySelectorAll(".select-cell input");

    headers.forEach((header) => (header.style.display = show ? "" : "none"));
    cells.forEach((cell) => (cell.style.display = show ? "" : "none"));
    checkboxes.forEach((cb) => (cb.disabled = !show));

    if (selectAll) {
      selectAll.disabled = !show;
      selectAll.checked = false;
    }
  }

  // Show checkboxes when Add or Delete is clicked
  addBtn.addEventListener("click", () => {
    toggleCheckboxes(true);
  });

  deleteBtn.addEventListener("click", () => {
    toggleCheckboxes(true);
  });

  // Handle "Select All" checkbox for users table
  if (selectAll) {
    selectAll.addEventListener("change", function () {
      const checkboxes = userTable.querySelectorAll(
        ".select-cell input:not(:disabled)"
      );
      checkboxes.forEach((cb) => {
        cb.checked = this.checked;
      });
    });
  }
});